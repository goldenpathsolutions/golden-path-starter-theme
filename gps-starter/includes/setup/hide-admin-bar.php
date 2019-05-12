<?php

namespace GPS\Setup;
/**
 * Created by PhpStorm.
 * User: pjackson
 * Date: 2019-05-12
 * Time: 11:13
 */

// hide admin bar for non-admins
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'show_admin_bar', array( __NAMESPACE__ . '\\__return_false' ) );
}