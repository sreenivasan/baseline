<?php

/* Wrap '350' in site title with <span class="tf-logo"> so CSS can style it */
function tf_site_title(){
	$title = get_bloginfo('title');
	if  ( preg_match('/350/', $title) ){
		$new_title = preg_replace('/350/', '<span class="tf-logo title-350logo">350</span><span class="title-text">', $title . '</span>');
		return $new_title;
	} else {
		return $title;
	}
}

function tf_header_options_menu(){
	// here's where we add our theme options page link to the dashboard sidebar
	add_submenu_page('themes.php', "Header Options", "Header", 'manage_options', basename(__FILE__), 'tf_header_options_page');
}

function tf_header_options_page(){
	// here is the main function that will generate our options page
	 ?>
    <div class="wrap">
        <h2>Header Options</h2>
        <form method="POST" action="">
            <input type="hidden" name="update_tf_header_options" value="true" />

			<?php
				/* Check for site_colors option, use default 350 colors if not present */
				$site_colors_default_string = "White:white:rgb(255,255,255):dark:default\nBlue:blue:rgb(15,129,233):light:light\nOrange:orange:rgb(255,169,2):light:light\nDark Gray:dkgray:rgb(23,41,46):light:light\nDark Gray (transparent):dkgray-trans:rgba(23,41,46,0.6):light:light\nLight Gray:ltgray:rgb(218,230,242):dark:dark\nTransparent:transparent:rgba(0,0,0,0):light:light";
				$site_colors_option = trim( get_option('site_colors', $site_colors_default_string) );
				$site_colors_raw = !empty( $site_colors_option ) ? $site_colors_option : $site_colors_default_string;
				$site_colors = tfArrayifyColors( $site_colors_raw );

				$header_buttons = stripslashes( get_option('header_buttons') );
				 /* translators: admin settings */
				$site_nav_button_label = get_option('site_nav_button_label', __('Menu','baseline') );
			?>


			<h3>Show Header</h3>
			<p>
				<input value="" type="radio" name="site_hide_header" id="site_hide_header_false" <?php if ( !(get_option('site_hide_header')) ){ echo 'checked'; } ?> /> <label for="site_hide_header_false"><strong>Show Header</strong> (default)</label>
			</p>
			<p>
				<input value="true" type="radio" name="site_hide_header" id="site_hide_header_true" <?php if ( (get_option('site_hide_header')) ){ echo 'checked'; } ?> /> <label for="site_hide_header_true"><strong>Hide Header</strong> — Hides header bar, site title, and header buttons. Nav remains visible.</label>
			</p>
			<hr>
			<h3>Header Layout</h3>
			<p>
				<input value="site-header-layout-compact" type="checkbox" name="site_header_layout" id="site_header_layout" <?php if ( (get_option('site_header_layout')) ){ echo 'checked'; } ?>  <label for="site_header_layout">Enable experimental compact layout (CSS flexbox-mode).</label>
			</p>
			<hr>
			<h3>Header Alignment</h3>
			<p>
				<input value="text-center" type="radio" name="site_header_alignment" id="site_header_alignment_center" <?php if ( (get_option('site_header_alignment','text-center') == 'text-center' ) ){ echo 'checked'; } ?> /> <label for="site_header_alignment_center"><strong>Center-aligned (default)</strong></label>
			</p>
			<p>
				<input value="text-left" type="radio" name="site_header_alignment" id="site_header_alignment_left" <?php if ( (get_option('site_header_alignment') == 'text-left' ) ){ echo 'checked'; } ?> /> <label for="site_header_alignment_left"><strong>Left-aligned</strong></label>
			</p>
			<hr>
			<h3>Header + Nav colors</h3>
			<label for="site_header_bgcolor">Header Background Color</label>
			<select id="site_header_bgcolor" name="site_header_bgcolor">
				<?php foreach ( $site_colors as $color ){ ?>
				<option <?php if ( get_option('site_header_bgcolor') == $color['slug'] ){ echo 'selected'; } ?> value="<?php echo $color['slug']; ?>"><?php echo $color['name']; ?></option>
				<?php } ?>
			</select>
			<br>
			<label for="site_mainnav_bgcolor">Main Nav Background Color</label>
			<select id="site_mainnav_bgcolor" name="site_mainnav_bgcolor">
				<?php foreach ( $site_colors as $color ){ ?>
				<option <?php if ( get_option('site_mainnav_bgcolor','dkgray-trans') == $color['slug'] ){ echo 'selected'; } ?> value="<?php echo $color['slug']; ?>"><?php echo $color['name']; ?></option>
				<?php } ?>
			</select>
			<br>
			<label for="site_langnav_bgcolor">Language Nav Background Color</label>
			<select id="site_langnav_bgcolor" name="site_langnav_bgcolor">
				<?php foreach ( $site_colors as $color ){ ?>
				<option <?php if ( get_option('site_langnav_bgcolor') == $color['slug'] ){ echo 'selected'; } ?> value="<?php echo $color['slug']; ?>"><?php echo $color['name']; ?></option>
				<?php } ?>
			</select>
			<p><input type="submit" value="Save Changes" name="search"  class="button button-primary" /></p>
			<hr/>
			<label for="header_buttons"><strong>Code for Header buttons, top right</strong></label><br />
			<textarea style="font-family:monospace;" name="header_buttons" id="header_buttons" rows="6" cols="75"><?php echo ( $header_buttons ); ?></textarea><br />
			<hr>
			<label for="site_nav_button_label"><strong><?php  /* translators: admin settings */ _e('Site Nav "Menu" Button Text','baseline'); ?></strong></label>
			<p class="small"><em><?php  /* translators: admin settings */ _e('Leave blank to use just the <span style="display: inline-block; width: 18px; background: rgba(255, 255, 255, 0.6) url(&quot;data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4yIiBiYXNlUHJvZmlsZT0idGlueSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiDQoJIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjAgNjAiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHJlY3QgZmlsbD0iIzE3MjkyRSIgd2lkdGg9IjYwIiBoZWlnaHQ9IjEyIi8+DQo8cmVjdCB5PSI0OCIgZmlsbD0iIzE3MjkyRSIgd2lkdGg9IjYwIiBoZWlnaHQ9IjEyIi8+DQo8cmVjdCB5PSIyNCIgZmlsbD0iIzE3MjkyRSIgd2lkdGg9IjYwIiBoZWlnaHQ9IjEyIi8+DQo8L3N2Zz4NCg==&quot;) no-repeat scroll center center / 14px 14px; height: 14px;"> </span> icon.','baseline'); ?></em></p>
			<input type="text" name="site_nav_button_label" id"site_nav_button_label" value="<?php echo $site_nav_button_label; ?>">
			<br>
			<h4>Main Navigation Display Options</h4>
			<p><em>To disable the menu, go to <a href="nav-menus.php?action=locations">Appearance > Menus > Menu Locations</a> and set "Main Navigation" to "— Select a Menu —".</em></p>
			<label for="site_nav_display_desktop">Large-sized Screens (Desktop)</label>
			<select id="site_nav_display_desktop" name="site_nav_display_desktop">
				<option value="nav-desktop-dropdown" <?php if ( get_option('site_nav_display_desktop','nav-desktop-dropdown') == 'nav-desktop-dropdown' ){ echo 'selected'; } ?> >Drop-down Menu</option>
				<option value="nav-desktop-modal" <?php if ( get_option('site_nav_display_desktop') == 'nav-desktop-modal' ){ echo 'selected'; } ?> >Slide-out Modal Overlay</option>
			</select>
			<p><input type="submit" value="Save Changes" name="search"  class="button button-primary" /></p>
		</form>
	</div>
	<?php
}

add_action('admin_menu', 'tf_header_options_menu');

//////////////////
// Update the DB with new theme options
//////////////////

    function tf_header_options_update(){
        // this is where validation would go
		update_option('site_header_bgcolor',  $_POST['site_header_bgcolor']);
		update_option('site_mainnav_bgcolor',  $_POST['site_mainnav_bgcolor']);
		update_option('site_langnav_bgcolor',  $_POST['site_langnav_bgcolor']);
		update_option('site_hide_header',  $_POST['site_hide_header']);
		update_option('site_header_layout',  $_POST['site_header_layout']);
		update_option('site_header_alignment',  $_POST['site_header_alignment']);
		update_option('header_buttons',  $_POST['header_buttons']);
		update_option('site_nav_button_label',  $_POST['site_nav_button_label']);
		update_option('site_nav_display_desktop',  $_POST['site_nav_display_desktop']);
	}
$update_tf_header_options = isset( $_POST['update_tf_header_options'] ) ? $_POST['update_tf_header_options'] : '';
  if ( $update_tf_header_options == 'true' ) { tf_header_options_update(); }

?>
