<?php
/**
 * @package Manual
 * @version 0.3
 */
/*
Plugin Name: Manual de uso
Description: Manual de creación y mantención de contenidos.
Author: Guillermo Cádiz & Juan Jorquera
Version: 0.3
*/

add_action( 'admin_menu', 'wp_template_manual' );

function wp_template_manual() {
	add_menu_page( 'Manual de creación y mantención de contenidos', 'Manual', 'edit_posts', 'manual', 'wp_template_manual_view', 'dashicons-welcome-learn-more' );
}

function wp_template_manual_view() {

	$url_manual = 'https://docs.google.com/document/d/1xlge08Z0XHngzsGFS4ktRrWSNgTb4JhOTUwfzSsBD-A/pub';

	if ( !current_user_can( 'edit_posts' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	else {
		echo '<style>@import url('.get_template_directory_uri().'/lib/manual/manual-style.css)</style>';
		echo '<div id="manual-wrap">';
		echo file_get_contents( $url_manual );
		echo '</div>';
		echo '<script>jQuery("#header, #footer").hide();</script>';
	}
}
?>