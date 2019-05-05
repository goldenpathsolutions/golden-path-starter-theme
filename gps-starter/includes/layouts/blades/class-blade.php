<?php

namespace GPS\Layouts\Blades;
/**
 * Parent class for layout blades
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
Class Blade {

	static protected $blade_count = 0;

	public function __construct() {
		self::$blade_count++;
	}

}