<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 13.08.18
 * Time: 12:21
 */

class Wordlift_Entity_Redirect_Submit_Box {

	/**
	 * Wordlift_Entity_Redirect_Submit_Box constructor.
	 */
	public function __construct() {

		add_action( 'post_submitbox_misc_actions', array( $this, 'post_submitbox_misc_actions' ) );
		add_action( 'wp_ajax_wl_entity_redirect_status', array( $this, 'ajax_entity_redirect_status' ) );
	}

	public function post_submitbox_misc_actions( $post ) {

		$enabled       = Wordlift_Entity_Redirect_Status::is_enabled( $post->ID );
		$enabled_label = $enabled ? __( 'Enabled', 'wl-entity-redirect' ) : __( 'Disabled', 'wl-entity-redirect' );

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wordlift-entity-redirect-submit-box.php';

	}

	public function ajax_entity_redirect_status() {

		if ( false === wp_verify_nonce( $_REQUEST['nonce'], 'wl_entity_redirect_status' ) ) {
			wp_send_json_error( 'Missing or invalid nonce.' );
		}

		if ( empty( $_REQUEST['post_id'] ) || ! is_numeric( $_REQUEST['post_id'] ) ) {
			wp_send_json_error( 'Missing or invalid post id.' );
		}

		$post_id = (int ) $_REQUEST['post_id'];
		$value   = ! empty( $_REQUEST['value'] ) && 'yes' === $_REQUEST['value'];

		Wordlift_Entity_Redirect_Status::set_enabled( $post_id, $value );

		wp_send_json_success( array( 'nonce' => wp_create_nonce( 'wl_entity_redirect_status' ) ) );

	}

}