<?php

add_theme_support( 'custom-background' );

// Add "tflogo Options" link to the "Appearance" menu
function site_bg_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('themes.php','Background', 'Background Image', 'edit_theme_options', 'bg-image', 'site_bg_page');
}
// Load the Admin Options page
add_action('admin_menu', 'site_bg_menu_options');

function site_bg_page() {
    ?>
        <div class="wrap">
            <h2><?php /* translators: admin settings */ _e( 'Background Image', 'threefifty_world' ); ?></h2>
            <?php
				$theme_bg_id = get_option('theme_bg');
				$theme_bg_url = wp_get_attachment_image_src( $theme_bg_id, 'page-background');
			?>
			<div class="image-upload-preview">
				<h5>Preview:</h5>
				<img id="site_bg_preview" src="<?php if ( $theme_bg_id ){ echo $theme_bg_url[0]; } else { echo 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; } ?>" style="max-width:750px;"/>
			</div>
			<form method="POST" action="">
           		<input type="hidden" name="site_bg_update" value="true" />
				<input id="site_bg_id" type="hidden" name="theme_bg" value="<?php echo $theme_bg; ?>" />
				<input id="site_bg_select" class="button" type="button" value="Select Image" /> <input id="site_bg_clear" class="button" type="button" value="Remove Image" /> <br />
<br />

				<input type="submit" value="Save" class="button button-primary" />
			</form>
			<p>Recommended dimensions: 1400 pixels wide, 800 pixels tall (1400x800).
			<script>
				jQuery(document).ready(function(){
					wp_image_upload('site_bg');
				});
			</script>
        </div>
    <?php
}

function site_bg_update(){
	// this is where validation would go
	update_option('theme_bg',  $_POST['theme_bg']);
}
$site_bg_update = isset( $_POST['site_bg_update'] ) ? $_POST['site_bg_update'] : '';
if ( $site_bg_update == 'true' ) { site_bg_update(); }



?>
