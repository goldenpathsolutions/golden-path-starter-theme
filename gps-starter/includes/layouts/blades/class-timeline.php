<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Timeline blade
 *
 * includes tagline, body text, and 4 small info block elements with animated timeline graphic
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Timeline extends Blade {

	private static $timeline_idx = 0;
	private $blade_idx;

	public function __construct() {

		parent::__construct();

		$this->blade_idx = parent::$blade_count;

		Timeline::$timeline_idx ++;

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
        <section id="blade-<?= $this->blade_idx ?>"
                 class="blade blade-timeline <?= $bg_color_cls ?> fg-<?= $foreground ?> text-<?= $text_alignment ?> <?= $parallax_cls ?> <?= $class ?>" <?= $parallax_data ?>
                 style="<?= $img_style ?>"
                 data-start-color="<?= get_sub_field( 'timeline_start' ) ?>"
                 data-end-color="<?= get_sub_field( 'timeline_end' ) ?>">
            <div class="container">
                <div class="row">
                    <div class="block block-eyebrow">
                        <h2 class="eyebrow"><?= get_sub_field( 'section_heading' ) ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-12 col-xl-10">
                        <div class="tagline"><?= get_sub_field( 'tagline' ) ?></div>
                        <div class="body-text"><?= get_sub_field( 'body_text' ) ?></div>
                    </div>
                </div>

				<?php
				$point_idx      = 1;
				$point_color[0] = "#3959cb";
				$point_color[1] = "#4c7bd0";
				$point_color[2] = "#79acdc";
				$point_color[3] = "#5dc1bb";
				?>
                <div class="row timeline-graphic hide-xxs hide-xs hide-sm">

					<?php while ( have_rows( 'timeline_info_blocks' ) ):
						the_row();
						$the_block = get_sub_field( 'info_block' );
						$width     = Blocks\Block::get_width( $the_block['layout']['width'] );
						$step      = 0.5;
						?>

                        <div id="timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?>"
                             class="timeline-point col <?= $width ?>">
                            <svg class="timeline-point-<?= $point_idx ?> animate-on-scroll"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120"
                                 style="animation-delay: <?= $point_idx * $step ?>s;
                                         -webkit-animation-delay: <?= $point_idx * $step ?>s">
                                <defs>
                                    <style>
                                        #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-1 {
                                            fill: #ecebeb;
                                            animation-delay: <?= $point_idx * $step ?>s;
                                            -webkit-animation-delay: <?= $point_idx * $step ?>s;
                                        }

                                        #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-2 {
                                            fill: <?= $point_color[$point_idx-1] ?>;
                                            animation-delay: <?= ($point_idx * $step) ?>s;
                                            -webkit-animation-delay: <?= ($point_idx * $step) ?>s;
                                        }

                                        #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-3 {
                                            fill: <?= $point_color[$point_idx-1] ?>;
                                            animation-delay: <?= ($point_idx * $step) + .1?>s;
                                            -webkit-animation-delay: <?= ($point_idx * $step) + .1 ?>s;
                                        }

                                        #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-4 {
                                            fill: <?= $point_color[$point_idx-1] ?>;
                                            animation-delay: <?= ($point_idx * $step) + .2 ?>s;
                                            -webkit-animation-delay: <?= ($point_idx * $step) + .2 ?>s;
                                        }

                                        #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-5 {
                                            fill: <?= $point_color[$point_idx-1] ?>;
                                            animation-delay: <?= ($point_idx * $step) + .3 ?>s;
                                            -webkit-animation-delay: <?= ($point_idx * $step) + .3 ?>s;
                                        }


                                    </style>
                                </defs>
                                <circle class="circle-1" cx="60" cy="60" r="11.89"/>
                                <circle class="circle-2" cx="60" cy="60" r="11.89"/>
                                <circle class="circle-3" cx="60" cy="60" r="27.67"/>
                                <circle class="circle-4" cx="60" cy="60" r="44.29"/>
                                <circle class="circle-5" cx="60" cy="60" r="60"/>
                            </svg>
                        </div>
						<?php $point_idx ++; ?>
					<?php endwhile; ?>
                </div>

				<?php Timeline::$timeline_idx ++; ?>

                <div class="row row-block-info hide-xxs hide-xs hide-sm">
					<?php
					while ( have_rows( 'timeline_info_blocks' ) ) {
						the_row();
						new Blocks\Info_Block();
					}
					?>
                </div>

                <div class="col-timeline-info-blocks hide-md hide-lg hide-xl show-xxs show-xs show-sm">
					<?php $point_idx = 1; ?>
					<?php while ( have_rows( 'timeline_info_blocks' ) ) :
						the_row(); ?>
                        <div class="row">
                            <div class="col-block-info col col-12">

                                <div id="timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?>"
                                     class="timeline-point">
                                    <svg class="timeline-point-<?= $point_idx ?> animate-on-scroll"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120">
                                        <defs>
                                            <style>
                                                #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-1 {
                                                    fill: #ecebeb;
                                                }

                                                #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-2 {
                                                    fill: <?= $point_color[$point_idx-1] ?>;
                                                }

                                                #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-3 {
                                                    fill: <?= $point_color[$point_idx-1] ?>;
                                                }

                                                #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-4 {
                                                    fill: <?= $point_color[$point_idx-1] ?>;
                                                }

                                                #timeline-<?= Timeline::$timeline_idx ?>-point-<?= $point_idx ?> .circle-5 {
                                                    fill: <?= $point_color[$point_idx-1] ?>;
                                                }


                                            </style>
                                        </defs>
                                        <circle class="circle-1" cx="60" cy="60" r="11.89"/>
                                        <circle class="circle-2" cx="60" cy="60" r="11.89"/>
                                        <circle class="circle-3" cx="60" cy="60" r="27.67"/>
                                        <circle class="circle-4" cx="60" cy="60" r="44.29"/>
                                        <circle class="circle-5" cx="60" cy="60" r="60"/>
                                    </svg>
                                </div>
								<?php new Blocks\Info_Block(); ?>

                            </div>
                        </div>
						<?php $point_idx ++; ?>
					<?php endwhile; ?>
                </div>


				<?php if ( $btn = get_sub_field( 'button' ) ): ?>
                    <div class="row">
						<?php Layouts\Elements::button_element( $btn ); ?>
                    </div>
				<?php endif; ?>
            </div>
        </section>
		<?php
	}

}