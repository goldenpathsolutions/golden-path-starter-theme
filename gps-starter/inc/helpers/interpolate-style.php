<?php
namespace GPS\Helpers;

/**
 * Interpolate Style
 *
 * Given a style, min, and max values, this uses the global constant CONTAINER_BREAKPOINTS to interpolate the values
 * for each breakpoint, and echo the appropriate media queries.
 *
 * Assume $min and $max are in units of pixels.
 * Assume CONTAINER_BREAKPOINTS is stored in increasing order of breakpoints.
 * Assume min value applies to 1st and 2nd breakpoints.
 *
 * Output is generated in mobile first format
 * Does NOT generate <style> tags
 *
 * @author Patrick Jackson <patrick@newtheory.is>
 */

function interpolate_style($selector, $style, $min, $max){

	$breakpoints = array_values( CONTAINER_BREAKPOINTS );
	if( empty($breakpoints) ){
		return "\n";
	}

	// echo out lowest value
	echo $selector . " {\n";
	echo "  " . $style . ": " . $min . "px;\n";
	echo "}\n";

	$slope = ($max - $min) / (end( $breakpoints ) - $breakpoints[1]);
	$y_intercept = $min - ( $slope * $breakpoints[1]);
	$num_breakpoints = count($breakpoints);
	
	for( $idx = 2; $idx < $num_breakpoints; $idx++ ){
		echo "@media ( min-width: " . $breakpoints[$idx] . "px ){\n";
		echo "  " . $selector . " {\n";
		echo "    " . $style . ": " . ($breakpoints[$idx] * $slope + $y_intercept) . "px;\n";
		echo "  }\n";
		echo "}\n";
	}


}