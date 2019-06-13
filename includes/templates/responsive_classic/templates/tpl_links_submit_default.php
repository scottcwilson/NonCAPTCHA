<?php
/**
 * Links Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_submit_default.php 3.5.3 4/16/2010 Clyde Jones $
 *
 * @version $Id: tpl_links_submit_default.php  3.7.0 5/14/2016 davewest $
 */
?>

<div class="centerColumn" id="ezPageDefault">
   
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<div class="mainContent success"><?php echo LINKS_SUCCESS; ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>


<?php
  } else { /////////////////////////////////////////////////////// main form /////////////////////////
?>
<fieldset>
<div class="boxcontainer">
<section>
<?php if (DEFINE_LINKS_STATUS >= '1' and DEFINE_LINKS_STATUS <= '2') { ?>
<div id="pageThreeMainContent">
<?php
require($define_page);
?>
</div>
<?php } ?>
</section>

<section>
<?php if (LINKS_STORE_NAME_ADDRESS == 'true') { ?>
<section>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
</section>
<?php } ?>
<section>
<div class="pasduck"><?php echo zen_image(DIR_WS_TEMPLATE . 'images/cowboy50.gif'); ?></div>
</section>
<br />
<p>By submiting, you agree to <?php echo '<strong>' . STORE_NAME . '</strong>'; ?> <?php if (function_exists('zen_colorbox') && ZEN_COLORBOX_STATUS == 'true') { ?>
<a class='iframe' href="<?php echo zen_href_link(FILENAME_POPUP_CONDITIONS,  '', $request_type) ; ?> "><b> Conditions of Use</b></a> and <a class='iframe' href="<?php echo zen_href_link(FILENAME_POPUP_PRIVACY,  '', $request_type) ; ?> "><b>Privacy Notice.</b></a>
<?php } else { ?>
<a href="javascript:popupWindow('<?php echo zen_href_link(FILENAME_POPUP_CONDITIONS,  '', $request_type) ; ?>')"><b> Conditions of Use </b></a> and <a href="javascript:popupWindow('<?php echo zen_href_link(FILENAME_POPUP_PRIVACY,  '', $request_type) ; ?>')"><b>Privacy Notice.</b></a>
<?php } ?>
</p>
</section>
</div>
</fieldset>

<fieldset>
<legend><?php //echo NAVBAR_LINKS_2; ?></legend>
<?php if ($messageStack->size('submit_link') > 0) echo $messageStack->output('submit_link'); ?>

<?php
if (function_exists('zen_colorbox') && ZEN_COLORBOX_STATUS == 'true') { ?>
<a class="iframe forward" href=" <?php echo zen_href_link(FILENAME_POPUP_LINKS_HELP,  '', $request_type) ; ?> " target="_blank"><?php echo zen_image(DIR_WS_TEMPLATE . 'buttons/english/button_help.png', BUTTON_LINK_HELP_ALT); ?></a>
<?php } else { ?>
<a class="forward" href="javascript:popupWindow('<?php echo zen_href_link(FILENAME_POPUP_LINKS_HELP) ; ?>')"><?php echo zen_image(DIR_WS_TEMPLATE . 'buttons/english/button_help.png', BUTTON_LINK_HELP_ALT); ?></a>
<?php }
?>
<?php if (BOX_DISPLAY_SUBMIT_LINK == 'true') {  ?>
<?php echo zen_draw_form('submit_link', zen_href_link(FILENAME_LINKS_SUBMIT, 'action=send', $request_type), 'post',  'onsubmit="return check_form(submit_link);" enctype="multipart/form-data" '); ?>
<div class="pseudolink back">Required <i class="fa fa-hand-o-left fa-fw"></i></div>
<br class="clearBoth" />
<fieldset>
<legend><?php echo CATEGORY_CONTACT; ?></legend>

<div class="js-float-label-wrapper">
<label for="contactname"><?php echo ENTRY_LINKS_CONTACT_NAME; ?></label>
<?php echo zen_draw_input_field('contactname', $links_contact_name, '  id="contactname"  pattern="^([- \w\d\u00c0-\u024f]+)$" spellcheck="false" title="Your name (no special characters)"  required="required" aria-required="true"'); ?>
</div>

<div class="js-float-label-wrapper">
<label for="links_contact_email"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('links_contact_email', $links_contact_email, '  id="links_contact_email"  spellcheck="false" title="Please enter a E-Mail address (dave@addme.com)" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" required="required" aria-required="true"', 'email'); ?>
</div>
               
</fieldset>

<fieldset>
<legend><?php echo CATEGORY_WEBSITE; ?></legend>

<?php $TitleRequire = ((ENTRY_LINKS_TITLE_MIN_LENGTH > 0) ? 'required="required" aria-required="true"' : '' );?>

<div class="js-float-label-wrapper">
<label for="links_title"><?php echo ENTRY_LINKS_TITLE; ?></label>
<?php echo zen_draw_input_field('links_title', $links_title, ' id="links_title" pattern="^([- \w\d\u00c0-\u024f]+)$" spellcheck="false" title="Links Title (no special characters)" ' .  $TitleRequire . '', 'text') ; ?>
</div>


<?php $URLRequire = ((ENTRY_LINKS_URL_MIN_LENGTH > 0) ? ' required="required" aria-required="true"' : '' );?>
<div class="js-float-label-wrapper">
<label for="links_url"><?php echo ENTRY_LINKS_URL; ?></label>
<?php echo zen_draw_input_field('links_url', '', ' id="links_url" title="Links URL (http://www.cowboygeek.com) " ' .  $URLRequire . '', 'url') ; ?>
</div>

<div class="js-float-label-wrapper">            
<?php echo ENTRY_LINKS_CATEGORY_INFO;?>
<?php echo zen_draw_pull_down_menu('links_category', $categories_array, $default_category, 'id="links_category"  title="Select a category from this list."' );?>
</div>

<?php $descRequire = ((ENTRY_LINKS_DESCRIPTION_MIN_LENGTH > 0) ? ' required="required" aria-required="true"' : '' );?>
<?php echo ENTRY_LINKS_DESCRIPTION_INFO; ?>
<div class="js-float-label-wrapper">
<label for="links_description"><?php echo ENTRY_LINKS_DESCRIPTION; ?></label>
<?php echo zen_draw_textarea_field('links_description', '20', '5', $links_description, ' id="links_url" wrap="virtual" ' .  $descRequire . ''); ?>
</div>



<?php if (SHOW_LINKS_BANNER_IMAGE == 'true') { ?>

<div class="box">
<input type="file" name="links_image_url" id="quote_file" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" />
<label for="quote_file"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Upload 1 File (Optional)</span></label>
</div>

<?php
  }
?>
<div class="js-float-label-wrapper email-pot">
<label for="email-us"></label>
<?php echo zen_draw_input_field(SPAM_TEST_TEXT, '', ' id="email-us" title="do not fill in!" placeholder="do not fill in!" autocomplete="off"', 'email'); ?>
</div>

<div class="js-float-label-wrapper email-pot">
<p><?php echo HUMAN_TEXT_NOT_DISPLAYED; ?></p>
<?php echo zen_draw_radio_field(SPAM_TEST_USER, 'H1', '', 'id="user-1"') . '<span class="input-group-addon"><i class="fa fa-male fa-2x"></i></span>' . zen_draw_radio_field(SPAM_TEST_USER, 'C2', '', 'id="user-2"') . '<span class="input-group-addon"><i class="fa fa-laptop fa-2x"></i></span>'; ?>
</div>

<?php  if (SPAM_USE_SLIDER == 'true') { ?>
<br />
<div class="slidecontainer">
<p><?php echo HUMAN_TEXT_DISPLAYED; ?></p>
  <?php echo zen_draw_input_field(SPAM_TEST_IQ, '', ' min="0" max="50" value="25" class="slider" id="id1"', 'range'); ?>
<br /><br />
<span>Value:</span> <span id="f" style="font-weight:bold;color:red"></span>
 </div>
 <br /><br />
 <?php } /**/ ?>
 
</fieldset>   
  
<?php if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') { ?>
<fieldset>
<legend><?php echo CATEGORY_RECIPROCAL; ?></legend>
<p>We require the Reciprocal to be on the same domain as the link you are submitting. Hidden link pages will get you BANED and listed as a spammer!</p>
<div class="js-float-label-wrapper">
<label for="links_reciprocal_url"><?php echo ENTRY_LINKS_RECIPROCAL_URL; ?></label>
<?php echo zen_draw_input_field('links_reciprocal_url', '', ' id="links_reciprocal_url" title="Enter Reciprocal link url (http://www.cowboygeek.com)"  required="required" aria-required="true"', 'url'); ?>
</div>
<br class="clearBoth" />

<p>To validate the reciprocal link please include the following HTML code in the page at the URL specified above. We check all links before posting, spammers will get listed on our black list and sent out to others for blocking.
<textarea name="textarea" readonly="readonly"><a href="http://www.cowboygeek.com">CowboyGeek.com Store and Auction Site!</a></textarea></p>

</fieldset>
<?php
  }
?>

</fieldset>

<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>
<div class="buttonRow forward">
<?php 
 echo zen_image_submit(BUTTON_IMAGE_SUBMIT_LINK, BUTTON_SUBMIT_LINK_ALT); 
 echo '</div>';
 ?>
 </form>
 <script>
'use strict';

;( function( $, window, document, undefined )
{
	$( '.inputfile' ).each( function()
	{
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();  

			if( fileName )
				$label.find( 'span' ).html( fileName );
			else
				$label.html( labelVal );
		});

		// Firefox bug fix
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});
})( jQuery, window, document );

</script>
<?php
}else{
  echo '<h2>Sorry, We are not taking Links at this time.</h2>';
} ?>


<?php
  }
?>

<br class="clearBoth" />
</div>
