<?php get_header(); ?>
<?php
	$text_on_image_classes = get_option('site_text_on_image_classes');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header id="page-header" class="page-header section width-normal padding-large text-center bg-transparent">
	<div id="page-title" class="section-inner">
		<h2 class="title1"><span class="<?php echo $text_on_image_classes; ?>"><?php the_title(); ?></span></h2>
	</div>
</header>
<section id="content" class="section bg-white width-normal padding-medium notch">
	<div id="content-inner" class="section-inner page-inner">
		<article id="page-content" class="content">
			<?php the_content(); ?>
		</article>
		<footer class="clear"></footer>
	</div>
</section>

<?php endwhile; endif;?>
<?php get_sidebar('featboxes'); ?>
<?php get_footer(); ?>