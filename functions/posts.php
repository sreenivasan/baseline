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
         /* translators: admin settings */
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
         /* translators: admin settings */
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

// Change default "more..." text to language-agnostic "..."
function new_excerpt_more( $more ) {
    return '<span class="text-cutoff">...</span>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// display featured post thumbnails in WordPress feeds (why doesn't WP do this by default?)
function post_thumbnails_in_feeds( $content ) {
    global $post;
    if( has_post_thumbnail( $post->ID ) ) {
        $content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
    }
    return $content;
}
add_filter( 'the_excerpt_rss', 'post_thumbnails_in_feeds' );
add_filter( 'the_content_feed', 'post_thumbnails_in_feeds' );

?>
