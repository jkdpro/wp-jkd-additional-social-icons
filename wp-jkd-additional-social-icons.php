<?php
/**
 * Plugin Name: wp-jkd-additional-social-icons
 * Description: Adds Booksy and Freelancer.com options to the core Social Icons block.
 * Version: 0.9.1
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
				'd' => 'M11.779,14.21L11.779,6.033L11.87,5.812L12.104,5.708L12.338,5.812L12.429,6.033L12.429,12.091L12.832,11.571L13.287,11.142L13.82,10.778L14.405,10.518L15.016,10.336L15.757,10.258L16.394,10.31L17.005,10.453L17.603,10.7L18.149,11.025L18.63,11.441L19.111,12.013L19.423,12.572L19.644,13.157L19.774,13.794L19.8,14.431L19.696,15.172L19.462,15.887L19.085,16.563L18.682,17.057L18.097,17.551L17.447,17.928L16.719,18.175L15.978,18.279L15.003,18.24L14.21,18.11L13.391,17.837L12.65,17.473L12.026,17.031L11.389,16.459L9.296,14.119L8.724,13.69L8.1,13.43L7.645,13.365L6.995,13.378L6.462,13.482L6.033,13.638L5.591,13.911L5.214,14.301L4.993,14.691L4.824,15.276L4.733,15.406L4.577,15.484L4.408,15.458L4.278,15.367L4.2,15.211L4.33,14.613L4.616,14.028L4.967,13.599L5.461,13.209L6.098,12.91L6.696,12.767L7.554,12.702L8.139,12.78L8.867,13.04L9.647,13.56L10.245,14.171L11.844,15.991L12.338,16.446L12.897,16.849L13.521,17.187L14.236,17.447L15.068,17.603L15.939,17.629L16.576,17.538L17.174,17.33L17.733,17.018L18.214,16.602L18.604,16.108L18.903,15.536L19.085,14.925L19.15,14.288L19.098,13.651L18.916,13.04L18.63,12.481L18.24,11.974L17.668,11.493L17.109,11.181L16.511,10.986L15.874,10.908L15.341,10.947L14.717,11.09L14.236,11.298L13.703,11.649L13.17,12.169L12.767,12.793L12.52,13.495L12.377,14.392L12.182,14.535L12.013,14.535L11.818,14.392L11.779,14.21Z',
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
