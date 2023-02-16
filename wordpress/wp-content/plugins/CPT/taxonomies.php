<?php

/**
 * Registers the `type` taxonomy,
 * for use with 'book'
 * make sure secound argument is the number of post type you want to add this taxonomy
 */
function CPT_type_init()
{
    register_taxonomy('type', ['post'], [
        'hierarchical'          => true,
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
            'name'                       => __('Types', 'CPT-TEXTDOMAIN'),
            'singular_name'              => _x('Type', 'taxonomy general name', 'CPT-TEXTDOMAIN'),
            'search_items'               => __('Search Types', 'CPT-TEXTDOMAIN'),
            'popular_items'              => __('Popular Types', 'CPT-TEXTDOMAIN'),
            'all_items'                  => __('All Types', 'CPT-TEXTDOMAIN'),
            'parent_item'                => __('Parent Type', 'CPT-TEXTDOMAIN'),
            'parent_item_colon'          => __('Parent Type:', 'CPT-TEXTDOMAIN'),
            'edit_item'                  => __('Edit Type', 'CPT-TEXTDOMAIN'),
            'update_item'                => __('Update Type', 'CPT-TEXTDOMAIN'),
            'view_item'                  => __('View Type', 'CPT-TEXTDOMAIN'),
            'add_new_item'               => __('Add New Type', 'CPT-TEXTDOMAIN'),
            'new_item_name'              => __('New Type', 'CPT-TEXTDOMAIN'),
            'separate_items_with_commas' => __('Separate types with commas', 'CPT-TEXTDOMAIN'),
            'add_or_remove_items'        => __('Add or remove types', 'CPT-TEXTDOMAIN'),
            'choose_from_most_used'      => __('Choose from the most used types', 'CPT-TEXTDOMAIN'),
            'not_found'                  => __('No types found.', 'CPT-TEXTDOMAIN'),
            'no_terms'                   => __('No types', 'CPT-TEXTDOMAIN'),
            'menu_name'                  => __('Types', 'CPT-TEXTDOMAIN'),
            'items_list_navigation'      => __('Types list navigation', 'CPT-TEXTDOMAIN'),
            'items_list'                 => __('Types list', 'CPT-TEXTDOMAIN'),
            'most_used'                  => _x('Most Used', 'type', 'CPT-TEXTDOMAIN'),
            'back_to_items'              => __('&larr; Back to Types', 'CPT-TEXTDOMAIN'),
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
        1 => __('Type added.', 'CPT-TEXTDOMAIN'),
        2 => __('Type deleted.', 'CPT-TEXTDOMAIN'),
        3 => __('Type updated.', 'CPT-TEXTDOMAIN'),
        4 => __('Type not added.', 'CPT-TEXTDOMAIN'),
        5 => __('Type not updated.', 'CPT-TEXTDOMAIN'),
        6 => __('Types deleted.', 'CPT-TEXTDOMAIN'),
    ];

    return $messages;
}

add_filter('term_updated_messages', 'type_updated_messages');
