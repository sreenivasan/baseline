<?php
/*
* Single Template for Single Press Releases
*
*/
?>
<article class="press-release c10">
	<p id="press-release-time" class="meta">
		<a class="text-unstyled text-underline-none" href="<?php the_permalink(); ?>"><?php echo (get_the_date() ); ?></a>
	</p>
	<h3 class="margin-bottom-large">
		<a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>
	<?php the_content(); ?>
</article>
