<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 10:19
 */
use Carbon\Carbon;

add_shortcode( 'new_event_form', 'sh_new_event');


function sh_new_event($atts) {
//	if( !pc_user_logged() ) {
//		return;
//	}
	
	$user = new \Timber\User( pc_user_logged('id') );
	
	return \Timber\Timber::compile( 'templates/shortcodes/events/new-event-form.twig', [ 'user' => $user ]);
}

add_action( 'admin_post_new_event', 'boot_new_event_callback' );
add_action( 'admin_post_nopriv_new_event', 'boot_new_event_callback');


function boot_new_event_callback() {
	
	if(!isset($_POST))
		wp_redirect('/mijn?fail=1');
	
	$event_data = [
		'start' => isset($_POST['startDate'])? Carbon::createFromTimestamp( (int) substr($_POST[ 'startDate' ], 0, -3) ) : new DateTime(),
		'end'   => isset($_POST['endDate'])? Carbon::createFromTimestamp( (int) substr( $_POST[ 'endDate' ], 0, -3) ) : new DateTime(),
	];
	
	if( isset($_POST['repeat'])) {
		if( $_POST['repeat'] === 'on') {
			$event_data += [
				'schedule'  =>  'weekly',
				'schedule_meta' => [
					$_POST['day-mo']?? null,
					$_POST['day-tu']?? null,
					$_POST['day-we']?? null,
					$_POST['day-th']?? null,
					$_POST['day-fr']?? null,
					$_POST['day-sa']?? null,
					$_POST['day-su']?? null,
				],
				'frequency' => 1
			];
		}
	}

	
	$post_data = [
		'post_title'    => $_POST['title'],
		'post_content'  => $_POST['description'],
	];
	
	if( $_FILES['thumbnail']['error'] !== 4) {
		$move_thumbnail = wp_handle_upload( $_FILES[ 'thumbnail' ], ['action' => 'new_event']);
		$filename = $move_thumbnail['file'];
	} else {
		wp_redirect('/mijn?fail=1');
	}
	
	$event = eo_insert_event($post_data, $event_data);
	
	if( $filename ) {
		$attachment = [
			'guid'              => $move_thumbnail['url'],
			'post_mime_type'    => $move_thumbnail['type'],
			'post_title'        => $_POST['title'] . '_image',
			'post_content'      => '',
			'post_status'       => 'inherit'
		];
		
		$attach_id = wp_insert_attachment( $attachment, $filename, $event);
		
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename);
		
		wp_update_attachment_metadata( $attach_id, $attach_data);
		
		set_post_thumbnail( $event, $attach_id);
	}

	update_field('organisator', get_current_user_id(), $event);
	
	wp_redirect('/mijn?success=1');
}
