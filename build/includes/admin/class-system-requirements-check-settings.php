<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

/**
 * System_Requirements_Check_Setting class
 */
class System_Requirements_Check_Settings {
	
	/**
	 * __construct function
	 *
	 * @access public
	 * @return void
	 */
	 public function __construct() {
		 
		 $this->settings_group = "system_requirements_check";
		 add_action('admin_init', array($this, 'register_settings'));
		 
	 }
	 
	 /**
	 * init_settings function
	 *
	 * @access protected
	 * @return void
	 */
	protected function init_settings() {
	
		$this->settings = apply_filters('system_requirements_check_settings',
			array(
				'system_requirements' => array(
					__( 'System Requirements', 'system_requirements_check' ),
					array(
    					array(
							'name'		=> 'disable_os_check',
							'std'		=> '0'
						),
					    array(
							'name'		=> 'windows_xp',
							'std'		=> '0'
						),
						array(
							'name'		=> 'windows_vista',
							'std'		=> '1'
						),
						array(
							'name'		=> 'windows_7',
							'std'		=> '1'
						),
						array(
							'name'		=> 'windows_8',
							'std'		=> '1'
						),
						array(
							'name'		=> 'windows_81',
							'std'		=> '1'
						),
						array(
							'name'		=> 'windows_10',
							'std'		=> '1'
						),
						array(
							'name'		=> 'mac',
							'std'		=> '1'
						),
						array(
							'name'		=> 'linux',
							'std'		=> '0'
						),
						array(
							'name'		=> 'disable_browser_check',
							'std'		=> '0'
						),
						array(
							'name'		=> 'ie',
							'std'		=> '9'
						),
						array(
							'name'		=> 'edge',
							'std'		=> '12'
						),
						array(
							'name'		=> 'firefox',
							'std'		=> '27'
						),
						array(
							'name'		=> 'chrome',
							'std'		=> '33'
						),
						array(
							'name'		=> 'safari',
							'std'		=> '6'
						),
						array(
							'name'		=> 'opera',
							'std'		=> '12'
						),
						array(
							'name'		=> 'jre',
							'std'		=> '1.6.0'
						),
						array(
							'name'		=> 'cookie',
							'std'		=> '1'
						),
						array(
							'name'		=> 'js',
							'std'		=> '1'
						),
						array(
							'name'		=> 'flash',
							'std'		=> '11'
						),
						array(
							'name'		=> 'ip',
							'std'		=> '0'
						),
						array(
							'name'		=> 'host_ip',
							'std'		=> '0'
						),
						array(
							'name'		=> 'screen',
							'std'		=> '0'
						),
						array(
							'name'		=> 'disable_screen_check',
							'std'		=> '1'
						),
						array(
							'name'		=> 'screen_w',
							'std'		=> '1024'
						),
						array(
							'name'		=> 'screen_h',
							'std'		=> '640'
						)
					),
				)
			)
		);
	}
	
	/**
	 * register_settings function
	 *
	 * @access public
	 * @return void
	 */
	public function register_settings() {
	
		$this->init_settings();

		foreach ($this->settings as $section) {
		
			foreach ($section[1] as $option) {
			
				if (isset($option['std'])) {
					add_option($option['name'], $option['std']);
				}
					
				register_setting($this->settings_group, $option['name']);
			}
		}
		
	}
	
	/**
	 * output function
	 *
	 * @access public
	 * @return void
	 */
	public function output() {
	
		$this->init_settings();
		
		?>
		
		<div class="wrap">
		
			<h2>System Requirements Check</h2>
			
			<div class="src-wrap">
			    
				<?php include_once(sprintf("%s",'system-requirements-check-settings-form.php')); ?>
				
			</div>
		</div>
		<?php
	}
	
} // end class System_Requirements_Check_Settings