<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 2019-01-17
 * Time: 08:57
 */

$templates          = [
	'templates/single-' .$post->post_type . '-' . $post->slug . '.twig',
	'templates/single-' .$post->post_type . '.twig',
	'templates/single.twig',
	'templates/index.twig'
];

$context            = \Timber\Timber::get_context();
$context['post']    = new \Timber\Post();
$context['owner']   = new \Timber\User($context['organisator']);


\Timber\Timber::render( $templates, $context );