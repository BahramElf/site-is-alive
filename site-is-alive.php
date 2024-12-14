<?php

/**
 * Plugin Name: Site is Alive
 * Plugin URI:  https://wpex.ir
 * Description: Display a message to reassure visitors that the site is active and up-to-date.
 * Version:     1.0.0
 * Author:      Bahram Chinsari
 * Author URI:  https://wpex.ir
 * Text Domain: site-is-alive
 * Domain Path: /languages
 */

defined('ABSPATH') || exit;
define('WPEX_SIA_VERSION', '1.0.0');
defined('WPEX_SIA_REQUIRED_WP_VERSION') || define('WPEX_SIA_REQUIRED_WP_VERSION', '5.4');
define('WPEX_SIA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPEX_SIA_PLUGIN_URL', plugin_dir_url(__FILE__));
defined('WPEX_SIA_TEXT_DOMAIN') || define('WPEX_SIA_TEXT_DOMAIN', 'site-is-alive');

require_once(WPEX_SIA_PLUGIN_DIR . 'includes/wpex-sia-admin-settings.php');
require_once(WPEX_SIA_PLUGIN_DIR . 'includes/wpex-sia-functions.php');

function wpex_sia_load_textdomain()
{
    load_plugin_textdomain(WPEX_SIA_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'wpex_sia_load_textdomain');

function wpex_sia_activate()
{
    do_action('wpex_sia_after_activate');
}
register_activation_hook(__FILE__, 'wpex_sia_activate');

function wpex_sia_deactivate()
{
    do_action('wpex_sia_after_deactivate');
}
register_deactivation_hook(__FILE__, 'wpex_sia_deactivate');
