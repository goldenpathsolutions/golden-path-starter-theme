<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Code block
 *
 * Inserts raw HTML
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Block_Code extends Block {

	public function __construct() {

		parent::__construct();

		$the_block = get_sub_field( 'block_code' );
		$width     = self::get_width( $the_block['width'] );
		$position  = self::get_position( $the_block['position'] );
		$visibility = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints']);
		?>

        <div class="block block-code col <?= $width ?> <?= $position ?> <?= $visibility ?>">
            <?= $the_block['code']; ?>
        </div>
		<?php

	}

}