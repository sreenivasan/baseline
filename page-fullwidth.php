<?php 
/*
Template Name: Full-width Template
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header id="page-header" class="page-header section">
	<h2 id="page-title" class="section-inner"><span><?php the_title(); ?></span></h2>
</header>
<section id="content" class="page int-page section">
	<div id="content-inner" class="section-inner page-inner">
		<div class="page-wrapper">
			<article id="page-content" class="content">
				<?php the_content(); ?>
			</article>
		</div>
		<footer class="clear"></footer>
	</div>
</section>

<?php endwhile; endif;?>
<?php get_sidebar('featboxes'); ?>
<?php get_footer(); ?>