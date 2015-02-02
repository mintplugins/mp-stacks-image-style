<?php
/*
Plugin Name: MP Stacks + Image Style
Plugin URI: http://mintplugins.com
Description: Add styling options to the Image Content-Type in MP Stacks.
Version: 1.0.0.0
Author: Mint Plugins
Author URI: http://mintplugins.com
Text Domain: mp_stacks_image_style
Domain Path: languages
License: GPL2
*/

/*  Copyright 2014  Phil Johnston  (email : phil@mintplugins.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Mint Plugins Core.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Mint Plugins Core, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// Plugin version
if( !defined( 'MP_STACKS_IMAGE_STYLE_VERSION' ) )
	define( 'MP_STACKS_IMAGE_STYLE_VERSION', '1.0.0.0' );

// Plugin Folder URL
if( !defined( 'MP_STACKS_IMAGE_STYLE_PLUGIN_URL' ) )
	define( 'MP_STACKS_IMAGE_STYLE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Plugin Folder Path
if( !defined( 'MP_STACKS_IMAGE_STYLE_PLUGIN_DIR' ) )
	define( 'MP_STACKS_IMAGE_STYLE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Root File
if( !defined( 'MP_STACKS_IMAGE_STYLE_PLUGIN_FILE' ) )
	define( 'MP_STACKS_IMAGE_STYLE_PLUGIN_FILE', __FILE__ );

/*
|--------------------------------------------------------------------------
| GLOBALS
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function mp_stacks_image_style_textdomain() {

	// Set filter for plugin's languages directory
	$mp_stacks_image_style_lang_dir = dirname( plugin_basename( MP_STACKS_IMAGE_STYLE_PLUGIN_FILE ) ) . '/languages/';
	$mp_stacks_image_style_lang_dir = apply_filters( 'mp_stacks_image_style_languages_directory', $mp_stacks_image_style_lang_dir );


	// Traditional WordPress plugin locale filter
	$locale        = apply_filters( 'plugin_locale',  get_locale(), 'mp-stacks-image-style' );
	$mofile        = sprintf( '%1$s-%2$s.mo', 'mp-stacks-image-style', $locale );

	// Setup paths to current locale file
	$mofile_local  = $mp_stacks_image_style_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/mp-stacks-image-style/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/mp_stacks_image_style folder
		load_textdomain( 'mp_stacks_image_style', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/message_bar/languages/ folder
		load_textdomain( 'mp_stacks_image_style', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'mp_stacks_image_style', false, $mp_stacks_image_style_lang_dir );
	}

}
add_action( 'init', 'mp_stacks_image_style_textdomain', 1 );

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/

function mp_stacks_image_style_include_files(){
	/**
	 * If mp_core isn't active, stop and install it now
	 */
	if (!function_exists('mp_core_textdomain')){
		
		/**
		 * Include Plugin Checker
		 */
		require( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-checker.php' );
		
		/**
		 * Include Plugin Installer
		 */
		require( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-installer.php' );
		
		/**
		 * Check if wp_core in installed
		 */
		include_once( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-core-check.php' );
		
	}
	/**
	 * If mp_core is active but mp_stacks isn't, stop and install it now
	 */
	elseif(!function_exists('mp_stacks_textdomain')){
		
		/**
		 * Check if wp_html_in_post in installed
		 */
		include_once( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-stacks.php' );
	}
	/**
	 * Otherwise, if mp_core and mp_stacks are installed, carry out the plugin's functions
	 */
	else{
			
		/**
		 * Update script - keeps this plugin up to date
		 */
		require( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . 'includes/updater/mp-stacks-image-style-update.php' );
		
		/**
		 * Modify Metabox for Main Image
		 */
		require( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . 'includes/metaboxes/mp-stacks-image-style/mp-stacks-image-style.php' );
		
		/**
		 * Add this add on to the list of Active MP Stacks Add Ons
		 */
		if ( function_exists('mp_stacks_developer_textdomain') ){
			function mp_stacks_image_style_add_active( $required_add_ons ){
				$required_add_ons['mp_stacks_image_style'] = 'MP Stacks + Image Style';
				return $required_add_ons;
			}
			add_filter( 'mp_stacks_active_add_ons', 'mp_stacks_image_style_add_active' );
		}
		
		/**
		 * Filters which modify the image on output
		 */
		require( MP_STACKS_IMAGE_STYLE_PLUGIN_DIR . 'includes/misc-functions/image-style-actions.php' );
		
	}
}
add_action('plugins_loaded', 'mp_stacks_image_style_include_files', 9);
