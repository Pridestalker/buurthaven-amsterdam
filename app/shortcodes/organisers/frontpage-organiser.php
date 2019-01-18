<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-18
 * Time: 08:43
 */

add_shortcode( 'organisation-fetch', function ( $atts ) {
	$atts = shortcode_atts( [
		'limit' => 4
	], $atts);
	$context = [];
	
	var_dump( get_users(
		[
			'limit'     => $atts['limit'],
			'status'    => 1,
			'categories'=> 6,
			'search'    => [
				[
					'key'       =>  'email',
					'operator'  => '!=',
					'val'       => 'support@doedejaarsma.nl',
				]
			]
		]
	) );
	
	return \Timber\Timber::render( 'templates/shortcodes/organiser/frontpage-organiser.twig', $context);
});