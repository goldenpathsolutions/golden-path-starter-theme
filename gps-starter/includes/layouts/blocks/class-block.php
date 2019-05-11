<?php

namespace GPS\Layouts\Blocks;

/**
 * Parent class for layout blocks
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
Class Block {

	public function __construct() {
		// do nothing
	}

	/**
	 * Get Width
	 *
	 * Width of this block
	 *
	 * @param string $width width assigned to the block
	 *
	 * @return string width class to add to the block element
	 */
	public static function get_width( $width ) {
		switch($width){
			case "one-twelfth": return "col-12 col-md-1";
			case "one-sixth": return "col-12 col-md-2";
			case "quarter": return "col-12 col-md-3";
			case "third": return "col-12 col-md-4";
			case "five-twelfths": return "col-12 col-md-5";
			case "half": return "col-12 col-md-6";
			case "seven-twelfths": return "col-12 col-md-7";
			case "two-thirds": return "col-12 col-md-8";
			case "three-quarters": return "col-12 col-md-9";
			case "five-sixths": return "col-12 col-md-10";
			case "ten-twelfths": return "col-12 col-md-11";
			case "full": return "col-12";
			default: return '';
		}
	}

	/**
	 * Get Position
	 *
	 * Shifts block to the left, center, or right when there is space available
	 *
	 * @param string $position position assigned to the block
	 *
	 * @return string position class to add to the block element
	 */
	public static function get_position( $position ){
		switch( $position ){
			case "left": return "pull-left";
			case "center": return "mx-auto";
			case "right": return "pull-right";
			default: return '';
		}
	}

	/**
	 * Get Image Size
	 *
	 * Use block with to limit the size of images used
	 *
	 * <ul>
	 * <li>add_image_size('section-bg', 1200);</li>
	 * <li>add_image_size('half', 600, 600);</li>
	 * <li>add_image_size('third', 400, 400);</li>
	 * <li>add_image_size('quarter', 300, 400);</li>
	 * </ul>
	 *
	 * @param string $width width assigned to the block
	 *
	 * @return  string image size to use for this block
	 */
	public static function get_image_size( $width ){
		switch($width){
			case "quarter": return "quarter";
			case "third": return "third";
			case "five-twelfths": return "half";
			case "half": return "half";
			default: return "section-bg";
		}
	}

	/**
	 * Adds classes that influence when this block is visible
	 *
	 * @param $visibility
	 */
	public static function get_visibility( $visibility, $breakpoints ){

		switch( $visibility ){
			case "desktop-only":
			case "mobile-only": return $visibility;
			case "breakpoints": return self::get_visibility_breakpoints($breakpoints);
			default: return '';
		}
	}

	private static function get_visibility_breakpoints( $breakpoints ){
		$breakpoint_labels = array('xxs', 'xs', 'sm', 'md', 'lg', 'xl');
		$output = '';
		foreach( $breakpoint_labels as $label){
			$output .= in_array($label, $breakpoints) ? ' show-' : ' hide-';
			$output .= $label;
		}
		return $output;
	}

}