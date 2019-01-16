<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-16
 * Time: 08:14
 */


/**
 * Enqueue scripts and styles.
 */
function buurthaven_amsterdams_enqueues() {
	wp_enqueue_style( 'buurthaven.amsterdam-style', get_stylesheet_uri(), [], 201811, 'all' );
	wp_enqueue_style( 'buurthaven.amsterdam-font', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,700', [] );
	wp_enqueue_style( 'buurthaven.amsterdam-general', get_stylesheet_directory_uri() . '/dist/styles/buurthaven.combined.css', [], 1547626846, 'all' );
	
	
	wp_enqueue_script( 'buurthaven.amsterdam-scripts-general', get_stylesheet_directory_uri() . '/dist/scripts/buurthaven.combined.js', [], 1547626846, true);
}
add_action( 'wp_enqueue_scripts', 'buurthaven_amsterdams_enqueues' );