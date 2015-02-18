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
	wp_register_script( 'plugins-script', get_template_directory_uri() . '/js/plugins-min.js', array( 'jquery'), '1', true );
	wp_register_script( 'main-script', get_template_directory_uri() . '/js/main-min.js', array( 'jquery'), '1', true );
	wp_register_script( 'modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr-min.js', array(), '2.6.1', false );
	wp_enqueue_script( 'plugins-script' );
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