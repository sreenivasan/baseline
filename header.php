<?php
	$lang = substr(get_locale(),0,2);
	$hide_header = get_option('site_hide_header');
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
// Header alignment options
	$site_header_layout_option = get_option('site_header_layout');
	$header_alignment_option = get_option('site_header_alignment','text-center');
	$header_alignment = !empty( $header_alignment_option ) ? $header_alignment_option : 'text-center';

	$header_fb_url = get_option('header_fb_pageurl');
	$header_buttons = get_option('header_buttons');
	$site_nav_button_label = get_option('site_nav_button_label');

	$nav_desktop_display = get_option('site_nav_display_desktop','desktop-modal');
	$site_logo = get_option('site_logo_url');
// Background image options
	$body_bg_color_class = '';
	$body_bg_img_class = "bg-off";
	$theme_bg_id = get_option('theme_bg');
	$superpageBgChoice = false;
	if ( $acf_on ){
		$superpageBgChoice = get_field("sp_default_bg_choice");
	}
	if ( $theme_bg_id || $superpageBgChoice == 'custom' ){
		$body_bg_img_class = "bg-on";
	}
	if ( $superpageBgChoice == 'color' ){
		$body_bg_color_class = !empty( get_field("sp_default_bg_color") ) ? get_field("sp_default_bg_color") : $body_bg_color_class;
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
