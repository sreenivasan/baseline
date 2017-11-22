<?php
add_action( 'init', 'create_crosspost_taxonomy', 0 );

function create_crosspost_taxonomy() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Crosspost Locations', 'taxonomy general name' ),
		'singular_name'              => _x( 'Crosspost Location', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Crosspost Locations' ),
		'popular_items'              => __( 'Popular Crosspost Locations' ),
		'all_items'                  => __( 'All Crosspost Locations' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Crosspost Location' ),
		'update_item'                => __( 'Update Crosspost Location' ),
		'add_new_item'               => __( 'Add New Crosspost Location' ),
		'new_item_name'              => __( 'New Crosspost Location Name' ),
		'separate_items_with_commas' => __( 'Separate crosspost locations with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Crosspost Locations' ),
		'choose_from_most_used'      => __( 'Choose from the most used Crosspost Locations' ),
		'not_found'                  => __( 'No Crosspost Locations found.' ),
		'menu_name'                  => __( 'Crosspost Locations' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'crosspost-location' ),
	);

	register_taxonomy( 'crosspost-location', array( 'post','press_release' ), $args );
}	