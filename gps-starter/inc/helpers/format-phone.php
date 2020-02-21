<?php
namespace GPS\Helpers;
/**
 * Format Phone helper function
 *
 * format a phone number for tel: tags or display
 *
 * @author Jason Kenison
 */
function formatPhone( $phone, $return_formatted = true ) {
	$phone = preg_replace( "/[^0-9]/", "", $phone );

	if ( ! $return_formatted ) {
		return $phone;
	}

	if ( strlen( $phone ) == 7 ) {
		return preg_replace( "/([0-9]{3})([0-9]{4})/", "$1.$2", $phone );
		//return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	} else if ( strlen( $phone ) == 10 ) {
		return preg_replace( "/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1.$2.$3", $phone );
		//return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
	} else {
		return $phone;
	}
}