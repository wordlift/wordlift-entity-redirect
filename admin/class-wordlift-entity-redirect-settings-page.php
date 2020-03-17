<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08.08.18
 * Time: 18:07
 */

class Wordlift_Entity_Redirect_Settings_Page {

	public function __construct() {

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'entity_redirect_options_page' ) );

	}

	public function admin_init() {

		register_setting( 'wl_entity_redirect', 'wl_entity_redirect_options' );

		add_settings_section(
			'wl_entity_redirect_section_general',
			__( 'General Settings', 'wordlift-entity-redirect' ),
			array( $this, 'entity_redirect_section_general' ),
			'wl_entity_redirect'
		);

		add_settings_field(
			'wl_entity_redirect_field_enable',
			__( 'Enable Redirects', 'wordlift-entity-redirect' ),
			array( $this, 'entity_redirect_field_enable' ),
			'wl_entity_redirect',
			'wl_entity_redirect_section_general',
			array(
				'label_for' => 'entity_redirect_field_enable',
				'class'     => 'entity_redirect_row',
			)
		);

		add_settings_field(
			'wl_entity_redirect_field_endpoint',
			__( 'Master Endpoint', 'wordlift-entity-redirect' ),
			array( $this, 'entity_redirect_field_master_endpoint' ),
			'wl_entity_redirect',
			'wl_entity_redirect_section_general',
			array(
				'label_for' => 'entity_redirect_field_endpoint',
				'class'     => 'entity_redirect_row',
			)
		);

		add_settings_field(
			'wl_entity_context_cards_field_endpoint',
			__( 'Context Cards Endpoint', 'wordlift-entity-redirect' ),
			array( $this, 'entity_context_cards_field_master_endpoint' ),
			'wl_entity_redirect',
			'wl_entity_redirect_section_general',
			array(
				'label_for' => 'entity_context_cards_field_endpoint',
				'class'     => 'entity_redirect_row',
			)
		);

	}

	public function entity_redirect_section_general( $args ) {
		?>
        <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php
			esc_html_e( 'Configure the general settings.', 'wordlift-entity-redirect' ); ?></p>
		<?php
	}

	public function entity_redirect_field_enable( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options = get_option( 'wl_entity_redirect_options' );
		// output the field
		?>
        <input type="radio" name="wl_entity_redirect_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
               value="yes" <?php checked( $options[ $args['label_for'] ], "yes" ); ?>/> Yes
        <input type="radio" name="wl_entity_redirect_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
               value="no" <?php echo isset( $options[ $args['label_for'] ] ) ? checked( $options[ $args['label_for'] ], "no", false ) : "checked='true'"; ?>/> No
        <p class="description">
			<?php esc_html_e( 'Select Yes to enable redirecting entity pages to the remote end-point.', 'wordlift-entity-redirect' ); ?>
        </p>
		<?php
	}

	function entity_redirect_field_master_endpoint( $args ) {
		$options = get_option( 'wl_entity_redirect_options' );
		?>
        <input type="text" name="wl_entity_redirect_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
               value="<?php esc_attr_e( $options[ $args['label_for'] ] ); ?>" class="regular-text"/>
        <p class="description">
			<?php esc_html_e( 'Type the remote end-point, e.g. https://master.example.org/wl-api?action=entity-redirect.', 'wordlift-entity-redirect' ); ?>
        </p>
		<?php
	}

	function entity_context_cards_field_master_endpoint( $args ) {
		$options = get_option( 'wl_entity_redirect_options' );
		?>
		<input type="text" name="wl_entity_redirect_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
		       value="<?php esc_attr_e( $options[ $args['label_for'] ] ); ?>" class="regular-text"/>
		<p class="description">
			<?php esc_html_e( 'Type the remote end-point, e.g. https://master.example.org/wl-api?action=entity-redirect.', 'wordlift-entity-redirect' ); ?>
		</p>
		<?php
	}

	function entity_redirect_options_page() {
		// add top level menu page
		add_menu_page(
			'WordLift Entity Redirect',
			'WordLift Entity Redirect Options',
			'manage_options',
			'wl_entity_redirect',
			array( $this, 'entity_redirect_options_page_html' )
		);
	}

	function entity_redirect_options_page_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// check if the user have submitted the settings
		// wordpress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'wl_entity_redirect_messages', 'wl_entity_redirect_message', __( 'Settings Saved', 'wordlift-entity-redirect' ), 'updated' );
		}

		settings_errors( 'wl_entity_redirect_messages' );
		?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
				<?php
				settings_fields( 'wl_entity_redirect' );
				do_settings_sections( 'wl_entity_redirect' );
				submit_button( 'Save Settings' );
				?>
            </form>
        </div>
		<?php
	}

}
