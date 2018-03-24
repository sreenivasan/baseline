<?php
/*
* Template for Single Press Releases
*
*/

// Text-on-image classes
	$text_on_image_classes = get_option('site_text_on_image_classes');

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php

?>
<div id="press-release-header" class="section width-normal padding-medium bg-transparent">
	<div class="section-inner">
		<p><span id="post-time" class="meta"><?php echo (get_the_date() ); ?></span></p>
		<h2 class="margin-bottom-large"><span class="<?php echo $text_on_image_classes; ?>"><?php the_title(); ?></span></h2>
	</div>
</div>
<section id="content" class="content section bg-white width-narrow padding-normal">
	<div id="page-content-inner" class="section-inner">
		<article class="clearfix">
			<?php the_content(); ?>
		</article>
	</div>
</section>
<?php endwhile; endif;?>
<?php get_footer(); ?>
