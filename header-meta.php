<?php /* header meta info module */ ?>
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

  <?php ?>
