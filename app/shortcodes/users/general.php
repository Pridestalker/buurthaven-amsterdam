<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 09:08
 */

add_shortcode( 'current_user_id', 'whoami_id' );

function whoami_id( $atts ) {
	if ( is_user_logged_in() || pc_user_logged('username')  ) {
		return get_current_user_id()?? pc_user_logged();
	}
}

add_shortcode( 'owner_edit_event', 'event_edit_link');

function event_edit_link($atts) {
	if($post = \get_queried_object_id()) {
		$owner = (int) get_field('organisator', $post);
	} else {
		return;
	}
	
	if( $owner === pc_user_logged('username')) {
		return \Timber\Timber::compile( 'templates/shortcodes/event/user-edit-link.twig', [ 'owner' => $owner ]);
	}
}