<?php

// Remove WP comment options from admin
function remove_discussion_menu(){
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}
add_action( 'admin_menu', 'remove_discussion_menu', 999 );

// Add custom comments menu to admin

function tfcomments_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('options-general.php','Comments', 'Comments', 'edit_theme_options', 'comments', 'tfcomments_page');
}
// Load the Admin Options page
add_action('admin_menu', 'tfcomments_menu_options');
 
function tfcomments_page() {
    ?>
        <div class="wrap">
            <h2><?php _e( 'Comments', 'tfcomments' ); ?></h2>
            <?php 
				$tfcomments_code = get_option('tfcomments_code'); 
			?>
			<p>To activate, paste the embed code from a third-party comments service like <a href="https://developers.facebook.com/docs/plugins/comments/">Facebook comments</a> or <a href="http://disqus.com">Disqus</a>. The embed code will be inserted after the blog post on individual blog pages.</p>
			<form method="POST" action="">  
           		<input type="hidden" name="tfcomments_update" value="true" />
				<textarea id="tfcomments_code" rows="6" cols="65" name="tfcomments_code"><?php echo $tfcomments_code; ?></textarea>
				<p><input type="submit" value="Save Changes" class="button button-primary" /></p>
			</form>
		
        </div>
    <?php
}

function tfcomments_update(){  
	// this is where validation would go   
	update_option('tfcomments_code',  $_POST['tfcomments_code']);  
}
$update_comments_option = isset( $_POST['tfcomments_update'] ) ? $_POST['tfcomments_update'] : '';
if ( $update_comments_option == 'true' ) { tfcomments_update(); } 




?>