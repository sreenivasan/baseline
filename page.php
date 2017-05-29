<?php get_header(); ?>
<?php 
/* Adjust header type size based on title length */
	$title_char_count = strlen ( get_the_title() );
	$title_size = "title2";
	if ( $title_char_count < 25 ) {
		$title_size = "title1";
	} elseif ( $title_char_count > 70) {
		$title_size = "title3";
	}
// Text-on-image classes
	$text_on_image_classes = get_option('site_text_on_image_classes');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header id="page-header" class="page-header section width-medium padding-large text-center bg-transparent">
	<div id="page-title" class="section-inner">
		<h2 class="<?php echo $title_size; ?>"><span class="<?php echo $text_on_image_classes; ?>"><?php the_title(); ?></span></h2>
	</div>
</header>
<section id="content" class="section bg-white width-normal padding-medium notch-semicircle">
	<div id="content-inner" class="section-inner page-inner">
		<article id="page-content" class="content">
			<?php the_content(); ?>
		</article>
		<footer class="clear"></footer>
	</div>
</section>

<?php endwhile; endif;?>
<?php get_footer(); ?>