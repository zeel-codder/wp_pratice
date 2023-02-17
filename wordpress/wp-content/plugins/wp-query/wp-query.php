<?php
/*
 * Plugin Name:       wp-query
 * Text Domain:       ml-plugin
 * Domain Path:       /languages
 */


function be_exclude_category_from_blog($query)
{

    // This is a hack to print code in formate manner in fortuned.
    echo '<pre>';
    print_r($query);
    echo '</pre>';

    $sample_array = get_posts('books');
    foreach ($sample_array as $post) {
        echo "<h3>" . $post->post_title . "</h3>";
    }

    die;
    if ($query->is_main_query() && !is_admin() && is_post_type_archive('wdsx')) {
        $query->set('posts_per_page', '2');
    }
}

// add_action('pre_get_posts', 'be_exclude_category_from_blog');


/**
 * Some observation of wp-query function.
 * 
 * 1. It User to get to posts data based on query
 * 2. At the end we use global $wp_query for making the query. make sure you reset it 
 *    if you update it.
 * 3. In query args you can pass the array for define the posts you want. 
 * 4. 
 * 
 */
function show_post()
{

    global $wp_query;

    if (is_admin()) {
        return;
    }

    get_posts();

    // The Query
    // $the_query = new WP_Query(array('category_name' => 'zeel'));

    // this is same ad 

    $the_query = new WP_Query;

    /* 
    This handy hear we are overriding the global query object. now let say you not reset
    it will fetch the post with category_name zeel only. make sure you use it when it need 
    only, 

    Node***: Make sure you reset the query object by wp_reset_postdata() so that it will 
    not break the default follow of wordpress. because some function may modify the default 
    wp_query function.
    */

    $wp_query = $the_query;
    $the_query->query(array('category_name' => 'zeel'));

    // The Loop
    if ($the_query->have_posts()) {
        echo '<ul>';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo '<li>' . get_the_title() . '</li>';
        }
        echo '</ul>';
    } else {
        // no posts found
    }

    /* Restore original Post Data */
    wp_reset_postdata();
}

// Before wp select the template to render
// add_action('template_redirect', 'show_post');

// Call after the page has loaded
// add_action('wp_footer', 'show_post');

// call after all obj are initialized 
// add_action('wp_loaded', 'show_post');



/** Query_post and get_posts */

function function_query_magic()
{
    /* 
    Same again this function is changing the global obj. make sure yoy double sure
    before using it. also do use `wp_reset_postdata` at the end
    */

    // This will modify the global wp_query
    $the_query = get_posts(array('category_name' => 'zeel'));

    // echo '<pre>';
    // print_r($the_query);
    // echo '</pre>';

    // this will create the nee wp object for make the query use this if just want to 
    //fetch the data
    // get_posts();
    // wp_reset_postdata();
}

// add_action('template_redirect', 'function_query_magic');
add_action('wp_footer', 'function_query_magic');


/**
 * WP_Query argument we can pass
 * 
 */

function function_find_magic($qry)
{
    if (is_admin()) {
        return;
    }

    // $qry = array(
    //     'author_name' => 'zeel',
    //     'suppress_filters' => true
    // );

    $qry->set('suppress_filters', false);

    // echo '<pre>';
    // print_r($qry);
    // echo '</pre>';

    // global $wp_query;

    // $wp_query->query = null;
}

/* 
Make sure not doing anything wih wp query in this action.
This is making the recursion.
*/
// add_action('pre_get_posts', 'function_find_magic');


add_filter('pre_get_posts', 'function_find_magic');



/**Change sql query */
function change_sql_query($arr)
{
    // echo '<pre>';
    // print_r($arr);
    // echo '</pre>';

    if (is_admin()) {
        return $arr;
    }

    $sql = "
            SELECT wp_posts.* FROM wp_posts 
            LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) 
            WHERE wp_posts.post_status = 'trash' GROUP BY wp_posts.ID  ORDER BY wp_posts.post_date DESC 
            LIMIT 0,5;
        ";
    return $sql;
}

/**
 * For this query the value of suppress_filters should be false 
 * then you can edit the sql query on this filter.
 * there where other filter to which we can use for modification of data.
 * */
add_filter('posts_request', 'change_sql_query');