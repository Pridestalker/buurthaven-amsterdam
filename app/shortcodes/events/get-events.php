<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 15:01
 */

add_shortcode('frontpage-events', function ($atts) {
    $events = eo_get_events(array(
        'numberposts'       => 3,
        // 'event_start_after' => 'today',
        'showpastevents'    => false, // Will be deprecated, but set it to true to play it safe.
        // False because this should load only a certain number of posts.
    ));
    $context['posts'] = [];
    
    if ($events) {
        foreach ($events as $event) {
            $context['posts'] [] = new \Timber\Post($event->ID);
        }
    }
    
    return \Timber\Timber::compile('templates/shortcodes/frontpage/events.twig', $context);
});

add_shortcode('grid_agenda', static function ($atts) {
    $events = eo_get_events( [
        'numberposts'       => 5,
        // 'event_start_after' => 'today',
        'showpastevents'    => false, // Will be deprecated, but set it to true to play it safe.
        // False because this should load only a certain number of posts.
    ] );
    $context['posts'] = [];
    
    if ($events) {
        foreach ($events as $event) {
            $context['posts'] [] = new \Timber\Post($event->ID);
        }
    }
    
    return \Timber\Timber::compile('templates/shortcodes/event/agenda.twig', $context);
});


add_shortcode( 'list_agenda', static function ( $atts ) {
	$events = eo_get_events( [
		'numberposts'       => 5,
		// 'event_start_after' => 'today',
		'showpastevents'    => false, // Will be deprecated, but set it to true to play it safe.
		// False because this should load only a certain number of posts.
	] );
	$context['posts'] = [];
	
	if ($events) {
		foreach ($events as $event) {
			$context['posts'] [] = new \Timber\Post($event->ID);
		}
	}
	
	return \Timber\Timber::compile('templates/shortcodes/event/agenda_list.twig', $context);
});
