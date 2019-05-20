<?php

namespace GPS\Layouts\Components;

use GPS\Layouts as Layouts;

/**
 * Body Content Component
 *
 * wysiwyg editor content with component attributes
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
class Component_Body_Content extends Component {

	private $component_idx;

	public function __construct() {

		parent::__construct();

		$this->component_idx = parent::$component_count;

		// create a loop for the group container. Lets us take advantage of
		// the_row() and get_sub_field() in child repeaters.
		while ( have_rows( 'component_body_content' ) ) : the_row();

			$layout     = get_sub_field( 'layout' );
			$visibility = get_sub_field( 'visibility' );

			parent::add_common_attribute_classes();
			$this->classes[] = 'c-body-conent';
			/*$this->classes[] = self::get_width( $layout['width'] );
			$this->classes[] = 'text-' . $layout['text_alignment'];
			$position  = $layout['position'];
			$this->classes[] = self::get_position( $position );
			$this->classes[] = self::get_visibility( $visibility['select_visibility'], $visibility['select_breakpoints'] );*/


			$content = get_sub_field( 'content' );
			?>

			<?php if ( $content ): ?>
                <div class="<?= implode( ' ', $this->classes ) ?>">

					<?= wpautop( $content ); ?>

                </div>

			<?php endif; ?>


		<?php

		endwhile;

	}

}