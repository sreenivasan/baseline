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

<?php if (have_posts()) { ?>
<header id="search-results-header" class="section padding-large bg-transparent width-wide">
	<div class="section-inner" id="search-results-header-inner">
		<!-- <h2 id="page-title" class="title2"><span class="highlight bg-dkgray">
			Search Results for "<?php echo $s ?>"</h2>
			</span>
		</h2> -->
		<?php
			// get total # of search results
			$mySearch = new WP_Query("s=$s & showposts=-1");
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
			<input type="submit" value="<?php _e('→','baseline'); ?>" class="search-form-submit c3 bg-icon-search" />
			<div class="clear"></div>
		</form>
	</div>
</div>
<div id="search-results" class="page-content section bg-white width-wide padding-normal">
	<div class="section-inner" id="search-results-inner">
		<?php
			while ( have_posts()) : the_post();
				$post_type = get_post_type();

				if ($post_type != 'team-member'){

					switch ($post_type) {
					    case "post":
					        $pretty_post_type = "Post";
					        break;
					    case "super_pages":
					        $pretty_post_type = "Page";
					        break;
					    case "page":
					        $pretty_post_type = "Page";
					        break;
					    case "press-release":
					        $pretty_post_type = "Press Release";
					        break;
			        default:
					        $pretty_post_type = $post_type;
					}

					echo	'<article id="post-' . $post_count. '" class="post post-type-post mobile-margin-bottom-huge post-no-thumb">
							<a class="area-link" href="' . get_the_permalink() . '">
								<div class="c10 ct10 cm10">
									<div class="search-item-meta meta p c2 ct3_3 cm10">
										<span class="search-item-time area-link-hover">' . get_the_date() . '</span>
										<div class="post-type"><span class="post-type-inner">' . $pretty_post_type . '</span></div>
									</div>
									<header class="c8 ct6_6 cm10">
										<h5 class="press-release-title area-link-hover">' . get_the_title() . '</h5>
										<div class="post-excerpt margin-bottom-normal  area-link-hover">
											<p>' . get_the_excerpt() . '</p>
										</div>

									</header>
								</div>
							<div class="clear"></div>
							</a>
						</article>';
				}
/*
				if ( $post_type ){
					get_template_part('content', $post_type );
				} else {
					get_template_part('content','post');
					//include(locate_template('content-post.php'));
				}
*/
			endwhile;

			if ( $total_pages > 1 ):

				echo '<div class="pagination">';
				$pagination_args = array(
					'prev_text'          => __('← Newer','baseline'),
					'next_text'          => __('Older →','baseline')
				);
				echo trim( paginate_links($pagination_args) );
				echo '</div>';
			endif;
		?>
	</div>
</div>
<?php } else {
	echo 'no results';
	}; ?>
<!-- end #content -->
<?php get_sidebar('featboxes'); ?>
<?php get_footer(); ?>
