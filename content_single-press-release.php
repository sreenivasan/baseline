<?php 
/*
* Single Template for Single Press Releases
*
*/
?>
<article class="press-release c10">
	<p><span id="press-release-time" class="meta"><?php echo (get_the_date() ); ?></span></p>
	<h3 class="margin-bottom-large"><span class=""><?php the_title(); ?></span></h3>
	<?php the_content(); ?>
</article>