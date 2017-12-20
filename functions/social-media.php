<?php


function smoptions_admin_menu(){
	add_submenu_page('options-general.php', "Social Media", "Social Media", 'manage_options', 'social-media', 'smoptions_page');
}
add_action('admin_menu', 'smoptions_admin_menu', 5);

function smoptions_settings_init(){
	// register a new section in the "social media" page
	add_settings_section(
	    'smoptions_general',
	    /* translators: admin settings */
	    __('General', 'baseline'),
	    'smoptions_general_callback',
	    'social-media'
	);
	function smoptions_general_callback(){
		 echo( '<hr>' );
	}

	add_settings_section(
	    'smoptions_facebook',
	     /* translators: admin settings */
	    __('Facebook', 'baseline'),
	    'smoptions_facebook_callback',
	    'social-media'
	);
	function smoptions_facebook_callback(){
	 echo( '<hr><p>Options for intergrating Facebook into your website.</p>' );
	}

	add_settings_section(
	    'smoptions_twitter',
	     /* translators: admin settings */
	    __('Twitter', 'baseline'),
	    'smoptions_twitter_callback',
	    'social-media'
	);
	function smoptions_twitter_callback(){
		 echo( '<hr><p>Options for intergrating Twitter into your website.</p>' );
	}

	// Default share image
	add_settings_field(
		'site_share_img',
		/* translators: ADMIN ONLY */
		__('Default Share Image','baseline'),
		'site_share_img_callback',
		'social-media',
		'smoptions_general',
		array(
		    'label_for' => 'site_share_img',
		    'id' => 'site_share_img'
		)
	);
    register_setting( 'social-media', 'site_share_img' );
    function site_share_img_callback( $args ){
    	$site_share_img = get_option('site_share_img');
		$site_share_img_url = wp_get_attachment_image_src( $site_share_img, "small" );
		echo '<input type="hidden" id="site_share_img_id" name="site_share_img" value="'. $site_share_img .'" />
		<div class="image-upload-preview" style="border:1px solid rgba(0,0,0,0.1);padding:5px;margin-bottom:10px;max-width:200px;">
			<img id="site_share_img_preview" src="'. $site_share_img_url[0] .'" style="max-width:200px;" />
		</div>
		<input id="site_share_img_select" class="button" type="button" value="Select Image" />
		<p><small>Used whenever a more specific share image is not available. Recommended minimum size: 843px by 504px</small></p>
		<script>
			jQuery(document).ready(function(){
				wp_image_upload("site_share_img");
			});
		</script>';}

	// Post sharing buttons
	add_settings_field(
		'post_sharing_buttons',
		/* translators: admin settings */
		__('Share Buttons on Blog Posts','baseline'),
		'post_sharing_buttons_callback',
		'social-media',
		'smoptions_general',
		array(
		    'label_for' => 'post_sharing_buttons',
		    'id' => 'post_sharing_buttons'
		)
	);
    register_setting( 'social-media', 'site_show_fb_share'  );
    register_setting( 'social-media', 'site_show_tw_share'  );
    register_setting( 'social-media', 'site_show_vk_share'  );
    register_setting( 'social-media', 'site_show_sina_weibo_share'  );

    function post_sharing_buttons_callback( $args ){
     /* translators: admin settings */
		echo '<input type="checkbox" name="site_show_fb_share" id="site_show_fb_share" value="1" ' . checked( get_option( 'site_show_fb_share', 'true' ), '1', 0 ) . ' /> <label for="site_show_fb_share">' .  /* translators: admin settings */ __("Facebook","baseline") .'</label><br>
			<input type="checkbox" name="site_show_tw_share" id="site_show_tw_share" value="1"  ' . checked( get_option( 'site_show_tw_share' ), '1', 0 ) . ' /> <label for="site_show_tw_share">' .  /* translators: admin settings */ __("Twitter","baseline") .'</label><br>
			<input type="checkbox" name="site_show_vk_share" id="site_show_vk_share" value="1"  ' . checked( get_option( 'site_show_vk_share' ), '1', 0 ) . ' /> <label for="site_show_vk_share">' .  /* translators: admin settings */ __("VK","baseline") .'</label><br>
			<input type="checkbox" name="site_show_sina_weibo_share" id="site_show_sina_weibo_share" value="1" ' . checked( get_option( 'site_show_sina_weibo_share' ), '1', 0 ) . ' /> <label for="site_show_sina_weibo_share">' .  /* translators: admin settings */ __("新浪微博 (Sina Weibo)","baseline") .'</label><br>';
	}

	// Load FB SDK
	add_settings_field(
		'site_fb_active',
		/* translators: admin settings */
		__('Load Facebook Javascript SDK','baseline'),
		'site_fb_active_callback',
		'social-media',
		'smoptions_facebook',
		array(
		    'label_for' => 'site_fb_active',
		    'id' => 'site_fb_active'
		)
	);
    register_setting( 'social-media', 'site_fb_active'  );
    function site_fb_active_callback( $args ){
		echo '<input type="checkbox" id="' . $args['id'] . '" name="'  . $args['id'] . '" value="1" ' . checked( get_option( $args['id'] ), '1', 0 ) . ' /><br>
			<p><small>Loads Facebook tracking javascript. Allows you to use Facebook "Like" buttons and social plugins. Also allows Facebook to track people who visit this website.</em></small></p>';
	}
	// FB App ID
	add_settings_field(
		'site_fb_appid',
		/* translators: admin settings */
		__('Facebook App ID','baseline'),
		'site_fb_appid_callback',
		'social-media',
		'smoptions_facebook',
		array(
		    'label_for' => 'site_fb_appid',
		    'id' => 'site_fb_appid'
		)
	);
    register_setting( 'social-media', 'site_fb_appid'  );
    function site_fb_appid_callback( $args ){
		echo '<input type="text" id="' . $args['id'] . '" name="'  . $args['id'] . '" value="' . get_option( $args['id'] ) . '" /><br>
			<p><small>Uses a general 350 app ID by default. If your site is using a custom URL (something besides world.350.org/mysitename), you will need to get an app ID configured to work specifically for that URL. See <a href="https://developers.facebook.com/apps" target="_blank">developers.facebook.com/apps</a> to get started.</small></p>';
	}

	// Site Twitter account
	add_settings_field(
		'site_twitter_account',
		/* translators: admin settings */
		__('Site Twitter account','baseline'),
		'site_twitter_account_callback',
		'social-media',
		'smoptions_twitter',
		array(
		    'label_for' => 'site_twitter_account',
		    'id' => 'site_twitter_account'
		)
	);
    register_setting( 'social-media', 'site_twitter_account'  );
    function site_twitter_account_callback( $args ){
		echo '<input type="text" id="' . $args['id'] . '" name="'  . $args['id'] . '" value="' . get_option( $args['id'] ) . '" /><br>
			<p><small>Twitter account associated with the site.</strong></a> — <em>Optional. examples: @350, @fossilfree, etc.</em></small></p>';
	}

}
add_action('admin_init', 'smoptions_settings_init');


function smoptions_page(){
	 ?>
    <div class="wrap">
        <h2>Social Media Options</h2>

        <form method="post" action="options.php">
            <?php

            // Output the settings sections.
            do_settings_sections( 'social-media' );

            // Output the hidden fields, nonce, etc.
            settings_fields( 'social-media' );

            // Submit button.
            submit_button();

            ?>
        </form>

    </div>
    <?php
}



//////////////////
// Update the DB with new theme options
//////////////////

    function smoptions_update(){
        // this is where validation would go

        update_option('site_show_fb_share',  $_POST['site_show_fb_share']);
        update_option('site_show_tw_share',  $_POST['site_show_tw_share']);
        update_option('site_show_vk_share',  $_POST['site_show_vk_share']);
        update_option('site_show_sina_weibo_share',  $_POST['site_show_sina_weibo_share']);
		update_option('site_fb_appid',  $_POST['site_fb_appid']);
		update_option('site_fb_active',  $_POST['site_fb_active']);
		update_option('site_share_img',  $_POST['site_share_img']);
		update_option('site_twitter_account',  $_POST['site_twitter_account']);
	}
$update_smoptions = isset( $_POST['update_smoptions'] ) ? $_POST['update_smoptions'] : '';
  if ( $update_smoptions == 'true' ) { smoptions_update(); }

/* Add ACF custom fields */

if( function_exists("register_field_group") ){
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
					'value' => 'press-release',
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
}

?>
