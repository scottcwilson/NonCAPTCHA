<?php
/**
 * Tell a Friend
 *
 * @package page
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: davewest  04-12-2019 2 Modified for v1.5.6 $
 */

// spam deterrents
define('TELL_A_FRIEND_SPAM_THROTTLE_TIMER', 90); // can't send tell-a-friend messages more frequently than this many seconds
define('TELL_A_FRIEND_SPAM_BOOT_THRESHOLD', 2); // can't send more than this many tell-a-friend messages before being logged out

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_TELL_A_FRIEND');

//log on users only can send emails
if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}


$valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = "select pd.products_name, p.products_image, p.products_model
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_status = '1'
                           and p.products_id = '" . (int)$_GET['products_id'] . "'
                           and p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $product_info = $db->Execute($product_info_query);

    if ($product_info->RecordCount() > 0) {
      $valid_product = true;
    }
  }

  if ($valid_product == false) {
    zen_redirect(zen_href_link(zen_get_info_page((int)$_GET['products_id']), 'products_id=' . (int)$_GET['products_id']));
  }

require DIR_WS_MODULES . zen_get_module_directory('require_languages.php');

// default email and name of customer
  $sql = "SELECT *
          FROM " . TABLE_CUSTOMERS . "
          WHERE customers_id = :customersID";

  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
  $check_customer = $db->Execute($sql);
  
  $email_address = $check_customer->fields['customers_email_address'];
  $name= $check_customer->fields['customers_firstname'];


$error = false;
if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
   
  if (isset($_SESSION['tell_friend_timeout']) && ((int)$_SESSION['tell_friend_timeout'] + TELL_A_FRIEND_SPAM_THROTTLE_TIMER) > time()) $error = true;

  $to_email_address = zen_db_prepare_input($_POST['to-email-address']);
  $to_name = zen_db_prepare_input(zen_sanitize_string($_POST['to_name']));

     $zco_notifier->notify('NOTIFY_NONCAPTCHA_CHECK');

  $enquiry = zen_db_prepare_input(strip_tags($_POST['enquiry']));
  

  if ($email_address == $to_email_address) {
    $error = true;
    $to_email_error = 'Please don\'t send to yourself!';
  }
  
  if (!zen_validate_email($to_email_address)) {
    $error = true;
     $to_email_error = ERROR_TO_ADDRESS;
  }
  if (($zc_validate_email == TRUE) && (BLOCK_EMAIL_STATUS == 'true')) {  //added for blockemail mod
    if (!zc_validate_blockemail($to_email_address)) {
    $error = true;
    $to_email_error = ERROR_BLOCKTO_ADDRESS;
    }
  }
    if (strlen($enquiry) < 10) {
    $error = true;
     $entry_description_error = 'Need more then 10 characters!';
  }
    if (strlen($enquiry) > 200) {
    $error = true;
     $entry_description_error = 'Need less then 200 characters!';
  }


  if ($error == false) {
   // if anti-spam is not triggered, prepare and send email:
   if ($antiSpam != '') {
      $zco_notifier->notify('NOTIFY_SPAM_DETECTED_USING_CONTACT_US');
   } elseif ($antiSpam == '')  {
    $email_subject = sprintf(EMAIL_FRIEND_SUBJECT, $name, STORE_NAME);
    $email_body = sprintf(EMAIL_TEXT_GREET, $to_name);
    $email_body .= sprintf(EMAIL_TEXT_INTRO,$name, $product_info->fields['products_name'], STORE_NAME) . "\n\n";
    $html_msg['EMAIL_GREET'] = str_replace('\n','',sprintf(EMAIL_TEXT_GREET, $to_name));
    $html_msg['EMAIL_INTRO'] = sprintf(EMAIL_TEXT_INTRO,$name, $product_info->fields['products_name'], STORE_NAME);

    if (zen_not_null($enquiry)) {
      $email_body .= sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $name)  . "\n\n";
      $email_body .= strip_tags($enquiry) . "\n\n" . EMAIL_SEPARATOR . "\n\n";
      $html_msg['EMAIL_MESSAGE_HTML'] = sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $name).'<br />';
      $html_msg['EMAIL_MESSAGE_HTML'] .= strip_tags($enquiry);
    } else {
      $email_body .= '';
      $html_msg['EMAIL_MESSAGE_HTML'] = '';
    }

    $email_body .= sprintf(EMAIL_TEXT_LINK, zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']), '', false) . "\n\n" .
    sprintf(EMAIL_TEXT_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

    $html_msg['EMAIL_TEXT_HEADER'] = EMAIL_TEXT_HEADER;
    $html_msg['EMAIL_PRODUCT_LINK'] = sprintf(str_replace('\n\n','<br />',EMAIL_TEXT_LINK), '<a href="'.zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']).'">'.$product_info->fields['products_name'].'</a>' , '', false);
    $html_msg['EMAIL_TEXT_SIGNATURE'] = sprintf(str_replace('\n','',EMAIL_TEXT_SIGNATURE), '' );

    // include disclaimer
    $email_body .= "\n\n" . EMAIL_ADVISORY . "\n\n";
    $html_msg['EMAIL_ADVISORY'] = EMAIL_ADVISORY;

    //send the email
    zen_mail($to_name, $to_email_address, $email_subject, $email_body, $name, $email_address, $html_msg, 'tell_a_friend');

    // limit spam/slamming
    $_SESSION['tell_friend_timeout'] = time();
    $_SESSION['tell_friend_boot']++;

    // send additional emails
    if (SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS == '1' and SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO !='')  {

      $extra_info=email_collect_extra_info($to_name, $to_email_address, $name, $email_address );

      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
      zen_mail('', SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO, SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT . ' ' . $email_subject,
      $email_body . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'tell_a_friend_extra');
    } //endif send extra emails
    

    $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info->fields['products_name'], zen_output_string_protected($to_name)), 'success');
    if ($_SESSION['tell_friend_boot'] > TELL_A_FRIEND_SPAM_BOOT_THRESHOLD) {
      sleep(28);
      zen_session_destroy();
      zen_redirect(zen_href_link(FILENAME_LOGOFF));
    }
      }

    zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
  }
} 

$breadcrumb->add(NAVBAR_TITLE);

// This should be the last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_TELL_A_FRIEND');
