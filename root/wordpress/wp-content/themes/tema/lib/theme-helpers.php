<?php
/**
 * Iniciando funciones del tema
 *
 * @package		RisingPhoenex
 * @author		Agencia Digital Reactor <contacto@reactor.cl>
 * @version		1.0.0
 */
/*********************************************************
				Funciones y Clases de ayuda
 ********************************************************/
/**
 * Nuevo post type
 */
class ContentType {
	public $type;
	public $options = array();
	public $labels = array();

	public function __construct($type, $options = array(), $labels = array()) {

		$this->type = $type;

		$default_options = array(
			'public' => true,
			'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'excerpt', 'comments'),
			'publicly_queryable' => true,
			'menu_icon' => get_template_directory_uri() . '/img/' . $this->type . '.png'
		);

		$required_labels = array(

			'singular_name' => ucwords($this->type),
			'plural_name' => ucwords($this->type)

		);

		$this->options = $options + $default_options;
		$this->labels = $labels;

		$this->options['labels'] = $this->labels + $this->default_labels();

		add_action('init', array($this, "register"));

	}

	public function register() {
		register_post_type( $this->type, $this->options );
	}

	public function default_labels() {

		return array(

			'name'					=>	$this->labels['plural_name'],
			'singular_name'			=>	$this->labels['singular_name'],
			'add_new'				=>	'Agregar nuevo ' . $this->labels['singular_name'],
			'add_new_item'			=>	'Agregar nuevo ' . $this->labels['singular_name'],
			'edit'					=>	'Editar',
			'edit_item'				=>	'Editar ' . $this->labels['singular_name'],
			'new_item'				=>	'Nuevo ' . $this->labels['singular_name'],
			'view'					=>	'Ver' . $this->labels['singular_name'] . ' Página',
			'view_item'				=>	'Ver ' . $this->labels['singular_name'],
			'search_items'			=>	'Buscar ' . $this->labels['plural_name'],
			'not_found'				=>	'No se encontraron ' . $this->labels['plural_name'],
			'not_found_in_trash'	=>	'No se encontraron ' . $this->labels['plural_name'] . ' en la papelera',
			'parent_item_colon'		=>	'Padre ' . $this->labels['singular_name']

		);
	}

}

function register_taxonomies($sitio, $name, $type, $slug) {
//    return;
    $labels_cat = array(
        'name' => _x($name , 'Taxonomy General Name', $sitio),
        'singular_name' => _x('Categoría', 'Taxonomy Singular Name', $sitio),
        'menu_name' => __($name, $sitio),
        'all_items' => __('Todas', $sitio),
        'parent_item' => __($name . ' padre', $sitio),
        'parent_item_colon' => __($name . ' padre:', $sitio),
        'new_item_name' => __('Agregar nueva ' . $name, $sitio),
        'add_new_item' => __('Agregar nueva', $sitio),
        'edit_item' => __('Editar', $sitio),
        'update_item' => __('Actualizar', $sitio),
        'separate_items_with_commas' => __('Separar ' . $name . ' por comas', $sitio),
        'search_items' => __('Buscar ' . $name, $sitio),
        'add_or_remove_items' => __('Agregar o borrar ' . $name , $sitio),
        'choose_from_most_used' => __('Elegir de las más usuadas', $sitio),
        'not_found' => __('No encontrado', $sitio)
    );
    $args_cat = array(
        'labels' => $labels_cat,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false
    );
    register_taxonomy($slug, array($type), $args_cat);
}


/*********************************************************
				Paginación
 ********************************************************/

/* Opcion 1 */
function reactor_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}


/* Opcion 2 */
function kriesi_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='navigation'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul></div>\n";
     }
}

/* Opcion 3 */

function wp_corenavi () {

	global $wp_query, $wp_rewrite;

	$pages ='';
	$max = $wp_query->max_num_pages;
	if (! $current = get_query_var('paged')) $current = 1;
	$A['base'] = str_replace (999999999, '% #%', get_pagenum_link(999999999));
	$A['total'] = $max;
	$A['current'] = $current;

	$total = 1; // 1 - show the text "Page N of N", 0 - do not display
	$A['mid_size'] = 3; // show how many links on the left and right of the current
	$A['end_size'] = 1; // how many references show the beginning and end of the
	$A['prev_text'] = '«'; // link text" Previous Page "
	$A['next_text'] = '»'; // link text" Next Page "

//	if ($max> 1) echo '';
	if ($total == 1 && $max> 1) $pages = ' Página '. $current. ' of '. $max.'  '. " \r  \n ";
	echo '<div class="navigation">';
	echo $pages.'<br />'.paginate_links ($A);
	echo '</div>';
//	if ($max> 1) echo '';
}

/*********************************************************
				Titulo del tema
 ********************************************************/
/**
 * Provides a standard format for the page title depending on the view. This is
 * filtered so that plugins can provide alternative title formats.
 *
 * @param       string    $title    Default title text for current view.
 * @param       string    $sep      Optional separator.
 * @return      string              The filtered title.
 * @package     mayer
 * @subpackage  includes
 * @version     1.0.0
 * @since       1.0.0
 */
function mayer_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	} // end if

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} // end if

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) ) . " $sep $title";
	} // end if

	return $title;

} // end mayer_wp_title
add_filter( 'wp_title', 'mayer_wp_title', 10, 2 );