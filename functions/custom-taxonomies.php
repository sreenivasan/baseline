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
		'show_ui'               => false,
		'show_in_menu'          => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'crosspost-location' ),
	);

	register_taxonomy( 'crosspost-location', array( 'post','press_release' ), $args );
}	

	register_field_group(array (
		'id' => 'acf_crosspost-locations',
		'title' => 'Crosspost Locations',
		'fields' => array (
			array (
				'key' => 'field_5a1dcbedbad59',
				'label' => '',
				'name' => 'crosspost_location_field',
				'type' => 'taxonomy',
				'instructions' => 'Make a copy of this content on the sites listed below (in the language-version that matches this site). Contact the Web team to create a new crosspost location.',
				'taxonomy' => 'crosspost-location',
				'field_type' => 'checkbox',
				'allow_null' => 1,
				'load_save_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'press-release',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 2,
	));

}

?>