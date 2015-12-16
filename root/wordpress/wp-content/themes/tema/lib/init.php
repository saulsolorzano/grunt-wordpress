<?php
/**
 * Iniciando funciones del tema
 *
 * @package		RisingPhoenex
 * @author		Agencia Digital Reactor <contacto@reactor.cl>
 * @version		1.0.0
 */

if ( ! function_exists('ss_setup') ) :

function ss_setup() {
	// Registrando Menús principales
	register_nav_menus(
		array(
			'top_header_menu'   => 'Menu Principal',
			'footer_menu' => 'Menú del footer'
		)
	);

	// Ejecutar shortcodes en Widgets
	// add_filter('widget_text', 'do_shortcode');

	// Agregar estilos al editor
	add_editor_style( 'editor-style.css' );

	// Permitir suporte de Thumbnails
	add_theme_support('post-thumbnails');

	// Tamaños de las imagenes
	// add_image_size( 'single-image', 800, 9999 );

	// Agregando soporte de post formats
	// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'link', 'image', 'quote', 'audio' ) );

	// Agregando scripts
	add_action( 'wp_enqueue_scripts', 'ss_scripts' );

	// Remove Query Strings From Static Resources
	add_filter( 'script_loader_src', 'mb_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', 'mb_remove_script_version', 15, 1 );

	// Excerpt más elegante
	add_filter('wp_trim_excerpt', 'new_excerpt_more');

	// Haciendo posible el responsive
	add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
	add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

	// Footer de Wordpress
	add_filter('admin_footer_text', 'modify_footer_admin');

	// Logo en el Home
	add_action('login_head', 'login_styles');

	//Quitando estilos de comentarios
	add_action('widgets_init', 'remove_recent_comments_style');

	// Cambiando links y titulo
	add_filter('login_headerurl', 'ss_url_login');
	add_filter('login_headertitle', 'ss_url_title');

	// Quitando cosas innecesarias de WP
	remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_theme_support('automatic-feed-links');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'qtranxf_wp_head_meta_generator');
    add_filter('disable_wpseo_json_ld_search', '__return_true');
}

endif; // ss_setup

add_action( 'after_setup_theme', 'ss_setup' );
