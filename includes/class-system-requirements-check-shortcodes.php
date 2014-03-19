<?php

if (!defined('ABSPATH'))
	exit; // exit if accessed directly

/**
 * System_Requirements_Check_Shortcode class
 */
class System_Requirements_Check_Shortcode {
	
	/**
	 * __construct function
	 *
	 * @access public
	 * @return void
	 */
	 public function __construct() {
		 
		 add_shortcode('requirements_check_all', array($this,'check_system_requirements'));
		 add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
		 
	 }
	 
	 /**
	  * syc handler function
	  *
	  * @access public
	  * @param mixed $args
	  * @return void
	  */
	 public function check_system_requirements() {
	 	
	 	$os = array('/windows nt 6.0/i'		=> prep_option(get_option('windows_vista')),
		 			'/windows nt 6.1/i'		=> prep_option(get_option('windows_7')),
		 			'/windows nt 6.2/i'		=> prep_option(get_option('windows_8')),
		 			'/windows nt 6.3/i'		=> prep_option(get_option('windows_81')),
		 			'/macintosh|mac os x/i'	=> prep_option(get_option('mac'))
		 			);
		 			
		$browser = array('ie'		=> prep_option(get_option('ie')),
						 'firefox'	=> prep_option(get_option('firefox')),
						 'chrome'	=> prep_option(get_option('chrome')),
						 'safari'	=> prep_option(get_option('safari')),
						 'opera'	=> prep_option(get_option('opera'))
		 				);
		 				
		$jre = prep_option(get_option('jre'));
		$cookie	= prep_option(get_option('cookie'));
		$js = prep_option(get_option('js'));
		$flash = prep_option(get_option('flash'));
		
		$osMSG = $this->checkOS($os);
		
		return $osMSG;
		 
	 }
	 
	 /**
	  * getOSMSG function
	  *
	  * @access protected
	  * @param mixed $args
	  * @return string
	  *
	  */
	 public function checkOS($arr) {
		 
		 $found = false;
		 
		 foreach($arr as $key => $value) {
		 
		 	if (preg_match($key, $_SERVER['HTTP_USER_AGENT']) && $value == '1') {
			 	$found = true;
			 	break;
			}
			
		 }
		 
		 if ($found) {
			 return '<div class="system_req_check callout success"><p><span class="icon-thumbsup big"></span> <strong>' . getOS() . '</strong></p><p>Your operating system met the requirement.</p></div>';
		 } else {
			 return '<div class="system_req_check callout danger"><p><span class="icon-danger big"></span> <strong>Your operating system does not meet the requirement!</strong></p><p>Recommend operating systems: ' . $this->recommendedOS() . '</p></div>';
		 }
		 
	 }
	 
	 public function recommendedOS() {

        $result = array();
        $os = '';
        
        if (prep_option(get_option('windows_vista')) == '1') {
            $result[] = 'Windows Vista';
        }
        
        if (prep_option(get_option('windows_7')) == '1') {
            $result[] = 'Windows 7';
        }
        
        if (prep_option(get_option('windows_8')) == '1') {
            $result[] = 'Windows 8';
        }
        
        if (prep_option(get_option('windows_81')) == '1') {
            $result[] = 'Windows 8.1';
        }
        
        if (prep_option(get_option('mac')) == '1') {
            $result[] = 'Mac OS X';
        }
        
        for ($i = 0; $i < count($result); $i++) {
            $os .= '<li>' . $result[$i] . '</li>';
        }
        
        return '<ul>' . $os .'</ul>';
    	 
	 }
	 
	 /**
	 * Register and enqueue scripts and css
	 */
	public function frontend_scripts() {
		wp_enqueue_style('system-requirements-check-frontend', '' . SYSTEM_REQ_URL . '/assets/css/system-requirements-check-frontend.css');
		
	}
	 
	
} // end class System_Requirements_Check_Shortcode

new System_Requirements_Check_Shortcode();