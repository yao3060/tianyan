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

    wp_enqueue_script( 'js-cookie', WPMU_PLUGIN_URL . '/core/js/js.cookie.min.js', array(), '3.4.4' );

}, 0 );


require_once ( dirname( __FILE__ ) . '/core/post-types.php');
require_once ( dirname( __FILE__ ) . '/core/confirm-box.php');