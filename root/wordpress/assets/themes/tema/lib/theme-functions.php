<?php
/**
 * Iniciando funciones del tema
 *
 * @package		RisingPhoenex
 * @author		Agencia Digital Reactor <contacto@reactor.cl>
 * @version		1.0.0
 */

/**
 * Remove Query Strings From Static Resources
 */
function mb_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
/**
 * Registrando JS para front de la página - Footer
 */
function ss_scripts() {
	wp_register_script( 'main-script', get_template_directory_uri() . '/js/app.min.js', array( 'jquery'), '1.0.0', true );
	wp_register_script( 'modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', false );
	wp_enqueue_script( 'main-script' );
	wp_enqueue_script( 'modernizr-script' );
}
/**
 * Excerpt más elegante
 */
function new_excerpt_more($excerpt) {
	return str_replace('[...]', ' ', $excerpt);
}
/**
 * Registrando Sidebar
 */
register_sidebar();
/**
 * Quitando Width y Height de todas las imagenes - Sin esto el responsive no sirve
 */
function remove_width_attribute( $html ) {
	 $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	 return $html;
}


/**
 * Agregar soporte para subir un svg
 */
function custom_upload_mimes($existing_mimes = array()) {
		$existing_mimes['svg'] = 'mime/type';
		$existing_mimes['svgz'] = 'mime/type';
		return $existing_mimes;
}

add_filter('upload_mimes', 'custom_upload_mimes');

/**
 * ACF: Options page
 */
if (function_exists('acf_add_options_page')) {

		acf_add_options_page(array(
				'page_title' => 'Opciones del Tema',
				'menu_title' => 'Opciones',
				'menu_slug' => 'opciones-generales-tema',
				'icon_url' => 'dashicons-hammer',
				'capability' => 'edit_posts',
				'redirect' => false
		));
}
/*
 * Ocultar barra de abministración
 *  */
add_filter('show_admin_bar', '__return_false');
/**
 * Limpiando nombre de archivo antes de la subida
 * @param  string $filename pasamos el nombre del archivo
 * @return string           nos retorna el nombre del archivo sin caracteres especiales
 */
function sanitize_filename_on_upload($filename) {
	$exp = explode('.',$filename);
	$ext = end($exp);
	// Replace all weird characters
	$sanitized = preg_replace('/[^a-zA-Z0-9-_.]/','', substr($filename, 0, -(strlen($ext)+1)));
	// Replace dots inside filename
	$sanitized = str_replace('.','-', $sanitized);
	return strtolower($sanitized.'.'.$ext);
}

add_filter('sanitize_file_name', 'sanitize_filename_on_upload', 10);

/**
 * Colocando Créditos en footer de Wordpress
 */
function modify_footer_admin () {
	echo 'Creado por <a href="http://reactor.cl">Agencia Digital Reactor</a>. Potenciado por <a href="http://www.wordpress.org">WordPress</a>';
}
/**
 * Colocando logo de Saul en pantalla de login
 */
function login_styles() {
	echo '<style type="text/css">body.login #login h1 a { background: url('. get_bloginfo('template_directory') .'/img/wdt_logo.png) no-repeat center top; height:146px; width:326px; margin-top: -50px;}</style>';
}

/**
 * Asignando dirección y Título al link del login
 */
function ss_url_login(){
	return 'http://reactor.cl/'; // The root of your site or any relative link
}
function ss_url_title(){
	return 'Agencia Digital Reactor'; // The title of your link
}

function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
