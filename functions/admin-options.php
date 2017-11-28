<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/

/**/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

}



// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');



/************* CUSTOM LOGIN PAGE *****************


// changing the logo link from wordpress.org to your site
function bones_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action('login_head', 'bones_login_css');
add_filter('login_headerurl', 'bones_login_url');
add_filter('login_headertitle', 'bones_login_title');


/************* CUSTOMIZE ADMIN *******************/

// Remove redundant WP menu options from admin
function edit_menu_options(){
	remove_submenu_page( 'options-general.php', 'options-writing.php' );
	remove_submenu_page( 'themes.php', 'customize.php' );
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	//remove_submenu_page( 'themes.php', 'nav-menus.php' );
	remove_menu_page( 'edit-comments.php' );
	//add_menu_page( 'Menus', 'Menus', 'manage_options', 'nav-menus.php','','', 42 );
}
add_action( 'admin_menu', 'edit_menu_options', 999 );


// Move excerpt metabox above editor
function my_add_excerpt_meta_box( $post_type ) {
    if ( in_array( $post_type, array( 'post' ) ) ) {
         add_meta_box(
            'contact_details_meta',  /* translators: admin settings */ __( 'Summary (1-2 sentences)' ), 'post_excerpt_meta_box', $post_type, 'test', // change to something other then normal, advanced or side
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'my_add_excerpt_meta_box' );

function my_run_excerpt_meta_box() {
    # Get the globals:
    global $post, $wp_meta_boxes;

    # Output the "advanced" meta boxes:
    do_meta_boxes( get_current_screen(), 'test', $post );

}
add_action( 'edit_form_after_title', 'my_run_excerpt_meta_box' );

function my_remove_normal_excerpt() { /*this added on my own*/
    remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
}
add_action( 'admin_menu' , 'my_remove_normal_excerpt' );

// Custom CSS to reposition excerpt metabox
function my_post_edit_page_footer(){
	echo '<style>
	  .acf_postbox .field textarea{
	  	font-family: menlo,monaco,monospace;
    	font-size: 13px;
    	line-height: 1.6;}
		#test-sortables{
			position:relative;
			top:18px;}
		#test-sortables p{
			display:none;}
		</style>';
}
add_action( 'admin_footer-post.php', 'my_post_edit_page_footer' );

// Repositioning Multisite Post Duplicator's aggressive metabox position
function mpd_reposition_metabox(){
	echo '<style>
/* multisite post duplicator styles */
		#side-sortables{
		  display: flex;
    	flex-wrap: wrap;}
		#multisite_clone_metabox,
		#multisite_create_link{
		    order: 5;}
		#mpd_blogschecklist{
			max-height:200px;
			overflow:scroll;}
	</style>';
}
add_action( 'admin_footer-post.php', 'mpd_reposition_metabox' );

