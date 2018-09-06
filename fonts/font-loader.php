<?php
/* Font loader code */
?>
<?php /* check for local storage variable and add .wf-active class if present (to minimize FOUT) */ ?>
<script>
    (function() {
      if (sessionStorage.fonts) {
        // console.log("Fonts installed.");
        document.documentElement.classList.add('wf-active');
      } else {
        // console.log("No fonts found in memory.");
      }
    })();
  </script>

<?php
// Check for custom font loader code in site option
$custom_fonts = stripslashes(get_option('site_font_loader_code'));
if ( $custom_fonts ){
	echo $custom_fonts;
}
?>
