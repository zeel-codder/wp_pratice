<?php
/*
 * Plugin Name:       wp-query
 * Text Domain:       ml-plugin
 * Domain Path:       /languages
 */


function be_exclude_category_from_blog($query)
{

    // This is a hack to print code in formate manner in fortuned.
    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';

    // $sample_array = get_posts('books');
    // foreach ($sample_array as $post) {
    //     echo "<h3>" . $post->post_title . "</h3>";
    // }

    // die;
    // if ($query->is_main_query() && !is_admin() && is_post_type_archive('wdsx')) {
    //     $query->set('posts_per_page', '2');
    // }
}

add_action('pre_get_posts', 'be_exclude_category_from_blog');
