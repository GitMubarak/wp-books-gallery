<?php

/**
 * Plugin Name:	WP Books Gallery
 * Plugin URI:	https://wordpress.org/plugins/wp-books-gallery/
 * Description:	A simple plugin to display Books Gallery in your Page, using Shortcode: [wp_books_gallery]
 * Version:		2.2
 * Author:		HM Plugin
 * Author URI:	https://hmplugin.com
 * License:		GPL-2.0+
 * License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined('ABSPATH') ) exit;

define( 'WBG_PATH', plugin_dir_path( __FILE__ ) );
define( 'WBG_ASSETS', plugins_url('/assets/', __FILE__) );
define( 'WBG_SLUG', plugin_basename( __FILE__ ) );
define( 'WBG_PRFX', 'wbg_' );
define( 'WBG_CLS_PRFX', 'cls-books-gallery-' );
define( 'WBG_TXT_DOMAIN', 'wp-books-gallery' );
define( 'WBG_VERSION', '2.2' );

require_once WBG_PATH . 'inc/' . WBG_CLS_PRFX . 'master.php';
$wbg = new WBG_Master();
$wbg->wbg_run();

// Extra link to plugin description
add_filter( 'plugin_row_meta', 'wbg_plugin_row_meta', 10, 2 );
function wbg_plugin_row_meta( $links, $file ) {

    if ( WBG_SLUG === $file ) {
        $row_meta = array(
          'wbg_donation'    => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Plugin Additional Links', 'wp-books-gallery' ) . '" style="color:green; font-weight: bold;">' . esc_html__( 'Donate us', 'wp-books-gallery' ) . '</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

// rewrite_rules upon plugin activation
register_activation_hook( __FILE__, 'wbg_myplugin_activate' );
function wbg_myplugin_activate() {
    if ( ! get_option( 'wbg_flush_rewrite_rules_flag' ) ) {
        add_option( 'wbg_flush_rewrite_rules_flag', true );
    }
}

add_action( 'init', 'wbg_flush_rewrite_rules_maybe', 10 );
function wbg_flush_rewrite_rules_maybe() {
    if( get_option( 'wbg_flush_rewrite_rules_flag' ) ) {
        flush_rewrite_rules();
        delete_option( 'wbg_flush_rewrite_rules_flag' );
    }
}


// include your custom post type on category and tags pages
function wbg_custom_post_type_cat_filter( $query ) {
    
    global $pagenow;
    $type = 'post';
    if ( isset( $_GET['post_type'] ) ) {
        $type = $_GET['post_type'];
    }
    if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array( 'post', 'books' ) );
    }
    if ( $query->is_tag() && $query->is_main_query() ) {
       
        $query->set( 'post_type', array( 'post', 'books' ) );
    }
    if ( is_admin() && 'books' == $type && $query->is_main_query() && $pagenow == 'edit.php' ) {
        $query->set( 'post_type', 'books' );
    }
    if ( is_admin() && 'post' == $type && $query->is_main_query() && $pagenow == 'edit.php' ) {
        $query->set( 'post_type', 'post' );
    }

    return $query;
}
add_action('pre_get_posts', 'wbg_custom_post_type_cat_filter');


// Custom Query Vars for search page
function themeslug_query_vars( $qvars ) {
    $qvars[] = 'wbg_title_s';
    $qvars[] = 'wbg_category_s';
    $qvars[] = 'wbg_author_s';
    $qvars[] = 'wbg_publisher_s';
    $qvars[] = 'wbg_published_on_s';
    $qvars[] = 'wbg_isbn_s';
    $qvars[] = 'wbg_language_s';
    $qvars[] = 'book-id';
    return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );

//register_deactivation_hook(__FILE__, array($wbg, WBG_PRFX . 'unregister_settings'));