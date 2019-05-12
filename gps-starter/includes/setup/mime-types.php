<?php
namespace GPS\Setup;
/**
 * Add to the list of mime types allowed for upload to the media library.
 * For example, lets us upload SVG
 *
 * @param $mimes
 *
 * @return mixed
 */
function add_uploadable_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}
add_filter( 'upload_mimes', __NAMESPACE__ . '\\add_uploadable_mime_types' );
