<?php

/**
 * Posts as paragraphs sidebar
 */

global $post;

if ( has_children( $post->ID ) ) {
    $post_parent = $post->ID;
    // The post has children. Child posts are displayed as paragraphs and we need to use anchor points to link to them
    $mode = 'paragraph';
} else {
    $post_parent = $post->post_parent;
    // The post has no children. Link to the actual posts
    $mode = 'post';
}

// Get current posts's children
$menu_items = get_posts(
    array(
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_type' => $post->post_type,
        'post_parent' => $post_parent,
    )
);

?>

<div class="hide-for-medium dropdown-menu-posts-as-paragraphs dropdown-menu-posts-as-paragraphs--inverted">
    <a class="trigger collapsed">Please select a section</a>
    <nav>
        <ul class="menu-items">
            <?php foreach ( $menu_items as $item ) : ?>

                <?php $url = $mode == 'paragraph' ? '#' . get_the_slug( $item->ID ) : get_permalink( $item->post_parent ) . '#' . get_the_slug( $item->ID); ?>

                <li>
                    <?php if ( has_children( $item->ID )  ) : ?>
                        <a href="<?php echo get_permalink( $item->ID ); ?>"><?php echo $item->post_title; ?> <i class="fa fa-link" aria-hidden="true"></i></a>
                    <?php else : ?>
                        <a id="post-<?php echo get_the_slug( $item->ID ); ?>" href="<?php echo $url; ?>"><?php echo $item->post_title; ?></a>
                    <?php endif; ?>
                </li>
                
            <?php endforeach; ?>
        </ul>
    </nav>
</div>

<nav class="menu-posts-as-paragraphs">
    <ul class="show-for-medium regular-menu">
        <?php foreach ( $menu_items as $item ) : ?>

            <?php $url = $mode == 'paragraph' ? '#' . get_the_slug( $item->ID ) : get_permalink( $item->post_parent ) . '#' . get_the_slug( $item->ID); ?>

            <li>
                <?php if ( has_children( $item->ID )  ) : ?>
                    <a href="<?php echo get_permalink( $item->ID ); ?>"><?php echo $item->post_title; ?> <i class="fa fa-link" aria-hidden="true"></i></a>
                <?php else : ?>
                    <a id="post-<?php echo get_the_slug( $item->ID ); ?>" href="<?php echo $url; ?>"><?php echo $item->post_title; ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>