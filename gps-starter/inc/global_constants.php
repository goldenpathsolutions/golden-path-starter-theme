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
	'xl' => 1140
));