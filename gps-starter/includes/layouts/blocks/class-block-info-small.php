<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * small info block
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Block_Info_Small extends Info_Block {

	public function __construct() {

		add_filter( 'block-class_info_block', array( self::class, 'add_class' ) );

		parent::__construct();

		// make sure the filter is only used once on the parent block
		remove_filter( 'block-class_info_block', array( self::class, 'add_class' ) );

	}

	public static function add_class( $classes ) {
		for ( $i = 0; $i < count( $classes ); $i ++ ) {

			if ( 'block-info' === $classes[ $i ] ) {
				$classes[ $i ] = 'block-small-info';
			}
		}

		return $classes;
	}
}