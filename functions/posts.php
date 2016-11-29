<?php 

/* Add options to Settings > Reading */
add_action('admin_init', 'baseline_post_options_section');  
function baseline_post_options_section() {  
    add_settings_section(
        'baseline_post_options',
        'Post Display Options',
        'settings_section_callback',
        'reading'
    );
    add_settings_field(
        'post_show_author',
        __('Show Author Name and Photo','baseline'),
        'settings_checkbox_callback',
        'reading',
        'baseline_post_options',
        array( 
            'label_for' => 'post_show_author',
            'id' => 'post_show_author'
        )
    );
    add_settings_field(
        'post_show_categories',
        __('Show Categories','baseline'),
        'settings_checkbox_callback',
        'reading',
        'baseline_post_options',
        array(
            'label_for' => 'post_show_categories', 
            'id' => 'post_show_categories' 
        )
    ); 
    register_setting( 'reading', 'post_show_author'  );
    register_setting( 'reading', 'post_show_categories'  );
}

function settings_section_callback( $arg ){ // Section Callback
    echo '';  
}
function settings_checkbox_callback( $args ){ 
    $value = get_option( $args['id'] ); 
    echo '<input type="checkbox" id="'  . $args['id'] . '" name="'  . $args['id'] . '" value="1" ' . checked( $value, '1', 0 ) . '>';
}


// Adjust excerpt length
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Change default "more..." text to Int'l friendly "..."
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* function og_excerpt($text, $excerpt) {
    if ($excerpt) return $excerpt;
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
} */

?>