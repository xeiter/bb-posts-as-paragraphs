<?php

// add_action('admin_enqueue_scripts', array('bb_page_as_paragraph_enqueue', 'admin_scripts'));
add_action('wp_enqueue_scripts', array('bb_page_as_paragraph_enqueue', 'frontend_scripts'));

class bb_page_as_paragraph_enqueue {

    /*public static function admin_scripts() {
        wp_enqueue_style(
            'admin',
            get_stylesheet_directory_uri() . '/css/admin.css',
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . '/css/admin.css' )
        );
    }*/

    /**
     * Enqueue frontend styles and JavaScript
     */
    public static function frontend_scripts() {

        // Plugin styles
        wp_enqueue_style(
            'bb-posts-as-paragraphs-main-css',
            plugin_dir_url(__FILE__) . 'css/bb-posts-as-paragraphs.css',
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . 'css/bb-posts-as-paragraphs.css' )
        );

        // Footer scripts
        wp_enqueue_script( 'bb-posts-as-paragraphs-main-js', plugin_dir_url(__FILE__) . 'js/bb-posts-as-paragraphs.js', array(), '1.0.0', true );

    }
}
