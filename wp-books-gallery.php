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

function wbg_plugin_settings_flush_rewrite()
{
    if (get_option('plugin_settings_have_changed') == true) {
        flush_rewrite_rules();
        update_option('plugin_settings_have_changed', false);
    }
}
add_action('admin_init', 'wbg_plugin_settings_flush_rewrite');

register_deactivation_hook(__FILE__, array($wbg, WBG_PRFX . 'unregister_settings'));