<?php 

function tf_layout_menu(){  
	// here's where we add our theme options page link to the dashboard sidebar  
	add_submenu_page('themes.php', "Layout Options", "Layout", 'manage_options', basename(__FILE__), 'tf_layout_page'); 
} 

function tf_layout_page(){ 
	// here is the main function that will generate our options page 
	 ?>  
    <div class="wrap">  
        <h2>Layout Options</h2>  
        <form method="POST" action="">  
            <input type="hidden" name="update_tf_layout_options" value="true" />  	
			<h3>Header Layout</h3>
			<p>
				<input value="" type="radio" name="site_header_layout" id="site_header_layout_vert" <?php if ( !(get_option('site_header_layout')) ){ echo 'checked'; } ?> /> <label for="site_header_layout_vert"><strong>Expanded</strong> <br/>The logo and navigation are each full-width and stacked on top of each other. More room for larger logos and more nav menu items.</label>
			</p>
			<p>
				<input value="horz" type="radio" name="site_header_layout" id="site_header_layout_horz" <?php if ( get_option('site_header_layout') ){ echo 'checked'; } ?> /> <label for="site_header_layout_horz"><strong>Compact</strong> <br> A narrow header with the logo, navigation and optional social media buttons arranged left-to-right in a single row. Less room, but takes up less space on the page.</label>
			<p>
				<input type="text" name="site_header_bgcolor" value="<?php if ( get_option('site_header_bgcolor') ){ echo get_option('site_header_bgcolor'); } ?>" id="site_header_bgcolor"/> <label for="site_header_bgcolor"><strong>Header background color</strong>. Optional, leave blank for transparent. Use CSS formats for color: Hex, RGB, RGBA, etc.</label>
			</p>
			<p><input type="submit" value="Save Changes" name="search"  class="button button-primary" /></p>  
			<hr/>
			<h3>Blog Post Display</h3>
			<p><input type="checkbox" name="blog_excerpt_or_full" id="blog_excerpt_or_full" <?php if (get_option('blog_excerpt_or_full')) { ?> checked <?php } ?> /> <label for="blog_excerpt_or_full">Show full posts (default is an excerpt of the post with a thumbnail)</label> </p>
			<p><input type="submit" value="Save Changes" name="search"  class="button button-primary" /></p>  
		</form>
	</div>
	<?php  
} 
 
add_action('admin_menu', 'tf_layout_menu');  

//////////////////
// Update the DB with new theme options
//////////////////
 
function tf_layout_options_update(){  
    // this is where validation would go   
	update_option('site_header_layout',  $_POST['site_header_layout']);  
	if ($_POST['site_header_layout']=='horz') { $headerlayout = 'checked'; } else { $headerlayout = ''; }
	update_option('site_header_alignment',  $_POST['site_header_alignment']);  
	if ($_POST['site_header_alignment']=='centered') { $headeralign = 'checked'; } else { $headeralign = ''; }
	update_option('site_header_bgcolor',  $_POST['site_header_bgcolor']);
	if ($_POST['blog_excerpt_or_full']=='on') { $display = 'checked'; } else { $display = ''; }  
    update_option('blog_excerpt_or_full', $display);
}
$update_tf_layout_options = isset( $_POST['update_tf_layout_options'] ) ? $_POST['update_tf_layout_options'] : '';
if ( $update_tf_layout_options == 'true' ) { tf_layout_options_update(); } 

?>