// Add "lang" attribtues to language menu items
function add_menu_item_language__atts( $atts, $item, $args ) {
    // check if the item is in the primary menu
    if( $item->title == 'English' ) {
      $atts['lang'] = 'en-US';
    } elseif ($item->title == 'Français') {
    	$atts['lang'] = 'fr-FR';
    } elseif ($item->title == 'Español') {
    	$atts['lang'] = 'es-ES';
    } elseif ($item->title == 'Português') {
    	$atts['lang'] = 'pt-PT';
    } elseif ($item->title == 'Deutsch') {
    	$atts['lang'] = 'de-DE';
    } elseif ($item->title == 'Turkçe') {
    	$atts['lang'] = 'tr-TR';
    } elseif ($item->title == '日本語') {
    	$atts['lang'] = 'ja-JA';
    } elseif ($item->title == 'Русский') {
    	$atts['lang'] = 'ru-RU';
    } elseif ($item->title == '日本語') {
    	$atts['lang'] = 'ja-JA';
    } elseif ($item->title == 'ﺔﻳِﺑَﺭَﻌﻟﺍ') {
    	$atts['lang'] = 'ar-AR';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_item_language__atts', 10, 3 );


function threefifty_admin_features(){
	remove_action( 'welcome_panel', 'wp_welcome_panel' );

	//Add instructions to post editing page
	$pstInstrTypes = array( 'post','page' );
	foreach ( $pstInstrTypes as $pstInstrType ) {
		add_meta_box("instructions", "Tips", 'instructionsFunction', $pstInstrType, 'normal',
			 'high', '' );
	}
	function instructionsFunction(){
			echo '
			<style type="text/css">
			.writing-tips ul li{
				list-style-position:outside;
				list-style-type:disc;}
			.writing-tips ul{
				padding-left:1.5em;}
			.style-tip{
				background:#ebedef;
				display:inline-block;
				font-size:1.2em;
				text-decoration:none;
				padding:1em;}
			</style>
			<div class="writing-tips">
			<h3>General Tips:</h3>
				<ul>
					<li>People will see your content on a variety of devices. The way things look on a laptop screen will be different from how they look on a mobile phone, so when in doubt, keep it simple.</li>
					<li>If you are using any advanced code, avoid switching back and forth between the "Visual" and "Text" tabs. Switching can accidentally break your code.</li>
				</ul>
			<h3>Special Tools</h3>
			<p><a class="style-tip" target="_blank" href="http://350.org/_/buttons/">
			<strong>Adding Buttons</strong>
			</a>
			<a class="style-tip" target="_blank" href="http://350.org/_/expandos/">
			<strong>Adding Expandos</strong>
			</a></p>

			</div>
				';
		};
}
add_action( 'admin_menu', 'threefifty_admin_features');

// TinyMCE: First line toolbar customizations
if( !function_exists('base_extended_editor_mce_buttons') ){
	function base_extended_editor_mce_buttons($buttons) {
		// The settings are returned in this array. Customize to suite your needs.
		return array(
			'formatselect','styleselect', 'bold', 'italic', 'sub', 'bullist', 'numlist', 'link', 'unlink', 'blockquote','outdent', 'indent','hr', 'removeformat', 'wp_more','forecolor','code'
		);
		// WordPress Defaults: 'bold', 'italic', 'strikethrough', 'separator', 'bullist', 'numlist', 'blockquote', 'separator', 'justifyleft', 'justifycenter', 'justifyright', 'separator', 'link', 'unlink', 'wp_more', 'separator', 'spellchecker', 'fullscreen', 'wp_adv'
	}
	add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
}

// TinyMCE: Second line toolbar customizations
if( !function_exists('base_extended_editor_mce_buttons_2') ){
	function base_extended_editor_mce_buttons_2($buttons) {
		// The settings are returned in this array. Customize to suite your needs. An empty array is used here because I remove the second row of icons.
		return array();
		// WordPress Defaults: 	'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator', 'pastetext', 'pasteword', 'removeformat', 'separator', 'media', 'charmap', 'separator', 'outdent', 'indent', 'separator', 'undo', 'redo', 'wp_help'
	}
	add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2", 0);
}

function make_mce_awesome( $init ) {
    $init['theme_advanced_blockformats'] = 'h2,h3,h4,h5,p,blockquote';
    $init['theme_advanced_disable'] = 'underline,spellchecker,strikethrough,wp_help,wp_fullscreen';
    $init['theme_advanced_text_colors'] = '04A0C3,3B3E3F,FFA017';
    $init['theme_advanced_buttons2_add'] = 'styleselect';
    $init['theme_advanced_styles'] = "button=button, expando=expando, bigquote=bigquote";
    return $init;
}

add_filter('tiny_mce_before_init', 'make_mce_awesome');


// Add WYSIWYG styles so people can see what custom class they're adding
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
	add_editor_style( '../fonts/fonts.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

/* function disable_autop() {
	global $post;
	$disable_autop_var = get_post_meta($post->ID, 'disable_autop', TRUE);
		if ( !empty( $disable_autop_var ) ) {
		remove_filter('the_content', 'wpautop');
		}
	}
add_action ('loop_start', 'disable_autop'); */

// Enqueue Image Uploader JS
function image_upload_js(){
	wp_enqueue_script(
		'image-upload',
		get_template_directory_uri() . '/js/image-upload.js',
		array( 'jquery' )
	);
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'image_upload_js' );

// Add capabilities to roles
function add_contr_caps() {
    $role = get_role( 'contributor' );
	$role->add_cap( 'read_private_pages' );
	$role->add_cap( 'read_private_posts' );
}
add_action( 'admin_init', 'add_contr_caps');
function add_auth_caps() {
    $role = get_role( 'author' );
    $role->add_cap( 'unfiltered_html' );
	$role->add_cap( 'read_private_pages' );
	$role->add_cap( 'read_private_posts' );
}
add_action( 'admin_init', 'add_auth_caps');

function add_ed_caps() {
	$role = get_role( 'editor' );
    $role->add_cap('unfiltered_html');
    $role->add_cap('edit_theme_options');
}
add_action( 'admin_init', 'add_ed_caps');

function add_admin_caps() {
	$role = get_role( 'administrator' );
    $role->add_cap( 'unfiltered_html' );
}
add_action( 'admin_init', 'add_admin_caps');
?>
