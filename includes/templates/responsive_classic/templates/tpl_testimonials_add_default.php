<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * @copyright 2007 Clyde Jones
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v1.5.4
 */
?>

<div class="centerColumn" id="testimonialDefault">
<?php echo HEADING_ADD_TITLE; ?>
<?php echo zen_draw_form('new_testimonial', zen_href_link(FILENAME_TESTIMONIALS_ADD, 'action=send', 'SSL')); ?>

<?php if (TESTIMONIAL_STORE_NAME_ADDRESS == 'true') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>

<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<br class="clearBoth" />
<div class="mainContent success"><?php echo TESTIMONIAL_SUCCESS; ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>
<?php
  } else {
?>

<?php if (DEFINE_TESTIMONIAL_STATUS >= '1' and DEFINE_TESTIMONIAL_STATUS <= '2') { ?>
<div id="pageThreeMainContent">
<?php
require($define_page);
?>
</div>
<?php } ?>

<fieldset id="personal">
<legend><?php echo TESTIMONIAL_CONTACT; ?></legend>
<?php if ($messageStack->size('new_testimonial') > 0) echo $messageStack->output('new_testimonial'); ?>
<div class="alert forward"><?php echo zen_image($template->get_template_dir(RETURN_REQUIRED_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_REQUIRED_IMAGE, RETURN_REQUIRED_IMAGE_ALT, RETURN_REQUIRED_IMAGE_WIDTH, RETURN_REQUIRED_IMAGE_HEIGHT) . RETURN_REQUIRED_INFORMATION . zen_image($template->get_template_dir(RETURN_OPTIONAL_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_OPTIONAL_IMAGE, RETURN_OPTIONAL_IMAGE_ALT, RETURN_OPTIONAL_IMAGE_WIDTH, RETURN_OPTIONAL_IMAGE_HEIGHT) . RETURN_OPTIONAL_INFORMATION; ?></div>
<br class="clearBoth" />

<label class="inputLabel" for="testimonials_name"><?php echo (($error == true && $entry_name_error == true) ? TEXT_TESTIMONIALS_NAME . zen_image($template->get_template_dir(RETURN_WARNING_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_WARNING_IMAGE, RETURN_WARNING_IMAGE_ALT, RETURN_WARNING_IMAGE_WIDTH, RETURN_WARNING_IMAGE_HEIGHT) : TEXT_TESTIMONIALS_NAME . zen_image($template->get_template_dir(RETURN_REQUIRED_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_REQUIRED_IMAGE, RETURN_REQUIRED_IMAGE_ALT, RETURN_REQUIRED_IMAGE_WIDTH, RETURN_REQUIRED_IMAGE_HEIGHT)); ?></label>
<?php echo (($error == true && $entry_name_error == true) ? zen_draw_input_field('testimonials_name', $testimonials_name, 'size="25" id="testimonials_name"') . ERROR_TESTIMONIALS_NAME_REQUIRED : zen_draw_input_field('testimonials_name', $testimonials_name, 'size="25" id="testimonials_name"')); ?>
<br class="clearBoth" />

<label class="inputLabel" for="testimonials_mail"><?php echo (($error == true && $entry_email_error == true) ? TEXT_TESTIMONIALS_MAIL . zen_image($template->get_template_dir(RETURN_WARNING_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_WARNING_IMAGE, RETURN_WARNING_IMAGE_ALT, RETURN_WARNING_IMAGE_WIDTH, RETURN_WARNING_IMAGE_HEIGHT) : TEXT_TESTIMONIALS_MAIL . zen_image($template->get_template_dir(RETURN_REQUIRED_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_REQUIRED_IMAGE, RETURN_REQUIRED_IMAGE_ALT, RETURN_REQUIRED_IMAGE_WIDTH, RETURN_REQUIRED_IMAGE_HEIGHT)); ?></label>
<?php echo (($error == true && $entry_email_error == true) ? zen_draw_input_field('testimonials_mail', $testimonials_mail, 'size="25" id="testimonials_mail"') . ERROR_TESTIMONIALS_EMAIL_REQUIRED : zen_draw_input_field('testimonials_mail', $testimonials_mail, 'size="25" id="testimonials_mail"')); ?>
<br class="clearBoth" />
<?php
  if (TESTIMONIALS_COMPANY == 'true') {
?>

<label class="inputLabel" for="testimonials_company"><?php echo TEXT_TESTIMONIALS_COMPANY . zen_image($template->get_template_dir(RETURN_OPTIONAL_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_OPTIONAL_IMAGE, RETURN_OPTIONAL_IMAGE_ALT, RETURN_OPTIONAL_IMAGE_WIDTH, RETURN_OPTIONAL_IMAGE_HEIGHT); ?></label>

<?php echo zen_draw_input_field('testimonials_company', $testimonials_company, 'size="25" id="testimonials_company"'); ?>
<br class="clearBoth" />
<?php
  }
?>
<?php
  if (TESTIMONIALS_CITY == 'true') {
?>

<label class="inputLabel" for="testimonials_city"><?php echo TEXT_TESTIMONIALS_CITY . zen_image($template->get_template_dir(RETURN_OPTIONAL_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_OPTIONAL_IMAGE, RETURN_OPTIONAL_IMAGE_ALT, RETURN_OPTIONAL_IMAGE_WIDTH, RETURN_OPTIONAL_IMAGE_HEIGHT); ?></label>

<?php echo zen_draw_input_field('testimonials_city', $testimonials_city, 'size="25" id="testimonials_city"'); ?>
<br class="clearBoth" />
<?php
  }
?>
<?php
  if (TESTIMONIALS_COUNTRY == 'true') {
?>

<label class="inputLabel" for="testimonials_country"><?php echo TEXT_TESTIMONIALS_COUNTRY . zen_image($template->get_template_dir(RETURN_OPTIONAL_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_OPTIONAL_IMAGE, RETURN_OPTIONAL_IMAGE_ALT, RETURN_OPTIONAL_IMAGE_WIDTH, RETURN_OPTIONAL_IMAGE_HEIGHT); ?></label>

<?php echo zen_draw_input_field('testimonials_country', $testimonials_country, 'size="25" id="testimonials_country"'); ?>
<br class="clearBoth" />

<?php
  }
?>
</fieldset>

<fieldset id="write">
<legend><?php echo TEXT_TESTIMONIALS_HTML_TEXT ; ?></legend>

<label class="inputLabel" for="testimonials_title"><?php echo (($error == true && $entry_title_error == true) ? TEXT_TESTIMONIALS_TITLE . zen_image($template->get_template_dir(RETURN_WARNING_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_WARNING_IMAGE, RETURN_WARNING_IMAGE_ALT, RETURN_WARNING_IMAGE_WIDTH, RETURN_WARNING_IMAGE_HEIGHT) : TEXT_TESTIMONIALS_TITLE . zen_image($template->get_template_dir(RETURN_REQUIRED_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_REQUIRED_IMAGE, RETURN_REQUIRED_IMAGE_ALT, RETURN_REQUIRED_IMAGE_WIDTH, RETURN_REQUIRED_IMAGE_HEIGHT)); ?></label>
<?php echo (($error == true && $entry_title_error == true) ? zen_draw_input_field('testimonials_title', $testimonials_title, 'size="25" id="testimonials_title"') . ERROR_TESTIMONIALS_TITLE_REQUIRED : zen_draw_input_field('testimonials_title', $testimonials_title, 'size="25" id="testimonials_title"')); ?>
<br class="clearBoth" />
<?php if ($error == true && $entry_description_error == true) { ?>

<br /><div class="testimonialsSmallText"><?php echo TEXT_TESTIMONIALS_DESCRIPTION_INFO ; ?></div>
<br class="clearBoth" />
<label class="inputLabel" for="testimonials_html_text"><?php echo TEXT_TESTIMONIALS_DESCRIPTION . zen_image($template->get_template_dir(RETURN_WARNING_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_WARNING_IMAGE, RETURN_WARNING_IMAGE_ALT, RETURN_WARNING_IMAGE_WIDTH, RETURN_WARNING_IMAGE_HEIGHT); ?></label>
<?php echo zen_draw_textarea_field('testimonials_html_text', '30', '7', $testimonials_html_text, 'id="testimonials_html_text"') . ERROR_TESTIMONIALS_DESCRIPTION_REQUIRED; ?>
<br class="clearBoth" />
<?php } else {  ?>
<?php if ($error == true && $entry_description_big_error == true) { ?>

<br /><div class="testimonialsSmallText"><?php echo TEXT_TESTIMONIALS_DESCRIPTION_INFO ; ?></div>
<br class="clearBoth" />
<label class="inputLabel" for="testimonials_html_text"><?php echo TEXT_TESTIMONIALS_DESCRIPTION . zen_image($template->get_template_dir(RETURN_WARNING_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_WARNING_IMAGE, RETURN_WARNING_IMAGE_ALT, RETURN_WARNING_IMAGE_WIDTH, RETURN_WARNING_IMAGE_HEIGHT); ?></label>
<?php echo zen_draw_textarea_field('testimonials_html_text', '30', '7', $testimonials_html_text, 'id="testimonials_html_text"') . ERROR_TESTIMONIALS_TEXT_MAX_LENGTH; ?>
<br class="clearBoth" />
<?php } else {  ?>

<br /><div class="testimonialsSmallText"><?php echo TEXT_TESTIMONIALS_DESCRIPTION_INFO ; ?></div>
<br class="clearBoth" />
<label class="inputLabel" for="testimonials_html_text"><?php echo TEXT_TESTIMONIALS_DESCRIPTION . zen_image($template->get_template_dir(RETURN_REQUIRED_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . RETURN_REQUIRED_IMAGE, RETURN_REQUIRED_IMAGE_ALT, RETURN_REQUIRED_IMAGE_WIDTH, RETURN_REQUIRED_IMAGE_HEIGHT); ?></label>
<?php echo zen_draw_textarea_field('testimonials_html_text', '30', '7', $testimonials_html_text, 'id="testimonials_html_text"'); ?>
<br class="clearBoth" />
<?php } 
}
?>
<div class="email-pot">
<label for="email-us"></label>
<?php echo zen_draw_input_field(SPAM_TEST_TEXT, '', ' id="email-us" title="do not fill in!" placeholder="do not fill in!" autocomplete="off"', 'email'); ?>
</div>

<div class="email-pot">
<p><?php echo HUMAN_TEXT_NOT_DISPLAYED; ?></p>
<?php echo zen_draw_radio_field(SPAM_TEST_USER, 'H1', '', 'id="user-1"') . '<span class="input-group-addon"><i class="fa fa-male fa-2x"></i></span>' . zen_draw_radio_field(SPAM_TEST_USER, 'C2', '', 'id="user-2"') . '<span class="input-group-addon"><i class="fa fa-laptop fa-2x"></i></span>'; ?>
</div>

<?php  if (SPAM_USE_SLIDER == 'true') { ?>
<div class="slidecontainer">
<p><?php echo HUMAN_TEXT_DISPLAYED; ?></p>
  <?php echo zen_draw_input_field(SPAM_TEST_IQ, '', ' min="0" max="50" value="25" class="slider" id="id1"', 'range'); ?>
<br /><br />
<span>Value:</span> <span id="f" style="font-weight:bold;color:red"></span>
 </div>
 <?php }  /*comment out to not use on this page*/ ?>
<br /><br />
</fieldset>
<br class="clearBoth" />

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT_TESTIMONIALS, BUTTON_TESTIMONIALS_SUBMIT_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>
<?php
  }
?>
</form>
<br class="clearBoth" />
</div>
