<?php

namespace GPS\Setup;

/**
 * Register Menus
 */
function register_menus() {
// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'footer' => __( 'Footer Menu', 'gps' ),
		'copyright' => __( 'Copyright Menu', 'gps' ),
	) );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\register_menus' );