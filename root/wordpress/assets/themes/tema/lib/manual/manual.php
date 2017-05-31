<?php
/*
  Plugin Name: Manual de uso
  Description: Manual de creación y mantención de contenidos.
  Author: Jairo Burbano  - Juan Pablo Pardo
  Version: 1.0
 */

function compilar_manual() {
    $screen = get_current_screen();
    if (strpos($screen->id, "opciones-del-manual") == true) {
        $results = get_field('field_592de992ce38e', 'options');
        $json = array();
        foreach ($results as $item) {
            $contenido = array();
            foreach ($item['contenido'] as $cont) {
                array_push($contenido, array(
                    'name' => $cont['titulo'],
                    'tab' => sanitize_title($cont['titulo']),
                    'url' => str_replace(array('https://youtu.be/', 'https://www.youtube.com/watch?v='), array('', ''), $cont['video']),
                    'img' => $cont['imagen'],
                    'content' => $cont['descripcion']
                ));
            }
            $data = array(
                'name' => $item['nombre'],
                'tab' => sanitize_title($item['nombre']),
                'content' => $item['descripcion'],
                'url' => str_replace(array('https://youtu.be/', 'https://www.youtube.com/watch?v='), array('', ''), $item['video']),
                'img' => $item['imagen'],
                'contenido' => $contenido
            );
            array_push($json, $data);
        }
        $jsonencoded = json_encode($json, JSON_UNESCAPED_UNICODE);
        file_put_contents(WP_CONTENT_DIR . '/uploads/manual/manual.json', $jsonencoded, NULL);
        file_put_contents(get_template_directory() . '/lib/manual/json/manual.json', $jsonencoded, NULL);
    }
}

function wp_template_manual() {

    add_acf_manual();
    add_menu_page('Manual de creación y mantención de contenidos', 'Manual', 'edit_posts', 'manual', 'wp_template_manual_view', 'dashicons-welcome-learn-more');
    if (is_super_admin(get_current_user_id())) {
        acf_add_options_page(array(
            'page_title' => 'Opciones del Manual',
            'menu_title' => 'Opciones del Manual',
            'menu_slug' => 'opciones-del-manual',
            'icon_url' => 'dashicons-admin-generic',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }
    // Archivo para respaldar el manual
    if (!file_exists(get_template_directory() . '/lib/manual/json/manual.json')) {

        if (!mkdir(get_template_directory() . '/lib/manual/json/', 0755, true)) {
            die('Fallo al crear la carpeta del diccionario de respaldo.');
        } else {
            file_put_contents(get_template_directory() . '/lib/manual/json/manual.json', '', NULL);
        }
    }

    // Archivo para el manual
    if (!file_exists(WP_CONTENT_DIR . '/uploads/manual/manual.json')) {
        if (!mkdir(WP_CONTENT_DIR . '/uploads/manual/', 0755, true)) {
            die('Fallo al crear la carpeta del diccionario.');
        } else {
            file_put_contents(WP_CONTENT_DIR . '/uploads/manual/manual.json', '', NULL);
        }
    }
}

if (function_exists('acf_add_options_page')) {
    add_action('admin_menu', 'wp_template_manual');
    add_action('acf/save_post', 'compilar_manual', 20);
}

function add_acf_manual() {

    if (function_exists('acf_add_local_field_group')):

        acf_add_local_field_group(array(
            'key' => 'group_592de94d1ce83',
            'title' => 'Manual',
            'fields' => array(
                array(
                    'key' => 'field_592de992ce38e',
                    'label' => 'Páginas',
                    'name' => 'paginas',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'row',
                    'button_label' => 'Agregar una página',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_592deb210ffb6',
                            'label' => 'Nombre',
                            'name' => 'nombre',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_592de9b9ce38f',
                            'label' => 'Descripción',
                            'name' => 'descripcion',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'maxlength' => '',
                            'rows' => 3,
                            'new_lines' => '',
                        ),
                        array(
                            'key' => 'field_592de9ccce390',
                            'label' => 'Video',
                            'name' => 'video',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array(
                            'key' => 'field_592ef6647b3f5',
                            'label' => 'Imagen',
                            'name' => 'imagen',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'url',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                        ),
                        array(
                            'key' => 'field_592de9dece391',
                            'label' => 'Contenido',
                            'name' => 'contenido',
                            'type' => 'repeater',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'collapsed' => '',
                            'min' => 0,
                            'max' => 0,
                            'layout' => 'row',
                            'button_label' => 'Agregar más contenidos',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_592dea32ce392',
                                    'label' => 'Título',
                                    'name' => 'titulo',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_592dea3fce393',
                                    'label' => 'Video',
                                    'name' => 'video',
                                    'type' => 'url',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                ),
                                array(
                                    'key' => 'field_592ef5c1c9f91',
                                    'label' => 'Imagen',
                                    'name' => 'imagen',
                                    'type' => 'image',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'return_format' => 'url',
                                    'preview_size' => 'thumbnail',
                                    'library' => 'all',
                                    'min_width' => '',
                                    'min_height' => '',
                                    'min_size' => '',
                                    'max_width' => '',
                                    'max_height' => '',
                                    'max_size' => '',
                                    'mime_types' => '',
                                ),
                                array(
                                    'key' => 'field_592dea4cce394',
                                    'label' => 'Descripción',
                                    'name' => 'descripcion',
                                    'type' => 'textarea',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'maxlength' => '',
                                    'rows' => 3,
                                    'new_lines' => '',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'opciones-del-manual',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => 1,
            'description' => '',
        ));

    endif;
}

function wp_template_manual_view() {
    ?>
    <iframe class="manual" style="padding:20px 20px 0 0; box-sizing:border-box;" src="<?php echo get_template_directory_uri(); ?>/lib/manual/index.html" width="100%"></iframe>
    <script>jQuery('.manual').height(jQuery(window).height() - 120);</script>
    <?php
}
?>
