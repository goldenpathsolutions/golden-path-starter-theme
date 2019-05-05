<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * shortcode block
 *
 * text field with block attributes
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Block_Shortcode extends Block {

	public function __construct() {

		parent::__construct();

		$the_block = get_sub_field( 'block_shortcode' );

		$classes[] = 'block';
		$classes[] = 'block-shortcode';
		$classes[] = 'col';
		$classes[] = self::get_width( $the_block['layout']['width'] );
		$classes[] = 'text-' . $the_block['layout']['text_alignment'];
		$position  = $the_block['layout']['position'];
		$classes[] = self::get_position( $position );
		$classes[] = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );

		$classes = apply_filters( 'block-class_block_shortcode', $classes );
		?>
        <div class="<?= implode( ' ', $classes ) ?>">


			<?php if ( $the_block['shortcode'] ): ?>

				<?php if ( $the_block['shortcode'] ): ?>
                    <div class="shortcode-content">
						<?= do_shortcode( $the_block['shortcode'] ); ?>
                    </div>
				<?php endif; ?>

			<?php endif; ?>

        </div>


		<?php
	}

}