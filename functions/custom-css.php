<?php 

function baseline_custom_css() {
	/* get options from WP */
	$lang = substr(get_locale(),0,2);
	$theme_bg_id = get_option('theme_bg'); 
	  $theme_bg_small = wp_get_attachment_image_src( $theme_bg_id, 'page-background-mob');
	  $theme_bg_medium = wp_get_attachment_image_src( $theme_bg_id, 'page-background-medium');
	  $theme_bg_large = wp_get_attachment_image_src( $theme_bg_id, 'page-background');
	$addl_custom_css = stripslashes( get_option('custom_css') );

	$display_font_option = stripslashes(get_option('site_display_font','GraphCondensedWeb') );
	$display_font_lineheight_option = get_option('site_display_font_line_height',0.95);
	$body_font_option = stripslashes( get_option('site_body_font','-apple-system,BlinkMacSystemFont,Arial') );
	$secondary_font_option = stripslashes( get_option('site_secondary_font','Menlo,Monaco,Courier,monospace') );
	$fallback_font_option = stripslashes( get_option('site_fallback_font','sans-serif') );
	$link_color_option = get_option('site_link_color','rgb(15,129,232)');
	$button_color_option = get_option('site_button_color','rgb(255,169,2)' );
	$site_colors_default_string = "White:white:rgb(255,255,255):dark:default:default\nBlue:blue:rgb(15,129,233):light:auto:auto\nOrange:orange:rgb(255,169,2):light:auto:auto\nDark Gray:dkgray:rgb(23,41,46):light:auto:auto\nDark Gray (transparent):dkgray-trans:rgba(23,41,46,0.6):light:auto:auto\nLight Gray:ltgray:rgb(218,230,242):dark:auto:auto\nTransparent:transparent:rgba(0,0,0,0):light:auto:auto";
	$site_colors_raw = get_option('site_colors', $site_colors_default_string );

	/* Turkish needs all-caps fonts set to text-transform:uppercase in order to display accents correctly */
	$turkish_text_transform = ( $display_font_option=='GraphCondensedWeb' && $lang=='tr' ) ? 'text-transform:uppercase;' : false;

	/* provide backups in case options are set to an empty string */
	$display_font = !empty( $display_font_option ) ? $display_font_option : 'GraphCondensedWeb';
	$body_font = !empty( $body_font_option ) ? $body_font_option : '-apple-system,BlinkMacSystemFont,Arial';
	$secondary_font = !empty( $secondary_font_option ) ? $secondary_font_option : 'Menlo,Monaco,Courier,monospace';
	$fallback_font = !empty( $fallback_font_option ) ? $fallback_font_option : 'sans-serif';
	$display_font_lineheight = !empty( $display_font_lineheight_option ) ? $display_font_lineheight_option : 0.95;
	$link_color = !empty( $link_color_option ) ? $link_color_option : 'rgb(15,129,232)';
	$button_color = !empty( $button_color_option ) ? $button_color_option : 'rgb(255,169,2)';
	$site_colors = tfArrayifyColors( !empty( $site_colors_raw ) ? $site_colors_raw : $site_colors_default_string );

	/* multiply base font size by user-defined modifier */
	function fontSize( $origSize ){
		$modifier_option = get_option('site_display_font_size_modifier', 1.2 );
		$modifier = !empty( $modifier_option ) ? $modifier_option : 1.2 ;
		$finalSize = $origSize * $modifier + 0;
		if ( is_numeric( $finalSize ) ){
			return $finalSize;
		} else {
			return $origSize;
		}
	}

	/* Colors */
	/* Check for site_colors option, use default 350 colors if not present */
	$color_css_array = array();
	foreach ($site_colors as $site_color){ 
		$cur_link_color = !empty( $site_color['link'] ) ? $site_color['link'] : 'auto';
		if ( $cur_link_color != 'auto' && $cur_link_color != 'default') {
			$custom_link_color = $site_color['link'];
		} elseif ( $site_color['link'] == 'default' && $link_color_option ){
			$custom_link_color = $link_color_option;
		} elseif ( $site_color['text'] == 'light' ){
			$custom_link_color = 'rgba(255,255,255,0.75)';
		} else {
			$custom_link_color = 'rgba(21,36,43,0.75)';
		}

		$cur_link_hover_color = !empty( $site_color['link_hover'] ) ? $site_color['link_hover'] : 'auto';
		if ( $cur_link_hover_color != 'auto' && $cur_link_hover_color != 'default') {
			$custom_link_hover_color = $site_color['link_hover'];
		} elseif ( $site_color['link'] == 'default' && $link_color_option ){
			$custom_link_color = $link_color_option;
		} elseif ( $site_color['text'] == 'light' ){
			$custom_link_hover_color = 'rgba(255,255,255,0.3)';
		} else {
			$custom_link_hover_color = 'rgba(21,36,43,0.3)';
		}

		$cur_text_color = !empty( $site_color['text'] ) ? $site_color['text'] : 'dark';
		if ( $cur_text_color == 'light') {
			$text_color = '#ffffff';
			$border_color = "rgba(255,255,255,0.15)";
		} else {
			$text_color = '#17292e';
			$border_color = "rgba(21,36,43,0.14)";
		}
		$color_css_array[] = '.bg-'. $site_color['slug'] .',
		.button.bg-'. $site_color['slug'] .'{
			background-color:'. $site_color['code'] .';
			border-color:'. $border_color .';
			color:'. $text_color .';}
		/* Nav Color */
		nav.bg-'. $site_color['slug'] .' li,
		nav.bg-'. $site_color['slug'] .' .sub-menu{
			border-color:'. $border_color .';}
		/* Notch Color */
		.bg-'. $site_color['slug'] .'.notch::after{
			border-bottom-color:'. $site_color['code'] .';}
		.bg-'. $site_color['slug'] .'.notch-semicircle::after,
		.bg-'. $site_color['slug'] .'.notch-tab::after{
			background-color:'. $site_color['code'] .';}
		/* Text Color */
		.text-'. $site_color['slug'] .'{
			color:'. $site_color['code'] .';}
		/* Link Color */
		.bg-'. $site_color['slug'] .' a{
			color:'. $custom_link_color .';}
		/* Link:hover Color */
		.bg-'. $site_color['slug'] .' a:hover{
			color:'. $custom_link_hover_color .';}
		/* Button Text Color */
		a.bg-'. $site_color['slug'] .'{
			color:'. $text_color .';}
		/* Button:hover Text Color */
		a.bg-'. $site_color['slug'] .':hover{
			color:'. $custom_link_color .';}
		/* Thick Underline */
		.text-underline-thick-'. $site_color['slug'] .'{
			box-shadow:0 -0.35em 0 '. $site_color['code'] .' inset;}
		';
		}

	$color_css_string = implode( ' ', $color_css_array );

	$custom_css = '
	body,
	button, input, select, textarea,
	.text-font-body{
		font-family:'. $body_font .','. $fallback_font .';}
	body{
	 	font-family:'. $body_font .','. $fallback_font .';}
	#body-mobile-background{
		background-image:url(' . $theme_bg_small[0] . ');}
	h1,
	h2,
	h3,
	.title0,
	.title1,
	.title2,
	.title3,
	.title4,
	.text-display,
	.text-font-display{
		font-family:'. $display_font .','. $body_font .','. $fallback_font .';
		line-height:'. $display_font_lineheight .';' . 
		$turkish_text_transform . '}
	.text-display,
	.text-font-display{
		display:inline-block;}
	.text-font-secondary,
	.meta{
		font-family:'. $secondary_font .','. $fallback_font .';}
	h1{
		font-size:'. fontSize(2.2) .'em;}
	h2{
		font-size:'. fontSize(1.9) .'em;}
	h3{
		font-size:'. fontSize(1.4) .'em;}
	a,
	a.area-link:hover .area-link-hover{
		color:'. $link_color .';}
	#site-title{
	  font-size:'. fontSize(1.5) .'rem;}
	input.submit,
	input[type="submit"],
	.button,
	.button-primary{
		background-color:'. $button_color .';}
	.button-secondary{
		background-color:'. $link_color .';}
	.button-big,
	input.submit.button-big{
		font-family:'. $display_font .','. $body_font .','. $fallback_font .';
		font-size:'. fontSize(1.6) .'rem;}

	.search-form-submit,
	.pagination a.page-numbers,
	.pagination .page-numbers.current{
	  background-color:'. $link_color .';}

	input.search-form-submit{
		background-color:'. $button_color .';}

	.form #can_embed_form input[type="submit"],
	.form #can_embed_form .button,
	#donate_auto_modal input[type="submit"],
	#donate_auto_modal .button{
		background-color:'. $button_color .';
		font-family:'. $display_font .','. $body_font .','. $fallback_font .';
		font-size:'. fontSize(1.5) .'rem;
		text-shadow:none;
	  	border-width:0 0 3px;
		border-bottom:3px solid rgba(21,35,43,0.15);}
	.form #can_embed_form input[type="submit"]:hover,
	.form #can_embed_form .button:hover,
	#donate_auto_modal input[type="submit"]:hover,
	#donate_auto_modal .button:hover{
  		background:'. $button_color .';}


	.title0{
  	  font-size:'. fontSize(55) .'px;}
	.title1{
	  font-size:'. fontSize(46) .'px;}
	.title2{
	  font-size:'. fontSize(38) .'px;}
	.title3{
	  font-size:'. fontSize(30) .'px;}
	.title4{
	  font-size:'. fontSize(24) .'px;}

	@media only screen and (min-width:650px){
		#body-mobile-background{
		    background-image:url(' . $theme_bg_medium[0] .');}
	    h1{
			font-size:'. fontSize(2.4) .'em;}
		h2{
			font-size:'. fontSize(2.1) .'em;}
		h3{
			font-size:'. fontSize(1.8) .'em;}
		.title0{
  	  		font-size:'. fontSize(72) .'px;}
		.title1{
			font-size:'. fontSize(60) .'px;}
		.title2{
			font-size:'. fontSize(50) .'px;}
		.title3{
			font-size:'. fontSize(42) .'px;}
		.title4{
			font-size:'. fontSize(34) .'px;}
		#site-title{
			font-size:'. fontSize(1.8) .'rem;}
	}

	@media only screen and (min-width:1023px){
		#body-mobile-background{
			background-image:url(' . $theme_bg_large[0] . ');}
	  h1{
	    font-size:'. fontSize(2.5) .'em;}
	  h2{
	    font-size:'. fontSize(2.2) .'em;}
	  h3{
	    font-size:'. fontSize(1.8) .'em;}
	  .title0{
  	  	font-size:'. fontSize(85) .'px;
  	  	line-height:' . $display_font_lineheight * 0.9 .';}
	  .title1{
	    font-size:'. fontSize(70) .'px;}
	  .title2{
	    font-size:'. fontSize(60) .'px;}
	  .title3{
	    font-size:'. fontSize(53) .'px;}
	  .title4{
	    font-size:'. fontSize(45) .'px;}
	}
	';
	$custom_css_combined = $custom_css . $color_css_string . $addl_custom_css;
	wp_add_inline_style( 'baseline', $custom_css_combined );
}
add_action( 'wp_enqueue_scripts', 'baseline_custom_css' );

?>