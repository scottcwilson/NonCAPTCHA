<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tell_a_friend_default.php 5927 2007-02-28 18:32:34Z drbyte $
 */
?>
<div class="centerColumn" id="tellAFriendDefault">
<?php echo zen_draw_form('email_friend', zen_href_link(FILENAME_TELL_A_FRIEND, 'action=send&products_id=' . $_GET['products_id'], $request_type),'post'); ?>



<?php if ($messageStack->size('friend') > 0) echo $messageStack->output('friend'); ?>

<fieldset>

<br class="clearBoth" />
<div class="pseudolink back">Required <i class="fa fa-hand-o-left fa-fw"></i></div>
<br class="clearBoth" />

<div class="boxcontainer">
<section>
<div class="js-float-label-wrapper">
<label for="from-name"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></label>
<?php echo '<input type="text" name="name" autocomplete="off" value=' . $name . ' readonly>'; ?>
</div>

<div class="js-float-label-wrapper">
<label for="from-email-address"><?php echo ENTRY_EMAIL; ?></label>
<?php echo '<input type="text" name="email_address" autocomplete="off" value=' . $email_address . ' readonly>'; ?>
</div>

<div class="js-float-label-wrapper">
<label for="to_name"><?php echo FORM_FIELD_FRIEND_NAME; ?></label>
<?php echo zen_draw_input_field('to_name', '', ' id="to_name" pattern="^([- \w\d\u00c0-\u024f]+)$" spellcheck="false" title="Fried name (no special characters)" required="required" aria-required="true" '); ?>
</div>

<div class="js-float-label-wrapper">
<label for="to-email-address"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></label>
<?php echo zen_draw_input_field('to-email-address', $to_email_error, ' id="to-email-address" spellcheck="false" title="Please enter a E-Mail address (dave@addme.com)" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" required="required" aria-required="true"', 'email'); ?>
</div>

<div class="js-float-label-wrapper">
<label for="enquiry"><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></label>
<?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, ' id="enquiry" placeholder="' . ENTRY_ENQUIRY . '" id="enquiry" wrap="virtual"  required="required" aria-required="true"') ; ?>
</div>

<div class="js-float-label-wrapper email-pot">
<label for="email-us"></label>
<?php echo zen_draw_input_field(SPAM_TEST_TEXT, '', ' id="email-us" title="do not fill in!" placeholder="do not fill in!" autocomplete="off"', 'email'); ?>
</div>

<div class="js-float-label-wrapper email-pot">
<p><?php echo HUMAN_TEXT_NOT_DISPLAYED; ?></p>
<?php echo zen_draw_radio_field(SPAM_TEST_USER, 'H1', '', 'id="user-1"') . '<span class="input-group-addon"><i class="fa fa-male fa-2x"></i></span>' . zen_draw_radio_field(SPAM_TEST_USER, 'C2', '', 'id="user-2"') . '<span class="input-group-addon"><i class="fa fa-laptop fa-2x"></i></span>'; ?>
</div>

<?php  if (SPAM_USE_SLIDER == 'true') { ?>
<div class="slidecontainer">
<p><?php echo HUMAN_TEXT_DISPLAYED; ?></p>
  <?php echo zen_draw_input_field(SPAM_TEST_IQ, '', ' min="0" max="50" value="25" class="slider" id="id1"', 'range'); ?>
<br />
<span>Value:</span> <span id="f" style="font-weight:bold;color:red"></span>
 </div>
 <?php } /*comment out to not use on this page */ ?>
 
</section>

<section>
<h1><?php echo sprintf(HEADING_TITLE, $product_info->fields['products_name']); ?></h1>
<div id="cartbutton">
<!--bof Main Product Image -->
<?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $product_info->fields['products_image'], $product_info->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '</a>'; ?>

<!--eof Main Product Image-->
</div>

<br />
<div id="tellAFriendAdvisory" class="advisory"><?php echo EMAIL_ADVISORY_INCLUDED_WARNING . str_replace('-----', '', EMAIL_ADVISORY); ?></div>
<br />
<div id="tellAFriendAdvisory" class="advisory"><?php echo EMAIL_BANNED; ?></div>
<br />
</section>
</fieldset>
<br class="clearBoth" />
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<br class="clearBoth" />
</form>
</div>
