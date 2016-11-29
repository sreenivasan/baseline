<?php if (is_active_sidebar('featboxes')) { ?> 
<section class="featboxes section padding-normal width-full bg-dkgray-trans <?php if ( is_home() ){ echo 'notch'; }?>">
	<div class="section-inner featboxes-inner">
		<?php dynamic_sidebar( 'featboxes' ); ?>
	</div>
</section>
<?php } ?>