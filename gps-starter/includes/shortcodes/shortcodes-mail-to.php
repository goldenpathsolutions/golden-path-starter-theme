<?php
/**
 *
 * MailTo
 *
 * Generates bot-busting email link
 *
 * [mailto address='test@test.com' label='Click to Email Me']
 *
 * @param $atts
 *
 * @return false|string
 */
function mailto( $atts ) {
	ob_start();
	extract( shortcode_atts(
			array(
				'address' => false,
				'label'   => false
			), $atts )
	);

	// convert email address to character codes
	$obj               = array_map( function ( $x ) {
		return "&#" . strval( ord( $x ) ) . ";";
	}, str_split( $address ) );
	$encrypted_address = implode( $obj );

	// split email address into parts
	$parts  = explode( '@', $address );
	$name   = $parts[0];
	$domain = $parts[1];

	?>
	<script language="JavaScript"><!--
        var name = "<?php echo $name; ?>";
        var domain = "<?php echo $domain; ?>";
        document.write('<a href=\"mailto:' + name + '@' + domain + '\">');
		<?php

		if ( $label !== false ) {
			echo "document.write('" . $label . "' + '</a>');";
		} else {
			echo "document.write(name + '@' + domain + '</a>');";
		}

		?>
        // --></script>
	<noscript><a href="mailto:<?php echo $encrypted_address; ?>"><?php
			if ( $label !== false ) {
				echo $label;
			} else {
				echo $encrypted_address;
			}
			?></a></noscript><?php

	return ob_get_clean();

}

add_shortcode( 'mailto', 'mailto' );