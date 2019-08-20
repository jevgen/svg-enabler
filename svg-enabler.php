<?php
/*
Plugin Name: 	SVG Enabler
Plugin URI:		https://github.com/jevgen/svg-enabler/
Description: 	Enable upload of SVG files to the Media Library and render SVG files thumbnails.
Version: 		1
Author: 		Chris Coyer, Ricky Synnot, pudDesign, Jevgenijs Cernihovics
Author URI: https://codepen.io/chriscoyier/post/wordpress-4-7-1-svg-upload
Text Domain: 	svg-enabler
Domain Path:	/languages
License: 		GPLv2 or later
License URI:	http://www.gnu.org/licenses/gpl-2.0.html

*/

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

global $wp_version; if( $wp_version == '4.7' || ( (float) $wp_version < 4.7 ) ) { return $data; }

$filetype = wp_check_filetype( $filename, $mimes );

return [ 'ext' => $filetype['ext'], 'type' => $filetype['type'], 'proper_filename' => $data['proper_filename'] ];

}, 10, 4 );

function cc_mime_types( $mimes ){ $mimes['svg'] = 'image/svg+xml'; return $mimes; } add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() { echo ' <style>.attachment-266x266, .thumbnail img { width: 100% !important; height: auto !important; }</style> '; } add_action( 'admin_head', 'fix_svg' );
