<?php
/*
Plugin Name: Zeel
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
author: Matt Mullenweg
Version: 1.7.2
Author URI: http://ma.tt/
Text Domain: my-plugin
*/


// will only return the translation string.
$info = __('This is demo', 'my-plugin');
echo $info;

// will print the translation string.
_e('This is demo', 'my-plugin');


// always use esc_html_ when outputting the string.
esc_html_e('<script>alert("demo");</script>', 'my-plugin');


// User variables this way.
$city = 'kalol';
printf(__('Your city is %s.', 'my-plugin'), $city);

// This is incorrect do not use.
_e("Your city is $city.", 'my-plugin');


/**If you have string that changes when the number of items changes, 
 * you’ll need a way to reflect this in your translations. 
 * For example, in English you have "One comment" and "Two comments". */

function get_count(){
    return 121;
}

printf(
    _n(
        // if count is one
        '%s comment',
        // more the one count
        '%s comments',
        // this is the count value
        get_count(),
        'my-plugin'
    ),
    // make sure hear you pass the same count value
    number_format_i18n(get_count())
);


// the better way to do same thing.

$comments_plural = _n_noop(
    '%s comment.',
    '%s comments.'
);

printf(
    translate_nooped_plural(
        $comments_plural,
        get_count(),
        'my-plugin'
    ),
    number_format_i18n(get_count())
);
