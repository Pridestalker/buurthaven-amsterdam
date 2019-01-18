<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-18
 * Time: 08:43
 */

add_shortcode( 'organisation-fetch', function () {
	$context = [];
	
	var_dump( get_users() );
	
	return \Timber\Timber::render( 'templates/shortcodes/organiser/frontpage-organiser.twig', $context);
});