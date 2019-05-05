<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * info block
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Info_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block = get_sub_field( 'info_block' );

		$classes[] = 'block';
		$classes[] = 'block-info';
		$classes[] = 'col';
		$classes[] = self::get_width( $the_block['layout']['width'] );
		$classes[] = 'text-' . $the_block['layout']['text_alignment'];
		$position  = $the_block['layout']['position'];
		$classes[] = self::get_position( $position );
		$classes[] = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );

		$classes = apply_filters( 'block-class_info_block', $classes );
		
		?>
        <div class="<?= implode( ' ', $classes ) ?>">

			<?php if ( ! empty( $the_block['top_image'] ) ): ?>
                <div class="image-wrapper">
                    <img src="<?= $the_block['top_image']['url'] ?>" alt="<?= $the_block['top_image']['alt'] ?>"/>
                </div>
			<?php endif; ?>

			<?php if ( $the_block['tagline'] || $the_block['body_text'] || $the_block['button'] ): ?>

                <div class="info-block-copy">

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

			<?php endif; ?>

        </div>


		<?php
	}

}