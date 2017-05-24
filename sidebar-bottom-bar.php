<?php if (is_active_sidebar('bottom-bar')) { ?> 
<footer id="site-footer" class="section padding-large width-wide bg-dkgray-trans">
	<div class="section-inner clearfix">
		<?php dynamic_sidebar( 'bottom-bar' ); ?>
		<br class="clear" />
	</div>
</footer>
<?php } ?>