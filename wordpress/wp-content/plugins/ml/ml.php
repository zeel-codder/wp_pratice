<?php
/*
 * Plugin Name:       Ml
 * Plugin URI:        https://akismet.com/
 * Description:       This is basic plugin that give ml support for wordpress
 * Version:           1.10.3
 * Requires at least: 5.2 // wordpress version
 * Requires PHP:      7.2
 * Author:            Zeel Prajapati
 * Author URI:        https://akismet.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ml-plugin
 * Domain Path:       /languages
 */


/**
 * Activate the plugin.
 */
function plug_activate() {
	$name = __( 'Ml is activated', 'ml-plugin' );
	printf( __( '<script>alert(\'%s\')</script>', 'ml-plugin' ), $name );
}

/**
 * Deactivate the plugin.
 */
function plug_deactivate() {
	write( " \n" );
}

_e( __FILE__ );
register_activation_hook( __FILE__, 'plug_activate' );
register_deactivation_hook( __FILE__, 'plug_deactivate' );



// check if function is exits or not.
if ( ! function_exists( 'output' ) ) {
	function output() {
		_e( 'Hi I am output function' );
	}
}
output();
// same as above function we have class_exists() and isset() functions.



// Hooks


/**
 * The  function will call after every save post action. 
 */
function enterLog( $post_id, $post ) {
	$text = 'The post is created ' . $post_id . "--" . date( "h:i:sa" ) . "\n";
	$file = plugin_dir_path( __FILE__ ) . '/errors.txt';
	$open = fopen( $file, "a" );
	fputs( $open, $text );
	fclose( $open );
}

add_action( 'save_post', 'enterLog', 10, 2 );

/**
 * The  function will call after every save post action. 
 */
function create_category( $term_id, $tt_id, $taxonomy ) {
	$term_name = get_term( $term_id )->name;
	write( 'The category named ' . $term_name . ' is created with : ' . $taxonomy . 'on ' . date( 'h:i:sa' ) . "\n" );
}

/*Make sure your function should take max only the arguments as last parameter value of 
add_action otherwise it will give error.*/
add_action( 'create_term', 'create_category', 10, 3 );

// priority is litle bit diff form other. the lower the priority, it will execute first. (default is 10)
// exmple
add_action( 'create_term', 'create_category1', 1, 3 );
add_action( 'create_term', 'create_category2', 2, 2 );
add_action( 'create_term', 'create_category3', 30 );
add_action( 'create_term', 'create_category4', 43 );
add_action( 'create_term', 'create_category5', 10 );

/**
 * The output
 * create_category1->create_category2->create_category5->create_category3->create_category4
 */

function write( $text ) {
	$file = plugin_dir_path( __FILE__ ) . '/errors.txt';
	$open = fopen( $file, "a" );
	fputs( $open, $text );
	fclose( $open );
}


function create_category1( $term_id, $tt_id, $taxonomy ) {
	write( "The category 1 \n" );
}
function create_category2( $zeel, $ZE ) {
	write( "The category 2 \n" . $zeel );
}

function create_category3() {
	write( "The category 3 \n" );
}

function create_category4() {
	write( "The category 4 \n" );
}

function create_category5() {
	write( "The category 5 \n" );
}
