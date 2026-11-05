<?php
/**
 * Plugin Name: wp-jkd-additional-social-icons
 * Description: Adds Booksy and Freelancer.com options to the core Social Icons block.
 * Version: 0.9.0
 * Requires at least: 6.9
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;

const WP_JDK_ADDITIONAL_SOCIAL_ICONS = array(
	'booksy' => array(
		'viewBox' => '0 0 24 24',
		'paths'   => array(
			array(
				'd' => 'M21.3525 0.0675h-18.705a2.58 2.58 0 0 0-2.58 2.58v18.705a2.58 2.58 0 0 0 2.58 2.58h18.705a2.58 2.58 0 0 0 2.58-2.58v-18.705a2.58 2.58 0 0 0-2.58-2.58',
				'fill' => '#000000',
			),
			array(
				'd'              => 'M12.1027 6.03885V14.275m0 0a3.68615 3.68615 0 1 1 3.6855 3.6855c-5.0297 0-5.1038-4.92995-8.31415-4.92995c-2.7625 0-2.94905 2.12745-2.94905 2.12745',
				'fill'            => 'none',
				'stroke'          => '#ffffff',
				'strokeWidth'     => 1.2,
				'strokeLinecap'   => 'round',
				'strokeLinejoin'  => 'round',
			),
		),
	),
	'freelancer' => array(
		'viewBox' => '0 0 24 24',
		'paths'   => array(
			array(
				'd'    => 'M14.096 3.076l1.634 2.292L24 3.076M5.503 20.924l4.474-4.374-2.692-2.89m6.133-10.584L11.027 5.23l4.022.15M4.124 3.077l.857 1.76 4.734.294m-3.058 7.072l3.497-6.522L0 5.13m7.064 7.485l3.303 3.548 3.643-3.57 1.13-6.652-4.439-.228Z',
				'fill' => '#29B2FE',
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
			'0.9.0',
			true
		);
		wp_add_inline_script(
			$handle,
			'window.wpJdkAdditionalSocialIcons = ' . wp_json_encode( WP_JDK_ADDITIONAL_SOCIAL_ICONS ) . ';',
			'before'
		);

		$style_handle = 'wp-jkd-additional-social-icons-editor';
		wp_register_style( $style_handle, false, array(), '0.9.0' );
		wp_enqueue_style( $style_handle );
		wp_add_inline_style(
			$style_handle,
			'.block-editor-block-variation-picker__variations .wp-jkd-social-icon-booksy path:first-child{display:none}.block-editor-block-variation-picker__variations .wp-jkd-social-icon-booksy path:not(:first-child){fill:none!important;stroke:#000!important}.block-editor-block-variation-picker__variations .wp-jkd-social-icon-freelancer path{fill:#000!important;stroke:none!important}'
		);
	}
);

// Black background for the Booksy icon regardless of the block's colour settings.
/*
add_action(
	'enqueue_block_assets',
	function () {
		$handle = 'wp-jkd-additional-social-icons-style';
		wp_register_style( $handle, false, array(), '0.9.0' );
		wp_enqueue_style( $handle );
		wp_add_inline_style(
			$handle,
			'.wp-block-social-links .wp-social-link.wp-social-link-booksy{background-color:#000 !important;color:#fff !important;}'
		);
	}
);
*/
