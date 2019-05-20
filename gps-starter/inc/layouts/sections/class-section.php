<?php

namespace GPS\Layouts\Sections;
/**
 * Parent class for layout sections
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
Class Section extends \GPS\Layouts\Layout{

	static protected $section_count = 0;

	protected function __construct() {
		parent::__construct();
		self::$section_count++;
	}

	/**
	 * Add Common Attribute Classes
	 *
	 * All section elements must include these classes.  Call this function inside the main element loop.
	 */
	protected function add_common_attribute_classes(){
		parent::add_common_attribute_classes();
	}

}