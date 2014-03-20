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
		 
		 // function lib
         include_once('system-requirements-check-functions.php');
		 include_once('class-system-requirements-check-system.php');
		 add_shortcode('system_requirements_check', array($this,'check_system_requirements'));
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
	 	
	 	$system = new System_Requirements_Check_System();
	 	
	 	$os = array('/windows nt 6.0/i'		=> prep(get_option('windows_vista')),
		 			'/windows nt 6.1/i'		=> prep(get_option('windows_7')),
		 			'/windows nt 6.2/i'		=> prep(get_option('windows_8')),
		 			'/windows nt 6.3/i'		=> prep(get_option('windows_81')),
		 			'/macintosh|mac os x/i'	=> prep(get_option('mac'))
		 			);
		 			
		$browser = array('/msie|trident/'		=> prep(get_option('ie')),
						 '/firefox/'	=> prep(get_option('firefox')),
						 '/chrome/'	=> prep(get_option('chrome')),
						 '/safari/'	=> prep(get_option('safari')),
						 '/opera/'	=> prep(get_option('opera'))
		 				);
		 				
		$jre = prep(get_option('jre'));
		$cookie	= prep(get_option('cookie'));
		$js = prep(get_option('js'));
		$flash = prep(get_option('flash'));
		
		$osCallout = $this->checkOS($os,$system);
		$broCallout = $this->checkBro($browser,$system);
		$javaCallout = $this->checkJAVA($jre,$system);
		$jsCallout = ($js == 1) ? $system->getJS() : '';
		$cookieCallout = ($cookie == 1) ? $system->getCookie() : '';
		$flashCallout = $this->checkFlash($flash,$system);
		
		return $osCallout . $broCallout . $jsCallout . $cookieCallout . $javaCallout . $flashCallout;
		 
	 }
	 
	 /**
	  * checkOS function
	  *
	  * @access protected
	  * @param mixed $args
	  * @return string
	  *
	  */
	 public function checkOS($arr,$os) {
		 
		 $found = false;
		 
		 foreach($arr as $key => $value) {
		 
		 	if (preg_match($key, $os->getAgent()) && $value == '1') {
			 	$found = true;
			 	break;
			}
			
		 }
		 
		 if ($found) {
			 return '<div class="system_req_check callout success"><p><span class="icon-thumbsup big"></span> <strong>' . $os->getOS() . '</strong> - Your operating system met the requirement.</p></div>';
		 } else {
			 return '<div class="system_req_check callout danger"><p><span class="icon-danger big"></span> <strong>Your operating system does not meet the requirement!</strong></p><p>Recommend operating systems: ' . $this->recommendedOS() . '</p></div>';
		 }
		 
	 }
	 
	 public function recommendedOS() {

        $result = array();
        $os = '';
        
        if (prep(get_option('windows_vista')) == '1') {
            $result[] = 'Windows Vista';
        }
        
        if (prep(get_option('windows_7')) == '1') {
            $result[] = 'Windows 7';
        }
        
        if (prep(get_option('windows_8')) == '1') {
            $result[] = 'Windows 8';
        }
        
        if (prep(get_option('windows_81')) == '1') {
            $result[] = 'Windows 8.1';
        }
        
        if (prep(get_option('mac')) == '1') {
            $result[] = 'Mac OS X';
        }
        
        for ($i = 0; $i < count($result); $i++) {
            $os .= '<li>' . $result[$i] . '</li>';
        }
        
        return '<ul>' . $os .'</ul>';
    	 
	 }
	 
	 /**
	  * checkBro function
	  *
	  * @access protected
	  * @param mixed $args
	  * @return string
	  *
	  */
	 public function checkBro($arr,$os) {
		 
		 $found = false;
		 $correctVersion = false;
		 $clientBrowser = $os->getBrowser();
		 $browser = '';
		 $version = '';
		 
		 foreach($arr as $key => $value) {
		 
		 	if (preg_match($key, $clientBrowser[0])) {
			 	
			 	if ($value <= 0) {
    			 	$found = false;
                    break;
			 	}
			 	
			 	$browser = $clientBrowser[0];
                switch($browser) {
                    case 'trident':
                    case 'msie':
                    $browser = 'Microsoft Internet Explorer';
                    break;
                    case 'firefox':
                    $browser = 'Mozilla Firefox';
                    break;
                    case 'chrome':
                    $browser = 'Google Chrome';
                    break;
                    case 'opera':
                    $browser = 'Opera';
                    break;
                    case 'safari':
                    $browser = 'Apple Safari';
                    break;
                    default:
                    $browser = 'Unsupported Web Browser';
                    break;
                }
			 	
			 	if ($clientBrowser[0] != 'trident') {
                    if ($clientBrowser[1] >= $value) {
                        $version = $clientBrowser[1];
                        $correctVersion = true;
                    } else {
                        $version = $value;
                    }
			 	} else {
                    if ($clientBrowser[1] >= '7') {
                        $version = 11;
                        $correctVersion = true;
                    }
			 	}
			 	
			 	$found = true;
			 	break;
			}
			
		 }
		 
		 if ($found) {
		    
		    if ($correctVersion) {
    		    return '<div class="system_req_check callout success"><p><span class="icon-thumbsup big"></span><strong>' . $browser . ' ('.$version.')' . '</strong> - Your web browser met the requirement.</p></div>';
		    } else {
    		    return '<div class="system_req_check callout warning"><p><span class="icon-warning big"></span><strong>' . $browser . ' (' . $clientBrowser[1] . ') - <span class="warning">UPDATE REQUIRED</span></strong></p><p>Your web browser browser is outdated. Please update ' . $browser . ' to version <strong>' .$version.' or greater</strong>.</p></div>';
		    }
			 
		 } else {
			 return '<div class="system_req_check callout danger"><p><span class="icon-danger big"></span><strong>Your web browser is not supported!</strong></p><p>Please try using any of the following web browsers:'. $this->recommenedBrowser() .'</p></div>';
		 }
		 
	 }
	 
	 public function recommenedBrowser() {

        $result = array();
        $bro = '';
        
        if (prep(get_option('ie')) >= '1') {
            $result[] = '<span class="icon-link"></span><a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank">Microsoft Internet Explorer</a> version '. prep(get_option('ie')) .' or greater';
        }
        
        if (prep(get_option('firefox')) >= '1') {
            $result[] = '<span class="icon-link"></span><a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Mozilla Firefox</a> version '. prep(get_option('firefox')) .' or greater';
        }
        
        if (prep(get_option('chrome')) >= '1') {
            $result[] = '<span class="icon-link"></span><a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Google Chrome</a> version '. prep(get_option('chrome')) .' or greater';
        }
        
        if (prep(get_option('opera')) >= '1') {
            $result[] = '<span class="icon-link"></span><a href="http://www.opera.com/" target="_blank">Opera</a> version '. prep(get_option('opera')) .' or greater';
        }
        
        if (prep(get_option('safari')) >= '1') {
            $result[] = '<span class="icon-link"></span><a href="https://www.apple.com/safari/" target="_blank">Apple Safari</a> version '. prep(get_option('safari')) .' or greater';
        }
        
        for ($i = 0; $i < count($result); $i++) {
            $bro .= '<li>' . $result[$i] . '</li>';
        }
        
        return '<ul>' . $bro .'</ul>';
    	 
	 }
	 
	 public function checkJAVA($ver,$sys) {
	    if ($ver <= 0) {
    	    return null;
	    }
	    return $sys->getJAVA($ver);
	 }
	 
	 public function checkFlash($ver, $sys) {
    	 if ($ver <= 0) {
    	    return null;
	    }
	    return $sys->getFlash($ver);
	 }
	 
	 
	 /**
	 * Register and enqueue scripts and css
	 */
	public function frontend_scripts() {
		wp_enqueue_style('system-requirements-check-frontend', '' . SYSTEM_REQ_URL . '/assets/css/system-requirements-check-frontend.css');
		
	}
	 
	
} // end class System_Requirements_Check_Shortcode

new System_Requirements_Check_Shortcode();