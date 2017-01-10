<?php
// Add "Favicon" link to the "Appearance" menu
function site_fav_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('themes.php','Favicon', 'Favicon', 'edit_theme_options', 'favicon', 'site_fav_page');
}
// Load the Admin Options page
add_action('admin_menu', 'site_fav_menu_options');
 
function site_fav_page() {
    ?>
        <div class="wrap">
            <h2><?php /* translators: admin settings */ _e( 'Favicon', 'site_fav' ); ?></h2>
			<p>Favicons are the 16x16px icons that appear in browser tabs and toolbars next to the title of the site. Make sure the file you upload is 16x16 and saved in .png format.</p>
            <?php 
				$site_fav_id = get_option('site_fav_id'); 
				$site_fav_url = wp_get_attachment_image_src( $site_fav_id );
			?>
			<div class="image-upload-preview">
				<h5>Preview:</h5>
				<img id="site_fav_preview" src="<?php echo $site_fav_url[0]; ?>" />
			</div>
			<form method="POST" action="">  
           		<input type="hidden" name="site_fav_update" value="true" />
				<input id="site_fav_id" type="hidden" name="site_fav_id" value="<?php echo $site_fav_id; ?>" />
				<input id="site_fav_select" class="button" type="button" value="Select Image" /><br />
<br />

				<input type="submit" value="Save" class="button button-primary" />
			</form>
			<script>
				jQuery(document).ready(function(){
					wp_image_upload('site_fav');	
				});
			</script>
        </div>
    <?php
}

function site_fav_update(){  
	// this is where validation would go   
	update_option('site_fav_id',  $_POST['site_fav_id']);  
}
$site_fav_update = isset( $_POST['site_fav_update'] ) ? $_POST['site_fav_update'] : '';
if ( $site_fav_update == 'true' ) { site_fav_update(); } 


?>