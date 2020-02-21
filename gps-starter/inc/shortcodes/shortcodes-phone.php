<?php
namespace GPS\Shortcodes;
/**
 * Phone Shortcode
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com
 */

function shortcode_phone( $atts ) {

	$phone     = get_field( 'phone', 'options' );

	return '<a href="tel:' . $phone . '" itemprop="telephone">' . \GPS\Helpers\formatPhone( $phone ) . '</a>';
}

add_shortcode('phone', __NAMESPACE__ . '\\shortcode_phone');