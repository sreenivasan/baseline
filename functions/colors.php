<?php
// Add "Colors" settings page to the "Appearance" menu
function site_colors_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('themes.php','Colors', 'Colors', 'edit_theme_options', 'colors', 'site_colors_page');
}
// Load the Admin Options page
add_action('admin_menu', 'site_colors_menu_options');
 
function site_colors_page() {

	$site_colors_default_array = array (
	      array(
	        'name' => 'White',
	        'slug' => 'white',
	        'code' => 'rgb(255,255,255)',
	        'text' => 'dark',
	        'link' => 'rgb(15,129,233)',
	        'link_hover' => 'rgba(15,129,233,0.7)'
	      ),
	      array(
	        'name' => 'Blue',
	        'slug' => 'blue',
	        'code' => 'rgb(15,129,233)',
	        'text' => 'light',
	        'link' => 'auto',
	        'link_hover' => 'auto'
	      ),
	      array(
	        'name' => 'Orange',
	        'slug' => 'orange',
	        'code' => 'rgb(255,169,2)',
	        'text' => 'light',
	        'link' => 'auto',
	        'link_hover' => 'auto'
	      ),
	      array(
	        'name' => 'Light Gray',
	        'slug' => 'ltgray',
	        'code' => 'rgb(218,230,242)',
	        'text' => 'dark',
	        'link' => 'auto',
	        'link_hover' => 'auto'
	      ),
	      array(
	        'name' => 'Dark Gray',
	        'slug' => 'dkgray',
	        'code' => 'rgb(23,41,46)',
	        'text' => 'light',
	        'link' => 'auto',
	        'link_hover' => 'auto'
	      ),
	      array(
	        'name' => 'Transparent',
	        'slug' => 'transparent',
	        'code' => 'rgba(0,0,0,0)',
	        'text' => 'light',
	        'link' => 'auto',
	        'link_hover' => 'auto'
	      )
	);
	$site_colors_default_string = "White:white:rgb(255,255,255):dark:default:default\nBlue:blue:rgb(15,129,233):light:auto:auto\nOrange:orange:rgb(255,169,2):light:auto:auto\nDark Gray:dkgray:rgb(23,41,46):light:auto:auto\nDark Gray (transparent):dkgray-trans:rgba(23,41,46,0.6):light:auto:auto\nLight Gray:ltgray:rgb(218,230,242):dark:auto:auto\nTransparent:transparent:rgba(0,0,0,0):light:auto:auto";
    ?>
        <div class="wrap">
            <h2><?php /* translators: admin settings */ _e( 'Colors', 'site_colors' ); ?></h2>
            <?php /* Check for site_colors option, use default 350 colors if not present */
				$site_colors_option = trim( get_option('site_colors') );
				if ( $site_colors_option ){
					$site_colors = $site_colors_option;
				} else {
					$site_colors = $site_colors_default_string; 
				}
			?>
			<p>No UI for this yet :(</p>
			<p>Format is "[Color Name]:[color slug]:[color CSS code]:[text light/dark]:[link color CSS]:[link hover color CSS]", with each color on its own line. Example:</p>
			<p><code>White:white:#fff:dark:default:default<br>Blue:blue:#0f81e8:light:auto:auto<br>Light Gray:ltgray:#dae6f2:dark:auto:auto</code></p>
			<p><strong>Defaults:</strong> 350's brand colors (white, blue, orange, dark gray, light gray).</p>
			<form method="POST" action="">  
           		<input type="hidden" name="site_colors_update" value="true" />
				<textarea id="site_colors_input" type="textarea" name="site_colors" style="width:100%;max-width:650px;height:220px;font-family:monospace;"><?php echo $site_colors; ?></textarea><br>
				<br><hr>
		        <?php 
					$site_colors_array = tfArrayifyColors( $site_colors ); 
				?>
				<label for="site_link_color"><strong>Default Link Color</strong></label>
				<select id="site_link_color" name="site_link_color">
					<?php foreach ( $site_colors_array as $site_color ){ ?>
					<option <?php if ( get_option('site_link_color','rgb(15,129,233)') == $site_color['code'] ){ echo 'selected'; } ?> value="<?php echo $site_color['code']; ?>"><?php echo $site_color['name']; ?></option>
					<?php } ?>
				</select>
				<br><hr>
				<label for="site_button_color"><strong>Default Button Color</strong></label>
				<select id="site_button_color" name="site_button_color">
					<?php foreach ( $site_colors_array as $site_color ){ ?>
					<option <?php if ( get_option('site_button_color','rgb(15,129,233)') == $site_color['code'] ){ echo 'selected'; } ?> value="<?php echo $site_color['code']; ?>"><?php echo $site_color['name']; ?></option>
					<?php } ?>
				</select>
				<br><hr><br>
				<input type="submit" value="Save Changes" class="button button-primary" />
			</form>
        </div>

    <?php
}

function tfArrayifyColors($colors_raw){
	if ( $colors_raw ){
	    /* json_decode doesn't work on WPEngine's PHP v4.x :((
	    $sp_colors = json_decode( $site_colors_json, true);
	    ... so do it the old-fashioned way: */
	    $colors_array = array();
	    // break the string by End Of Line
	    $colors = explode(PHP_EOL, trim( $colors_raw ));
	    // iterate through the lines.
	    	foreach( $colors as $color ) { 
	        // just make sure that the line's whitespace is cleared away
	        $color = trim( $color );
	        if( $color ){
	            // break the line at the colon
	            $pieces = explode( ":", $color );
	            // Add each piece with it's corresponding key to a new sub-array
	            $colors_array[] = array( 'name' => $pieces[0], 'slug' => $pieces[1], 'code' => $pieces[2], 'text' => $pieces[3], 'link' => $pieces[4], 'link_hover' => $pieces[5] );

	        }
	    }
	} else {

	} 
	return $colors_array;
}

function site_colors_update(){  
	// this is where validation would go   
	$site_colors_filtered = trim( stripslashes('site_colors') );
	update_option('site_colors', $_POST[ $site_colors_filtered ]);  
	update_option('site_link_color',  $_POST['site_link_color']);
	update_option('site_button_color',  $_POST['site_button_color']);
}
// Check if $_POST variable exists first, WPDEBUG will throw warnings if you don't
$site_colors_update_var = false;
if (isset( $_POST['site_colors_update']) ){
	$site_colors_update_var = $_POST['site_colors_update'];
}
if ($site_colors_update_var  == 'true' ){ 
	site_colors_update(); 
} 

?>