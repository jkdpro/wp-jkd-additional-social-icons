<?php
/**
 * Plugin Name: wp-jkd-additional-social-icons
 * Description: Adds Booksy and Freelancer.com options to the core Social Icons block.
 * Version: 0.9.2
 * Requires at least: 6.9
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;

$wp_jkd_asi_plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), 'plugin' );
define( 'WP_JKD_ASI_VERSION', $wp_jkd_asi_plugin_data['Version'] );
unset( $wp_jkd_asi_plugin_data );

const WP_JDK_ADDITIONAL_SOCIAL_ICONS = array(
	'booksy' => array(
		'viewBox' => '0 0 24 24',
		'paths'   => array(
			array(
				'd' => 'M5.245,15.371L5.189,15.507L5.06,15.685L4.884,15.817L4.678,15.893L4.458,15.906L4.313,15.879L4.177,15.823L3.999,15.694L3.867,15.518L3.791,15.312L3.775,15.165L3.801,14.933L3.87,14.641L3.971,14.35L4.103,14.061L4.26,13.795L4.443,13.543L4.726,13.237L5.037,12.979L5.392,12.756L5.78,12.575L6.208,12.435L6.674,12.339L7.155,12.29L7.664,12.286L7.934,12.31L8.182,12.35L8.433,12.41L8.679,12.49L8.917,12.587L9.155,12.705L9.383,12.84L9.601,12.989L9.984,13.298L10.386,13.69L10.77,14.116L11.8,15.331L12.139,15.691L12.455,15.989L12.831,16.296L13.222,16.558L13.632,16.775L14.045,16.941L14.338,17.031L14.651,17.104L14.963,17.157L15.297,17.192L15.655,17.209L15.947,17.206L16.217,17.179L16.482,17.127L16.742,17.051L16.994,16.952L17.235,16.83L17.464,16.686L17.679,16.521L17.878,16.338L18.059,16.137L18.221,15.92L18.399,15.618L18.546,15.283L18.65,14.932L18.71,14.571L18.724,14.206L18.695,13.857L18.621,13.498L18.502,13.152L18.341,12.823L18.141,12.517L17.904,12.238L17.634,11.991L17.336,11.779L17.013,11.606L16.672,11.474L16.332,11.389L16.048,11.35L15.762,11.338L15.492,11.353L15.209,11.396L14.931,11.466L14.661,11.563L14.402,11.686L14.17,11.825L13.866,12.056L13.605,12.312L13.369,12.612L13.181,12.926L13.033,13.261L12.928,13.612L12.875,13.91L12.849,14.35L12.82,14.494L12.725,14.693L12.632,14.806L12.518,14.899L12.319,14.993L12.102,15.025L11.956,15.01L11.749,14.936L11.627,14.855L11.523,14.751L11.441,14.629L11.385,14.493L11.353,14.275L11.356,5.965L11.41,5.752L11.479,5.622L11.572,5.509L11.749,5.377L11.885,5.321L12.029,5.292L12.176,5.292L12.32,5.321L12.456,5.377L12.578,5.459L12.682,5.563L12.764,5.685L12.82,5.821L12.849,5.965L12.853,10.949L13.09,10.754L13.341,10.574L13.591,10.421L13.868,10.276L14.15,10.152L14.426,10.053L14.726,9.967L15.028,9.904L15.318,9.863L15.63,9.841L15.943,9.841L16.251,9.862L16.56,9.906L16.847,9.966L17.144,10.05L17.419,10.149L17.702,10.272L17.98,10.417L18.229,10.57L18.484,10.751L18.723,10.947L18.936,11.147L19.148,11.377L19.341,11.617L19.509,11.858L19.67,12.126L19.81,12.401L19.925,12.67L20.027,12.965L20.108,13.263L20.169,13.57L20.206,13.86L20.225,14.313L20.2,14.745L20.133,15.173L20.025,15.592L19.876,15.998L19.689,16.388L19.462,16.762L19.202,17.108L18.91,17.427L18.588,17.716L18.239,17.973L17.849,18.203L17.456,18.385L17.044,18.529L16.623,18.631L16.194,18.692L15.787,18.71L15.212,18.69L14.703,18.635L14.216,18.546L13.76,18.426L13.311,18.269L12.885,18.081L12.471,17.856L12.127,17.636L11.791,17.389L11.46,17.112L11.137,16.81L10.562,16.196L9.476,14.915L9.234,14.656L9.017,14.446L8.781,14.248L8.547,14.086L8.321,13.963L8.087,13.872L7.874,13.818L7.642,13.788L7.404,13.782L7.108,13.797L6.845,13.831L6.613,13.879L6.389,13.948L6.179,14.037L6.001,14.137L5.839,14.254L5.704,14.379L5.575,14.529L5.468,14.692L5.379,14.87L5.31,15.061Z',
			),
		),
	),
	'freelancer' => array(
		'viewBox' => '0 0 24 24',
		'paths'   => array(
			array(
				'd' => 'M14.096 3.076l1.634 2.292L24 3.076M5.503 20.924l4.474-4.374-2.692-2.89m6.133-10.584L11.027 5.23l4.022.15M4.124 3.077l.857 1.76 4.734.294m-3.058 7.072l3.497-6.522L0 5.13m7.064 7.485l3.303 3.548 3.643-3.57 1.13-6.652-4.439-.228Z',
			),
		),
	),
);

add_filter(
	'block_core_social_link_get_services',
	function ( $services ) {
		$names = array(
			'booksy'     => 'Booksy',
			'freelancer' => 'Freelancer',
		);

		foreach ( WP_JDK_ADDITIONAL_SOCIAL_ICONS as $service => $icon_data ) {
			$icon = '<svg width="24" height="24" viewBox="' . esc_attr( $icon_data['viewBox'] ) . '" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">';
			foreach ( $icon_data['paths'] as $path ) {
				$icon .= '<path';
				foreach ( $path as $attribute => $value ) {
					$attribute = strtolower( preg_replace( '/([A-Z])/', '-$1', $attribute ) );
					$icon      .= ' ' . esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
				}
				$icon .= ' />';
			}
			$icon .= '</svg>';

			$services[ $service ] = array(
				'name' => $names[ $service ],
				'icon' => $icon,
			);
		}
		return $services;
	}
);

add_action(
	'enqueue_block_editor_assets',
	function () {
		$handle = 'wp-jkd-additional-social-icons';
		wp_enqueue_script(
			$handle,
			plugins_url( 'wp-jkd-additional-social-icons.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-primitives' ),
			WP_JKD_ASI_VERSION,
			true
		);
		wp_add_inline_script(
			$handle,
			'window.wpJdkAdditionalSocialIcons = ' . wp_json_encode( WP_JDK_ADDITIONAL_SOCIAL_ICONS ) . ';',
			'before'
		);
	}
);

// Brand colours, mirroring core's socials-with-bg / socials-without-bg mixins.
// :where() keeps specificity at zero so block-level icon colours still win.
add_action(
	'enqueue_block_assets',
	function () {
		$handle = 'wp-jkd-additional-social-icons-colors';
		wp_register_style( $handle, false, array(), WP_JKD_ASI_VERSION );
		wp_enqueue_style( $handle );
		wp_add_inline_style(
			$handle,
			':where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-booksy{background-color:#000;color:#fff}' .
			':where(.wp-block-social-links.is-style-logos-only) .wp-social-link-booksy{color:#000}' .
			':where(.wp-block-social-links:not(.is-style-logos-only)) .wp-social-link-freelancer{background-color:#29b2fe;color:#fff}' .
			':where(.wp-block-social-links.is-style-logos-only) .wp-social-link-freelancer{color:#29b2fe}'
		);
	}
);
