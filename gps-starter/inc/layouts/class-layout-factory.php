<?php

namespace GPS\Layouts;

/**
 * Layout Factory
 *
 * Handles processing template layouts
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Layout_Factory {

	const SECTIONS = 'Sections';
	const BLOCKS = 'Blocks';
	const COMPONENTS = 'Components';
	const HEADER = true;

	/**
	 * @param $acf_field
	 * @param string $type
	 * @param array $the_row
	 *
	 * @return \WP_Error
	 */
	public static function get_layouts( $acf_field, $type = self::SECTIONS ) {

		while ( have_rows( $acf_field ) ) {
			the_row();
			$layout_class = self::get_class_name( $type, (string) get_row_layout() );

			if (  'false' != $acf_field && class_exists( $layout_class ) ) {
				new $layout_class();
			} else {
				return new \WP_Error( 'Layout Missing', __( "Layout class `" . $layout_class . '` is missing`', "eggsandrice" ) );
			}

		}

		return null;
	}

	private static function get_class_name( $type, $layout ) {

		$layout_class = str_replace( '-', '_', $layout );      // convert hyphens to underscores

		// convert $layout to camel case
		$lastPos = 0;
		do {
			$char   = substr( $layout_class, $lastPos, 1 );
			$layout_class = substr_replace( $layout_class, strtoupper( $char ), $lastPos, 1 );
		} while ( ( $lastPos = strpos( $layout_class, '_', $lastPos ) ) !== false && strlen( $layout_class ) > $lastPos ++ );

		$layout_class = '\\GPS\\Layouts\\' . $type . '\\' . $layout_class;    // prepend namespace prefix

		return $layout_class;
	}

}