<?php
include 'functions.php';
/**
 * Cabacera de la Página
 *
 * Nuestra todo el contenido hasta <body>
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */
?>
<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/vendor/modernizr.js"></script>
	</head>
	<body <?php body_class(); ?>>
		<div class="page-wrap">