<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordlift.io
 * @since      1.0.0
 *
 * @package    Wordlift_Entity_Redirect
 * @subpackage Wordlift_Entity_Redirect/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordlift_Entity_Redirect
 * @subpackage Wordlift_Entity_Redirect/admin
 * @author     David Riccitelli <david@wordlift.io>
 */
class Wordlift_Entity_Redirect_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		if ( is_admin() ) {

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wordlift-entity-redirect-settings-page.php';
			new Wordlift_Entity_Redirect_Settings_Page();

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wordlift-entity-redirect-submit-box.php';
			new Wordlift_Entity_Redirect_Submit_Box();

		}

		add_action( 'init', array( $this, 'register_meta' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordlift_Entity_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordlift_Entity_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordlift-entity-redirect-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordlift_Entity_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordlift_Entity_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( $this->is_gutenberg_page() ) {
			wp_enqueue_script( $this->plugin_name . '-admin', plugin_dir_url( dirname( __FILE__ ) ) . 'build/admin.js', array(
				'wp-plugins',
				'wp-edit-post'
			), $this->version, false );
		} else {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordlift-entity-redirect-admin.js', array( 'jquery' ), $this->version, false );
		}

	}

	/**
	 * Register's post meta.
	 */
	public function register_meta() {
		register_post_meta( '', Wordlift_Entity_Redirect_Status::ENABLED_META_KEY, array(
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'string',
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			}
		) );
	}

	/**
	 * Helper function to check Gutenberg
	 */
	function is_gutenberg_page() {
		if ( function_exists( 'is_gutenberg_page' ) &&
		     is_gutenberg_page()
		) {
			// The Gutenberg plugin is on.
			return true;
		}
		$current_screen = get_current_screen();
		if ( method_exists( $current_screen, 'is_block_editor' ) &&
		     $current_screen->is_block_editor()
		) {
			// Gutenberg page on 5+.
			return true;
		}

		return false;
	}
}
