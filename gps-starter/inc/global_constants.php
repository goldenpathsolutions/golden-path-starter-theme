<?php
namespace GPS;
/**
 * Global Constants
 *
 * Add handy constants used throughout theme here.
 * These are loaded in a WP-friendly way that helps avoid naming conflicts.
 */


/*
 * Container Max Widths
 *
 * These are the max widths defined for the bootstrap css grid.  We make these available for things that depend on them
 * like relative image sizes (1/2 max width, etc.)
 *
 * These are in units of px
 *
 */
define('CONTAINER_MAX_WIDTHS', array(
	'sm' => 540,
	'md' => 720,
	'lg' => 960,
	'xl' => 1170
));

define('CONTAINER_BREAKPOINTS', array(
	'xs' => 0,
	'sm' => 576,
	'md' => 768,
	'lg' => 992,
	'xl' => 1210
));

$max_image_width = CONTAINER_MAX_WIDTHS['xl'] * 2;
define('MAX_IMAGE_WIDTH', $max_image_width);

function get_max_content_width() {
	$max = 0;
	foreach ( CONTAINER_MAX_WIDTHS as $width ) {
		$max = $width > $max ? $width : $max;
	}

	return $max;
}