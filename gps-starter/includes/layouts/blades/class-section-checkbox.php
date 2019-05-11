<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Checkboxes blade
 *
 * Displays tagline and checkboxes blocks
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Section_Checkbox extends Blade {

	private $blade_idx;

	public function __construct() {

		parent::__construct();

		$this->blade_idx = parent::$blade_count;

		$bg_color   = get_sub_field( 'background_color' );
		$btn        = get_sub_field( 'button_block' )['button'];
		$foreground = get_sub_field( 'foreground' );
		$class      = get_sub_field( 'class' );
		?>

        <section id="blade-<?= $this->blade_idx ?>" class="blade blade-checkboxes bg-<?= $bg_color ?> fg-<?= $foreground ?>  <?= $class ?>">
            <div class="container">
                <div class="row">

					<?php if ( get_sub_field( 'tagline' ) || ! empty( $btn ) ): ?>

                        <div class="block block-tagline-button col-12 col-md-6">

							<?php if ( get_sub_field( 'tagline' ) ): ?>
                                <div class="tagline"><?= wpautop( get_sub_field( 'tagline' ) ) ?></div>
							<?php endif; ?>

							<?php if ( ! empty( $btn ) ): ?>
                                <div class="row desktop-only">
									<?php new Blocks\Button_Block(); ?>
                                </div>
							<?php endif; ?>
                        </div>

					<?php endif; ?>

					<?php if ( have_rows( 'checkboxes' ) ): ?>
                        <div class="block block-checkboxes col-12 col-md-6">
							<?php
							$step = .7;
							$idx  = 0;
							?>
                            <ul class="checkbox-list animate-on-scroll">
								<?php while ( have_rows( 'checkboxes' ) ): the_row(); ?>
                                    <li class="checkbox-item"
                                        style="animation-delay: <?= $idx * $step ?>s;
                                                -webkit-animation-delay: <?= $idx * $step ?>s"><span
                                                class="text"><?= get_sub_field( 'checkbox_text' ) ?></span></li>
									<?php $idx ++; ?>
								<?php endwhile; ?>
                            </ul>
                            <?php 
	                        /* replacing with an alternate animation on a single list
                            <ul class="checkbox-list active animate-on-scroll">
								<?php $idx = 0; ?>
								<?php while ( have_rows( 'checkboxes' ) ): the_row(); ?>
                                    <li class="checkbox-item"
                                        style="animation-delay: <?= $idx * $step ?>s;
                                                -webkit-animation-delay: <?= $idx * $step ?>s"><span
                                                class="text"><?= get_sub_field( 'checkbox_text' ) ?></span>
                                    </li>
									<?php $idx ++; ?>
								<?php endwhile; ?>
                            </ul>
                            */
                            ?>
                        </div>
					<?php endif; ?>

					<?php if ( ! empty( $btn ) ): ?>
                        <div class="col mobile-only">
							<?php Layouts\Elements::button_element( $btn ); ?>
                        </div>
					<?php endif; ?>

                </div>
            </div>
        </section>
		<?php
	}

}