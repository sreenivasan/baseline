<?php

	$sphp_args = array(
		'post_type' => 'super_pages',
		'tax_query' => array(
			array(
				'taxonomy' => 'display-location',
				'field'    => 'slug',
				'terms'    => 'homepage',
			),
		),
		'posts_per_page'=> '1',
	);
	$sphp_query  = new WP_Query( $sphp_args );

	// if there's a superpage marked as "homepage" and it's not paged
	if ( $sphp_query->have_posts() && !is_paged() ) :
		get_template_part('single','super_pages');
	else:
		get_template_part('homepage','default');
	endif; // end WP post loop
?>
