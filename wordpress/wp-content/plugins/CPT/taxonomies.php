<?php

/**
 * Registers the `type` taxonomy,
 * for use with 'timepass', 'action', 'horror'.
 */
function CPT_type_init()
{
    register_taxonomy('type', ['timepass', 'action', 'horror'], [
        'hierarchical'          => false,
        'public'                => true,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_admin_column'     => false,
        'query_var'             => true,
        'rewrite'               => true,
        'capabilities'          => [
            'manage_terms' => 'edit_posts',
            'edit_terms'   => 'edit_posts',
            'delete_terms' => 'edit_posts',
            'assign_terms' => 'edit_posts',
        ],
        'labels'                => [
            'name'                       => __('Types', 'YOUR-TEXTDOMAIN'),
            'singular_name'              => _x('Type', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
            'search_items'               => __('Search Types', 'YOUR-TEXTDOMAIN'),
            'popular_items'              => __('Popular Types', 'YOUR-TEXTDOMAIN'),
            'all_items'                  => __('All Types', 'YOUR-TEXTDOMAIN'),
            'parent_item'                => __('Parent Type', 'YOUR-TEXTDOMAIN'),
            'parent_item_colon'          => __('Parent Type:', 'YOUR-TEXTDOMAIN'),
            'edit_item'                  => __('Edit Type', 'YOUR-TEXTDOMAIN'),
            'update_item'                => __('Update Type', 'YOUR-TEXTDOMAIN'),
            'view_item'                  => __('View Type', 'YOUR-TEXTDOMAIN'),
            'add_new_item'               => __('Add New Type', 'YOUR-TEXTDOMAIN'),
            'new_item_name'              => __('New Type', 'YOUR-TEXTDOMAIN'),
            'separate_items_with_commas' => __('Separate types with commas', 'YOUR-TEXTDOMAIN'),
            'add_or_remove_items'        => __('Add or remove types', 'YOUR-TEXTDOMAIN'),
            'choose_from_most_used'      => __('Choose from the most used types', 'YOUR-TEXTDOMAIN'),
            'not_found'                  => __('No types found.', 'YOUR-TEXTDOMAIN'),
            'no_terms'                   => __('No types', 'YOUR-TEXTDOMAIN'),
            'menu_name'                  => __('Types', 'YOUR-TEXTDOMAIN'),
            'items_list_navigation'      => __('Types list navigation', 'YOUR-TEXTDOMAIN'),
            'items_list'                 => __('Types list', 'YOUR-TEXTDOMAIN'),
            'most_used'                  => _x('Most Used', 'type', 'YOUR-TEXTDOMAIN'),
            'back_to_items'              => __('&larr; Back to Types', 'YOUR-TEXTDOMAIN'),
        ],
        'show_in_rest'          => true,
        'rest_base'             => 'type',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    ]);
}

add_action('init', 'CPT_type_init');

/**
 * Sets the post updated messages for the `type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `type` taxonomy.
 */
function type_updated_messages($messages)
{

    $messages['type'] = [
        0 => '', // Unused. Messages start at index 1.
        1 => __('Type added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Type deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Type updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Type not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Type not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Types deleted.', 'YOUR-TEXTDOMAIN'),
    ];

    return $messages;
}

add_filter('term_updated_messages', 'type_updated_messages');
