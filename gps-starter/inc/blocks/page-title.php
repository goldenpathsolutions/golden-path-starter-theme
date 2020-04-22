<?php
namespace GPS\Blocks;

function register_block_page_title() {

	// register a testimonial block.
	acf_register_block_type(array(
		'name'              => 'page-title',
		'title'             => __('Page Title Hero'),
		'description'       => __('Page title with optional background image.'),
		'render_template'   => 'template-parts/blocks/block-page-title.php',
		'category'          => 'oculus',
		'icon'              => 'welcome-widgets-menus',
		'keywords'          => array( 'Title', 'Hero' ),
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', __NAMESPACE__ . '\\register_block_page_title');
}