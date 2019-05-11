<?php

namespace GPS\Layouts\Sections;
/**
 * Parent class for layout sections
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 */
Class Section {

	static protected $section_count = 0;

	public function __construct() {
		self::$section_count++;
	}

}