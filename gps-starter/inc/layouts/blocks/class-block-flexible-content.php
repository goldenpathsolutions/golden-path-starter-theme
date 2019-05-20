<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Flexible Content Block
 *
 * Populated by an assortment of interchangeable Content Block Components
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Block_Flexible_Content extends Block {

	private $block_idx;

	public function __construct() {

		parent::__construct();

		$this->block_idx = parent::$block_count;

		while ( have_rows( 'block_flexible_content' ) ): the_row();


			?>
            <div id="block-<?= $this->block_idx ?>" class="block block--flexible-content <?= $class ?>">

                <div class="block__component">
					<?php Layouts\Layout_Factory::get_layouts( 'content_components', Layouts\Layout_Factory::COMPONENTS ); ?>
                </div>

            </div>
		<?php
		endwhile;

	}

}