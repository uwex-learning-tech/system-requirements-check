<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

/**
 * System_Requirements_Check_Shortcode class
 */
class System_Requirements_Check_Shortcode {
	
    /**
     * __construct function
     *
     * @access public
     * @return void
     *
     */
    public function __construct() {
    
        // includes
        include_once('system-requirements-check-functions.php');
        include_once('class-system-requirements-check-system.php');
        
        $GLOBALS['system_to_check'] = new System_Requirements_Check_System();
        
        // add shortcode
        add_shortcode('system_requirements_check', array($this,'check_system_requirements'));
        
        // add action
        add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
    
    }
	 
    /**
     * syc handler function
     *
     * @access public
     * @return void
     *
     */
    public function check_system_requirements() {
    
        $osCallout = $this->checkOS();
        $browserCallout = $this->checkBrowser();
        $jsCallout = $this->checkJS();
        $cookieCallout = $this->checkCookies();
        $javaCallout = $this->checkJava();
        $flashCallout = $this->checkFlash();
        
        return '<div class="system_req_check">' . $osCallout . $browserCallout . $jsCallout . $cookieCallout . $javaCallout . $flashCallout . '</div>';
    
    }
	 
    /**
     * checkOS function
     *
     * @access public
     * @return string
     *
     */
    public function checkOS() {
    
        $osToCheck = array('/windows nt 6.0/i'     => prep(get_option('windows_vista')),
                           '/windows nt 6.1/i'     => prep(get_option('windows_7')),
                           '/windows nt 6.2/i'     => prep(get_option('windows_8')),
                           '/windows nt 6.3/i'     => prep(get_option('windows_81')),
                           '/macintosh|mac os x/i' => prep(get_option('mac'))
                          );
        $agent = $GLOBALS['system_to_check']->getAgent();    
        $os = '';        
        $found = false;
        
        foreach($osToCheck as $key => $value) {
        
            if (preg_match($key, $agent) && $value == '1') {
            
            switch($key) {
                case '/windows nt 6.0/i':
                $os = '<span class="icon-windows big"></span>Windows Vista';
                break;
                case '/windows nt 6.1/i':
                $os = '<span class="icon-windows big"></span>Windows 7';
                break;
                case '/windows nt 6.2/i':
                $os = '<span class="icon-windows8 big"></span>Windows 8';
                break;
                case '/windows nt 6.3/i':
                $os = '<span class="icon-windows8 big"></span>Windows 8.1';
                break;
                case '/macintosh|mac os x/i':
                $os = '<span class="icon-apple big"></span>Mac OS X';
                break;
            }
            
            $found = true;
            break;
            
            }
        
        }
        
        if ($found) {
        
            return '<div class="callout success"><p><span class="icon-checkmark big"></span><strong>' . $os . '</strong></p></div>';
        
        } else {
        
            return '<div class="callout danger"><p><span class="icon-danger big"></span><strong>Your operating system does not meet the requirement!</strong></p><p>Recommend operating systems: ' . $this->recommendOS() . '</p></div>';
        
        }
    
    }
	
	/**
     * recommendOS function
     *
     * @access public
     * @return string
     *
     */ 
    public function recommendOS() {
    
        $result = array();
        $os = '';
    
        if (prep(get_option('windows_vista')) == '1') {
            $result[] = '<span class="icon-windows big"></span>Windows Vista';
        }
        
        if (prep(get_option('windows_7')) == '1') {
            $result[] = '<span class="icon-windows big"></span>Windows 7';
        }
        
        if (prep(get_option('windows_8')) == '1') {
            $result[] = '<span class="icon-windows8 big"></span>Windows 8';
        }
        
        if (prep(get_option('windows_81')) == '1') {
            $result[] = '<span class="icon-windows8 big"></span>Windows 8.1';
        }
        
        if (prep(get_option('mac')) == '1') {
            $result[] = '<span class="icon-apple big"></span>Mac OS X';
        }
        
        for ($i = 0; $i < count($result); $i++) {
            $os .= '<li>' . $result[$i] . '</li>';
        }
        
        return '<ul class="os">' . $os .'</ul>';
    
    }
	 
