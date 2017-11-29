<?php
if( function_exists("register_field_group") )
{
	register_field_group(array (
		'id' => 'acf_custom-social-media-fields',
		'title' => 'Custom Social Media Fields',
		'fields' => array (
			array (
				'key' => 'field_529e3e7f1a23a',
				'label' => 'Custom Social Media Share Info',
				'name' => 'post_share_info',
				'type' => 'checkbox',
				'instructions' => 'Add your own custom share info rather than share info that\'s been generated from the content of the post.',
				'choices' => array (
					'yes' => 'Yes, use custom info',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_529e41891a23d',
				'label' => 'Share Image',
				'name' => 'post_share_img',
				'type' => 'image',
				'instructions' => 'Upload a custom share image. Facebook suggests minimum dimensions of 1200×627 (presumably for Retina displays), but you should use at least 560×292 to enable the larger image thumbnail. <em>Default: Featured image for the post</em>',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'id',
				'preview_size' => 'large',
				'library' => 'all',
			),
			array (
				'key' => 'field_529e3ebc1a23b',
				'label' => 'Facebook Share Title',
				'name' => 'post_fb_title',
				'type' => 'text',
				'instructions' => 'Replace the "Title" text. <em>Default value: The title of the post</em>',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529e3ffc1a23c',
				'label' => 'Facebook Share Description',
				'name' => 'post_fb_desc',
				'type' => 'textarea',
				'instructions' => 'Replace the generated share description. One to two short sentences. <em>Default: First few sentences of the post content</em',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_529e41f41a23e',
				'label' => 'Facebook Share URL',
				'name' => 'post_fb_url',
				'type' => 'text',
				'instructions' => 'A custom URL for the post when it\'s shared on facebook. Useful if the page URL has a shortened version, ("350.org/shortlink") or if you want to add tracking codes into the url ("350.org/my-post-name-here?tracking-code=123") <em>Default: The Permalink, as defined in the field below the title of the post</em>',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529e42851a23f',
				'label' => 'Tweet Text',
				'name' => 'post_tw_text',
				'type' => 'text',
				'instructions' => 'Note: Special AddThis buttons aren\'t currently customizable, and will use the default values. The built-in "Share on Twitter" button will use the custom text. <em>Default: The title of the post</em> ',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529e43ff1a240',
				'label' => 'Tweet URL',
				'name' => 'post_tw_url',
				'type' => 'text',
				'instructions' => 'A custom URL for the post when it\'s shared on Twitter. Useful if the page URL has a shortened version, ("350.org/shortlink") or if you want to add tracking codes into the url ("350.org/my-post-name-here?tracking-code=123") <em>Default: The Permalink, as defined in the field below the title of the post</em>
	
	Note: Special AddThis buttons aren\'t currently customizable, and will use the default values. The built-in "Share on Twitter" button will use the custom URL. ',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e3e7f1a23a',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
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
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'super_pages',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

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
