<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Infinite loop carousel block
 *
 * Display images as a carousel that automatically advances continuously
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Block_Infinite_Loop_Carousel extends Block {

	public function __construct() {

		parent::__construct();

		$the_block  = get_sub_field( 'block_infinite_loop_carousel' );
		$width      = self::get_width( $the_block['width'] );
		$image_size = self::get_image_size( $the_block['width'] );
		$position   = self::get_position( $the_block['position'] );

		?>

        <div class="block block-infinite-loop-carousel carousel-infinite-loop col <?= $width ?> <?= $position ?>">

			<?php foreach ( $the_block['slides'] as $slide ):
				?>
                <div class="carousel-slide">
                    <img src="<?= $slide['image']['sizes'][ $image_size ] ?>" alt="<?= $slide['image']['alt'] ?>"/>
                </div>

			<?php endforeach; ?>

        </div>
		<?php

	}

}