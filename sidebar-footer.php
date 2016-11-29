<?php if (is_active_sidebar('footer-widgets')) { ?> 
<footer id="site-footer" class="section padding-large width-wide bg-dkgray">
	<div class="section-inner">
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
		<br class="clear" />
	</div>
</footer>
<?php } ?>