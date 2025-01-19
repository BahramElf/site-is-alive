<?php

/**
 * Plugin Name: Site is Alive
 * Plugin URI:  https://wpex.ir/site-is-alive
 * Description: Display a message with the current date and time to reassure users that your site is active and up-to-date.
 * Version:     1.0.0
 * Author:      wpexir
 * Author URI:  https://wpex.ir
 * License: GPL v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: site-is-alive
 * Domain Path: /languages
 */

defined('ABSPATH') || exit;
define('WPEX_SIA_VERSION', '1.0.0');
defined('WPEX_SIA_REQUIRED_WP_VERSION') || define('WPEX_SIA_REQUIRED_WP_VERSION', '5.4');
define('WPEX_SIA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPEX_SIA_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once(WPEX_SIA_PLUGIN_DIR . 'includes/wpex-sia-admin-settings.php');
require_once(WPEX_SIA_PLUGIN_DIR . 'includes/wpex-sia-functions.php');

/**
 * Handles plugin activation tasks
 * 
 * @since 1.0.0
 * @return void
 */
function wpex_sia_activate()
{
    do_action('wpex_sia_after_activate');
}
register_activation_hook(__FILE__, 'wpex_sia_activate');

/**
 * Handles plugin deactivation tasks
 * 
 * @since 1.0.0
 * @return void
 */
function wpex_sia_deactivate()
{
    do_action('wpex_sia_after_deactivate');
}
register_deactivation_hook(__FILE__, 'wpex_sia_deactivate');
