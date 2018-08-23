<?php
	$lang = substr(get_locale(),0,2);

// check for ACF support for custom share info
	$acf_on = function_exists('get_field');
// Header Bar Background color
	$header_bgcolor_option = get_option('site_header_bgcolor','white');
	$header_bgcolor = !empty( $header_bgcolor_option ) ? $header_bgcolor_option : 'white';
// Main Nav Bar background color
	$nav_desktop_bgcolor_option = get_option('site_mainnav_bgcolor','dkgray-trans');
	$nav_desktop_bgcolor = !empty( $nav_desktop_bgcolor_option ) ? $nav_desktop_bgcolor_option : 'dkgray-trans';
// Language Nav Bar Background color
	$langnav_bgcolor_option = get_option('site_langnav_bgcolor','dkgray-trans');
	$langnav_bgcolor = !empty( $langnav_bgcolor_option ) ? $langnav_bgcolor_option : 'white';


	$site_header_layout_option = get_option('site_header_layout');
// Header alignment options
	// If site header layout option is present, and not equal to a legacy value...

$site_header_layout_leftcompact = [
	"name" => "logo_left-compact",
	"nav-type" => "nav-desktop-dropdown",
	"text-align" => "left"
];
$site_header_layout_centercompact = [
	"name" => "logo_center-compact",
	"nav-type" => "nav-desktop-modal",
	"text-align" => "center"
];
$site_header_layout_centerstacked = [
	"name" => "logo_center-stacked",
	"nav-type" => "nav-desktop-dropdown",
	"text-align" => "center"
];
$site_header_layout_headless = [
	"name" => "headless",
	"nav-type" => "nav-desktop-modal",
	"text-align" => "left"
];

$site_header_layout = $site_header_layout_leftcompact;

if ( $site_header_layout_option && $site_header_layout_option !== "site-header-layout-compact" ) {
	if ( $site_header_layout_option === "logo_center-compact" ){
		$site_header_layout = $site_header_layout_centercompact;
	} else if ( $site_header_layout_option === "logo_center-stacked" ){
		$site_header_layout = $site_header_layout_centerstacked;
	} else if ( $site_header_layout_option === "headless" ){
		$site_header_layout = $site_header_layout_headless;
	} else {
		$site_header_layout = $site_header_layout_leftcompact;
	}
} else {
	// if no header layout option present, look at legacy header options and pick the closest match
	$hide_header = get_option('site_hide_header');
	$header_alignment_option = get_option('site_header_alignment','text-center');
	$header_alignment = !empty( $header_alignment_option ) ? $header_alignment_option : 'text-center';
	$nav_desktop_display = get_option('site_nav_display_desktop','desktop-modal');

	if ( $hide_header){
		$site_header_layout = $site_header_layout_headless;
	}
	else if ( $site_header_layout_option === "site-header-layout-compact" ){
		if ( $header_alignment === "text-center"){
			$site_header_layout = $site_header_layout_centercompact;
		} else {
			$site_header_layout = $site_header_layout_leftcompact;
		}
	}
	else if ( $header_alignment === "text-center"){
		$site_header_layout = $site_header_layout_centerstacked;
	}
	else {
		$site_header_layout = $site_header_layout_leftcompact;
	}

}




	$header_fb_url = get_option('header_fb_pageurl');
	$header_buttons = get_option('header_buttons');
	$site_nav_button_label = get_option('site_nav_button_label');


	$site_logo = get_option('site_logo_url');
// Background image options
	$body_bg_color_class = '';
	$body_bg_img_class = "bg-off";
	$theme_bg_id = get_option('theme_bg');
	$superpageBgChoice = false;
	if ( $acf_on ){
		$superpageBgChoice = get_field("sp_default_bg_choice");
	}
	if ( $superpageBgChoice == 'custom' ){
		$body_bg_img_class = "bg-on";
	} else if ( $superpageBgChoice == 'default' && $theme_bg_id ){
		$body_bg_img_class = "bg-on";
	} else if ( $superpageBgChoice == 'color'){
		$body_bg_color_class = !empty( get_field("sp_default_bg_color") ) ? get_field("sp_default_bg_color") : $body_bg_color_class;
	} else if ( $superpageBgChoice == 'none'){
		// leave bg off
	} else if ( is_singular( $post_types = 'post' ) ){
		// if is single blog post_tw_url
		$body_bg_img_class = "bg-on";
	} else if ( $theme_bg_id ){
		// if not a superpage && there's a theme bg:
		$body_bg_img_class = "bg-on";
	}
	$fb_app_id = get_option('site_fb_appid','148617041897246');
	$site_twitter_account = get_option('site_twitter_account');
	$custom_code = stripslashes( get_option('customcode'));
	$text_on_image_classes_header = get_option('site_text_on_image_classes');
	$site_fav_id = get_option('site_fav_id');
//legacy support for site_fav_url
	$site_fav_url = get_option('site_fav_url');
	$site_favicon = '';
	if ( $site_fav_id || $site_fav_url ){
		if ( $site_fav_id ){
			$site_favicon_array = wp_get_attachment_image_src( $site_fav_id );
			$site_favicon = $site_favicon_array[0];
		} else if ( $site_fav_url ){
			$site_favicon = $site_fav_url;
		} else {
			$site_favicon = get_stylesheet_directory_uri() . "/favicon.png";
		}
	}
// default, general meta info
	$title = get_bloginfo('name');
	$description = get_bloginfo('description');
	$share_img = get_option('site_share_img');
	$share_img_url = wp_get_attachment_image_src( $share_img, "large" );
	$share_img_url = $share_img_url[0];
	$page_url = home_url();
	$og_type = 'website';
// more specific meta info for pages and posts
	if ( is_single() || is_page() ):
		$title = !empty( get_the_title() ) ? get_the_title() : $title;
		$description = strip_tags( get_the_excerpt() );
		$description = str_replace("\"", "'", $description);
		if ( has_post_thumbnail() ):
			$post_thumb_src_raw = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			$share_img_url = !empty( $post_thumb_src_raw[0] ) ? $post_thumb_src_raw[0] : $share_img_url[0] ;
		endif;
		$page_url = !empty( get_the_permalink() ) ? get_the_permalink() : $page_url ;
		$og_type = 'article';
	endif;
// check for custom share info overrides
	if ( $acf_on ):
		$title = !empty( get_field('post_fb_title') ) ? get_field('post_fb_title') : $title;
		$description = !empty( get_field('post_fb_desc') ) ? get_field('post_fb_desc') : $description;
		if ( get_field('post_share_img') ):
			$post_thumb_src_raw = wp_get_attachment_image_src( get_field('post_share_img'), 'large');
			$share_img_url = !empty( $post_thumb_src_raw[0] ) ? $post_thumb_src_raw[0] : $share_img_url[0] ;
		elseif ( has_post_thumbnail() ):
			$post_thumb_src_raw = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			$share_img_url = !empty( $post_thumb_src_raw[0] ) ? $post_thumb_src_raw[0] : $share_img_url[0];
		endif;
		if ( get_field('post_fb_url') ):
			$fb_url = get_field('post_fb_url');
		endif;
		if ( get_field('post_tw_url') ):
			$tw_url = get_field('post_tw_url');
		endif;
	endif;
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js no-blend baseline">
<head>
	<title><?php bloginfo('name') ?> <?php wp_title('-'); ?></title>

<?php include(locate_template('header-meta.php')); ?>
<?php get_template_part( 'fonts/font', 'loader' ); ?>
<?php wp_head(); ?>
<?php echo $custom_code; ?>
</head>

<?php include(locate_template('header-markup.php')); ?>
