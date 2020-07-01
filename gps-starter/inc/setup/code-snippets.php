<?php

namespace GPS\Setup;

/**
 * Code Snippets
 *
 * Handle adding code snippets to areas of each page
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */

function add_head_snippets() {

	if ( get_query_var( 'head-snippet-added' ) ) {
		echo get_field( 'head_snippets', 'option' );
	}

	set_query_var( 'head-snippet-added', true );
}

add_action( 'wp_head', __NAMESPACE__ . '\\add_head_snippets', 1 ); // add higher in the list

function add_body_snippets() {

	if ( get_query_var( 'body-snippet-added' ) ) {
		echo get_field( 'body_snippets', 'option' );
	}

	set_query_var( 'body-snippet-added', true );
}

add_action( 'wp_body_open', __NAMESPACE__ . '\\add_body_snippets' );