<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * 
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v2.0 11-14-2018 davewest $
 */
?>
<script><!--testimonials form -->
<!--

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
