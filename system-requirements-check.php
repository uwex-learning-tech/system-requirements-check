<?php
/**
 * Plugin Name: System Requirements Check
 * Plugin URI:
 * Description: A system requirements plugin that checks for specified version of the operating systems, web browsers, Adobe Flash Player, Java Runtime Environment (JRE), Cookie, and Javascript on the client side. The result will be used to let the end-users be aware of that their system may not be optimal for specific tasks or operations. To display the result on a page, use this shortcode: <code>[system_requirements_check]</code>.
 * Version: 0.5.0
 * Author: Ethan Lin
 * Author URI: http://www.ethanslin.com
 * License: GPL2
 */
 /*  Copyright 2014  Ethan Lin  (email : ethan.lin.05@gmail.com)

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
if (!defined('ABSPATH'))
	exit;
/**
 * System Check Class
 */
 
class System_Requirements_Check {
	
	/**
	 * Constructor - set and hook up the plugin
	 */
	public function __construct() {
		
		// add a setting page
		include(sprintf("%s/includes/admin/class-system-requirements-check-settings.php", dirname(__FILE__)));
		$this->settings_page = new System_Requirements_Check_Settings();
		
		// actions
		add_action('admin_menu', array($this, 'add_menu'));
		add_action('admin_enqueue_scripts', array($this, 'backend_scripts'));
		
		// add localization
		//add_action('plugins_loaded', array($this, 'load_plugin_localization'));
		
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
		
		add_options_page('System Requirements Check', 'System Requirements Check', 'manage_options', 'system_requirements_check', array($this->settings_page, 'output'));
		
	}
	
	/**
	 * Localization
	 */
	public function load_plugin_textdomain() {
	
		load_plugin_textdomain('system-requirements-check', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
		
	}
	
	/**
	 * Add Admin CSS and JS files
	 */
	public function backend_scripts() {
		
		wp_enqueue_style('system-requirements-check-settings', plugin_dir_url(__FILE__) . 'assets/css/system-requirements-check-settings.css');
		
	}
	 
	
} // end class System_Requirements_Check

	
// Installation and uninstallation hooks
register_activation_hook(__FILE__, array('System_Requirements_Check', 'activate'));

// instantiate the plugin class
if (is_admin())
	$system_requirements_check = new System_Requirements_Check();

// add a link to the setting page onto the plugin page
if (isset($system_requirements_check)) {
	
	// add the setting link to the plugins page
	function plugin_settings_link($links) {
	
		$setting_link = '<a href="options-general.php?page=system_requirements_check">Settings</a>';
		array_unshift($links, $setting_link);
		return $links;
		
	}
	
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin",'plugin_settings_link');