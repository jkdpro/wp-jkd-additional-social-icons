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
	'booksy'     => array(
		'viewBox' => '0 0 48 48',
		'paths'   => array(
			array(
				'd'              => 'M24.158 14.829V27.5m0 0a5.671 5.671 0 1 1 5.67 5.67c-7.738 0-7.852-7.583-12.791-7.583c-4.25 0-4.537 3.273-4.537 3.273',
				'fill'           => 'none',
				'stroke'         => '#ffffff',
				'strokeWidth'    => '3',
				'strokeLinecap'  => 'round',
				'strokeLinejoin' => 'round',
				'transform'      => 'translate(-5.04 -5.04) scale(1.21)',
			),
		),
	),
	'freelancer' => array(
		'viewBox' => '0 0 24 24',
		'paths'   => array(
			array(
				'd'        => 'M6 4h12v3H9v3h8v3H9v4H6V4z',
				'fillRule' => 'evenodd',
			),
		),
	),
);

add_filter(
	'block_core_social_link_get_services',
	function ( $services ) {
		$names = array(
			'booksy'     => 'Booksy',
			'freelancer' => 'Freelancer.com',
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
	}
);

// Black background for the Booksy icon regardless of the block's colour settings.
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
