<?php
namespace GPS\Shortcodes;
/**
 * Business Name Shortcode
 *
 * Trivial shortcode that returns the value stored as the business name
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com
 */

function shortcode_business_name( $atts ) {
	return '<span itemprop="name">' . get_field( 'business_name', 'options' ) . '</span>';
}

add_shortcode('business-name', __NAMESPACE__ . '\\shortcode_business_name');