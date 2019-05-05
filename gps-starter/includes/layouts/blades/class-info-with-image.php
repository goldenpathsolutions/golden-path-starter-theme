<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Info with Image blade
 *
 * Info block and Image block used in the page header
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Info_With_Image extends Blade {

	private $blade_idx;
	public $is_header = true;

	public function __construct( $is_header = true ) {

		parent::__construct();

		$this->is_header = $is_header;
		$this->blade_idx = parent::$blade_count;

		$video   = get_sub_field( 'background_video' );
		$overlay = get_sub_field( 'overlay' );

		$img_obj        = get_sub_field( 'background_image' );
		$img_style      = ! empty( $img_obj ) && ! get_sub_field( 'parallax' ) ? 'background-image: url(\'' . $img_obj['sizes']['blade-bg'] . '\');' : '';
		$parallax_cls   = ! empty( $img_obj ) && get_sub_field( 'parallax' ) ? 'parallax-window' : '';
		$parallax_data  = $parallax_cls ? 'data-parallax="scroll" data-speed="0.1" data-image-src="' . $img_obj['sizes']['blade-bg'] . '"' : '';
		$bg_color       = get_sub_field( 'background_color' );
		$bg_color_cls   = empty( $img_obj ) ? 'bg-' . $bg_color : '';
		$foreground     = get_sub_field( 'foreground' );
		$text_alignment = get_sub_field( 'text_alignment' );
		$class          = get_sub_field( 'class' );
		?>

        <section id="<?= $is_header ? 'header' : '' ?>"
                 class="blade blade-info-with-image <?= $bg_color_cls ?> fg-<?= $foreground ?> text-<?= $text_alignment ?> <?= $parallax_cls ?>  <?= $class ?>" <?= $parallax_data ?>
                 style="<?= $img_style ?>">

	        <?php if ( $video ): ?>
                <div class="video-wrapper">
                    <video preload autoplay loop muted>
                        <source src="" data-src="<?= $video['url'] ?>"
                                type='video/mp4; codecs=" avc1.42E01E, mp4a.40.2"'/>
                    </video>
                </div>

		        <?php if ( 'none' !== $overlay ): ?>
                    <div class="overlay overlay--<?= $overlay ?>"></div>
		        <?php endif; ?>
	        <?php endif; ?>


            <div class="container">
                <div class="row">
					<?php Layouts\Layout_Factory::get_layouts( 'blocks', Layouts\Layout_Factory::BLOCKS ); ?>
                </div>
            </div>
        </section>
		<?= $is_header ? '</div>' : '' ?>
		<?php
	}

}