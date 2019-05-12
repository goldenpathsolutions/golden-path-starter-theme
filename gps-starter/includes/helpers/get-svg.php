<?php
namespace GPS\Helpers;

/**
 * Get SVG
 *
 * Converts SVG file into inline SVG, allowing us to apply CSS and JS to it
 *
 * @param $svg String URL for an SVG file
 *
 * @return string
 */
function get_svg( $svg ) {
	$svg          = substr( $svg, strpos( $svg, '/', - 1 ) );
	$fileContents = file_get_contents( $svg );
	$headers      = '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';

	return $headers . $fileContents;
}