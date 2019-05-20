<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Side Image block
 *
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Block_Side_Image extends Block {

	public function __construct() {

		parent::__construct();

		$the_block  = get_sub_field( 'block_side_image' );
		$width      = self::get_width( $the_block['layout']['width'] );
		$image_size = self::get_image_size( $the_block['layout']['width'] );
		$attach     = $the_block['attach_to_side'];
		$visibility = self::get_visibility( $the_block['visibility']['select_visibility'], $the_block['visibility']['select_breakpoints'] );
		$aspect_ratio = $the_block['image']['sizes'][$image_size . '-height'] / $the_block['image']['sizes'][$image_size . '-width'];
		?>

        <div class="block block-side-image col <?= $width ?> attach-<?= $attach ?> <?= $visibility ?>">

            <div class="image-wrapper image-<?= $image_size ?> col <?= $width ?>">
                <img src="<?= $the_block['image']['sizes'][$image_size] ?>" alt="<?= $the_block['image']['alt'] ?>"/>
            </div>

            <!-- spacer element consumes vertical space on behalf of the image -->
            <div class="image-spacer" style="padding-bottom: <?= $aspect_ratio * 100 ?>%"></div>

        </div>
		<?php

	}

	// override image sizes to allow custom size used in comp for 1/3 width
	public static function get_image_size( $width ){
		switch($width){
			case "quarter": return "quarter";
			case "third": return "third-side-image";
			case "five-twelfths": return "half";
			case "half": return "half";
			default: return "section-bg";
		}
	}

}