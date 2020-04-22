<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*********************************************************************************************************************
 * Load theme function files individually
 */
$includes = array(
	'/global_constants.php',
	'/setup/_setup.php',
	'/shortcodes/_shortcodes.php',
	'/layouts/_layouts.php',
	'/helpers/_helpers.php',
	//'/development/_development.php',
	'/custom-post-types/_custom-post-types.php',
	'/options-pages/theme-settings.php',
	'/blocks/_blocks.php',
);

foreach( $includes as $include){
	include_once( __DIR__ . $include);
}