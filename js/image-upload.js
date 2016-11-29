function wp_image_upload($namespace){	

var image_custom_uploader;
jQuery('#' + $namespace +'_select').click(function(e) {
	e.preventDefault();
	
	//If the uploader object has already been created, reopen the dialog
	if (image_custom_uploader) {
		image_custom_uploader.open();
		return;
	}

	//Extend the wp.media object
	image_custom_uploader = wp.media.frames.file_frame = wp.media({
		title: 'Choose Image',
		button: {
		text: 'Choose Image'
		},
		multiple: false
	});
	
	//When a file is selected, grab the WP Image ID and set it as the text field's value
	image_custom_uploader.on('select', function() {
		attachment = image_custom_uploader.state().get('selection').first().toJSON();
		var url = '';
		url = attachment['url'];
		id = attachment['id'];
		jQuery('#' + $namespace +'_id').val(id);
		jQuery('#' + $namespace +'_url').val(url);
		jQuery('#' + $namespace +'_preview').attr('src',url);
	});
	
	//Open the uploader dialog
	image_custom_uploader.open();
});

jQuery('#' + $namespace +'_clear').on('click',function(){
	jQuery('#' + $namespace +'_preview').attr('src','data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
	jQuery('#' + $namespace +'_url').val('');
	jQuery('#' + $namespace +'_id').val('');
});

}