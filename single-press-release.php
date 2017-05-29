<?php 
/*
* Template for Single Press Releases
*
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php 

?>
<section id="content" class="content section bg-white width-narrow padding-medium">
	<div id="page-content-inner" class="section-inner">
		<article class="clearfix">
			<p><span id="post-time" class="meta"><?php echo (get_the_date() ); ?></span></p>
			<h2 class="margin-bottom-large"><span class=""><?php the_title(); ?></span></h2>
			<?php the_content(); ?>
		</article>
	</div>
</section>
<?php endwhile; endif;?>
<?php get_footer(); ?>