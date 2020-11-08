<?php
/**
 * Plugin Name:     issuepage
 * Description:     Example block written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     issuepage
 *
 * @package         siejmy
 */

require_once dirname(__FILE__) . '/render_callbacks/issuepage.php';

function register_block_type_issuepage() {
	register_block_type( 'siejmy/issuepage', array(
		'render_callback' => 'siejmy_issuepage_downloadbtn_render_callback',
		'editor_script' => 'siejmy-issuepage-block-editor',
		'editor_style'  => 'siejmy-issuepage-block-editor',
		'style'         => 'siejmy-issuepage-block',
	) );
}

function create_block_issuepage_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "siejmy/issuepage" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'siejmy-issuepage-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'build/index.css';
	wp_register_style(
		'siejmy-issuepage-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'siejmy-issuepage-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type_issuepage();
}

add_action( 'init', 'create_block_issuepage_block_init' );
