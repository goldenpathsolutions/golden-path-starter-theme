<?php
/**
 *
 */

/*********************************************************************************************************************
 * Configure child theme text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'gps', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );