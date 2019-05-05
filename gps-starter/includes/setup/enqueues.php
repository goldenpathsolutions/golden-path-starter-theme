<?php
/**
 * Setup Enqueues
 *
 * Handle enqueueing/dequeueing stylesheets and scripts
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 * @version 1.0.0
 * @since 1.0.0
 */


/*********************************************************************************************************************
 * Remove Scripts
 *
 * This child theme re-bundles the parent styles and scripts with its local ones, so we need to remove the previously
 * enqueued parent assets.
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );

	// Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );


/*********************************************************************************************************************
 * Enqueue child theme styles and scripts
 */
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

	// use the minified version of the main stylesheet, otherwise fail over to the non-minified version
	if( file_exists( get_stylesheet_directory() . '/css/main.min.css') ){
		wp_enqueue_style( 'gps-main-styles', get_stylesheet_directory_uri() . '/css/main.min.css', array(), $the_theme->get( 'Version' ) );
	} else {
		wp_enqueue_style( 'gps-main-styles', get_stylesheet_directory_uri() . '/css/main.css', array(), $the_theme->get( 'Version' ) );
	}

	wp_enqueue_script( 'jquery');

	// use the minified version of the main JavaScript file, otherwise fail over to the non-minified version
	if( file_exists( get_stylesheet_directory() . '/js/main.min.js') ) {
		wp_enqueue_script( 'gps-main-scripts', get_stylesheet_directory_uri() . '/js/main.min.js', array(), $the_theme->get( 'Version' ), true );
	} else {
		wp_enqueue_script( 'gps-main-scripts', get_stylesheet_directory_uri() . '/js/main.min.js', array(), $the_theme->get( 'Version' ), true );
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );