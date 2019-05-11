<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Slider blade
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Slider extends Blade {

	private $blade_idx;
	public $is_header = true;

	public function __construct( $is_header = true ) {

		parent::__construct();

		$this->is_header = $is_header;
		$this->blade_idx = parent::$blade_count;

		$slider = get_sub_field( "slider" );
		$slides = $slider['slides'];

		$video   = $slider['background_video'];
		$overlay = $slider['overlay'];
		$bgimg   = $slides[0]['background_image']['sizes']['blade-bg'];


		$img_obj       = $bgimg ?: $slider['background_image']['sizes']['blade-bg'];
		$img_url       = $bgimg ?: $img_obj['sizes']['blade-bg'];
		$img_style     = ! empty( $img_obj ) && ! get_sub_field( 'parallax' ) ? 'background-image: url(\'' . $img_url . '\');' : '';
		$parallax_cls  = ! empty( $img_obj ) && get_sub_field( 'parallax' ) ? 'parallax-window' : '';
		$parallax_data = $parallax_cls ? 'data-parallax="scroll" data-speed="0.1" data-image-src="' . $img_url . '"' : '';
		$bg_color      = get_sub_field( 'background_color' );
		$bg_color_cls  = empty( $img_obj ) ? 'bg-' . $bg_color : '';
		$class         = get_sub_field( 'class' );
		?>
        <section id="<?= $is_header ? 'header' : '' ?>"
                 class="header_slideshow <?= $bg_color_cls ?> <?= $parallax_cls ?> <?= $class ?>" <?= $parallax_data ?>
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




            <div class="">
				<?php
				// LOOP
				$i              = 1;
				$total          = count( $slides );
				foreach ( $slides as $slide ):
					$show = 1 === $i ? 'block' : 'none';
					$position   = $slide['position'];
					$text_align = $slide['text_alignment'];
					?>
                    <div class="slider_container" id="slider_<?= $i; ?>" style="display:<?= $show; ?>">
                        <div class="container" data-slide="<?= $i; ?>"
                             data-bg="<?= $slide['background_image']['sizes']['blade-bg']; ?>"
                             data-overlay="<?= $slide['background_gradient'] ? 1 : 0; ?>">
                            <div class="row">
                                <div class="col col-12 col-md-9 col-lg-7 position-<?= $position ?> text-align-<?= $text_align ?>">
									<?php if ( $slide['tagline'] ): ?>
                                        <div class="tagline">
                                            <h1><?= $slide['tagline']; ?></h1>
                                        </div>
									<?php endif; ?>
									<?php if ( $slide['body_text'] ): ?>
                                        <div class="body-text">
											<?= wpautop( $slide['body_text'] ) ?>
                                        </div>
									<?php endif; ?>
									<?php if ( $slide['button'] ): ?>
                                        <a href="<?= $slide['button']['url']; ?>"
                                           class="button teal"
                                           target="<?= $slide['button']['target']; ?>"><?= $slide['button']['title']; ?></a>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
					++ $i;
				endforeach;
				// END LOOP

				if ( $total > 1 ) :
					?>
                    <div class="far_right">
                        <div class="slider_bars" id="top_bar">
							<?php
							$i = 1;
							while ( $i <= $total ):
								?>
                                <div class="bar bar_white" data-page="<?= $i; ?>">
                                    <div class="bar_line white">
                                        <div class="bar_line progress"></div>
                                    </div>
                                    <div class="bar_number"><?= sprintf( "%02d", $i ); ?></div>
                                </div>
								<?php
								++ $i;
							endwhile;
							?>
                        </div>
                    </div>
				<?php
				endif;
				?>
            </div>
        </section>
		<?= $is_header ? '</div>' : '' ?>
		<?php
	}

}