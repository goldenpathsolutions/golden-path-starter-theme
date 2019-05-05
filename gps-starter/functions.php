<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*********************************************************************************************************************
 * Load theme function files individually
 */
$includes = array(
	'/includes/setup/enqueues.php',      // CSS and JS enqueue/dequeue
	'/includes/setup/text-domain.php',   // define this theme's text domain for multilingual
);
foreach( $includes as $include){
	include_once( __DIR__ . $include);
}


/*********************************************************************************************************************
 *  Load layout php files via autoloader
 */
try {
	$filename = '';
	spl_autoload_register( function ( $class ) {

		if( false === strpos($class,'GPS\\') ){ return; } // ignore if GPS not in namespace

		// build path
		$path = str_replace( '\\', '/', strtolower($class) ) . '.php'; // convert namespace to path
		$path = str_replace( '_', '-', $path ); // convert _ to -
		$path = str_replace( 'gps/', '', $path ); // throw away gps
		$path = substr( $path, 0, strrpos( $path, '/' ) + 1 ) . 'class-' . substr( $path, strrpos( $path, '/' ) + 1, strlen( $path ) );
		$path = get_stylesheet_directory() . '/includes/' . $path;

		if ( file_exists( $path ) ) {
			include_once( $path );
		}

	} );
} catch ( Exception $e ) { /* do nothing */
}