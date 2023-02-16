<?php
/*
 * Plugin Name:       CPT
 * Text Domain:       CPT-TEXTDOMAIN
 * Domain Path:       /languages
 */
require_once __DIR__ . '/taxonomies.php';
require_once __DIR__.'/post.php';



/**
 * This are some the key note
 * 1. You can attach the taxonomy to given post type by register function secound parameter.
 * 2. this one the most handy thing of wordpress you can create any type of thing know in wordpress with custom post type.
 *    like create movies collection, book collections , game collection. gg power of wordpress :).
 * 3. Wordpress inline comments are more then sufficient.
 * 4. Make sure you register taxonomy first before using in CPT;
 *    In this config:
 *    'taxonomies'            => ['cpt_type','post_tag']
 *    In this if you want add taxonomy after CPT create then you can pass CPT as secound parameter 
 *    of register_taxonomy function.
 *    register_taxonomy('cpt_type', ['post'], ...)
 */
