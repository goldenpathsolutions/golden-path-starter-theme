<?php
namespace GPS\Shortcodes;
/**
 * Includes Shortcode files.
 *
 * You can add misc. shortcode things here if you don't want to create a separate file for them.
 */

$includes = array(
	'/shortcodes-mail-to.php',     // Generates bot-busting email link
);

foreach( $includes as $include ){
	include_once( __DIR__ . $include);
}