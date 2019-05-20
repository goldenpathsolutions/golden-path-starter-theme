<?php

namespace GPS\Layouts;
/**
 * Includes Layout files such as template parts
 */


$includes = array(
	'/class-layout-factory.php',    // CSS and JS enqueue/dequeue
	'/class-layout.php',            // Base class for all layout components
);

foreach ( $includes as $file ) {
	$filepath = locate_template( 'inc/layouts' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc/layouts%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 *  Autoloader for layouts.
 *
 * Layout files must follow the naming convention:
 * Must use namespace: GPS\Layouts\<parent directory(ies)>
 * Must start with "class-"
 *
 */
try {
	$filename = '';
	spl_autoload_register( function ( $class ) {

		if ( false === strpos( $class, 'GPS\\' ) ) {
			return;
		} // ignore if GPS not in namespace

		// build path
		$path = str_replace( '\\', '/', strtolower( $class ) ) . '.php'; // convert namespace to path
		$path = str_replace( '_', '-', $path ); // convert _ to -
		$path = str_replace( 'gps/', '', $path ); // throw away gps
		$path = substr( $path, 0, strrpos( $path, '/' ) + 1 ) . 'class-' . substr( $path, strrpos( $path, '/' ) + 1, strlen( $path ) );
		$path = get_stylesheet_directory() . '/inc/' . $path;

		if ( file_exists( $path ) ) {
			include_once( $path );
		}

	} );
} catch ( \Exception $e ) { /* do nothing */
}