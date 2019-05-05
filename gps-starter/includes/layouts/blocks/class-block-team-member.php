<?php

namespace GPS\Layouts\Blocks;

use GPS\Layouts as Layouts;

/**
 * Team Member block
 *
 * head shot, name, and title for a team member
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Block_Team_Member extends Block {

	public function __construct() {

		parent::__construct();

		$the_block = get_sub_field( 'block_team_member' );

		$classes[] = 'block';
		$classes[] = 'block-team-member';
		$classes[] = 'col-12';
		$classes[] = 'col-md-4';

		$classes = apply_filters( 'block-class_block_team_member', $classes );
		?>
        <div class="<?= implode( ' ', $classes ) ?>">

			<?php if ( ! empty( $the_block['image'] ) ): ?>
                <div class="image-wrapper">
                    <img src="<?= $the_block['image']['sizes']['third'] ?>" alt="<?= $the_block['image']['alt'] ?>"/>
                </div>
			<?php endif; ?>

			<?php if ( ! empty( $the_block['name'] ) ): ?>
                <div class="name-title-wrapper">
                    <h3 class="name"><?= $the_block['name']; ?></h3>
                    <div class="title"><?= $the_block['title']; ?></div>
                </div>
			<?php endif; ?>

        </div>


		<?php
	}

}