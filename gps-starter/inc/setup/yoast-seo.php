<?php

namespace GPS\Setup;
/**
 * Functions that customize Yoast SEO configuration
 */

/**
 * Move yoast metabox to the bottom of the metaboxes
 * @return string
 */
function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\\yoasttobottom' );