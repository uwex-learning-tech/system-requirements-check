<?php

if (!defined('ABSPATH'))
	exit; // exit if accessed directly

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
							'name'		=> 'mac',
							'std'		=> '1'
						),
						array(
							'name'		=> 'ie',
							'std'		=> '9'
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
							'std'		=> '6'
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
			<form method="post" action="options.php">

				<?php settings_fields($this->settings_group); ?>
			    
			    <h2>System Requirements Check Settings</h2>

				<?php
					if (!empty($_GET['settings-updated'] ) ) {
						flush_rewrite_rules();
					}
				?>
				
				<div id="system-requirements-check-form">
					<h3>Operating Systems</h3>
					
					<p>Which operating systems to check for?</p>
					
					<label><input type="checkbox" name="windows_vista" value="1" <?php checked('1', get_option('windows_vista')); ?> />Windows Vista </label>
					
					<label><input type="checkbox" name="windows_7" value="1" <?php checked('1', get_option('windows_7')); ?> />Windows 7 </label>
					
					<label><input type="checkbox" name="windows_8" value="1" <?php checked('1', get_option('windows_8')); ?> />Windows 8 </label>
					
					<label><input type="checkbox" name="windows_81" value="1" <?php checked('1', get_option('windows_81')); ?> />Windows 8.1 </label>
					
					<label><input type="checkbox" name="mac" value="1" <?php checked('1', get_option('mac')); ?> />Mac OS X </label>
					
					<h3>Web Browsers</h3>
					
					<p>Enter the <strong>minimum</strong> version number for each web browser to check against. If left blank or with value of 0, it will not be checked.</p>
					
					<label class="fixed-width" for="settings-ie">Internet Explorer</label>
					<input type="text" id="settings-ie" name="ie" value="<?php esc_attr_e(get_option('ie')); ?>" />
					<br />
					<label class="fixed-width" for="settings-firefox">Mozilla Firefox</label>
					<input type="text" id="settings-firefox" name="firefox" value="<?php esc_attr_e(get_option('firefox')); ?>" />
					<br />
					<label class="fixed-width" for="settings-chrome">Google Chrome</label>
					<input type="text" id="settings-chrome" name="chrome" value="<?php esc_attr_e(get_option('chrome')); ?>" />
					<br />
					<label class="fixed-width" for="settings-safari">Apple Safari</label>
					<input type="text" id="settings-safari" name="safari" value="<?php esc_attr_e(get_option('safari')); ?>" />
					<br />
					<label class="fixed-width" for="settings-opera">Opera</label>
					<input type="text" id="settings-opera" name="opera" value="<?php esc_attr_e(get_option('opera')); ?>" />
					
					<h3>Java Runtime Environment (JRE)</h3>
					
					<p>Enter the <strong>minimum</strong> version number of the JRE to check against. If left blank or with value of 0, it will not be checked.</p>
					
					<label for="settings-jre">Version </label>
					<input type="text" id="settings-jre" name="jre" value="<?php esc_attr_e(get_option('jre')); ?>" />
					
					<h3>Adobe Flash Player</h3>
					
					<p>Enter the <strong>minimum</strong> version number of the Adobe Flash Player to check against. If left blank or with value of 0, it will not be checked.</p>
					
					<label id="settings-flash">Version </label>
					<input type="text" id="settings-flash" name="flash" value="<?php esc_attr_e(get_option('flash')); ?>" />
					
					<h3>Cookie</h3>
					<label>Check for cookie? <input type="checkbox" name="cookie" value="1" <?php checked('1', get_option('cookie')); ?> /> </label>
					
					<h3>JavaScript</h3>
					<label>Check for JavaScript? <input type="checkbox" name="js" value="1" <?php checked('1', get_option('js')); ?> /></label>
				
				</div>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'system_requirements_check' ); ?>" />
				</p>
				
		    </form>
		</div>
		<?php
	}
	
} // end class System_Requirements_Check_Settings