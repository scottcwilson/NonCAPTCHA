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
