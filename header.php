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
	$body_bg_img_class = "bg-on";
	$theme_bg_id = get_option('theme_bg');
	$superpageBgChoice = false;
	if ( $acf_on ){
		$superpageBgChoice = get_field("sp_default_bg_choice");
	}
	if ( $superpageBgChoice == 'color' ){
		$body_bg_color_class = !empty( get_field("sp_default_bg_color") ) ? get_field("sp_default_bg_color") : $body_bg_color_class;
		$body_bg_img_class = "bg-off";
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
	<meta charset="utf-8">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="icon" type="image/png" href="<?php echo $site_favicon ?>">
	<link href="<?php bloginfo('rss2_url'); ?>" rel="alternate" type="application/rss+xml" title="<?php bloginfo('title'); ?>" />
	<link type="application/atom+xml" rel="alternate" href="<?php bloginfo('atom_url'); ?>" title="<?php bloginfo('title'); ?>" />
<?php if ( $fb_app_id ): ?>
	<meta name="fb:app_id" content="<?php echo $fb_app_id; ?>">
<?php endif; ?>
	<meta property="og:locale" content="<?php echo get_locale(); ?>">
	<meta property="og:title" content="<?php echo $title; ?>">
	<meta property="og:description" content="<?php echo $description; ?>">
	<meta property="og:site_name" content="<?php bloginfo('title'); ?>">
	<meta property="og:image" content="<?php echo $share_img_url; ?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?php echo !empty($fb_url) ? $fb_url : $page_url ?>">
<?php if ( $site_twitter_account ): ?>
	<meta name="twitter:site" content="<?php echo $site_twitter_account; ?>">
<?php endif; ?>
	<meta name="twitter:title" content="<?php echo $title; ?>">
	<meta name="twitter:site:id" content="<?php bloginfo('title'); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:description" content="<?php echo $description; ?>">
	<meta name="twitter:image" content="<?php echo $share_img_url; ?>">
	<meta name="twitter:url" content="<?php echo !empty($tw_url) ? $tw_url : $page_url ?>">
	<link rel="amphtml" href="https://mercury.postlight.com/amp?url=<?php echo urlencode( get_the_permalink() ); ?>">
<?php get_template_part( 'fonts/font', 'loader' ); ?>
<?php wp_head(); ?>
<?php echo $custom_code; ?>
</head>
<body <?php body_class($lang .' '. $body_bg_img_class .' body-bg-' . $body_bg_color_class); ?> ontouchstart >

<?php if ( get_option('site_fb_active') ): ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/<?php echo get_locale(); ?>/all.js#xfbml=1&appId=<?php if ( get_option('site_fb_appid') ){ echo get_option('site_fb_appid'); } else { ?>148617041897246<?php } ?>";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>
	<div id="container">
<?php if ( $site_header_layout_option ): ?>
	<?php // Language Nav ?>
	<?php if ( has_nav_menu('lang-nav') ):?>
		<nav class="site-language-nav hidden language-nav bg-<?php echo $langnav_bgcolor; ?>">
			<div class="site-language-nav-inner section-inner">
				<h5 class="meta language-nav opacity-50 margin-bottom-medium"><?php _e('Language', 'baseline'); ?></h5>
		<?php wp_nav_menu( array(
			'container' => '',
			'fallback_cb' => false,
			'theme_location' => 'lang-nav' ) ); 
		?>
			</div>
		</nav>
	<?php endif; ?>
		<header id="site-header" class="section header-layout-flex margin-none width-extrawide bg-<?php echo $header_bgcolor; ?>">
			<div id="site-header-inner" class="section-inner">
	<?php // Logo ?>
				<h1 id="site-title" class="site-header-item">
	<?php if ( $site_logo ): ?>
					<a class="logo" href="<?php bloginfo('url'); ?>">
						<img src="<?php echo $site_logo; ?>" alt="<?php bloginfo('title'); ?>" /> 
					</a>
	<?php else: ?>
					<a class="<?php if ( $header_bgcolor == 'transparent' ){ echo $text_on_image_classes_header; } ?> text-color-default" href="<?php bloginfo('url'); ?>"><?php echo tf_site_title(); ?></a>
	<?php endif; ?>
				</h1>
	<?php // Site Nav ?>
	<?php if ( has_nav_menu('main-nav') ): ?>
				<a id="site-nav-label" class="site-header-item js-modal <?php echo $nav_desktop_display; ?>" data-modal-source=".site-nav" data-modal-show-source="true" data-modal-classes-outer="width-narrow slide-out" data-modal-classes-inner="-"><?php if ( $site_nav_button_label ): ?><span id="site-nav-button-label"><?php echo $site_nav_button_label; ?></span><?php endif; ?></a>
	<?php endif; ?>
	<?php if ( has_nav_menu('main-nav') ): ?>
		<?php 
			$locations = get_nav_menu_locations();
			$menu_location_name = 'main-nav';
			$menu_id = $locations[ $menu_location_name ] ;
			$menu_object = wp_get_nav_menu_object( $menu_id );
			$menu_array = get_object_vars( $menu_object );
			$menu_width = "width-full";
			if ( $header_alignment != "text-center" ):
				$menu_width = "width-wide";
			endif;

		?>
				<nav class="site-nav site-header-item <?php echo $menu_width; ?> <?php echo $nav_desktop_display; ?> bg-<?php echo $nav_desktop_bgcolor; ?>">
					<h3 class="meta main-nav-label"><?php echo $menu_array['name']; ?></h3>
					<?php 
						wp_nav_menu( array(
							'container' => '',
							'fallback_cb' => false,
							'theme_location' => $menu_location_name 
							)
					 	);
					 ?>
					<div class="clear"></div>
				</nav>
	<?php endif; ?>
	<?php if ( has_nav_menu('lang-nav') ):?>
				<a id="site-language-nav-label" class="language-nav-label language-label js-modal site-header-item" data-modal-source=".site-language-nav" data-modal-classes-outer="slide-out slide-out-right width-narrow bg-<?php echo $langnav_bgcolor; ?>" data-modal-classes-inner="text-large2"><?php _e('Language', 'baseline'); ?></a>
	<?php endif; ?>
	<?php if ( $header_buttons ): ?>
				<div id="header-buttons-container" class="site-header-item">
					<?php echo stripslashes( $header_buttons ); ?>
				</div>
	<?php endif; ?>

<?php else: ?>

	<?php if ( has_nav_menu('lang-nav') ):?>
		<nav id="language-nav" class="section width-wide nav-desktop-dropdown nav-tablet-collapsed nav-mobile-collapsed padding-none bg-<?php echo $langnav_bgcolor; ?> <?php echo $header_alignment; ?> meta">
			<div class="section-inner">
			<?php wp_nav_menu( array(
				'container' => '',
				'fallback_cb' => false,
				'items_wrap'     => '<ul class="menu" id="menu-lang-nav"><li id="lang-label" class="lang-label"><a>' . __( 'Language', 'baseline' ) . '</a></li>%3$s</ul>',
				'theme_location' => 'lang-nav' ) ); 
			?>
				<div class="clear"></div>
			</div>
		</nav>
	<?php endif; ?>
		<header id="site-header" class="<?php echo $header_alignment; ?>">
			<div id="site-topbar" class="header section width-wide padding-small <?php echo $header_alignment; ?> <?php if ($hide_header){ ?>header-hide<?php } ?> <?php if ($header_bgcolor){ ?> bg-<?php echo $header_bgcolor; } ?>">
				<div id="site-header-inner" class="section-inner">
					<h1 id="site-title">
	<?php if ( $site_logo ): ?>
						<a class="logo " href="<?php bloginfo('url'); ?>">
							<img src="<?php echo $site_logo; ?>" alt="<?php bloginfo('title'); ?>" /> 
						</a>
	<?php else: ?>
						<a class="<?php if ( $header_bgcolor == 'transparent' ){ echo $text_on_image_classes_header; } ?> text-color-default" href="<?php bloginfo('url'); ?>"><?php echo tf_site_title(); ?></a>
	<?php endif; ?>
					</h1>
				</div>
			</div>
			<div id="header-buttons-wrap" class="section width-wide padding-small <?php echo $header_alignment; ?>">
				<div id="header-buttons-wrap-inner" class="section-inner">
					<div id="header-buttons">
	<?php if ( $header_buttons ): ?>
						<div id="header-custom-buttons" class="mobile-hide">
							<?php echo stripslashes( $header_buttons ); ?>
						</div>
	<?php endif; ?>
	<?php if ( has_nav_menu('main-nav') ): ?>
						<a id="site-nav-label" class="js-modal <?php echo $nav_desktop_display; ?>" data-modal-source=".site-nav" data-modal-show-source="true" data-modal-classes-outer="width-narrow slide-out" data-modal-classes-inner="-"><?php if ( $site_nav_button_label ): ?><span id="site-nav-button-label"><?php echo $site_nav_button_label; ?></span><?php endif; ?></a>
	<?php endif; ?>
					</div>
				</div>
			</div>
	<?php if ( has_nav_menu('main-nav') ): ?>
	<?php 
		$locations = get_nav_menu_locations();
		$menu_location_name = 'main-nav';
		$menu_id = $locations[ $menu_location_name ] ;
		$menu_object = wp_get_nav_menu_object( $menu_id );
		$menu_array = get_object_vars( $menu_object );
		$menu_width = "width-full";
		if ( $header_alignment != "text-center" ):
			$menu_width = "width-wide";
		endif;

	?>
			<nav class="section site-nav <?php echo $menu_width; ?> <?php echo $header_alignment; ?> <?php echo $nav_desktop_display; ?> bg-<?php echo $nav_desktop_bgcolor; ?>">
				<div class="section-inner">
					<h3 class="meta main-nav-label"><?php echo $menu_array['name']; ?></h3>
					<?php 
						wp_nav_menu( array(
							'container' => '',
							'fallback_cb' => false,
							'theme_location' => $menu_location_name 
							)
					 	);
					 ?>
					<div class="clear"></div>
				</div>
			</nav>
	<?php endif; ?>
<?php endif; ?>
		</header>