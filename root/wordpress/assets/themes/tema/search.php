<?php
/**
 * Template Name: Search Page
 *
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */
$templates = array('search.twig', 'archive.twig', 'index.twig');
$context = Timber::get_context();
$context['title'] = 'Resultados para: ' . get_search_query();
$context['posts'] = Timber::get_posts();
Timber::render($templates, $context);
