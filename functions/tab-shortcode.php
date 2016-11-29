<?php // Add Shortcode
function tab_function( $atts , $content = null ) {
	extract( shortcode_atts(
		array(
			'target' => '',
			'name' => ''
		), $atts )
	);
	if ($target){
		return '<a href="#' . esc_attr($target) .'" class="tab">' . $content . '</a>';
	} 
	if ($name){
		return '<div name="' . esc_attr($name) . '" class="tab-content">' . $content . '</div>';
	}
}
add_shortcode( 'tab', 'tab_function' );

function tabs_function( $atts , $content = null ) {
	return '<div class="tabs">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'tabs', 'tabs_function' );
remove_filter( 'the_content', 'wpautop' );
add_filter(    'the_content', 'wpautop' , 12);


?>