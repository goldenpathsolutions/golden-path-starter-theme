<?php
namespace GPS\Setup;
/**
 * Includes setup files.
 *
 * You can add misc. setup things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/block-category.php',
	'/page-title.php',  // add styling to improve look of ACF
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}