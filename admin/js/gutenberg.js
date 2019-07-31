/**
 * External dependencies
 */
import { errorMessages } from 'amp-block-editor-data';
import PropTypes from 'prop-types';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { FormToggle, Notice } from '@wordpress/components';
import { RawHTML } from '@wordpress/element';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose, withInstanceId } from '@wordpress/compose';

