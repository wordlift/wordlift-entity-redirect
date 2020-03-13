<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wordlift.io
 * @since      1.0.0
 *
 * @package    Wordlift_Entity_Redirect
 * @subpackage Wordlift_Entity_Redirect/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordlift_Entity_Redirect
 * @subpackage Wordlift_Entity_Redirect/public
 * @author     David Riccitelli <david@wordlift.io>
 */
class Wordlift_Entity_Redirect_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wordlift-entity-redirect-endpoint.php';
		new Wordlift_Entity_Redirect_Endpoint();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wordlift-entity-redirect-template-redirect.php';
		new Wordlift_Entity_Redirect_Template_Redirect();


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wordlift-entity-redirect-context-card.php';
		new Wordlift_Entity_Redirect_Context_Cards();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordlift-entity-redirect-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordlift-entity-redirect-public.js', array( 'jquery' ), $this->version, false );

	}

}
