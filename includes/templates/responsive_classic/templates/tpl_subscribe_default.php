<?php
/**
 * newsletter subscribe Template
 *
 * @package cart
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @Version $tpl_subscribe_default.php 1 2017-01-20 10:30:40Z davewest $
 */
?>
<!-- body_text //-->
<div class="centerColumn" id="newsletteronly">

<?php if (file_exists($definedpage)) { ?>
	<p class="plainBox"><?php require($definedpage); ?></p>
<?php } ?>


<fieldset>
<?php echo zen_draw_form('subscribe', zen_href_link(FILENAME_SUBSCRIBE, 'action=subscribe', 'SSL'),'post');

  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {  ?>

<h3 class="mainContent success"><?php echo TEXT_SUCCESS; ?></h3>
</div>
<?php  } else { ?>
 
<?php if(!empty($error)) { echo $messageStack->output('subscribe'); } ?>
 <div class="pseudolink back">Required <i class="fa fa-hand-o-left fa-fw"></i></div>
<br class="clearBoth" />        
<br />
<div ><?php echo BOX_SUBSCRIBE_DEFAULT_TEXT; ?></div>

<div class="js-float-label-wrapper">
<label for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', ' id="email-address" spellcheck="false" title="Please enter a E-Mail address (dave@addme.com)" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" required="required" aria-required="true"', 'email'); ?>
</div>

<div class="email-pot">
<label for="email-us"></label>
<?php echo zen_draw_input_field(SPAM_TEST_TEXT, '', ' id="email-us" title="do not fill in!" placeholder="do not fill in!" autocomplete="off"', 'email'); ?>
</div>

<div class="email-pot">
<p><?php echo HUMAN_TEXT_NOT_DISPLAYED; ?></p>
<?php echo zen_draw_radio_field(SPAM_TEST_USER, 'H1', '', 'id="user-1"') . '<span class="input-group-addon"><i class="fa fa-male fa-2x"></i></span>' . zen_draw_radio_field(SPAM_TEST_USER, 'C2', '', 'id="user-2"') . '<span class="input-group-addon"><i class="fa fa-laptop fa-2x"></i></span>'; ?>
</div>

<?php if (SPAM_USE_SLIDER == 'true') { ?>
<div class="slidecontainer">
<p><?php echo HUMAN_TEXT_DISPLAYED; ?></p>
  <?php echo zen_draw_input_field(SPAM_TEST_IQ, '', ' min="0" max="50" value="25" class="slider" id="id1"', 'range'); ?>
<br /><br />
<span>Value:</span> <span id="f" style="font-weight:bold;color:red"></span>
 </div>
 <?php } ?>
   
<?php if(EMAIL_USE_HTML == 'true') { ?>
<div><?php echo ENTRY_EMAIL_PREFERENCE; ?></div>
    <div class="input-group margin-bottom-sm">
<?php echo zen_draw_radio_field('email_format', 'HTML', ($email_format == 'HTML' ? true : false),'id="email-format-html"') . '<label class="radioButtonLabel" for="email-format-html">' . ENTRY_EMAIL_HTML_DISPLAY . '</label>' . zen_draw_radio_field('email_format', 'TEXT', ($email_format == 'TEXT' ? true : false), 'id="email-format-text"') . '<label class="radioButtonLabel" for="email-format-text">' . ENTRY_EMAIL_TEXT_DISPLAY . '</label>'; ?>
</div>
<?php  } ?>
<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>

<?php  } ?>
</form>

