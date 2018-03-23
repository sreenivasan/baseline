<?php
/* Header markup sub-template
/  includes the header container, site title/logo, menus and header Buttons
*/?>

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
<?php // Language Nav ?>
<?php if ( has_nav_menu('lang-nav') ):?>
		<nav class="site-language-nav hidden language-nav bg-<?php echo $langnav_bgcolor; ?>">
			<div class="site-language-nav-inner section-inner">
				<h3 class="meta language-nav opacity-50 margin-bottom-medium"><?php _e('Language', 'baseline'); ?></h5>
	<?php wp_nav_menu( array(
		'container' => '',
		'fallback_cb' => false,
		'theme_location' => 'lang-nav' ) );
	?>
			</div>
		</nav>
<?php endif; ?>
		<header id="site-header" class="section site-header-layout-<?php if ( $site_header_layout_option ){ ?>compact<?php } else { ?>stacked<?php } ?> margin-none bg-<?php echo $header_bgcolor; ?> <?php echo $header_alignment; ?>">
			<div id="site-header-inner" class="section-inner">
				<h1 id="site-title" class="site-header-item">
<?php if ( $site_logo ): ?>
					<a id="site-title-link" class="logo logo-image" href="<?php bloginfo('url'); ?>">
						<img id="site-title-image" src="<?php echo $site_logo; ?>" alt="<?php bloginfo('title'); ?>" />
					</a>
<?php else: ?>
					<a id="site-title-link" class="logo-text <?php if ( $header_bgcolor == 'transparent' ){ echo $text_on_image_classes_header; } ?> text-color-default" href="<?php bloginfo('url'); ?>"><?php echo tf_site_title(); ?></a>
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
		</header>
