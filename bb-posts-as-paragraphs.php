<?php
/*
Plugin Name: BB Posts As Paragraphs
Description: Display child posts as paragraphs
Version: 0.0.1
Author: Brown Box
Author URI: http://brownbox.net.au
License: GPLv2
Copyright 2016 Brown Box
*/

define( 'BB_POSTS_AS_PARAGRAPHS_DIR', dirname(__FILE__) . '/' );
define( 'BB_POSTS_AS_PARAGRAPHS_JS_DIR', dirname(__FILE__) . '/js/' );
define( 'BB_POSTS_AS_PARAGRAPHS_CSS_DIR', dirname(__FILE__) . '/css/' );
define( 'BB_POSTS_AS_PARAGRAPHS_ADMIN_DIR', BB_POSTS_AS_PARAGRAPHS_DIR . 'admin/' );
define( 'BB_POSTS_AS_PARAGRAPHS_NS', 'bb_posts_as_paragraphs' );

require_once( BB_POSTS_AS_PARAGRAPHS_DIR . 'templater.php' );
require_once( BB_POSTS_AS_PARAGRAPHS_DIR . 'scripts.php' );
require_once( BB_POSTS_AS_PARAGRAPHS_ADMIN_DIR . 'settings.php' );

/**
 * Check if a posts has children
 *
 * @param int $post_id
 * @return bool
 */
function has_children( $post_id = null ) {

    if ( $post_id === null ) {
        global $post;
        $post_id = $post->ID;
    }

    $post = get_post( $post_id );

    $query = new WP_Query( array( 'post_parent' => $post_id, 'post_type' => $post->post_type ));

    return $query->have_posts();
}