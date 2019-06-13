<?php
/**
 * non-captcha slider script
 *
 *  Powered by Zen-Cart (www.zen-cart.com)              
 *  Copyright (c) cowboygeek.com
 *
 *  Released under the GNU General Public license2.txt     
 *
 * @version $Id: jscript_main.php 1 2016-6-14 1600pst davewest $
 */
?>
<script>

$(document).ready(function () {
  
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

