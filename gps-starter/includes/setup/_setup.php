<?php
namespace GPS\Setup;
/**
 * Includes setup files.
 *
 * You can add misc. setup things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/enqueues.php',     // CSS and JS enqueue/dequeue
	'/image-sizes.php',  // define image sizes created on upload to the media library
	'/text-domain.php',  // define this theme's text domain for multilingual
	'/mime-types.php',   // define additional mime types allowed to upload to media library (i.e. SVG)
	'/yoast-seo.php',    // functions that customize Yoast SEO configuration
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}