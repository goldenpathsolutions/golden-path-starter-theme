<?php

namespace GPS\Setup;
/**
 * Set up Image Sizes
 *
 * Adds image sizes automatically generated when we upload an image to the media library
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */

/*
 * Add Custom Image Sizes
 *
 * - Add yours here
 */
function add_custom_image_sizes() {

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\add_custom_image_sizes' );

/**
 * Add Container Image sizes
 *
 * Image sizes based on grid size
 */
function add_container_image_sizes() {

	$max_content_width = \GPS\get_max_content_width();

	add_image_size( 'bg-width-2x', MAX_IMAGE_WIDTH * 2 );
	add_image_size( 'bg-width', MAX_IMAGE_WIDTH );
	add_image_size( 'full-width-2x', $max_content_width * 2 );
	add_image_size( 'full-width', $max_content_width );
	add_image_size( 'half-2x', $max_content_width );
	add_image_size( 'half', $max_content_width / 2 );
	add_image_size( 'third-2x', $max_content_width * 2 / 3 );
	add_image_size( 'third', $max_content_width / 3 );
	add_image_size( 'quarter-2x', $max_content_width / 2 );
	add_image_size( 'quarter', $max_content_width / 4 );

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\add_container_image_sizes' );