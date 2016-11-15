<?php
/**
 * Plugin Name: System Requirements Check
 * Plugin URI: http://www.ethanslin.com/plugin/wordpress/system_requirements_check/
 * Description: A minimum system requirements plugin that checks for specified version of the operating systems, web browsers, screen resolution, IP addresses, Adobe Flash Player, Java Runtime Environment (JRE), Cookie, and Javascript on the client side. The result will be displayed on a post or page with the use of a short code to let the end-users be aware of that their system may not be optimal for specific tasks or operations.
 * Version: 1.2.0
 * Author: Ethan Lin
 * Author URI: http://www.ethanslin.com
 * License: GPL2
 */
 /*  Copyright 2014-2016  Ethan Lin  (email : ethan.lin.05@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// exit if access directly
if ( !defined( 'ABSPATH' ) ) exit;

define( 'SYSTEM_REQ_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ) ) ) );

/**
 * System Check Class
 */
class System_Requirements_Check {

	/**
	 * Constructor - set and hook up the plugin
	 */
	public function __construct() {

		// add a setting page
		include( sprintf( "%s/includes/admin/class-system-requirements-check-settings.php", dirname( __FILE__ ) ) );
		$this->settings_page = new System_Requirements_Check_Settings();

		// actions
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'backend_scripts' ) );

	}

	/**
	 * Activate the plugin
	 */
	public static function activate() {

		// Do nothing

	}

	/**
	 * Deactivate the plugin
	 */
	public static function deactivate() {

		// Do nothing

	}

	/**
	 * add a menu
	 */
	public function add_menu() {

		add_options_page( 'System Requirements Check', 'System Requirements Check', 'manage_options', 'system_requirements_check', array( $this->settings_page, 'output' ) );

	}

	/**
	 * Add Admin CSS files
	 */
	public function backend_scripts() {

		wp_enqueue_style( 'system-requirements-check-settings', plugin_dir_url(__FILE__) . 'assets/css/system-requirements-check-settings.css' );

	}

} // end class System_Requirements_Check

// Installation and uninstallation hooks
register_activation_hook( __FILE__, array('System_Requirements_Check', 'activate' ) );

// instantiate the plugin class
if ( is_admin() )
	$system_requirements_check = new System_Requirements_Check();

// add shortcode
require_once( "includes/class-system-requirements-check-shortcodes.php" );