<?php if (is_active_sidebar('footer-widgets')) { ?> 
	<?php get_sidebar( 'footer' ); ?>
	<div class="clear"></div>		
<?php } ?>
</div>
<div id="body-mobile-background"></div>
<?php
	// Set tweet text for AddThis buttons 
	if ( get_field('post_tw_text') ): 
?>
<script type="text/javascript">
var addthis_share = addthis_share || {}
addthis_share = {
	passthrough : {
		twitter: {
			text: "<?php urlencode( the_field('post_tw_text') ); ?>"
		}
	}
}
</script>
<!-- TEST -->
<?php endif; ?>
<?php wp_footer(); ?>
<!--[if lt IE 9]>
	<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); echo '/ie/ie8-scripts.js'; ?>"></script>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); echo '/ie/ie8.css'; ?>" type="text/css">
<![endif]-->
<!--[if lt IE 8]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); echo '/ie/ie7.css'; ?>" type="text/css">
<![endif]-->
</body>
</html>