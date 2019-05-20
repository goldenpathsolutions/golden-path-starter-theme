<?php

namespace GPS\Layouts\Components;

use GPS\Layouts as Layouts;

/**
 * Button Component
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Component_Button extends Component {

	public function __construct() {

		parent::__construct();

		// create a loop for the group container. Lets us take advantage of
		// the_row() and get_sub_field() in child repeaters.
		while ( have_rows( 'component_button' ) ) : the_row();

			parent::add_common_attribute_classes();
			$this->classes[] = 'c-button';

			$button = get_sub_field('button');
			$button_style = get_sub_field( 'button_style' );

			?>

            <div class="<?= implode( ' ', $this->classes ) ?>">

                <a href="<?= $button['url']; ?>"
                   class="button <?= 'button' !== $button_style ? 'button--' . $button_style : '' ?>"
                   target="<?= $button['target']; ?>"><?= $button['title']; ?></a>

            </div>
		<?php
		endwhile;

	}

}