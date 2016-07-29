<?php
/**
 * Section for displaying posts as paragraphs
 */

global $post;

// Get current post's children
$child_posts = get_posts(
    array(
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
        'post_type' => $post->post_type,
        'post_parent' => $post->ID,
    )
);

?>

<aside class="small-24 medium-5 large-5 columns">
    <?php get_sidebar('posts-as-paragraphs'); ?>
</aside>

<div class="small-24 medium-19 large-19 columns">
    <?php foreach ( $child_posts as $child_post ) : ?>

        <?php

        $id = $child_post->ID;
        $slug = get_the_slug( $child_post->ID );
        $title = $child_post->post_title;
        $content = wpautop( $child_post->post_content );
        $read_more_label = get_theme_mod( ns_ . 'read_more_label', __( 'Read more on this topic'), ns_ );
        $read_more_link = has_children( $child_post->ID ) ? '<div class="posts-as-paragraphs-read-more-link"><a href="' . $slug . '">' . $read_more_label . '</a></div>' : '';

        ?>

        <a id="<?php echo $slug; ?>" name="<?php echo $slug; ?>"></a>

        <article>
            <h2><?php echo $title; ?></h2>
            <?php echo apply_filters( 'the_content', $content ); ?>
            <?php echo $read_more_link; ?>
        </article>

    <?php endforeach; ?>
</div>
