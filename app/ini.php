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
	
	wp_register_style('jquery_ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
	
	
	wp_enqueue_style( 'buurthaven.amsterdam-style', get_stylesheet_uri(), [], 201811, 'all' );
	wp_enqueue_style( 'buurthaven.amsterdam-font', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,700', [] );
	wp_enqueue_style( 'buurthaven.amsterdam-general', get_stylesheet_directory_uri() . '/dist/styles/buurthaven.combined.css', [], 1547626846, 'all' );
	wp_enqueue_style( 'jquery_ui');
	
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'buurthaven.amsterdam-scripts-general', get_stylesheet_directory_uri() . '/dist/scripts/buurthaven.combined.js', [], 1547626846, true);
}
add_action( 'wp_enqueue_scripts', 'buurthaven_amsterdams_enqueues' );


// Register Custom Post Type
function custom_post_type_events() {
	
	$labels = array(
		'name'                  => 'Evenementen',
		'singular_name'         => 'Evenement',
		'menu_name'             => 'Evenementen',
		'name_admin_bar'        => 'Evenement',
		'archives'              => 'Evenementen archieven',
		'attributes'            => 'Evenementen attributen',
		'parent_item_colon'     => 'Bovenliggent Evenement',
		'all_items'             => 'Alle Evenementen',
		'add_new_item'          => 'Nieuw Evenement toevoegen',
		'add_new'               => 'Nieuw',
		'new_item'              => 'Nieuw',
		'edit_item'             => 'Evenement aanpassen',
		'update_item'           => 'Evenement aanpassen',
		'view_item'             => 'Evenement bekijken',
		'view_items'            => 'Evenementen bekijken',
		'search_items'          => 'Evenement zoeken',
		'not_found'             => 'Niet gevonden',
		'not_found_in_trash'    => 'Niet gevonden in prullenbak',
		'featured_image'        => 'Uitgelichte afbeelding',
		'set_featured_image'    => 'Kies uitgelichte afbeelding',
		'remove_featured_image' => 'Verwijder uitgelichte afbeelding',
		'use_featured_image'    => 'Gebruik als uitgelichte afbeelding',
		'insert_into_item'      => 'Voeg toe aan',
		'uploaded_to_this_item' => 'Upload naar evenement',
		'items_list'            => 'Evenementen lijst',
		'items_list_navigation' => 'Evenementen lijst navigatie',
		'filter_items_list'     => 'Filter Evenementen',
	);
	$args = array(
		'label'                 => 'Evenement',
		'description'           => 'Evenementen die gehouden kunnen worden bij het buurthuis',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'evenement', $args );
	
}
add_action( 'init', 'custom_post_type_events', 0 );