const { registerPlugin } = wp.plugins;
const { PluginPostStatusInfo } = wp.editPost;
const { TextControl, FormToggle } = wp.components;
const { withSelect, withDispatch } = wp.data;
const { withState } = wp.compose;
const { __ } = wp.i18n;
const { addFilter } = wp.hooks;

/**
 * Updates the value in the store.
 *
 * @param {function} select
 */
const mapSelectToProps = select => {
	return {
		metaFieldValue: select("core/editor").getEditedPostAttribute("meta")[
			"_wl_entity_redirect_enabled"
		]
	};
};

/**
 * Updates the meta value.
 *
 * @param {function} dispatch
 */
const mapDispatchToProps = dispatch => {
	return {
		setMetaFieldValue: function(value) {
			dispatch("core/editor").editPost({
				meta: {
					_wl_entity_redirect_enabled: value ? "yes" : "no"
				}
			});
		}
	};
};

/**
 * Returns the Form Toggle Switch.
 *
 * @param {object} props Props passed by mapSelectToProps.
 */
const EntityRedirectSwitch = props => {
	return (
		<FormToggle
			checked={"no" !== props.metaFieldValue}
			onChange={() =>
				props.setMetaFieldValue(!("yes" === props.metaFieldValue))
			}
		/>
	);
};

const EntityRedirectSwitchWithData = withSelect(mapSelectToProps)(
	EntityRedirectSwitch
);
const EntityRedirectSwitchWithDataAndActions = withDispatch(mapDispatchToProps)(
	EntityRedirectSwitchWithData
);

/**
 * Registers a new control in the Plugin Post slot fill and renders it.
 */
registerPlugin("wer-entity-redirect-toggle", {
	render() {
		return (
			<PluginPostStatusInfo>
				<label>
					{__("Entity Redirect", "wordlift-entity-redirect")}
				</label>
				<EntityRedirectSwitchWithDataAndActions />
			</PluginPostStatusInfo>
		);
	}
});

addFilter("wl_context_cards_loader_function", defaultFn => {
	return el => {
		// should load things
		const ids = el.getAttribute("data-er-id").split(";");

		// make the call to the JSON-LD end-point using the master web site end-point.

		// if there are results, return them

		// if the aren't call `defaultFn`.

	};
});
