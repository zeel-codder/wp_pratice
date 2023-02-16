<?php

/**
 * Registers the `books` post type.
 */
function CPT_books_init()
{
    register_post_type(
        'books',
        [
            'labels'                => [
                'name'                  => __('Books', 'YOUR-TEXTDOMAIN'),
                'singular_name'         => __('Book', 'YOUR-TEXTDOMAIN'),
                'all_items'             => __('All Books', 'YOUR-TEXTDOMAIN'),
                'archives'              => __('Book Archives', 'YOUR-TEXTDOMAIN'),
                'attributes'            => __('Book Attributes', 'YOUR-TEXTDOMAIN'),
                'insert_into_item'      => __('Insert into Book', 'YOUR-TEXTDOMAIN'),
                'uploaded_to_this_item' => __('Uploaded to this Book', 'YOUR-TEXTDOMAIN'),
                'featured_image'        => _x('Featured Image', 'books', 'YOUR-TEXTDOMAIN'),
                'set_featured_image'    => _x('Set featured image', 'books', 'YOUR-TEXTDOMAIN'),
                'remove_featured_image' => _x('Remove featured image', 'books', 'YOUR-TEXTDOMAIN'),
                'use_featured_image'    => _x('Use as featured image', 'books', 'YOUR-TEXTDOMAIN'),
                'filter_items_list'     => __('Filter Books list', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation' => __('Books list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'            => __('Books list', 'YOUR-TEXTDOMAIN'),
                'new_item'              => __('New Book', 'YOUR-TEXTDOMAIN'),
                'add_new'               => __('Add New', 'YOUR-TEXTDOMAIN'),
                'add_new_item'          => __('Add New Book', 'YOUR-TEXTDOMAIN'),
                'edit_item'             => __('Edit Book', 'YOUR-TEXTDOMAIN'),
                'view_item'             => __('View Book', 'YOUR-TEXTDOMAIN'),
                'view_items'            => __('View Books', 'YOUR-TEXTDOMAIN'),
                'search_items'          => __('Search Books', 'YOUR-TEXTDOMAIN'),
                'not_found'             => __('No Books found', 'YOUR-TEXTDOMAIN'),
                'not_found_in_trash'    => __('No Books found in trash', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'     => __('Parent Book:', 'YOUR-TEXTDOMAIN'),
                'menu_name'             => __('Books', 'YOUR-TEXTDOMAIN'),
            ],
            'public'                => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'supports'              => ['title', 'editor'],
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
        1  => sprintf(__('Book updated. <a target="_blank" href="%s">View Book</a>', 'YOUR-TEXTDOMAIN'), esc_url($permalink)),
        2  => __('Custom field updated.', 'YOUR-TEXTDOMAIN'),
        3  => __('Custom field deleted.', 'YOUR-TEXTDOMAIN'),
        4  => __('Book updated.', 'YOUR-TEXTDOMAIN'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Book restored to revision from %s', 'YOUR-TEXTDOMAIN'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        /* translators: %s: post permalink */
        6  => sprintf(__('Book published. <a href="%s">View Book</a>', 'YOUR-TEXTDOMAIN'), esc_url($permalink)),
        7  => __('Book saved.', 'YOUR-TEXTDOMAIN'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Book submitted. <a target="_blank" href="%s">Preview Book</a>', 'YOUR-TEXTDOMAIN'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(__('Book scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Book</a>', 'YOUR-TEXTDOMAIN'), date_i18n(__('M j, Y @ G:i', 'YOUR-TEXTDOMAIN'), strtotime($post->post_date)), esc_url($permalink)),
        /* translators: %s: post permalink */
        10 => sprintf(__('Book draft updated. <a target="_blank" href="%s">Preview Book</a>', 'YOUR-TEXTDOMAIN'), esc_url(add_query_arg('preview', 'true', $permalink))),
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
        'updated'   => _n('%s Book updated.', '%s Books updated.', $bulk_counts['updated'], 'YOUR-TEXTDOMAIN'),
        'locked'    => (1 === $bulk_counts['locked']) ? __('1 Book not updated, somebody is editing it.', 'YOUR-TEXTDOMAIN') :
            /* translators: %s: Number of Books. */
            _n('%s Book not updated, somebody is editing it.', '%s Books not updated, somebody is editing them.', $bulk_counts['locked'], 'YOUR-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'deleted'   => _n('%s Book permanently deleted.', '%s Books permanently deleted.', $bulk_counts['deleted'], 'YOUR-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'trashed'   => _n('%s Book moved to the Trash.', '%s Books moved to the Trash.', $bulk_counts['trashed'], 'YOUR-TEXTDOMAIN'),
        /* translators: %s: Number of Books. */
        'untrashed' => _n('%s Book restored from the Trash.', '%s Books restored from the Trash.', $bulk_counts['untrashed'], 'YOUR-TEXTDOMAIN'),
    ];

    return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'books_bulk_updated_messages', 10, 2);
