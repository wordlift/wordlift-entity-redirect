<?php
/**
 * Created by PhpStorm.
 * User: Akshay Raje
 * Date: 2020-03-13
 * Time: 10:34
 */

class Wordlift_Entity_Redirect_Context_Cards {

	private $endpoint;

	public function __construct() {

		$options = get_option( 'wl_entity_redirect_options' );

		if (
			! isset( $options['entity_redirect_field_enable'] ) ||
			'yes' !== $options['entity_redirect_field_enable'] ||
			empty( $options['entity_context_cards_field_endpoint'] ) ) {
			return;
		}

		$this->endpoint = $options['entity_context_cards_field_endpoint'];

		add_filter( 'wl_context_cards_base_url', array( $this, 'wl_context_cards_base_url' ) );

	}

	function wl_context_cards_base_url($endpoint){
		return $this->endpoint;
	}

}
