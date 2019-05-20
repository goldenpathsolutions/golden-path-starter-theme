<?php

namespace GPS\Layouts\Components;

/**
 * Parent class for layout components
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
Class Component extends \GPS\Layouts\Layout {

	protected static $component_count;

	protected function __construct() {
		parent::__construct();
		self::$component_count++;
	}

	/**
	 * Add Common Attribute Classes
	 *
	 * All component elements must include these classes.  Call this function inside the main element loop.
	 */
	protected function add_common_attribute_classes(){
		parent::add_common_attribute_classes();
	}

}