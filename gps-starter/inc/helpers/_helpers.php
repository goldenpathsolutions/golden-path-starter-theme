<?php
namespace GPS\Helpers;
/**
 * Includes Helper files.
 *
 * You can add misc. helper things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/get-svg.php',     // converts SVG image files to inline SVG
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}