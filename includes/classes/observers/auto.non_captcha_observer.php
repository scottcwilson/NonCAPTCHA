<?php
/**
 * @package plugins nonCAPTCHA
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Designed for v1.5.6x  PHP7.3.x
 *
 * Observer class used to auto reset field names for nonCAPTCHA
 * @copyright Copyright 2019 CowboyGeek.com Development Team
 * @version $Id: auto.nonCAPTCHA_obs.php V0.05 4 6/13/2019 0600 davewest $
 * @path includes/classes/observers/auto.nonCAPTCHA_obs.php
 */

class zcObserverNonCaptchaObserver extends base
{
    /**
     * Set to the number of days before auto-changing field names. Default is 10
     * @var integer
     */
    protected $max_days = 10; 

    public function __construct()
    {
        $this->attach($this, [
            'NOTIFY_NONCAPTCHA_CHECK',
            'NOTIFY_CREATE_ACCOUNT_CAPTCHA_CHECK',
            'NOTIFY_CONTACT_US_CAPTCHA_CHECK',
            'NOTIFY_REVIEWS_WRITE_CAPTCHA_CHECK',
        ]);
    }

    public function updateNotifyCreateAccountCaptchaCheck(&$class, $eventID, $paramsArray)
    {       
       
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        $this->testSliderFields('create_account');
    }

    public function updateNotifyContactUsCaptchaCheck(&$class, $eventID, $paramsArray)
    {
        // sanitize the name field more aggressively
        $GLOBALS['name'] = zen_db_prepare_input(zen_sanitize_string($_POST['contactname']));

        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        $this->testSliderFields('contact');
    }

    public function updateNotifyReviewsWriteCaptchaCheck(&$class, $eventID, $paramsArray)
    {
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        $this->testSliderFields('review_text');
    }

    // generic fallback notifier watcher
    public function update(&$class, $eventID, $paramsArray)
    {
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        $this->testSliderFields('header');
    }

    protected function testAntiSpamFields()
    {
        if (defined('SPAM_TEST_TEXT') && defined('SPAM_TEST_USER')) {
            $GLOBALS['antiSpam'] .= isset($_POST[SPAM_TEST_TEXT]) ? zen_db_prepare_input($_POST[SPAM_TEST_TEXT]) : '';
            $GLOBALS['antiSpam'] .= isset($_POST[SPAM_TEST_USER]) ? zen_db_prepare_input($_POST[SPAM_TEST_USER]) : '';
        }
    }

    protected function testSliderFields($messageStackLocation = 'header')
    {
        if (defined('SPAM_USE_SLIDER') && SPAM_USE_SLIDER == 'true') {
            $humanTest = zen_db_prepare_input($_POST[SPAM_TEST_IQ]);
            if ($humanTest != SPAM_TEST) {
                $GLOBALS['messageStack']->add($messageStackLocation, SPAM_ERROR, 'error');
                $GLOBALS['error'] = true;
            }
        }
    }

    protected function rotateHoneypotFieldNames()
    {
        global $db;

        $check_date = $db->Execute("SELECT date_format(date_added, '%Y-%m-%d') as last_changed_date FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPAM_TEST_TEXT' ");

        $now = time(); //current date-time
        $last_changed_date = strtotime($check_date->fields['last_changed_date']);
        $datediff = $now - $last_changed_date;

        $days_since = round($datediff / (60 * 60 * 24));

        if ($days_since >= $this->max_days) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  //do numbers, lower case, upper case

            $spam_text = $this->generate_random_string($permitted_chars, 10);  // setting 10 as the length for the field name
            $spam_user = $this->generate_random_string($permitted_chars, 10);
            $spam_iq = $this->generate_random_string($permitted_chars, 10);

            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_text . "'  WHERE configuration_key = 'SPAM_TEST_TEXT'");
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_user . "'  WHERE configuration_key = 'SPAM_TEST_USER'");
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_iq . "'  WHERE configuration_key = 'SPAM_TEST_IQ'");
        }
    }

    protected function generate_random_string($input, $strength = 16)
    {
        $function = PHP_VERSION_ID >= 70000 ? 'random_int' : 'mt_rand';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[$function(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
    
    protected function testURLSpam()
    {
        /* This Regular Expression filter only does 'http://www.mysite.com'
         * $reg_exUrl = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
         *
         * This regular Expression filter does
         * www.google.com
         * http://www.google.com
         * mailto:somebody@google.com
         * somebody@google.com
         * www.url-with-querystring.com/?url=has-querystring
         **/
        $reg_exUrl = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+(:[0-9]+)?|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/';
        
        // The Text you want to filter for urls, most common input fields used
        $text = '';
        //create account, no account, one page checkout, regester account, ask a question, contact us 
        $text .= (!empty($_POST['firstname']) ? $_POST['firstname'] .  ' ' : '');
        $text .= (!empty($_POST['lastname']) ? $_POST['lastname'] .  ' ' : '');
        $text .= (!empty($_POST['contactname']) ? $_POST['contactname'] .  ' ' : '');
        $text .= (!empty($_POST['company']) ? $_POST['company'] .  ' ' : '');
        $text .= (!empty($_POST['street_address']) ? $_POST['street_address'] .  ' ' : '');
        $text .= (!empty($_POST['suburb']) ? $_POST['suburb'] .  ' ' : '');
        $text .= (!empty($_POST['city']) ? $_POST['city'] .  ' ' : '');
        $text .= (!empty($_POST['enquiry']) ? $_POST['enquiry'] .  ' ' : '');
        //links manager
        $text .= (!empty($_POST['links_title']) ? $_POST['links_title'] .  ' ' : '');
        // Testimonials Manager
        $text .= (!empty($_POST['feedback']) ? $_POST['feedback'] .  ' ' : '');
        $text .= (!empty($_POST['testimonials_name']) ? $_POST['testimonials_name'] .  ' ' : '');
        $text .= (!empty($_POST['testimonials_title']) ? $_POST['testimonials_title'] .  ' ' : '');
        $text .= (!empty($_POST['testimonials_html_text']) ? $_POST['testimonials_html_text'] .  ' ' : '');
        $text .= (!empty($_POST['telephone']) ? $_POST['telephone'] .  ' ' : '');
        //Tell a Friend, I still use this one..
        $text .= (!empty($_POST['to_name']) ? $_POST['to_name'] .  ' ' : '');
        $text .= (!empty($_POST['to_name']) ? $_POST['to_name'] .  ' ' : '');
        //reviews
        $text .= (!empty($_POST['review_text']) ? $_POST['review_text'] .  ' ' : '');
        //password hint -- subject fields
        $text .= (!empty($_POST['passwordhintA']) ? $_POST['passwordhintA'] .  ' ' : '');
        $text .= (!empty($_POST['subject']) ? $_POST['subject'] : '');

        // Check if there is a url in the text
        if(preg_match($reg_exUrl, $text)) {
        
        // We have a url spam
         $GLOBALS['antiSpam'] = 'html spam detected';
        }
        
        // if no urls in the text strip and return
        $text = '';
        return ;
    
    }

}

