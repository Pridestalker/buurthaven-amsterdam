<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-14
 * Time: 15:30
 */
require_once 'vendor/autoload.php';

/**
 * Require the helper files.
 */
array_map(
	function ( $file ) {
		$file = get_stylesheet_directory() . "/app/{$file}.php";
		load_template( $file, true );
	},
	[
		'ini',
		
		'timber/init',
		
		'shortcodes/users/general',
		
		'shortcodes/events/new-event-form',
		'shortcodes/events/get-events',
		
		'shortcodes/organisers/frontpage-organiser',
	]
);

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/DoedeJaarsmaCommunicatie/buurthaven-amsterdam/',
	__FILE__,
	'buurthaven-amsterdam'
);
