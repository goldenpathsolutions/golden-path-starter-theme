<?php
namespace GPS\Helpers;
/**
 * Includes Helper files.
 *
 * You can add misc. helper things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/get-svg.php',     // converts SVG image files to inline SVG
	'/format-phone.php', // format a phone number for tel: tags or display
	'/interpolate-style.php',   // echos media queries for interstitial breakpoints between low and high
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}