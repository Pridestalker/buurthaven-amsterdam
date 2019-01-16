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
	wp_enqueue_style( 'buurthanven.amsterdam-style', get_stylesheet_uri(), [], 201811, 'all' );
	wp_enqueue_style( 'buurthanven.amsterdam-font', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,700', [] );
	wp_enqueue_style( 'vmw_general_styles', get_stylesheet_directory_uri() . '/styles/general.css', [], 20190114, 'all' );
}
add_action( 'wp_enqueue_scripts', 'buurthaven_amsterdams_enqueues' );