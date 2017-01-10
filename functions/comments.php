<?php

/* ----- Disabling comments - much of this taken from https://www.dfactory.eu/turn-off-disable-comments/ */

// Remove "Comments" page from admin menu
function remove_discussion_menu(){
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}
add_action( 'admin_menu', 'remove_discussion_menu', 999 );

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Remove comment count from Posts page
function remove_pages_count_columns($defaults) {
	unset($defaults['comments']);
	return $defaults;
}
add_filter('manage_pages_columns', 'remove_pages_count_columns');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');



/* --------- Add custom comments features */

// Add custom comments menu page to admin
function tfcomments_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('options-general.php','Comments', 'Comments', 'edit_theme_options', 'comments', 'tfcomments_page');
}
add_action('admin_menu', 'tfcomments_menu_options');
 
// Set up custom comments options page HTML
function tfcomments_page() {
    ?>
        <div class="wrap">
            <h2><?php /* translators: admin settings */ _e( 'Comments', 'tfcomments' ); ?></h2>
            <?php 
				$tfcomments_code = get_option('tfcomments_code'); 
			?>
			<p>To activate, paste the embed code from a third-party comments service like <a href="https://developers.facebook.com/docs/plugins/comments/">Facebook comments</a> or <a href="http://disqus.com">Disqus</a>. The embed code will be inserted after the blog post on individual blog pages.</p>
			<form method="POST" action="">  
           		<input type="hidden" name="tfcomments_update" value="true" />
				<textarea id="tfcomments_code" rows="6" cols="65" name="tfcomments_code"><?php echo stripslashes($tfcomments_code); ?></textarea>
				<p><input type="submit" value="Save Changes" class="button button-primary" /></p>
			</form>
		
        </div>
    <?php
}

function tfcomments_update(){  
	update_option('tfcomments_code',  $_POST['tfcomments_code']);  
}
$update_comments_option = isset( $_POST['tfcomments_update'] ) ? $_POST['tfcomments_update'] : '';
if ( $update_comments_option == 'true' ) { tfcomments_update(); } 

?>