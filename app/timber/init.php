<?php

add_filter( 'timber/context', 'add_logo_to_context');

function add_logo_to_context( $context ) {
	$context['logo'] = new \Timber\Image( get_theme_mod( 'custom_logo' ) );
	
	return $context;
}
