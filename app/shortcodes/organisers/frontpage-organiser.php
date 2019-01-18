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
	
	$html = [];
	
	$context = \Timber\Timber::get_context();
	
	foreach ($users as $user) {
		$context['users'] [$user->ID]= new Timber\User($user->ID);
		
		$args = array(
			'numberposts' => -1,
			'post_type' => 'event',
			'meta_key' => 'organisator',
			'meta_value' => 'red'
		);
		$context['users'] [$user->ID] ['posts']= Timber::get_posts($args);
		
		
	}
	
	return \Timber\Timber::render( 'templates/shortcodes/organiser/frontpage-organiser.twig', $context);
	
});