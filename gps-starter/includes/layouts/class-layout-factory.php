<?php

namespace GPS\Layouts;

/**
 * Layout Factory
 *
 * Handles processing template layouts
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Layout_Factory {

	const BLOCKS = 'Blocks';
	const BLADES = 'Blades';
	const HEADER = true;

	public static function get_layouts( $acf_field, $type = self::BLADES, $is_header = false ) {

		while ( have_rows( $acf_field ) ) {
			the_row();
			$layout_class = 'GPS\\Layouts\\' . $type . '\\';
			$layout_class .= (string) get_row_layout();
			$layout_class = str_replace( '-', '_', $layout_class );

			if ( 'false' != $acf_field && class_exists( $layout_class ) ) {
				if ( ! $is_header ) {
					new $layout_class();
				} else {
					new $layout_class( $is_header );
				}
			}

		}

	}

}