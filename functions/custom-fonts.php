<?php
// Add "Custom Fonts" link to the "Appearance" menu
function fonts_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('themes.php','Fonts', 'Fonts', 'edit_theme_options', 'fonts', 'site_fonts_page');
}
// Load the Admin Options page
add_action('admin_menu', 'fonts_menu_options');
 
function site_fonts_page() {
    ?>
        <div class="wrap">
            <h2><?php _e( 'Fonts', 'baseline' ); ?></h2>
            <?php 
				$site_display_font = stripslashes (get_option('site_display_font','GraphCondensedWeb') ); 
				$site_body_font = stripslashes (get_option('site_body_font','-apple-system,BlinkMacSystemFont,arial') ); 
				$site_secondary_font = stripslashes (get_option('site_secondary_font','Menlo,Monaco,Courier,monospace') ); 
				$site_fallback_font = stripslashes (get_option('site_fallback_font','sans-serif') ); 
				$site_font_loader_code = stripslashes (get_option('site_font_loader_code') ); 
				$site_text_on_image_classes = stripslashes (get_option('site_text_on_image_classes') ); 
				$site_display_font_size_modifier = get_option('site_display_font_size_modifier',1.2);
				$site_display_font_line_height = get_option('site_display_font_line_height', 0.95);
				
			?>
			<form method="POST" action="">  
           		<input type="hidden" name="site_fonts_update" value="true" />
           		<h3>Loading Fonts</h3>
           		<label for="site_font_loader_code">Code for loading custom fonts:</label>
           		<p><small>CAUTION: this field outputs directly to the &lt;head&gt; of your website, so typos or mistakes can prevent your site from loading. Paste in font loading code from <a href="http://www.google.com/fonts#UsePlace:use/Collection:Lusitana" target="_blank">Google Fonts</a>, <a href="http://www.typekit.com" target="_blank">Typekit</a>, etc. Replaces the existing loaded fonts (Klima and Graph).</small></p>
				<textarea style="height:200px;width:550px;font-family:courier,monospace;" id="site_font_loader_code" name="site_font_loader_code"><?php echo $site_font_loader_code; ?></textarea><br />
				<hr>
				<h3>Font Names</h3>
				<p>(Use font names as they should appear in the CSS)</p>
				<div>
					<input type="text" name="site_display_font" id="site_display_font" value="<?php echo $site_display_font; ?>" />
					<label for="site_display_font"><strong>Display Font</strong> — used for titles, headings and buttons.</label>
				</div>
				<div>
					<input type="text" name="site_body_font" id="site_body_font" value="<?php echo $site_body_font; ?>" />
					<label for="site_body_font"><strong>Body Font</strong> — used for most of the text on the page. Should be legible at small sizes.</label>
				</div>
				<div>
					<input type="text" name="site_secondary_font" id="site_secondary_font" value="<?php echo $site_secondary_font; ?>" />
					<label for="site_secondary_font"><strong>Secondary Font</strong> — used for accent text and "meta" information.</label>
				</div>
				<div>
					<input type="text" name="site_fallback_font" id="site_fallback_font" value="<?php echo $site_fallback_font; ?>" />
					<label for="site_fallback_font"><strong>Fallback Fonts</strong> — shows up if the other fonts fail to load ("Georgia,serif" or "Arial,sans-serif", typically)</label>
				</div>
				<hr>
				<h3>Heading Text Options</h3>
				<p>If you're loading custom fonts, they can sometimes vary in size. Use this setting to normalize the font size and line spacing. Defaults are set for Graph Condensed.</p> 
				<div>
					<input type="number" min="0.7" max="1.7" step="0.05" name="site_display_font_size_modifier" id="site_display_font_size_modifier" value="<?php echo $site_display_font_size_modifier; ?>" />
					<label for="site_display_font_size_modifier"><strong>Heading Text Size Multiplier</strong> — [original font size] * [multiplier] = [final font size]. Typical values will range between 0.8 and 1.5.</label><br>
					<input type="number" min="0.7" max="1.8" step="0.05" name="site_display_font_line_height" id="site_display_font_line_height" value="<?php echo $site_display_font_line_height; ?>" />
					<label for="site_display_font_line_height"><strong>Heading Text Line Height</strong> —  </label>
				</div>
				<hr>
				<h3>Text on image (optional)</h3>
				<p>Choose how to add contrast and legibility to text that appears on top of the background image. Use built-in CSS classes like "highlight bg-white" "outline" or "drop-shadow", or add your CSS classes in the <a href="options-general.php?page=custom-code.php">Custom CSS</a> section.</p> 
				<div>
					<input type="text" name="site_text_on_image_classes" id="site_text_on_image_classes" value="<?php echo $site_text_on_image_classes; ?>" />
					<label for="site_text_on_image_classes"><strong>Text on image CSS classes</strong></label>
				</div>
				<hr>
				<input type="submit" value="Save" class="button button-primary" />
			</form>
        </div>
    <?php
}

function site_fonts_update(){  
	// this is where validation would go   
	update_option('site_display_font',  $_POST['site_display_font']);  
	update_option('site_body_font',  $_POST['site_body_font']);  
	update_option('site_secondary_font',  $_POST['site_secondary_font']); 
	update_option('site_fallback_font',  $_POST['site_fallback_font']); 
	update_option('site_font_loader_code',  $_POST['site_font_loader_code']); 
	update_option('site_text_on_image_classes',  $_POST['site_text_on_image_classes']);
	update_option('site_display_font_size_modifier',  $_POST['site_display_font_size_modifier']); 
	update_option('site_display_font_line_height',  $_POST['site_display_font_line_height']); 
	
}
$site_fonts_update = isset( $_POST['site_fonts_update'] ) ? $_POST['site_fonts_update'] : '';
if ( $site_fonts_update == 'true' ) { site_fonts_update(); } 


?>