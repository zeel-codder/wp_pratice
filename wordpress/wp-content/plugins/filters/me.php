<?php

class Timer
{
    static private $time_obj= array();
    public static function getInstance()
    {
        add_action('all', 'Timer::time_start');
    }

    public static function time_start()
    {
        $current = current_action();
        if (array_key_exists($current, Timer::$time_obj)){
        return;
        }
        Timer::$time_obj[$current] = microtime(true);
        add_action($current, 'Timer::time_end', 999999999,1);
    }

    public static function time_end()
    {
        $current = current_action();
        $time_taken = microtime(true) - Timer::$time_obj[$current];
        Timer::write('The filter name: '. $current.' Time taken by my_filter: ' . $time_taken . " seconds \n");
        remove_filter($current, 'Timer::time_end', 999999999, 1);
    }
    public static function write($text)
    {
        $file = plugin_dir_path(__FILE__) . '/errors.txt';
        $open = fopen($file, "a");
        fputs($open, $text . "\n");
        fclose($open);
    }
}

