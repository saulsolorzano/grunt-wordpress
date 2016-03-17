<?php
/**
 * Template para mostrar los errores 404
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */
$context = Timber::get_context();
$context['title'] = "Error 404: Página No Encontrada";
$context['mensaje'] = "La página que buscas puede haber sido removida, cambiado de nombre, o temporalmente no está disponible.";
Timber::render('404.twig', $context);