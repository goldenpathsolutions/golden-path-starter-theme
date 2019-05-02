<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*********************************************************************************************************************
 * Load theme function files
 */
$includes = array(
	'/includes/setup-enqueues.php',      // CSS and JS enqueue/dequeue
	'/includes/setup-text-domain.php',   // define this theme's text domain for multilingual
);
foreach( $includes as $include){
	include_once( __DIR__ . $include);
}