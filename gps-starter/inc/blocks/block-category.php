<?php
namespace GPS\Blocks;
/**
 * Add a category for custom blocks to the block editor
 *
 * @param $categories
 * @param $post
 *
 * @return array
 */
function add_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'oculus',
				'title' => __( 'Oculus', 'oculus-category' ),
				'icon'  => 'visibility',
			),
		)
	);
}
add_filter( 'block_categories', __NAMESPACE__ . '\\add_block_category', 10, 2 );