<?php

function my_theme_enqueue_styles() {
	wp_enqueue_style('parent', get_template_directory_uri() . '/style.css');
}

function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}

add_filter('mime_types', 'webp_upload_mimes');
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');