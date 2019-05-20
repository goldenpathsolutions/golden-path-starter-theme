<?php

namespace GPS\Layouts\Components;

use GPS\Layouts as Layouts;

/**
 * Secondary Subheading Component
 *
 * Creates subheading styled as secondary subheading
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Component_Secondary_Subheading extends Component {

	private $component_idx;

	public function __construct() {

		parent::__construct();

		$this->component_idx = parent::$component_count;

		// create a loop for the group container. Lets us take advantage of
		// the_row() and get_sub_field() in child repeaters.
		while ( have_rows( 'component_secondary_subheading' ) ) : the_row();

			parent::add_common_attribute_classes();
			$this->classes[] = 'c-secondary-subheading';

			?>
            <p id="component-<?= $this->component_idx ?>" class="<?= implode( ' ', $this->classes ) ?>">
                <?= get_sub_field('text') ?>
            </p>
		<?php
		endwhile;

	}

}