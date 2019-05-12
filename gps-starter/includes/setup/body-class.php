<?php

namespace GPS\Setup;
/**
 * Body Class
 *
 * Makes changes (usually adding something) to the body tag class attribute
 */


/**
 * Body Class Post Slug
 *
 * Adds the current post slug to the body class
 *
 * @param $classes
 * @param $class
 *
 * @return array
 */
function body_class_post_slug( $classes, $class ) {
	global $post;
	if ( ! is_home() && ! is_front_page() && $post ) {
		$classes[] = $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', array( __NAMESPACE__ . '\\body_class_post_slug' ), 10, 2 );

/**
 *
 * Body Class Tracer
 *
 * If the "show_tracer" class is set to true, adds "show-tracer" class to body tag.
 * Used to turn the tracer on/off during development
 *
 * @param $classes
 * @param $class
 *
 * @return array
 */
function body_class_tracer( $classes, $class ) {
	if ( get_field( 'show_tracer' ) ) {
		$classes[] = 'show-tracer';
	}

	return $classes;
}

add_filter( 'body_class', array( __NAMESPACE__ . '\\body_class_tracer' ), 10, 2 );