<?php

namespace GPS\Layouts\Sections;

use GPS\Layouts as Layouts;

/**
 * Flexible Content Section
 *
 * Uses blocks to allow a variety of options
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Section_Flexible_Content extends Section {

	private $section_idx;

	public function __construct() {

		parent::__construct();
		$this->section_idx = parent::$section_count;

		// create a loop for the group container. Lets us take advantage of
        // the_row() and get_sub_field() in child repeaters.
		while ( have_rows( 'section_flexible_content' ) ) : the_row();

			$class = get_sub_field( 'class' );

			?>
            <section id="section-<?= $this->section_idx ?>" class="section section--flexible-content <?= $class ?>">

                <div class="section__container">

					<?php Layouts\Layout_Factory::get_layouts( 'content_blocks', Layouts\Layout_Factory::BLOCKS ); ?>

                </div>

            </section>
		<?php
		endwhile;

	}

}