    /**
     * checkBrowser function
     *
     * @access protected
     * @return string
     *
     */
    public function checkBrowser() {
    
        $browserToCheck = array('/msie|trident/i'   => prep(get_option('ie')),
                                '/firefox/i'        => prep(get_option('firefox')),
                                '/chrome/i'         => prep(get_option('chrome')),
                                '/safari/i'         => prep(get_option('safari')),
                                '/opera/i'          => prep(get_option('opera'))
                                );
        $found = false;
        $correctVersion = false;
        $clientBrowser = $GLOBALS['system_to_check']->getBrowser();
        $icon = '';
        $browser = '';
        $version = '';
        
        foreach($browserToCheck as $key => $value) {
        
            if (preg_match($key, $clientBrowser[0])) {
            
                if ($value <= 0) {
                    $found = false;
                    break;
                }
                
                $browser = $clientBrowser[0];
                
                switch($browser) {
                    case 'trident':
                    case 'msie':
                    $icon = '<span class="icon-ie big"></span>';
                    $browser = 'Microsoft Internet Explorer';
                    break;
                    case 'firefox':
                    $icon = '<span class="icon-firefox big"></span>';
                    $browser = 'Mozilla Firefox';
                    break;
                    case 'chrome':
                    $icon = '<span class="icon-chrome big"></span>';
                    $browser = 'Google Chrome';
                    break;
                    case 'opera':
                    $icon = '<span class="icon-opera big"></span>';
                    $browser = 'Opera';
                    break;
                    case 'safari':
                    $icon = '<span class="icon-safari big"></span>';
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
            
                return '<div class="callout success"><p><span class="icon-checkmark big"></span><strong>' . $icon . $browser . ' ('.$version.')' . '</strong></p></div>';
                
            } else {
            
                return '<div class="callout warning"><p><span class="icon-warning big"></span><strong>' . $icon . $browser . ' (' . $clientBrowser[1] . ') - <span class="warning">UPDATE REQUIRED</span></strong></p><p>Your web browser browser is outdated. Please update <strong>' . $browser . '</strong> to version <strong>' .$version.' or greater</strong>.</p></div>';
                
            }
        
        } else {
        
            return '<div class="callout danger"><p><span class="icon-danger big"></span><strong>Your web browser is not supported!</strong></p><p>Please try using any of the following web browsers:'. $this->recommendBrowser() .'</p></div>';
        
        }
    
    }
	 
    /**
     * recommendBrowser function
     *
     * @access public
     * @return string
     *
     */
    public function recommendBrowser() {
    
        $result = array();
        $bro = '';
        
        if (prep(get_option('ie')) >= '1') {
            $result[] = '<span class="icon-ie big"></span><a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank">Microsoft Internet Explorer</a><span class="icon-link"></span> <small>(version '. prep(get_option('ie')) .'+)</small>';
        }
        
        if (prep(get_option('firefox')) >= '1') {
            $result[] = '<span class="icon-firefox big"></span><a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Mozilla Firefox</a><span class="icon-link"></span> <small>(version '. prep(get_option('firefox')) .'+)</small>';
        }
        
        if (prep(get_option('chrome')) >= '1') {
            $result[] = '<span class="icon-chrome big"></span><a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Google Chrome</a><span class="icon-link"></span> <small>(version '. prep(get_option('chrome')) .'+)</small>';
        }
        
        if (prep(get_option('opera')) >= '1') {
            $result[] = '<span class="icon-opera big"></span><a href="http://www.opera.com/" target="_blank">Opera</a><span class="icon-link"></span> <small>(version '. prep(get_option('opera')) .'+)</small>';
        }
        
        if (prep(get_option('safari')) >= '1') {
            $result[] = '<span class="icon-safari big"></span><a href="https://www.apple.com/safari/" target="_blank">Apple Safari</a><span class="icon-link"></span> <small>(version '. prep(get_option('safari')) .'+)</small>';
        }
        
        for ($i = 0; $i < count($result); $i++) {
            $bro .= '<li>' . $result[$i] . '</li>';
        }
        
        return '<ul class="browser">' . $bro .'</ul>';
    
    }
	 
    /**
     * checkJS function
     *
     * @access public
     * @param none
     * @return string
     *
     */
    public function checkJS() {
    
        $js = prep(get_option('js'));
    
        if ($js == 0) return '';
    
        return '<script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/js/checkJS.js"></script><noscript><div class="callout danger"><p><span class="icon-danger big"></span><span class="icon-javascript big"></span><strong>JavaScript is disabled!</strong> - Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';
    
    }
    
    /**
     * checkCookies function
     *
     * @access public
     * @param none
     * @return string
     *
     */
    public function checkCookies() {
    
        $cookies = prep(get_option('cookie'));
    
        if ($cookies == 0) return '';
    
        return '<script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/js/checkCookies.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big"></span><strong>Cookies check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';
    
    }
	 
    /**
     * checkJava function
     *
     * @access public
     * @param none
     * @return string
     *
     */
    public function checkJava() {
    
        $jre = prep(get_option('jre'));
        
        if ($jre <= 0) return '';
        
        return '<input id="checkJV" type="hidden" value="'.$jre.'" /><script type="text/javascript" src="http://java.com/js/deployJava.js"></script><script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/js/checkJava.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big"></span><span class="icon-java big"></span><strong>Java check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';
    
    }
	 
    /**
     * checkFlash function
     *
     * @access public
     * @param none
     * @return string
     *
     */
    public function checkFlash() {
    
        $flash = prep(get_option('flash'));
    
        if ($flash <= 0) return '';
    
        return '<input id="checkFL" type="hidden" value="'.$flash.'" /><script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script><script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/js/checkFlash.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big"></span><strong>Adobe Flash Player check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';
    
    }
	 
	 
    /**
     * Register and enqueue scripts and css
     */
    public function frontend_scripts() {
    
        wp_enqueue_style('system-requirements-check-frontend', '' . SYSTEM_REQ_URL . '/assets/css/system-requirements-check-frontend.css');
    
    }

} // end class System_Requirements_Check_Shortcode

new System_Requirements_Check_Shortcode();