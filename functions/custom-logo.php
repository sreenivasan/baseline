<?php
// Add "tflogo Options" link to the "Appearance" menu
function site_logo_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('themes.php','Logo', 'Logo', 'edit_theme_options', 'logo', 'site_logo_page');
}
// Load the Admin Options page
add_action('admin_menu', 'site_logo_menu_options');
 
function site_logo_page() {
    ?>
        <div class="wrap">
            <h2><?php _e( 'Logo', 'site_logo' ); ?></h2>
            <?php 
				$site_logo_url = get_option('site_logo_url'); 
			?>
			<div class="image-upload-preview">
				<h5>Preview:</h5>
				<img id="site_logo_preview" src="<?php if ( $site_logo_url ){ echo $site_logo_url[0]; } else { echo 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; } ?>" />
			</div>
			<form method="POST" action="">  
           		<input type="hidden" name="site_logo_update" value="true" />
				<input id="site_logo_url" type="hidden" name="site_logo_url" value="<?php echo $site_logo_url[0]; ?>" />
				<input id="site_logo_select" class="button" type="button" value="Select Image" /> <?php if ( $site_logo_url ) { ?> <input id="site_logo_clear" class="button" type="button" value="Remove Image" /> <?php } ?><br />
<br />

				<input type="submit" value="Save" class="button button-primary" />
			</form>
			<p><em>Note: Logo images larger than 700px wide or 110px tall will be scaled down to fit.</em></p>
			<script>
				jQuery(document).ready(function(){
					wp_image_upload('site_logo');	
				});
			</script>
        </div>
    <?php
}

function site_logo_update(){  
	// this is where validation would go   
	update_option('site_logo_url',  $_POST['site_logo_url']);  
}
$site_logo_update = isset( $_POST['site_logo_update'] ) ? $_POST['site_logo_update'] : '';
if ( $site_logo_update == 'true' ) { site_logo_update(); } 


?>