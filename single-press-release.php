<?php 
/*
* Template for Single Press Releases
*
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php 

?>
<section id="content single">
	<article id="page-content" class="content section bg-white width-narrow padding-medium">
		<div id="page-content-inner" class="section-inner">
			<p><span id="post-time" class="meta"><?php echo (get_the_date() ); ?></span></p>
			<h2 class="title4"><span class=""><?php the_title(); ?></span></h2>
			<p>&nbsp;</p>
			<?php the_content(); ?>
		</div>
	</article>
<footer class="clear"></footer>
</section>
<?php endwhile; endif;?>
<?php get_sidebar('featboxes'); ?>
<?php get_footer(); ?>