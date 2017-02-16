<?php 
/* Font loader code */ 
?>
<?php /* check for local storage variable and add .wf-active class if present (to minimize FOUT) */ ?>
<script>
    (function() {
      if (sessionStorage.fonts) {
        console.log("Fonts installed.");
        document.documentElement.classList.add('wf-active');
      } else {
        console.log("No fonts installed.");
      }
    })();
  </script>
  
<?php 
// Check for custom font loader code in site option
$custom_fonts = stripslashes(get_option('site_font_loader_code'));
if ( $custom_fonts ){ 
	echo $custom_fonts;
} else { 
// or else load the standard 350 web font loader
?>
	<script type="text/javascript">
		WebFontConfig = {
		  custom: {
				  families: ['KlimaWeb:n8'],
				  urls: ['<?php echo get_template_directory_uri(); ?>/fonts/fonts.css']
		  },
		  active: function() {
		    sessionStorage.fonts = true;
		  }
		};
		(function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})(); 
	</script>
<?php } ?>