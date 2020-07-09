<?php
namespace GPS\Setup;

/**
 * Add alignment support in block editor
 */
function add_alignment_support() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\add_alignment_support' );


/**
 * Add color palette support in block editor
 */
add_theme_support( 'editor-color-palette', array(
	array(
		'name' => __( 'White', 'gps' ),
		'slug' => 'white',
		'color' => '#ffffff',
	),

	array(
		'name' => __( 'Lt. Blue -- Cerulean -- Primary', 'gps' ),
		'slug' => 'lt-blue-cerulean',
		'color' => '#06B1F0',
	),
	array(
		'name' => __( 'Picton Blue', 'gps' ),
		'slug' => 'picton-blue',
		'color' => '#29ace3',
	),
	array(
		'name' => __( 'Sky Blue -- Viking', 'gps' ),
		'slug' => 'sky-blue-viking',
		'color' => '#5AD7E0',
	),
	array(
		'name' => __( 'Purple -- East Bay -- Secondary', 'gps' ),
		'slug' => 'purple-east-bay',
		'color' => '#3F3C82',
	),
	array(
		'name' => __( 'Blue Violet', 'gps' ),
		'slug' => 'blue-violet',
		'color' => '#4948AF',
	),
	array(
		'name' => __( 'Purple -- Gigas', 'gps' ),
		'slug' => 'purple-gigas',
		'color' => '#4A44A0',
	),
	array(
		'name' => __( 'very light gray', 'gps' ),
		'slug' => 'very-light-gray',
		'color' => '#eee',
	),
	array(
		'name' => __( 'Gray 2 -- Dusty Gray', 'gps' ),
		'slug' => 'gray-2-dusty-gray',
		'color' => '#999',
	),
	array(
		'name' => __( 'Gray 4 -- Boulder', 'gps' ),
		'slug' => 'gray-4-boulder',
		'color' => '#797979',
	),
	array(
		'name' => __( 'Gray 5 -- Storm Dust -- Font Base', 'gps' ),
		'slug' => 'gray-5-storm-dust',
		'color' => '#666660',
	),
	array(
		'name' => __( 'Gray 9 -- Mine Shaft', 'gps' ),
		'slug' => 'gray-9-mine-shaft',
		'color' => '#222222',
	),

) );

/**
 * Add support for editor font sizes.
 */
add_theme_support( 'editor-font-sizes', array(
	array(
		'name'      => __( 'extra small', 'gps' ),
		'shortName' => __( 'XS', 'gps' ),
		'size'      => 12,
		'slug'      => 'x-small'
	),
	array(
		'name'      => __( 'small', 'gps' ),
		'shortName' => __( 'S', 'gps' ),
		'size'      => 14,
		'slug'      => 'small'
	),
	array(
		'name'      => __( 'regular', 'gps' ),
		'shortName' => __( 'M', 'gps' ),
		'size'      => 17,
		'slug'      => 'regular'
	),
	array(
		'name'      => __( 'medium large', 'gps' ),
		'shortName' => __( 'M-LG', 'gps' ),
		'size'      => 20,
		'slug'      => 'md-large'
	),
	array(
		'name'      => __( 'large', 'gps' ),
		'shortName' => __( 'L', 'gps' ),
		'size'      => 25,
		'slug'      => 'large'
	),
	array(
		'name'      => __( 'extra large', 'gps' ),
		'shortName' => __( 'XL', 'gps' ),
		'size'      => 45,
		'slug'      => 'x-large'
	),
	array(
		'name'      => __( '2X large', 'gps' ),
		'shortName' => __( 'XXL', 'gps' ),
		'size'      => 60,
		'slug'      => '2x-large'
	),
	array(
		'name'      => __( 'Jumbo', 'gps' ),
		'shortName' => __( 'XXXL', 'gps' ),
		'size'      => 80,
		'slug'      => 'jumbo'
	)
) );