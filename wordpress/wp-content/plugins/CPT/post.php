<?php

/**
 * Registers the `books` post type.
 */

function CPT_books_init()
{
    register_post_type(
/* 
 * Must not exceed 20 characters and may
 * Only contain lowercase alphanumeric characters, dashes, and underscores.
 * Got to labels when you want to edit the name display on admin page. it can be sidebar name or table view item. you can also edit 
 * the editor item name.
 * Thumbnail will map to fechner image
 * */
        'books',
        [
            'labels'                => [
                'name'                  => __('Books', 'CPT-TEXTDOMAIN'),
                'singular_name'         => __('Book', 'CPT-TEXTDOMAIN'),
                'all_items'             => __('All Books', 'CPT-TEXTDOMAIN'),
                'archives'              => __('Book Archives', 'CPT-TEXTDOMAIN'),
                'attributes'            => __('Book Attributes', 'CPT-TEXTDOMAIN'),
                'insert_into_item'      => __('Insert into Book', 'CPT-TEXTDOMAIN'),
                'uploaded_to_this_item' => __('Uploaded to this Book', 'CPT-TEXTDOMAIN'),
                'featured_image'        => _x('Featured Image', 'books', 'CPT-TEXTDOMAIN'),
                'set_featured_image'    => _x('Set featured image', 'books', 'CPT-TEXTDOMAIN'),
                'remove_featured_image' => _x('Remove featured image', 'books', 'CPT-TEXTDOMAIN'),
                'use_featured_image'    => _x('Use as featured image', 'books', 'CPT-TEXTDOMAIN'),
                'filter_items_list'     => __('Filter Books list', 'CPT-TEXTDOMAIN'),
                'items_list_navigation' => __('Books list navigation', 'CPT-TEXTDOMAIN'),
                'items_list'            => __('Books list', 'CPT-TEXTDOMAIN'),
                'new_item'              => __('New Book', 'CPT-TEXTDOMAIN'),
                'add_new'               => __('Add Book', 'CPT-TEXTDOMAIN'),
                'add_new_item'          => __('Add New Book', 'CPT-TEXTDOMAIN'),
                'edit_item'             => __('Edit Book', 'CPT-TEXTDOMAIN'),
                'view_item'             => __('View Book', 'CPT-TEXTDOMAIN'),
                'view_items'            => __('View Books', 'CPT-TEXTDOMAIN'),
                'search_items'          => __('Find Books', 'CPT-TEXTDOMAIN'),
                'not_found'             => __('No Books found', 'CPT-TEXTDOMAIN'),
                'not_found_in_trash'    => __('No Books found in trash', 'CPT-TEXTDOMAIN'),
                'parent_item_colon'     => __('Parent Book:', 'CPT-TEXTDOMAIN'),
                'menu_name'             => __('Books', 'CPT-TEXTDOMAIN'),
            ],
            'public'                => false,
            'description'           => 'This is demo book which i want to use.',
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => false,
            'supports'              => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
            'taxonomies'            => ['type'],
            'has_archive'           => true,
            'rewrite'               => true,
            'query_var'             => true,
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-admin-post',
            'show_in_rest'          => true,
            'rest_base'             => 'books',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ]
    );
}

add_action('init', 'CPT_books_init');

/**
 * Sets the post updated messages for the `books` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `books` post type.
 */
function books_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['books'] = [
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Book updated. <a target="_blank" href="%s">View Book</a>', 'CPT-TEXTDOMAIN'), esc_url($permalink)),
        2  => __('Custom field updated.', 'CPT-TEXTDOMAIN'),
        3  => __('Custom field deleted.', 'CPT-TEXTDOMAIN'),
        4  => __('Book updated.', 'CPT-TEXTDOMAIN'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Book restored to revision from %s', 'CPT-TEXTDOMAIN'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        /* translators: %s: post permalink */
        6  => sprintf(__('Book published. <a href="%s">View Book</a>', 'CPT-TEXTDOMAIN'), esc_url($permalink)),
        7  => __('Book saved.', 'CPT-TEXTDOMAIN'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Book submitted. <a target="_blank" href="%s">Preview Book</a>', 'CPT-TEXTDOMAIN'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(__('Book scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Book</a>', 'CPT-TEXTDOMAIN'), date_i18n(__('M j, Y @ G:i', 'CPT-TEXTDOMAIN'), strtotime($post->post_date)), esc_url($permalink)),
        /* translators: %s: post permalink */
        10 => sprintf(__('Book draft updated. <a target="_blank" href="%s">Preview Book</a>', 'CPT-TEXTDOMAIN'), esc_url(add_query_arg('preview', 'true', $permalink))),
    ];

    return $messages;
}

add_filter('post_updated_messages', 'books_updated_messages');

/**
 * Sets the bulk post updated messages for the `books` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `books` post type.
 */
function books_bulk_updated_messages($bulk_messages, $bulk_counts)
{
    global $post;

    $bulk_messages['books'] = [
        /* translators: %s: Number of Books. */
        'updated'   => _n('%s Book updated.', '%s Books updated.', $bulk_counts['updated'], 'CPT-TEXTDOMAIN'),
        'locked'    => (1 === $bulk_counts['locked']) ? __('1 Book not updated, somebody is editing it.', 'CPT-TEXTDOMAIN') :
            /* translators: %s: Number of Books. */
            _n('%s Book not updated, somebody is editing it.', '%s Books not updated, somebody is editing them.', $bulk_counts['locked'], 'CPT-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'deleted'   => _n('%s Book permanently deleted.', '%s Books permanently deleted.', $bulk_counts['deleted'], 'CPT-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'trashed'   => _n('%s Book moved to the Trash.', '%s Books moved to the Trash.', $bulk_counts['trashed'], 'CPT-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'untrashed' => _n('%s Book restored from the Trash.', '%s Books restored from the Trash.', $bulk_counts['untrashed'], 'CPT-TEXTDOMAIN'),
    ];

    return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'books_bulk_updated_messages', 10, 2);
