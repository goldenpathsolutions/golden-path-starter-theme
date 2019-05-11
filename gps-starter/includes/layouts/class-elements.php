<?php

namespace GPS\Layouts;

/**
 * Layout Elements
 *
 * Reusable Elements used within blocks or blades
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Elements{


	public static function button_element( $acf_button ){ ?>
		<a href="<?= $acf_button['url']; ?>"
		   class="button teal"
		   target="<?= $acf_button['target']; ?>"><?= $acf_button['title']; ?></a>
	<?php }


}