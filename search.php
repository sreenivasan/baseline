<?php get_header(); ?>
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

	$search = new WP_Query($search_query);
	$the_search = get_search_query();
	$text_on_image_classes = get_option('site_text_on_image_classes');
?>

<?php if (have_posts()) : ?>
<header id="search-results-header" class="section padding-large bg-transparent width-wide">
	<div class="section-inner" id="search-results-header-inner">
		<!-- <h2 id="page-title" class="title2"><span class="highlight bg-dkgray">
			Search Results for "<?php echo $s ?>"</h2>
			</span>
		</h2> -->
		<?php 
			// get total # of search results
			$mySearch =& new WP_Query("s=$s & showposts=-1");
			$NumResults = $mySearch->post_count;
		?>
		<?php
			//display Page x of y pages
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$total_pages = $wp_query->max_num_pages;
		?>
		<h2 class="title2"><span class="<?php echo $text_on_image_classes; ?>"><?php printf( esc_html__('%d search results found for "%s"', 'baseline'), $NumResults, $the_search );?></span></h2>
	</div>
</header>	
<div id="search-bar" class="section bg-dkgray-trans padding-small width-wide">
	<div class="section-inner">
		<form action="<?php echo home_url(); ?>" method="get" class="lead">
			<input type="search" name="s" class="search-form-field c7" value="<?php echo $the_search; ?>" placeholder="<?php _e('Search...','baseline'); ?>" />
			<input type="submit" value="<?php _e('→','baseline'); ?>" class="search-form-submit c3" />
			<div class="clear"></div>
		</form>
	</div>
</div>
<div id="search-results" class="page-content section bg-white width-wide padding-normal">
	<div id="search-results-inner" class="section-inner">
		<?php $pagination_args = array(
			'prev_text'          => __('← Newer Posts','baseline'),
			'next_text'          => __('Older Posts →','baseline')
		);
		if ( $total_pages > 1 ): 
		?>
		<div class="c10">
			<?php echo paginate_links($pagination_args); ?>
		</div>
		<?php 
		endif;
			while ( have_posts()) : the_post(); 
				$post_type = get_post_type();
				if ( $post_type ){
					get_template_part('content', $post_type );
				} else {
					get_template_part('content','post');
				}
			endwhile; 
		?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<div class="section bg-white width-wide padding-normal pagination">
	<div class="section-inner pagination-inner">
		<?php $pagination_args = array(
			'prev_text'          => __('← Newer Posts','baseline'),
			'next_text'          => __('Older Posts →','baseline')
		); if ( $total_pages > 1 ): 
		?>
		<div class="c10">
			<?php echo paginate_links($pagination_args); ?>
		</div>
		<?php 
		endif; ?>
	</div>
</div>
<?php endif; ?> 
<!-- end #content -->
<?php get_sidebar('featboxes'); ?>
<?php get_footer(); ?>
