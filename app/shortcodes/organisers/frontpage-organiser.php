<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-18
 * Time: 08:43
 */

add_shortcode( 'organisation-fetch', function ( $atts ) {
	global $pc_users;
	
	$atts = shortcode_atts( [
		'limit' => 4
	], $atts);
	
	$users = $pc_users->get_users(
		[
			'limit'     => $atts['limit'],
			'status'    => 1,
			'categories'=> 6,
		]
	);
	
	$context = \Timber\Timber::get_context();
	
	foreach ($users as $user) {
		$context['users'] [$user->ID]= new Timber\User($user->ID);
		
		
	}
	
	return \Timber\Timber::render( 'templates/shortcodes/organiser/frontpage-organiser.twig', $context);
	
});