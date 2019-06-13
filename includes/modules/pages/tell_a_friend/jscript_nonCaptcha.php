<?php
/**
 *
 *  Powered by Zen-Cart (www.zen-cart.com)              
 *  Copyright (c) SmokeGranderWebDesign.com
 *
 *  Released under the GNU General Public License      
 *  available at www.smokegranderwebdesign.com/license/license2.txt     
 *  or see "license2.txt" in the downloaded zip  
 *
 * @version $Id: jscript_main.php 1 2010-12-27 1600pst davewest $
 * base on the form name, not the page name
 */
?>
<script><!--tell freand form --><!--

$(document).ready(function () {
   $( '.js-float-label-wrapper' ).FloatLabel();

var slideCol = document.getElementById("id1");
var y = document.getElementById("f");
y.innerHTML = slideCol.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slideCol.oninput = function() {
    y.innerHTML = this.value;
    if (this.value == "<?php echo SPAM_TEST; ?>") {
      y.innerHTML = "<?php echo SPAM_ANSWER; ?>";
    }
      
}

});

//--></script> 
