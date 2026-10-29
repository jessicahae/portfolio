<?php
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_gallery_scripts' );
function portfolio_enqueue_gallery_scripts() {
    if ( is_singular( 'project' ) ) { 
        wp_enqueue_style( 'justified-gallery-css', 'https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.8.1/css/justifiedGallery.min.css' );
        wp_enqueue_script( 'justified-gallery-js', 'https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.8.1/js/jquery.justifiedGallery.min.js', array('jquery'), '3.8.1', true );
        wp_enqueue_script( 'project-gallery-init', get_template_directory_uri() . '/frontend/scripts/project-gallery.js', array('justified-gallery-js', 'jquery'), '1.0', true );
    }
}