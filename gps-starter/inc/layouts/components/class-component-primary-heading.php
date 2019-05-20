<?php

namespace GPS\Layouts\Components;

use GPS\Layouts as Layouts;

/**
 * Primary Heading Component
 *
 * Creates heading styled as primary heading, H2 tag by default
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Component_Primary_Heading extends Component {

	private $component_idx;

	public function __construct() {

		parent::__construct();

		$this->component_idx = parent::$component_count;

		// create a loop for the group container. Lets us take advantage of
		// the_row() and get_sub_field() in child repeaters.
		while ( have_rows( 'component_primary_heading' ) ) : the_row();

			parent::add_common_attribute_classes();
			$this->classes[] = 'c-primary-heading';

			$tag   = get_sub_field('semantic_heading_h2');

			?>
            <<?=$tag?> id="component-<?= $this->component_idx ?>" class="<?= implode( ' ', $this->classes ) ?>">
                <?= get_sub_field('text') ?>
            </<?=$tag?>>
		<?php
		endwhile;

	}

}