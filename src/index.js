const { registerPlugin } = wp.plugins;
const { PluginPostStatusInfo } = wp.editPost;
const { TextControl, ToggleControl, FormToggle } = wp.components;
const { withSelect, withDispatch } = wp.data;
const { withState } = wp.compose;
const { __ } = wp.i18n;

registerPlugin( 'my-plugin-sidebar', {
	render() {

		const mapSelectToProps = select => {
			return {
				metaFieldValue: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ 'sid_toggle' ],
			}
		}
		
		const mapDispatchToProps = ( dispatch ) => {
			return {
				setMetaFieldValue: function( value ) {
					dispatch( 'core/editor' ).editPost(
						{
							meta: {
								sid_toggle: value
							}
						}
					);
				}
			}
		}
		
		const MetaBlockField = ( props ) => {
			return (
				<ToggleControl
					checked={ props.metaFieldValue }
					onChange={ content => {
						props.setMetaFieldValue( content )
					} }
				/>
			);
		}

		const MyFormToggle = withState( {
			checked: true,
		} )( ( { checked, setState } ) => (
			<FormToggle 
				checked={ checked }
				onChange={ () => setState( state => ( { checked: ! state.checked } ) ) } 
			/>
		) );
		
		const MetaBlockFieldWithData = withSelect( mapSelectToProps )( MetaBlockField );
		const MetaBlockFieldWithDataAndActions = withDispatch( mapDispatchToProps )( MetaBlockFieldWithData );

		return (
			<PluginPostStatusInfo>
				<label>{ __( 'Entity Redirect', 'wordlift-entity-redirect' ) }</label>
				<MetaBlockFieldWithDataAndActions />
			</PluginPostStatusInfo>	
		);
	}
} );
