<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 10:19
 */

add_shortcode( 'new_event_form', 'sh_new_event');


function sh_new_event($atts) {
	if( !pc_user_logged() ) {
		return;
	}
	
	$user = new \Timber\User(pc_user_logged('id'));
	
	return \Timber\Timber::compile( 'templates/shortcodes/events/new-event-form.twig', [ 'user' => $user ]);
}

add_action( 'admin_post_new_event', 'boot_new_event_callback' );
add_action( 'admin_post_nopriv_new_event', 'boot_new_event_callback');


function boot_new_event_callback() {
	
	wp_send_json_success( ['working', '$_POST' => $_POST,
	                                  '$_GET' => $_GET,
	                                  '$_REQUEST' => $_REQUEST ] );
}
