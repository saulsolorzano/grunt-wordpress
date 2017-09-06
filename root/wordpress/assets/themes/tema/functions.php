<?php
/**
 * Funciones y definiciones de {%= title %}
 *
 * @package		{%= name %}
 * @author		{%= author_name %} <{%= author_email %}>
 * @version		{%= version %}
 */

/****************************************
	Configuración Inicial del Tema
*****************************************/
require_once( get_template_directory() . '/lib/init.php');
require_once( get_template_directory() . '/lib/theme-functions.php');
require_once( get_template_directory() . '/lib/theme-helpers.php');
require_once( get_template_directory() . '/lib/theme-mails.php');
require_once( get_template_directory() . '/lib/gallery.php');
require_once( get_template_directory() . '/lib/manual/manual.php');


/* * **************************************
  Funciones para Timber
 * *************************************** */
if (!class_exists('Timber')) {
    add_action('admin_notices', function() {
        $link = na_action_link('timber-library/timber.php', 'activate');
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate Timber</a></p></div>';
    });
    return;
}

if (!function_exists('add_timber_clear_cache_admin_button')) {
    add_action('admin_notices', function() {
        $link = na_action_link('clear-cache-for-timber/clear-cache-for-timber.php', 'activate');
        echo '<div class="error"><p>Clear cache for Timber not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate Clear cache for Timber</a></p></div>';
    });
    return;
}

if (!class_exists('acf')) {
    add_action('admin_notices', function() {
        $link = na_action_link('advanced-custom-fields-pro/acf.php', 'activate');
        echo '<div class="error"><p>Advanced Custom Fields PRO not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate Advanced Custom Fields PRO</a></p></div>';
    });
    return;
}

if (!class_exists('AC_Yoast_SEO_ACF_Content_Analysis')) {
    add_action('admin_notices', function() {
        $link = na_action_link('acf-content-analysis-for-yoast-seo/yoast-acf-analysis.php', 'activate');
        echo '<div class="error"><p>ACF Content Analysis for Yoast SEO not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate ACF Content Analysis for Yoast SEO</a></p></div>';
    });
    return;
}

if (!class_exists('ITSEC_Core')) {
    add_action('admin_notices', function() {
        $link = na_action_link('better-wp-security/better-wp-security.php', 'activate');
        echo '<div class="error"><p>iThemes Security not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate iThemes Security</a></p></div>';
    });
    return;
}

if (!defined('WPSEO_FILE')) {
    add_action('admin_notices', function() {
        $link = na_action_link('wordpress-seo/wp-seo.php', 'activate');
        echo '<div class="error"><p>WordPress SEO not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate WordPress SEO</a></p></div>';
    });
    return;
}

if (!class_exists('WPMDB_Utils')) {
    add_action('admin_notices', function() {
        $link = na_action_link('wp-migrate-db-pro/wp-migrate-db-pro.php', 'activate');
        echo '<div class="error"><p>WP Migrate DB Pro not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate WP Migrate DB Pro</a></p></div>';
    });
    return;
}

if (!function_exists('wp_migrate_db_pro_media_files')) {
    add_action('admin_notices', function() {
        $link = na_action_link('wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php', 'activate');
        echo '<div class="error"><p>WP Migrate DB Pro Media Files not activated. Make sure you activate the plugin in <a href="' . esc_url($link) . '">Activate WP Migrate DB Pro Media Files</a></p></div>';
    });
    return;
}

class StarterSite extends TimberSite {

    function __construct() {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        parent::__construct();
    }

    function add_to_context($context) {
        $context['menu'] = new TimberMenu('top_header_menu');
        $context['menu_footer'] = new TimberMenu('footer_menu');
        $context['site'] = $this;
        $context['title_site'] = wp_title('-', false, 'right');
        $context['options'] = get_fields('options');
        return $context;
    }

    function add_to_twig($twig) {
        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        return $twig;
    }

}

new StarterSite();

/****************************************
	Funciones del tema propias
*****************************************/
// Función para el css
$filemtime_css = filemtime(get_stylesheet_directory() . '/css/main.css');
$context['filemtime_css'] = date ("Y\.m\.d\.His", $filemtime_css);