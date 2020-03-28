<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordlift.io
 * @since             1.0.0
 * @package           Wordlift_Entity_Redirect
 *
 * @wordpress-plugin
 * Plugin Name:       WordLift Entity Redirect
 * Plugin URI:        https://wordlift.io
 * Description:       Redirect Entity Pages to their sameAs equivalent on a master site.
 * Version:           1.2.0-dev
 * Author:            WordLift
 * Author URI:        https://wordlift.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordlift-entity-redirect
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
define( 'WL_ENTITY_REDIRECT_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordlift-entity-redirect-activator.php
 */
function activate_wordlift_entity_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordlift-entity-redirect-activator.php';
	Wordlift_Entity_Redirect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordlift-entity-redirect-deactivator.php
 */
function deactivate_wordlift_entity_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordlift-entity-redirect-deactivator.php';
	Wordlift_Entity_Redirect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordlift_entity_redirect' );
register_deactivation_hook( __FILE__, 'deactivate_wordlift_entity_redirect' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordlift-entity-redirect.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordlift_entity_redirect() {

	$plugin = new Wordlift_Entity_Redirect();
	$plugin->run();

}

run_wordlift_entity_redirect();

add_filter( 'wl_anchor_data_attributes', function ( $attributes, $post_id ) {

	$attributes[] = array(
		'entity-redirect-enabled' =>
			( Wordlift_Entity_Redirect_Status::is_enabled( $post_id ) ? 'true' : 'false' )
	);

	return $attributes;
}, 10, 2 );
