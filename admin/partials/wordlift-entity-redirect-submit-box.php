<div class="misc-pub-section misc-wl-entity-redirect-status">
    <span class="wl-entity-redirect-icon"></span>
	<?php esc_html_e( 'Entity Redirect:', 'wl-entity-redirect' ); ?>
    <strong class="wl-entity-redirect-status-text"><?php echo esc_html( $enabled_label ); ?></strong>
    <a href="#wl_entity_redirect_status" class="edit-wl-entity-redirect-status hide-if-no-js" role="button">
        <span aria-hidden="true"><?php esc_html_e( 'Edit', 'wl-entity-redirect' ); ?></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Edit Status', 'wl-entity-redirect' ); ?></span>
    </a>
    <div id="wl-entity-redirect-status-select" class="hide-if-js">
        <fieldset>
            <input id="wl-entity-redirect-status-enabled" type="radio"
                   name="wl_entity_redirect_status"
                   value="yes" <?php checked( true, $enabled ); ?>>
            <label for="wl-entity-redirect-status-enabled"
                   class="selectit"><?php echo esc_html__( 'Enabled', 'wl-entity-redirect' ); ?></label>
            <br/>
            <input id="wl-entity-redirect-status-disabled" type="radio"
                   name="wl_entity_redirect_status"
                   value="no" <?php checked( false, $enabled ); ?>>
            <label for="wl-entity-redirect-status-disabled"
                   class="selectit"><?php echo esc_html__( 'Disabled', 'wl-entity-redirect' ); ?></label>
            <br/>
			<?php wp_nonce_field( 'wl_entity_redirect_status', 'wl_entity_redirect_status_nonce' ); ?>
        </fieldset>
        <div class="wl-entity-redirect-status-actions">
            <a href="#wl_entity_redirect_status"
               class="save-wl-entity-redirect-status hide-if-no-js button"><?php esc_html_e( 'OK', 'wl-entity-redirect' ); ?></a>
            <a href="#wl_entity_redirect_status"
               class="cancel-wl-entity-redirect-status hide-if-no-js button-cancel"><?php esc_html_e( 'Cancel', 'wl-entity-redirect' ); ?></a>
        </div>
    </div>
</div>
