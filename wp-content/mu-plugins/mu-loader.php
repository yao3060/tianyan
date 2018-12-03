<?php
/**
 * Created by PhpStorm.
 * User: YAO
 * Date: 2018/8/19
 * Time: 19:06
 */

/*
Plugin Name: MU Plugin
Description: This is must use plugin.
Author: YYY
Version: 1.0
Text Domain: mu-plugin
Author URI: http://yaoyingying.com
 */


add_action( 'wp_enqueue_scripts', function (){

    wp_enqueue_script( 'html5shiv', WPMU_PLUGIN_URL . '/core/js/html5shiv.min.js', array(), '3.7.3' );
    wp_enqueue_script( 'respond', WPMU_PLUGIN_URL . '/core/js/respond.min.js', array(), '1.4.2' );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'js-cookie', WPMU_PLUGIN_URL . '/core/js/js.cookie.min.js', array(), '3.4.4' );

    ////at.alicdn.com/t/font_895797_870t37hr5cc.js
    wp_enqueue_style( 'dashicons' );

}, 0 );

add_action( 'wp_enqueue_scripts', function (){

    wp_enqueue_style( 'bootstrap', WPMU_PLUGIN_URL . '/core/css/bootstrap.min.css');
    wp_enqueue_script( 'bootstrap', WPMU_PLUGIN_URL . '/core/js/bootstrap.min.js', array('jquery'), '3.1.1' );

} );


require_once ( dirname( __FILE__ ) . '/core/clean.php');

require_once ( dirname( __FILE__ ) . '/core/post-types.php');
require_once ( dirname( __FILE__ ) . '/core/confirm-box.php');