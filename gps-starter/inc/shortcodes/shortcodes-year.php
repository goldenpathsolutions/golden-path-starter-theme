<?php
namespace GPS\Shortcodes;
/**
 * Year Shortcode
 *
 * Trivial shortcode that returns the current year.
 * Allows admin to add current year to content like copyright
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com
 */

function shortcode_year( $atts ) {
	return date( 'Y' );
}

add_shortcode('year', __NAMESPACE__ . '\\shortcode_year');