<?php
namespace GPS\Shortcodes;
/**
 * Address Shortcode
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com
 */

function shortcode_address( $atts ) {

	$address   = get_field( 'address', 'options' );

	ob_start();

	?>

	<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <span itemprop="streetAddress"><?= $address['street_address'] ?></span><br/>
        <span itemprop="addressLocality"><?= $address['city'] . ', ' . $address['state'] ?></span> <span itemprop="postalCode"><?= $address['zip'] ?></span>
    </address>


<?php
	return ob_get_clean();
}

add_shortcode('address', __NAMESPACE__ . '\\shortcode_address');