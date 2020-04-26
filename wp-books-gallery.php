<?php

/**
 * Plugin Name:	WP Books Gallery
 * Plugin URI:	http://wordpress.org/plugins/wp-books-gallery/
 * Description:	A simple plugin to display books in your Post/Page area. Use shortcode: [wp_books_gallery]
 * Version:		1.5
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
define('WBG_VERSION', '1.5');

require_once WBG_PATH . 'inc/' . WBG_CLS_PRFX . 'master.php';
$wbg = new WBG_Master();
$wbg->wbg_run();
register_deactivation_hook(__FILE__, array($wbg, WBG_PRFX . 'unregister_settings'));