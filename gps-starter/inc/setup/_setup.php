<?php
namespace GPS\Setup;
/**
 * Includes setup files.
 *
 * You can add misc. setup things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/acf-config.php',  // add styling to improve look of ACF
	'/body-class.php',  // add helpful classes to body tag
	'/enqueues.php',     // CSS and JS enqueue/dequeue
	'/google-config.php',    // add Google Tag Manager or Analytics
	'/hide-admin-bar.php',  // hide admin bar on front end for non-admins
	'/image-sizes.php',  // define image sizes created on upload to the media library
	'/mime-types.php',   // define additional mime types allowed to upload to media library (i.e. SVG)
	'/text-domain.php',  // define this theme's text domain for multilingual
	'/yoast-seo.php',    // functions that customize Yoast SEO configuration
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}