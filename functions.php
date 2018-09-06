<?php

require_once('functions/admin-options.php');
require_once('functions/colors.php');
require_once('functions/comments.php');
require_once('functions/custom-background.php');
require_once('functions/custom-code.php');
require_once('functions/custom-css.php');
require_once('functions/custom-fonts.php');
require_once('functions/custom-logo.php');
require_once('functions/custom-post-type.php');
require_once('functions/custom-taxonomies.php');
require_once('functions/header-options.php');
require_once('functions/favicon.php');
require_once('functions/images.php');
require_once('functions/plugin-loader-config.php');
require_once('functions/posts.php');
require_once('functions/sidebars.php');
require_once('functions/social-media.php');


// we're firing all out initial functions at the start
add_action('after_setup_theme','cleanup_functions', 15);

function cleanup_functions() {

    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'bones_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 1);

    // launching this stuff after theme setup
    add_action('after_setup_theme','bones_theme_support');


    // cleaning up random code around images


} /* end bones ahoy */


//i18n
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('baseline', get_template_directory() . '/languages');
}


/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {
  if (!is_admin()) {


//adding scripts file in the footer
    wp_register_script( 'baseline-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );
	// Optional Internal page-only scripts
	// wp_register_script( 'tfbase-js-internal', get_stylesheet_directory_uri() . '/js/scripts-internal.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'baseline-js' );
    wp_enqueue_script( 'actionkit', 'https://act.350.org/resources/actionkit.js', array('jquery'));
    
	/* if (!is_home()){
		 wp_enqueue_script( 'tfbase-js-internal' );
	}*/
  }
  // dequeue regular style.css so we can replace it style.php
  wp_dequeue_style( 'baseline-style' );
  wp_register_style( 'baseline', get_template_directory_uri() . '/style.css', array(), '1.1.1', 'all' );
  wp_enqueue_style( 'baseline' );
//  wp_enqueue_style( 'actionkit-350', 'https://dbqvwi2zcv14h.cloudfront.net/ak/ak-v3.css');  
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp menus
	add_theme_support( 'menus' );

	// registering menus
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',
			'lang-nav' => 'Translations Menu'
		)
	);
} /* end bones theme support */


function body_class_add_categories( $classes ) {
	// Only proceed if we're on a single post page
	if ( !is_single() )
		return $classes;
	// Get the categories that are assigned to this post
	$post_categories = get_the_category();
	// Loop over each category in the $categories array
	foreach( $post_categories as $current_category ) {
		// Add the current category's slug to the $body_classes array
		$classes[] = 'category-' . $current_category->slug;
	}
	// Finally, return the $body_classes array
	return $classes;
}
add_filter( 'body_class', 'body_class_add_categories' );



/*********************
RANDOM CLEANUP ITEMS
*********************/

////////////
// Remove Default Widgets

// unregister all widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('Twenty_Eleven_Ephemera_Widget');
 }
add_action('widgets_init', 'unregister_default_widgets', 11);

add_filter('bwp_minify_style_ignore','ignore_ie_css');
function ignore_ie_css($excluded){
	$excluded = array('ie');
	return $excluded;
}

function threefifty_theme_features() {
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',   // main nav in header
			'lang-nav' => 'Language Menu'
		)
	);
	add_filter('get_post_meta', array($GLOBALS['wp_embed'], 'autoembed'), 9);
}
add_action('after_setup_theme','threefifty_theme_features');



?>
