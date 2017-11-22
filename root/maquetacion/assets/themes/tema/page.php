<?php
/**
 * Archivo genérico para páginas
 *
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context, 86400);