<?php
/*
 * Plugin Name:       Filters
*/

require_once __DIR__.'/me.php';

function add_class_to_body1($classes,$class)
{
    if (!is_admin()) {
        $classes = $classes;
    }
    return $classes;
}


function add_class_to_body2($classes,$class)
{
    if (!is_admin()) {
        $class[] = 'container_box_2';
    }
    return $class;
}

add_filter('body_class', 'add_class_to_body1',10,2);
add_filter('body_class', 'add_class_to_body2', 1, 2);


// create the own filter

function demo1($text){
    write($text.'1');
    return $text . '1';
}

function demo2($text)
{
    write($text . '2');
    return $text . '2';
}

function demo3($text)
{
    write($text . '3');
    return $text . '3';
}

/* 

When we call this function all the filters related to this name will be executed.
like same this do_actions works in actions.

*/

// This filters will not print anything because we are adding filters after this file.
apply_filters('filter_my_demo', 'Numbers:');

add_filter('filter_my_demo', 'demo1');
add_filter('filter_my_demo', 'demo2');
add_filter('filter_my_demo', 'demo3');

// We can see the logs for this function call
apply_filters('filter_my_demo', 'Numbers:');

/* The follow is same for actions also. */



function write($text)
{
    $file = plugin_dir_path(__FILE__) . '/errors.txt';
    $open = fopen($file, "a");
    fputs($open, $text."\n");
    fclose($open);
}

// $wp_hooktimer = Timer::getInstance();


// function all_actions(){
//     write("all call");
// }

// add_action('all','all_actions');

// add_action('shutdown', 'all_actions');
