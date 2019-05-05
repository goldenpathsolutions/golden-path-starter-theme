<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Funnel with 3 Text Sections Block
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Funnel_With_3_Text_Sections_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block      = get_sub_field( 'funnel_with_3_text_sections_block' );
		$width          = parent::get_width( $the_block['width'] );
		$text_alignment = $the_block['text_alignment'];
		$position       = self::get_position( $the_block['position'] );
		$center_img     = $the_block['center_funnel_image'];

		?>
        <div class="block block-funnel-with-3-text-sections col <?= $width ?> text-<?= $text_alignment ?> <?= $position ?>">

            <div class="slider">

				<?php for ( $idx = 0; $idx < 3; $idx ++ ): ?>

                    <div class="slide-<?= $idx ?>">

                        <div class="left-column">
                            <div class="heading"><?= $the_block['left_column_heading'] ?></div>
                            <div class="top-funnel-text">
                                <div class="heading"><?= $the_block['top_funnel_text']['heading'] ?></div>
                                <div class="subheading"><?= $the_block['top_funnel_text']['subheading'] ?></div>
                                <div class="body-text"><?= wpautop( $the_block['top_funnel_text']['body_text'] ) ?></div>
                            </div>
                            <div class="bottom-funnel-text">
                                <div class="heading"><?= $the_block['bottom_funnel_text']['heading'] ?></div>
                                <div class="subheading"><?= $the_block['bottom_funnel_text']['subheading'] ?></div>
                                <div class="body-text"><?= wpautop( $the_block['bottom_funnel_text']['body_text'] ) ?></div>
                            </div>
                        </div>

                        <div class="center-column">
                            <img src="<?= $center_img['url'] ?>" class="marketing-funnel"
                                 alt="<?= $center_img['alt'] ?>"/>
                        </div>
                        
                        <div class="right-column">
                            <div class="heading"><?= $the_block['right_column_heading'] ?></div>
                            <div class="full-funnel-text">
                                <div class="heading"><?= $the_block['full_funnel_text']['heading'] ?></div>
                                <div class="subheading"><?= $the_block['full_funnel_text']['subheading'] ?></div>
                                <div class="body-text"><?= wpautop( $the_block['full_funnel_text']['body_text'] ) ?></div>
                            </div>
                        </div>

                    </div>

				<?php endfor; ?>

            </div>

        </div>


		<?php
	}

}