<?php

namespace GPS\Layouts\Blocks;

/**
 * Parent class for layout blocks
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
Class Block extends \GPS\Layouts\Layout {

	protected static $block_count;

	protected function __construct() {
		parent::__construct();
		self::$block_count++;
	}

	/**
	 * Add Common Attribute Classes
	 *
	 * All block elements must include these classes.  Call this function inside the main element loop.
	 */
	protected function add_common_attribute_classes(){
		parent::add_common_attribute_classes();
	}


}