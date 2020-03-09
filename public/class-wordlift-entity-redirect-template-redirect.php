<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08.08.18
 * Time: 22:08
 */

class Wordlift_Entity_Redirect_Template_Redirect {

	private $endpoint;

	public function __construct() {

		$options = get_option( 'wl_entity_redirect_options' );

		if ( isset( $_GET['noredir'] )
		     || ! isset( $options['entity_redirect_field_enable'] )
		     || 'yes' !== $options['entity_redirect_field_enable']
		     || empty( $options['entity_redirect_field_endpoint'] ) ) {
			return;
		}

		$this->endpoint = $options['entity_redirect_field_endpoint'];

		add_action( 'template_redirect', array( $this, 'template_redirect' ) );

	}

	function template_redirect() {

		if ( ! class_exists( 'Wordlift_Entity_Service' ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_post();
		if ( ! isset( $post ) ) {
			return;
		}

		$entity_service = Wordlift_Entity_Service::get_instance();

		$is_entity = $entity_service->is_entity( $post->ID );

		if ( ! $is_entity ) {
			return;
		}

		// Check whether the redirect is disabled on this specific entity.
		$is_enabled = Wordlift_Entity_Redirect_Status::is_enabled( $post->ID );

		if ( false === $is_enabled ) {
			return;
		}

		$uri      = $entity_service->get_uri( $post->ID );
		$same_ass = get_post_meta( $post->ID, Wordlift_Schema_Service::FIELD_SAME_AS );

		$redir = self::add_parameter( get_permalink( $post->ID ), 'noredir' );
		$url   = self::add_parameter( $this->endpoint, 'redir=' . urlencode( $redir ) );

		$target_url = array_reduce( array_merge( array( $uri ), $same_ass ), function ( $initial, $this_uri ) {
			return $initial . '&id[]=' . urlencode( $this_uri );
		}, $url );

		wp_redirect( $target_url );
		exit();

	}

	private static function add_parameter( $url, $parameter ) {

		if ( false === strpos( $url, '?' ) ) {
			return $url . '?' . $parameter;
		}

		return $url . '&' . $parameter;
	}

}
