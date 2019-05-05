<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * simple content block
 *
 * wysiwyg editor content with block attributes
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Block_Simple_Content extends Block {

	public function __construct() {

		parent::__construct();

		$the_block = get_sub_field( 'block_simple_content' );

		$classes[] = 'block';
		$classes[] = 'block-simple-content';
		$classes[] = 'col';
		$classes[] = self::get_width( $the_block['layout']['width'] );
		$classes[] = 'text-' . $the_block['layout']['text_alignment'];
		$position  = $the_block['layout']['position'];
		$classes[] = self::get_position( $position );
		$classes[] = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );

		$classes = apply_filters( 'block-class_block_simple_content', $classes );
		?>
        <div class="<?= implode( ' ', $classes ) ?>">


			<?php if ( $the_block['content'] ): ?>

                <div class="info-block-copy">

					<?php if ( $the_block['content'] ): ?>
                        <div class="content">
							<?= wpautop( $the_block['content'] ); ?>
                        </div>
					<?php endif; ?>

                </div>

			<?php endif; ?>

        </div>


		<?php
	}

}