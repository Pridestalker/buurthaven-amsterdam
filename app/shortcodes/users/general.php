<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 09:08
 */

add_shortcode( 'current_user_id', 'whoami_id' );

function whoami_id( $atts ) {
	var_dump( \pc_user_logged() );
	if ( is_user_logged_in() ) {
		return get_current_user_id();
	}
}
