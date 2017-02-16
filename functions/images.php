<?php
// Add thumbnail and featured image support
function tfbase_images() {
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 430, 400 ); // default Post Thumbnail dimensions
	add_image_size( 'dataURI-preview', 20, 15); 
	add_image_size( 'small', 270, 185, true ); //
	add_image_size( 'page-background', 1280, 800);
	add_image_size( 'page-background-medium', 768, 1024);
	add_image_size( 'page-background-mob', 425, 700, true);
    add_image_size( 'grid-square-img', 600, 600, true);
	// set new default width for "medium" size
	update_option('medium_size_w', 700);
}
add_action('after_setup_theme','tfbase_images');

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'bones_filter_ptags_on_images');

// Increase default JPEG compression quality
add_filter( 'jpeg_quality', create_function( '', 'return 70;' ) );

// Switch image uploads to https://
function have_https_for_media( $url ) {
	if ( is_ssl() )
		$url = str_replace( 'http://', 'https://', $url );
	return $url;
}
add_filter( 'wp_get_attachment_url', 'have_https_for_media' );

// Allow SVG uploads
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function scaled_image_path($attachment_id, $size) {
    $file = get_attached_file($attachment_id, true);
    if (empty($size) || $size === 'full') {
        // for the original size get_attached_file is fine
        return realpath($file);
    }
    if (! wp_attachment_is_image($attachment_id) ) {
        return false; // the id is not referring to a media
    }
    $info = image_get_intermediate_size($attachment_id, $size);
    if (!is_array($info) || ! isset($info['file'])) {
        return false; // probably a bad size argument
    }

    return realpath(str_replace(wp_basename($file), $info['file'], $file));
}

function getDataURI($image_id) {
	$image_path = scaled_image_path($image_id, "dataURI-preview");
    if ( $image_path ){
        $mimetype = mime_content_type($image_path);
        return 'data:'.$mimetype.';base64,'.base64_encode(file_get_contents($image_path));
    }
}

// Display resized image URLs in admin
// Adds a "Sizes" column
function sizes_column( $cols ) {
        $cols["sizes"] = "Sizes";
        return $cols;
}

// Fill the Sizes column
function sizes_value( $column_name, $id ) {
    if ( $column_name == "sizes" ) {
        // Including the direcory makes the list much longer 
        // but required if you use /year/month for uploads
        $up_load_dir =  wp_upload_dir();
        $dir = $up_load_dir['url'];
        $dir_url = str_replace('http://', 'https://', $dir );

        // Get the info for each media item
        $meta = wp_get_attachment_metadata($id);

        // and loop + output
        foreach ( $meta['sizes'] as $name=>$info) {
            // could limit which sizes are output here with a simple if $name ==
            echo "<strong>" . $name . "</strong><br>";
            echo "<small>" . $dir_url . "/" . $info['file'] . " </small><br>";
        }
    }
}

// Hook actions to admin_init
function hook_new_media_columns() {
    add_filter( 'manage_media_columns', 'sizes_column' );
    add_action( 'manage_media_custom_column', 'sizes_value', 10, 2 );
}
add_action( 'admin_init', 'hook_new_media_columns' )

?>