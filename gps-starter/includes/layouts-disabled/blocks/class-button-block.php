<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Button Block
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Button_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block      = get_sub_field( 'button_block' );
		$width          = self::get_width( $the_block['width'] );
		$text_alignment = $the_block['text_alignment'];
		$position       = self::get_position( $the_block['position'] );
		$visibility     = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );

		?>

        <div class="block block-button col <?= $width ?> text-<?= $text_alignment ?> <?= $position ?> <?= $visibility ?>">

            <a href="<?= $the_block['button']['url']; ?>"
               class="button teal"
               target="<?= $the_block['button']['target']; ?>"><?= $the_block['button']['title']; ?></a>

        </div>
		<?php

	}

}