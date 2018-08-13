<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 13.08.18
 * Time: 13:16
 */

class Wordlift_Entity_Redirect_Status {

	const ENABLED_META_KEY = '_wl_entity_redirect_enabled';

	public static function is_enabled( $post_id ) {

		$meta_value = get_post_meta( $post_id, self::ENABLED_META_KEY, true );

		return 'no' !== $meta_value;
	}

	public static function set_enabled( $post_id, $value ) {

		update_post_meta( $post_id, self::ENABLED_META_KEY, $value ? 'yes' : 'no' );

	}

}