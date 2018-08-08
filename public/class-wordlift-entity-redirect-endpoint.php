<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08.08.18
 * Time: 21:44
 */

class Wordlift_Entity_Redirect_Endpoint {

	public function __construct() {

		add_action( 'admin_post_wl_redirect', array(
			$this,
			'redirect',
		) );
		add_action( 'admin_post_nopriv_wl_redirect', array(
			$this,
			'redirect',
		) );

	}

	public function redirect() {

		$redir = isset( $_REQUEST['redir'] ) ? $_REQUEST['redir'] : get_home_url();

		if ( ! isset( $_REQUEST['id'] ) || ! class_exists( 'Wordlift_Entity_Service' ) ) {
			wp_redirect( $redir );
			exit();
		}

		// Look for an entity.
		foreach ( $_REQUEST['id'] as $id ) {
			$post = Wordlift_Entity_Service::get_instance()
			                               ->get_entity_post_by_uri( $id );

			if ( null !== $post ) {
				wp_redirect( get_permalink( $post ) );
				exit;
			}
		}

		// Nothing found.
		wp_redirect( $redir );
		exit();

	}

}