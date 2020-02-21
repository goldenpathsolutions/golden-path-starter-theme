<?php

namespace GPS\Layouts;
/**
 * Layout
 *
 * The base class for all layout components
 *
 * @author Patrick Jackson  <pjackson@goldenpathsolutions.com>
 */
class Layout {

	protected $element = array();
	protected $classes = array();
	protected $styles = array();
	protected $attributes = array(); // manage other html attributes, like data-*

	protected function __construct() {
	}

	/**
	 * Add Common Attribute Classes
	 *
	 * All layout elements must include these classes.  Call this function inside the main element loop.
	 */
	protected function add_common_attributes() {

		$this->add_common_classes();

		$this->add_background_treatment();

		$this->add_common_styles();

		$this->element['id'] = get_sub_field( 'id_attribute' );

		// special attributes

		/*echo "<pre>";
		echo print_r($this->element, true);
		echo "</pre>";*/

	}

	protected function add_common_classes() {

		// attribute fields
		$this->element['width']      = get_sub_field( 'width' );
		$this->element['position']   = get_sub_field( 'position' );
		$this->element['visibility'] = get_sub_field( 'visibility' );
		$this->element['foreground'] = get_sub_field( 'foreground' );

		$this->element['width'] && $this->classes[] = self::get_width( $this->element['width'] );
		$this->element['position'] && $this->classes[] = self::get_position( $this->element['position'] );
		$this->element['visibility'] && $this->classes[] = self::get_visibility( $this->element['visibility']['select_visibility'], $this->element['visibility']['select_breakpoints'] );

		$this->element['foreground'] && $this->classes[] = 'light' === $this->element['foreground'] ? 'text-light' : 'text-dark';

		// advanced fields
		$this->element['class'] = get_sub_field( 'class_attribute' );
		$this->element['class'] && $this->classes[] = $this->element['class'];

	}

	protected function add_background_treatment() {

		$img_group       = get_sub_field( 'background_image' );
		$img_obj         = $img_group['image'];
		$this->styles[]  = $img_obj && ! $img_group['parallax'] ? 'background-image: url(\'' . $img_obj['sizes']['bg-width-2x'] . '\'); ' : '';
		$parallax_cls    = $img_obj && $img_group['parallax'] ? 'parallax-window' : '';
		$this->classes[] = $parallax_cls ?: '';
		$img_obj && ! $parallax_cls && $this->classes[] = 'has-background-image';
		$this->attributes[] = $parallax_cls ? 'data-parallax="scroll" data-speed="0.1" data-image-src="' . $img_obj['sizes']['bg-width-2x'] . '"' : '';

		// only add background color if no image (overrides image)
		if ( ! $img_obj ) {
			$this->element['bg-color'] = get_sub_field( 'background_color' );
			$this->styles[]            = $this->element['bg-color'] && 'none' !== $this->element['bg-color'] ? ' background-color: ' . $this->element['bg-color'] . '; ' : '';
		}
	}

	protected function add_common_styles() {

		$this->styles[] = ' ' . get_sub_field( 'style_attribute' );
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
	protected static function get_width( $width ) {
		switch ( $width ) {
			case "one-twelfth":
				return "col-12 col-md-1";
			case "one-sixth":
				return "col-12 col-md-2";
			case "quarter":
				return "col-12 col-md-3";
			case "third":
				return "col-12 col-md-4";
			case "five-twelfths":
				return "col-12 col-md-5";
			case "half":
				return "col-12 col-md-6";
			case "seven-twelfths":
				return "col-12 col-md-7";
			case "two-thirds":
				return "col-12 col-md-8";
			case "three-quarters":
				return "col-12 col-md-9";
			case "five-sixths":
				return "col-12 col-md-10";
			case "ten-twelfths":
				return "col-12 col-md-11";
			case "full":
				return "col-12";
			default:
				return '';
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
	protected static function get_position( $position ) {
		switch ( $position ) {
			case "left":
				return "pull-left";
			case "center":
				return "mx-auto";
			case "right":
				return "pull-right";
			default:
				return '';
		}
	}

	/**
	 * Get Image Size
	 *
	 * Use block with to limit the size of images used
	 *
	 *
	 * @param string $width width assigned to the block
	 *
	 * @return  string image size to use for this block
	 */
	protected static function get_image_size( $width ) {
		switch ( $width ) {
			case "quarter":
				return "quarter-2x";
			case "third":
				return "third-2x";
			case "half":
				return "half-2x";
			default:
				return "full-width-2x";
		}
	}

	/**
	 * Adds classes that influence when this block is visible
	 *
	 * @param $visibility
	 */
	protected static function get_visibility( $visibility, $breakpoints ) {

		switch ( $visibility ) {
			case "desktop-only":
				return 'd-none d-md-block';
			case "mobile-only":
				return 'd-block d-md-none';
			case "breakpoints":
				return self::get_visibility_breakpoints( $breakpoints );
			default:
				return '';
		}
	}

	protected static function get_visibility_breakpoints( $breakpoints ) {
		$breakpoint_labels = CONTAINER_BREAKPOINTS ? array_keys( CONTAINER_BREAKPOINTS ) :
			array( 'xs', 'sm', 'md', 'lg', 'xl' );
		$output            = '';
		foreach ( $breakpoint_labels as $label ) {
			$output .= ' d-' . $label;
			$output .= in_array( $label, $breakpoints ) ? '-block' : '-none';
		}

		return $output;
	}

	/**
	 * Adds class or custom style block for vertical spacing
	 */
	protected function add_vertical_spacing() {

		$vertical_spacing = get_sub_field( 'vertical_spacing' );

		switch ( $vertical_spacing['margin_top'] ) {
			case 'none' :
				$this->classes[] = 'margin-top-none';
				break;
			case 'title' :
				$this->classes[] = 'margin-top-title';
				break;
			case 'custom' :
				$this->add_custom_style_range( $vertical_spacing['margin-top_custom_range'], 'margin-top' );
				break;
			case 'default' :
				$this->classes[] = 'margin-top-default';
				break;
		}

		switch ( $vertical_spacing['margin_bottom'] ) {
			case 'none' :
				$this->classes[] = 'margin-bottom-none';
				break;
			case 'custom' :
				$this->add_custom_style_range( $vertical_spacing['margin-bottom_custom_range'], 'margin-bottom' );
				break;
			case 'default' :
				$this->classes[] = 'margin-bottom-default';
				break;
		}

	}

	/**
	 * Adds custom style block for given style's custom range.
	 *
	 * @param $prefix
	 */
	protected function add_custom_style_range( $values, $style ) {

		if ( empty( $values ) ) {
			return;
		}

		echo "<style>";
		\GPS\Helpers\interpolate_style( '#' . $this->element['id'], $style, $values['min'], $values['max'] );
		echo "</style>";
	}

}