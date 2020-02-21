<?php
namespace GPS\CustomPostTypes;
/**
 * Includes Custom Post Type files.
 *
 * CPT files define CPTs and their taxonomies
 *
 */

$includes = array(
	// '/projects.php',     // project CPT for portfolio
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}