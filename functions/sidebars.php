<?php

// Sidebars & Widgetizes Areas
function tf_register_sidebars() {
    register_sidebar(array(
    	'id' => 'featboxes',
    	'name' => 'Feature Boxes',
		'description'   => 'Displayed on every page, directly below the top panel on the homepage, just above the footer on all internal pages. Supports 350-specific customizable widgets',
		'class'         => 'featbox',
		'before_widget' => '<div id="%1$s" class="widget featbox %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' 
    ));
}
add_action( 'widgets_init', 'tf_register_sidebars' );



// Footer widgets are registered separately and with a lower priority to ensure they appear last in the list of sidebars
function tf_register_footer_widg() {   
	register_sidebar(array(
    	'id' => 'footer-widgets',
    	'name' => 'Footer',
    	'description' => "Optional row of widgets in the footer.",
    	'before_widget' => '<div id="%1$s" class="widget footer-widget c2 %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'tf_register_footer_widg', 13 );
?>