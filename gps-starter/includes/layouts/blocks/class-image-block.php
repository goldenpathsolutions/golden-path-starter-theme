<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Image block
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Image_Block extends Block {

	public function __construct() {

		parent::__construct();

		$the_block  = get_sub_field( 'image_block' );
		$width      = self::get_width( $the_block['layout']['width'] );
		$image_size = self::get_image_size( $the_block['width'] );
		$position   = self::get_position( $the_block['layout']['position'] );
		$visibility = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );
		?>

        <div class="block block-image col <?= $width ?> <?= $position ?> <?= $visibility ?>">

            <img src="<?= $the_block['image']['sizes'][ $image_size ] ?>" alt="<?= $the_block['image']['alt'] ?>"/>

        </div>
		<?php

	}

}