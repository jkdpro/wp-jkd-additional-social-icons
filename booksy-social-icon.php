<?php
/**
 * Plugin Name: Booksy Social Icon
 * Description: Adds a Booksy service to the core Social Icons block (requires WordPress 6.9+).
 * Version: 0.9.0
 * Requires at least: 6.9
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;

/**
 * SVG path (24x24 viewBox). This is a placeholder "B".
 * Replace it with the path data of the official Booksy logo (single-color).
 */
const BOOKSY_SOCIAL_ICON_PATH = 'M7 4h6.2c2.3 0 3.8 1.3 3.8 3.3 0 1.2-.6 2.2-1.6 2.7 1.3.5 2.1 1.6 2.1 3.1 0 2.3-1.7 3.9-4.3 3.9H7V4zm2.4 2v3h3.5c1 0 1.6-.6 1.6-1.5S13.9 6 12.9 6H9.4zm0 5v3.9h3.9c1.1 0 1.8-.8 1.8-1.9s-.7-2-1.8-2H9.4z';

// Front end: make the block render the icon.
add_filter(
	'block_core_social_link_get_services',
	function ( $services ) {
		$services['booksy'] = array(
			'name' => 'Booksy',
			'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="' . esc_attr( BOOKSY_SOCIAL_ICON_PATH ) . '"></path></svg>',
		);
		return $services;
	}
);

// Editor: add Booksy to the list of services.
add_action(
	'enqueue_block_editor_assets',
	function () {
		wp_enqueue_script(
			'booksy-social-icon',
			plugins_url( 'booksy-social-icon.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-primitives' ),
			'1.0.0',
			true
		);
		wp_add_inline_script(
			'booksy-social-icon',
			'window.booksySocialIconPath = ' . wp_json_encode( BOOKSY_SOCIAL_ICON_PATH ) . ';',
			'before'
		);
	}
);
