<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Title block
 *
 * Includes h1 title element, tagline, body text, and button
 * Usually used in page header
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Title_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block      = get_sub_field( 'title_block' );
		$width          = parent::get_width( $the_block['layout']['width'] );
		$position       = self::get_position( $the_block['layout']['position'] );
		$eyebrow        = $the_block['add_eyebrow'] ? 'eyebrow' : '';

		?>
        <div class="block block-title col <?= $width ?> text-<?= $the_block['text_alignment'] ?> <?= $position ?>">

			<?php if ( $the_block['title'] ): ?>
                <div class="title">
                    <h1 class="<?= $eyebrow ?>"><?= $the_block['title'] ?></h1>
                </div>
			<?php endif; ?>

			<?php if ( $the_block['tagline'] ): ?>
                <div class="tagline">
                    <h3><?= $the_block['tagline'] ?></h3>
                </div>
			<?php endif; ?>

			<?php if ( $the_block['body_text'] ): ?>
                <div class="body-text">
					<?= wpautop( $the_block['body_text'] ); ?>
                </div>
			<?php endif; ?>

			<?php if ( $the_block['button'] ): ?>
				<?php Layouts\Elements::button_element( $the_block['button'] ); ?>
			<?php endif; ?>

        </div>


		<?php
	}

}