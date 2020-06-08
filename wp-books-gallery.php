<?php

/**
 * Plugin Name:	WP Books Gallery
 * Plugin URI:	http://wordpress.org/plugins/wp-books-gallery/
 * Description:	A simple plugin to display books in your Post/Page area. Use shortcode: [wp_books_gallery]
 * Version:		1.6
 * Author:		Hossni Mubarak
 * Author URI:	http://www.hossnimubarak.com
 * License:		GPL-2.0+
 * License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) exit;

define('WBG_PATH', plugin_dir_path(__FILE__));
define('WBG_ASSETS', plugins_url('/assets/', __FILE__));
define('WBG_SLUG', plugin_basename(__FILE__));
define('WBG_PRFX', 'wbg_');
define('WBG_CLS_PRFX', 'cls-books-gallery-');
define('WBG_TXT_DOMAIN', 'wp-books-gallery');
define('WBG_VERSION', '1.6');

require_once WBG_PATH . 'inc/' . WBG_CLS_PRFX . 'master.php';
$wbg = new WBG_Master();
$wbg->wbg_run();

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


// include your custom post type on category pages
function wbg_custom_post_type_cat_filter( $query ) {
    if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array( 'post', 'books' ) );
        return $query;
    }
}
add_action('pre_get_posts', 'wbg_custom_post_type_cat_filter');   

register_deactivation_hook(__FILE__, array($wbg, WBG_PRFX . 'unregister_settings'));