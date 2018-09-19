<?php

function customcode_admin_menu(){
	add_submenu_page('options-general.php', "Custom Code", "Custom Code", 'manage_options', basename(__FILE__), 'customcode_page');
}

function customcode_page(){
	// here is the main function that will generate our options page
?>
<div class="wrap">
  <h2>Custom Code</h2>
	<p><span style="background:yellow;"><strong>WARNING:</strong> Because this allows you to insert unfiltered code, it's easy to break your website by using these options. Only recommended for people with knowledge of how websites work.</span></p>
  <form method="POST" action="">
    <input type="hidden" name="update_customcode" value="true" />

		<h3>Insert code in header</h3>
		<div style="padding:6px 12px;background:#e3e5e7;border-radius:3px;margin-bottom:20px;">
			<label for="customcode"><strong>Add custom code into the &lt;head&gt; of your website</strong></label><br />
			<textarea style="font-family:monospace;" name="customcode" id="customcode" rows="5" cols="75"><?php echo ( stripslashes( get_option('customcode') ) ); ?></textarea><br />
		</div>
		<p><input type="submit" name="search" value="Save Changes" class="button button-primary" /></p>

		<h3>Custom CSS styles</h3>
		<div style="padding:6px 12px;background:#e3e5e7;border-radius:3px;margin-bottom:20px;">
			<label for="custom_css"><strong>Appends your own custom CSS styles to the end of the main stylesheet.</strong></label><br />
			<textarea style="font-family:monospace;" name="custom_css" id="custom_css" rows="6" cols="75"><?php echo ( stripslashes( get_option('custom_css') ) ); ?></textarea><br />
		</div>
		<p><input type="submit" name="search" value="Save Changes" class="button button-primary" /></p>

	</form>
</div>

<?php }
add_action('admin_menu', 'customcode_admin_menu');

//////////////////
// Update the DB with new theme options
//////////////////

    function customcode_update(){
        // this is where validation would go
		update_option('customcode',  $_POST['customcode']);
		update_option('custom_css',  $_POST['custom_css']);
	}

$update_customcode = isset( $_POST['update_customcode'] ) ? $_POST['update_customcode'] : '';
  if ( $update_customcode == 'true' ) { customcode_update(); }


?>
