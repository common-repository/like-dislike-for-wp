<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wplikedislike.pro
 * @since             1.0.0
 * @package           Likedislike_For_Wp
 *
 * @wordpress-plugin
 * Plugin Name:       Like Dislike For WP
 * Plugin URI:        https://wplikedislike.pro
 * Description:       Add like and dislike buttons to your WordPress posts/pages, allowing visitors to express their opinion with a simple click.
 * Version:           1.0.1
 * Author:            Ankit Panchal
 * Author URI:        https://wplikedislike.pro/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       like-dislike-for-wp-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LIKEDISLIKE_FOR_WP_VERSION', '1.0.1' );

define( 'LIKEDISLIKE_FOR_WP_LOGO', plugins_url( 'admin/img/logo-wp-like-dislike.svg', __FILE__ ) );
define( 'LIKEDISLIKE_FOR_WP_ICON', plugins_url( 'admin/img/icon-wp-like-dislike.png', __FILE__ ) );
define( 'LIKEDISLIKE_FOR_WP_PATH', plugin_dir_path( __FILE__ ) );
define( 'LIKEDISLIKE_FOR_WP_DASHBOARD', 'wp-like-dislike-settings' );

if (isset($_GET['page'])) {
    // Remove magic quotes and unnecessary slashes, then sanitize the text as a single operation.
    $page = sanitize_text_field(wp_unslash($_GET['page']));

    // Check if the sanitized value is not empty to proceed with defining the constant.
    if (!empty($page)) {
        define('LIKEDISLIKE_FOR_WP_CURRENT_PAGE', $page);
    } else {
        define('LIKEDISLIKE_FOR_WP_CURRENT_PAGE', '/');
    }
} else {
    define('LIKEDISLIKE_FOR_WP_CURRENT_PAGE', '/');
}


define( 'LIKEDISLIKE_FOR_WP_DB_VERSION', 1 );

define( 'LIKEDISLIKE_FOR_WP_ALLOWED_PAGES', apply_filters( 'like_dislike_for_wp_pages_for_assets', array( 'wp-like-dislike-settings', 'wp-like-dislike-posts-counts', 'wp-like-dislike-pages-counts' ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-like-dislike-for-wp-activator.php
 */
function like_dislike_for_wp_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-like-dislike-for-wp-activator.php';
	Likedislike_For_Wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-like-dislike-for-wp-deactivator.php
 */
function like_dislike_for_wp_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-like-dislike-for-wp-deactivator.php';
	Likedislike_For_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'like_dislike_for_wp_activate' );
register_deactivation_hook( __FILE__, 'like_dislike_for_wp_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-like-dislike-for-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function like_dislike_for_wp_run() {

	$plugin = new Likedislike_For_Wp();
	$plugin->run();

}
like_dislike_for_wp_run();
