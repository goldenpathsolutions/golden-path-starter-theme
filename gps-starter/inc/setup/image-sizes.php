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
function add_custom_image_sizes(){

}
add_action('after_setup_theme', __NAMESPACE__ . '\\add_custom_image_sizes' );

/**
 * Add Container Image sizes
 *
 * Image sizes based on grid size
 */
function add_container_image_sizes(){

	if( empty( CONTAINER_MAX_WIDTHS ) ){
		return;
	}

	foreach( CONTAINER_MAX_WIDTHS as $size ) {

		add_image_size( 'full-width-2x', $size * 2, 1200 );
		add_image_size( 'full-width', $size, 1200 );
		add_image_size( 'half-2x', $size, 1200 );
		add_image_size( 'half', $size / 2, 1200 );

		if( $size > 768 ) {
			add_image_size( 'third-2x', $size * 2 / 3, 800 );
			add_image_size( 'third', $size / 3, 800 );
		}

		if( $size > 480 ) {
			add_image_size( 'quarter-2x', $size / 2, 800 );
			add_image_size( 'quarter', $size / 4, 800 );
		}

	}
}
add_action('after_setup_theme', __NAMESPACE__ . '\\add_container_image_sizes' );