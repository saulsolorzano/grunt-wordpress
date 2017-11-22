<?php
/**
 * Template para mostrar la página de archivos
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */
if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin.';
    return;
}