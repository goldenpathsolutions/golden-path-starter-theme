<?php
namespace GPS\OptionPages;
/**
 * Theme Options
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */

function theme_settings(){

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
add_action('init', __NAMESPACE__ . '\\theme_settings');