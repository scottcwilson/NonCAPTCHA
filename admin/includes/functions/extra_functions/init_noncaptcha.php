<?php
/*
 * Non-CAPTCHA Spam test and hidden tests
 * Configuration installer only
 *
 * @copyright Copyright 2018 cowboygeek.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @Version int_noncaptcha.php 2 2019-05-20 10:30:40Z davewest $
 * 
 */
 
if (!defined('SPAM_TEST_TEXT')) {
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Hidden input field name.', 'SPAM_TEST_TEXT', 'should_be_13', 'You should change this field name like &quot;sams_cat&quot;.', '19', '501', now(), NULL, NULL)"
    );

    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Hidden radio field name.', 'SPAM_TEST_USER', 'should_be_14', 'You should change this field name like &quot;sams_dog&quot;.', '19', '502', now(), NULL, NULL)"
    );

    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'CAPTCHA field name.', 'SPAM_TEST_IQ', 'should_be_15', 'You should change this field name like &quot;sams_iq&quot;.', '19', '503', now(), NULL, NULL)"
    );
    
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Select a test number', 'SPAM_TEST', '10', 'Choose a number between the minimum and maximum of your slider.', '19', '504', now(), NULL, NULL)"
    );

    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Slider Question Text.', 'HUMAN_TEXT_DISPLAYED', 'Are you Human? Slide to Human..', 'Enter your slider question text.', '19', '505', now(), NULL, NULL)"
    );
    
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Radio hidden display text.', 'HUMAN_TEXT_NOT_DISPLAYED', 'To prevent Spam we ask if you are a human or a computer.<br />If for some reason you are reading this line.<br /><b>Do not Answer!</b>', 'Very impotent to display text to explain what not to do here if the css hide fails.', '19', '506', now(), NULL, NULL)"
    );
    
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Slider error message if wrong.', 'SPAM_ERROR', 'You don\'t seem to be Human yet!', 'This is the message displayed if the slider is wrong!', '19', '507', now(), NULL, NULL)"
    );

    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Use Spam Slider.', 'SPAM_USE_SLIDER', 'true', 'Enable the question slider! All hidden tests still work.', '19', '508', now(), NULL, 'zen_cfg_select_option (array(\'true\', \'false\'), ')"
    );
    
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " 
            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) 
         VALUES 
            ( 'Slider answer message.', 'SPAM_ANSWER', 'Human', 'This is the Answer to the slider question!', '19', '509', now(), NULL, NULL)"
    );
}

