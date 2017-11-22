<?php

/**
 * Galerías 
 * */
add_filter('post_gallery', 'reactor_post_gallery', 10, 3);

function to_timber_image($image_id) {
    return new TimberImage($image_id);
}

function reactor_post_gallery($output = '', $attrs, $instance) {
    $return = $output; // fallback
    try {
        $context = array();
        $images_ids = explode(',', $attrs['ids']);
        $images = array_map('to_timber_image', $images_ids);
        $context['images'] = $images;
        $return = Timber::compile('item/gallery.twig', $context);
    } catch (Exception $e) {
        // do nothing
        return '';
    }

    return $return;
}
