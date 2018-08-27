<?php get_header(); ?>
<?php
	$text_on_image_classes = get_option('site_text_on_image_classes');
?>
<?php if( !is_paged() ): //if normal homepage... ?>
    <section id="top-panel" class="section padding-huge width-normal bg-transparent text-center">
    	<div class="section-inner">
    		<h2 class="title1"><span class="<?php echo $text_on_image_classes; ?>"><?php bloginfo('description'); ?></span></h2>
    	</div>
    </section>

<?php
		if ( (is_active_sidebar('featboxes')) ):
			get_sidebar('featboxes');
		endif;
	else: // else paginated page code...
		$pagedNum = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$post_type_object = get_post_type_object( get_post_type($post->ID) );

?>
	<div class="section padding-large width-normal bg-transparent text-center">
		<div class="section-inner">
			<h2 class="title2"><span class="<?php echo $text_on_image_classes; ?>"><?php printf( esc_html__('%1$s: Page %2$s', 'baseline'), $post_type_object->label, $pagedNum); ?></span></h2>
		</div>
	</div>
<?php endif; ?>

<?php
$i=1;
if ( have_posts() ) :
?>
	<div id="content" class="section bg-white width-wide padding-medium notch posts-layout-list">
		<section id="blog" class="section-inner">
			<?php if( is_paged() ): ?>

			<?php endif; ?>
			<?php
				while ( have_posts() ) : the_post();
					get_template_part('content', 'post');
				endwhile;
			?>
			<div class="pagination">
			<?php
			$pagination_args = array(
				'prev_text'          => __('← Newer Posts','baseline'),
				'next_text'          => __('Older Posts →','baseline')
			);
			echo paginate_links($pagination_args);
			?>
			</div>
			<br class="clear"/>
		</section>
	</div>
	<div class="section padding-normal width-wide bg-white pagination">
    	<div class="section-inner">

        </div>
	</div>
<?php endif; ?>
<!-- end #content -->
<?php get_footer(); ?>
