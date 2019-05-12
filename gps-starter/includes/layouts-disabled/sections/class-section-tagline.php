<?php

namespace GPS\Layouts\Sections;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Taglne section
 *
 * Uses only tagline and button
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Section_Tagline extends Section {

	private $section_idx;

	public function __construct() {

		parent::__construct();

		$this->section_idx = parent::$section_count;

		$img_obj        = get_sub_field( 'background_image' );
		$img_style      = ! empty( $img_obj ) && ! get_sub_field( 'parallax' ) ? 'background-image: url(\'' . $img_obj['sizes']['section-bg'] . '\');' : '';
		$parallax_cls   = ! empty( $img_obj ) && get_sub_field( 'parallax' ) ? 'parallax-window' : '';
		$parallax_data  = $parallax_cls ? 'data-parallax="scroll" data-speed="0.1" data-image-src="' . $img_obj['sizes']['section-bg'] . '"' : '';
		$bg_color       = get_sub_field( 'background_color' );
		$bg_color_cls   = empty( $img_obj ) ? 'bg-' . $bg_color : '';
		$foreground     = get_sub_field( 'foreground' );
		$text_alignment = get_sub_field( 'text_alignment' );
		$width          = get_sub_field( 'width' );
		$width_cls      = Blocks\Block::get_width( $width );
		$position       = get_sub_field( 'position' );
		$position_cls   = Blocks\Block::get_position( $position );
		$class          = get_sub_field( 'class' );
		?>

        <section id="section-<?= $this->section_idx ?>"
                 class="section section-tagline <?= $bg_color_cls ?> fg-<?= $foreground ?> text-<?= $text_alignment ?> <?= $parallax_cls ?> <?= $class ?>" <?= $parallax_data ?>
                 style="<?= $img_style ?>">

            <div class="container">

				<?php if ( get_sub_field( 'section_heading' ) ): ?>
                    <div class="row">
                        <div class="block block-eyebrow">
                            <h2 class="eyebrow"><?= get_sub_field( 'section_heading' ) ?></h2>
                        </div>
                    </div>
				<?php endif; ?>

                <div class="block <?= $width_cls ?> <?= $position_cls ?> ">

					<?php if ( get_sub_field( 'tagline' ) ): ?>
                        <div class="row row-tagline">
                            <div class="tagline"><?= wpautop( get_sub_field( 'tagline' ) ) ?></div>
                        </div>
					<?php endif; ?>

					<?php if ( $btn = get_sub_field( 'button' ) ): ?>
                        <div class="row row-button">
                            <div class="col">
								<?php Layouts\Elements::button_element( $btn ); ?>
                            </div>
                        </div>
					<?php endif; ?>

                </div>
            </div>
        </section>
		<?php
	}

}