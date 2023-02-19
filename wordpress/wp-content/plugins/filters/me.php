<?php

class Timer {
	static private $time_obj = array();
	static private $time_diff = array();
	public static function getInstance() {
		add_action( 'all', 'Timer::time_start' );
		add_action( 'shutdown', 'Timer::write_file' );
	}

	public static function time_start() {
		$current = current_action();
		if ( array_key_exists( $current, Timer::$time_obj ) ) {
			return;
		}
		Timer::$time_obj[ $current ] = microtime( true );
		add_action( $current, 'Timer::time_end', 999999999, 1 );
	}

	public static function write_file() {
		$_str = '';
		foreach ( Timer::$time_diff as $current => $time_taken ) {
			$_str .= 'The filter name: ' . $current . ' Time taken by my_filter: ' . $time_taken . " seconds \n";
		}
		Timer::write( $_str );
	}

	public static function time_end() {
		$current                      = current_action();
		Timer::$time_diff[ $current ] = microtime( true ) - Timer::$time_obj[ $current ];
		remove_filter( $current, 'Timer::time_end', 999999999, 1 );
	}
	public static function write( $text ) {
		$file = plugin_dir_path( __FILE__ ) . '/errors.txt';
		$open = fopen( $file, "a" );
		fputs( $open, $text . "\n" );
		fclose( $open );
	}
}
