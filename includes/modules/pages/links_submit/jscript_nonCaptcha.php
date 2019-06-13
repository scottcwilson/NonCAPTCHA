<?php
/**
 *
 *  Powered by Zen-Cart (www.zen-cart.com)              
 *  Copyright (c) cowboygeek.com
 *
 *  Released under the GNU General Public License      
 *  available at www.smokegranderwebdesign.com/license/license2.txt     
 *  or see "license2.txt" in the downloaded zip  
 * @version $Id: links_manager.php  3.5.2 1/28/2010 Clyde Jones
 * @version $Id: links_manager.php 4.0  2015-12-27 1600pst davewest $
 * 
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
</script>
