<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts;

/**
 * Team Blade
 *
 * grid of team members
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Section_Team extends Blade {

	private $blade_idx;

	public function __construct() {

		parent::__construct();

		$this->blade_idx = parent::$blade_count;

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
                 class="blade blade-team <?= $bg_color_cls ?> fg-<?= $foreground ?> text-<?= $text_alignment ?> <?= $class ?> <?= $parallax_cls ?>" <?= $parallax_data ?>
                 style="<?= $img_style ?>">

            <div class="container">

				<?php if ( get_sub_field( 'section_heading' ) ): ?>
                    <div class="row">
                        <div class="block block-eyebrow">
                            <h2 class="eyebrow"><?= get_sub_field( 'section_heading' ) ?></h2>
                        </div>
                    </div>
				<?php endif; ?>


                <div class="row row-team">
                    <div class="block block-spacer block-team-member desktop-only col-4"></div>
					<?php while ( have_rows( 'team_members' ) ) {
						the_row();
						new Layouts\Blocks\Block_Team_Member();
					} ?>
                </div>

            </div>

        </section>
		<?php
	}

}