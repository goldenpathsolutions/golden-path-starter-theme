<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Four Stacked Layers with Text Block
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Four_Stacked_Layers_With_Text_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block      = get_sub_field( 'block_four_stacked_layers_with_text_block' );
		$width          = parent::get_width( $the_block['width'] );
		$text_alignment = $the_block['text_alignment'];
		$position       = self::get_position( $the_block['position'] );
		$center_img     = $the_block['center_layer_image'];
		$layers         = $the_block['layer_content'];
		?>
        <div class="block block-four-stacked-layers-with-text col <?= $width ?> text-<?= $text_alignment ?> <?= $position ?>">

            <div class="image_slider">

				<?php for ( $idx = 0; $idx < count( $layers ); $idx ++ ) : ?>

                    <div class="slide-<?= $idx ?>">

                        <div class="left-column">

                            <div class="info-block-top">
								<?php
								$img     = $layers[0]['top_image'];
								$tagline = $layers[0]['tagline'];
								$body    = $layers[0]['body_text'];
								?>
                                <img src="<?= $img['url'] ?>" class="top-image" alt=""/>
                                <div class="tagline"><?= $tagline ?></div>
                                <div class="body-text"><?= wpautop( $body ) ?></div>
                            </div>

                            <div class="info-block-bottom">
								<?php
								$img     = $layers[1]['top_image'];
								$tagline = $layers[1]['tagline'];
								$body    = $layers[1]['body_text'];
								?>
                                <img src="<?= $img['url'] ?>" class="top-image" alt=""/>
                                <div class="tagline"><?= $tagline ?></div>
                                <div class="body-text"><?= wpautop( $body ) ?></div>
                            </div>

                        </div>

                        <div class="center-column">
                            <img src="<?= $center_img['url'] ?>" class="stacked-layers"
                                 alt="<?= $center_img['alt'] ?>"/>
                        </div>

                        <div class="right-column">

                            <div class="info-block-top">
								<?php
								$img     = $layers[2]['top_image'];
								$tagline = $layers[2]['tagline'];
								$body    = $layers[2]['body_text'];
								?>
                                <img src="<?= $img['url'] ?>" class="top-image" alt=""/>
                                <div class="tagline"><?= $tagline ?></div>
                                <div class="body-text"><?= wpautop( $body ) ?></div>
                            </div>

                            <div class="info-block-top">
								<?php
								$img     = $layers[3]['top_image'];
								$tagline = $layers[3]['tagline'];
								$body    = $layers[3]['body_text'];
								?>
                                <img src="<?= $img['url'] ?>" class="top-image" alt=""/>
                                <div class="tagline"><?= $tagline ?></div>
                                <div class="body-text"><?= wpautop( $body ) ?></div>
                            </div>

                        </div>

                    </div>

				<?php endfor; ?>

            </div>

        </div>


		<?php
	}

}