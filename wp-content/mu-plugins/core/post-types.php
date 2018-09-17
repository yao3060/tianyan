<?php
/**
 * Created by PhpStorm.
 * User: YAO
 * Date: 2018/8/19
 * Time: 19:07
 */


add_action( 'init', 'mu_plugin_fund_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function mu_plugin_fund_init() {
    $labels = array(
        'name'               => _x( 'Funds', 'post type general name', 'tianyan' ),
        'singular_name'      => _x( 'Fund', 'post type singular name', 'tianyan' ),
        'menu_name'          => _x( 'Funds', 'admin menu', 'tianyan' ),
        'name_admin_bar'     => _x( 'Fund', 'add new on admin bar', 'tianyan' ),
        'add_new'            => _x( 'Add New', 'fund', 'tianyan' ),
        'add_new_item'       => __( 'Add New Fund', 'tianyan' ),
        'new_item'           => __( 'New Fund', 'tianyan' ),
        'edit_item'          => __( 'Edit Fund', 'tianyan' ),
        'view_item'          => __( 'View Fund', 'tianyan' ),
        'all_items'          => __( 'All Funds', 'tianyan' ),
        'search_items'       => __( 'Search Funds', 'tianyan' ),
        'not_found'          => __( 'No funds found.', 'tianyan' ),
        'not_found_in_trash' => __( 'No funds found in Trash.', 'tianyan' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'     => 3,
        'menu_icon'          => 'dashicons-chart-line',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'fund' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'excerpt'  )
    );

    register_post_type( 'fund', $args );
}