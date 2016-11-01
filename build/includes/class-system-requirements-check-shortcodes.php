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

        $osToCheck = array(
                           '/windows nt 5.1/i'     => prep(get_option('windows_xp')),
                           '/windows nt 6.0/i'     => prep(get_option('windows_vista')),
                           '/windows nt 6.1/i'     => prep(get_option('windows_7')),
                           '/windows nt 6.2/i'     => prep(get_option('windows_8')),
                           '/windows nt 6.3/i'     => prep(get_option('windows_81')),
                           '/windows nt 10.0/i'    => prep(get_option('windows_10')),
                           '/macintosh|mac os x/i' => prep(get_option('mac'))
                          );
        $agent = $GLOBALS['system_to_check']->getAgent();
        $os = '';
        $icon = '';
        $found = false;

        foreach($osToCheck as $key => $value) {

            if (preg_match($key, $agent) && $value == '1') {

            switch($key) {
                case '/windows nt 5.1/i':
                $icon = '<span class="icon-windows big"></span>';
                $os = 'Windows XP';
                break;
                case '/windows nt 6.0/i':
                $icon = '<span class="icon-windows big"></span>';
                $os = 'Windows Vista';
                break;
                case '/windows nt 6.1/i':
                $icon = '<span class="icon-windows big"></span>';
                $os = 'Windows 7';
                break;
                case '/windows nt 6.2/i':
                $icon = '<span class="icon-windows8 big"></span>';
                $os = 'Windows 8';
                break;
                case '/windows nt 6.3/i':
                $icon = '<span class="icon-windows8 big"></span>';
                $os = 'Windows 8.1';
                break;
                case '/windows nt 10.0/i':
                $icon = '<span class="icon-windows8 big"></span>';
                $os = 'Windows 10';
                break;
                case '/macintosh|mac os x/i':
                $icon = '<span class="icon-apple big"></span>';
                $os = 'Mac OS X';
                break;
                case '/linux/i':
                $icon = '<span class="icon-linux big"></span>';
                $os = 'Linux';
                break;
            }

            $found = true;
            break;

            }

        }

        if ($found) {

            return '<div class="callout success"><p><span class="icon-checkmark big green"></span><strong>' . $icon . $os . '</strong></p>' . $this->recommendOS(false,$os) . '</div>';

        } else {

            return '<div class="callout danger"><p><span class="icon-danger big red"></span><strong>Your operating system does not meet the requirement!</strong></p><p>Recommended operating systems:' . $this->recommendOS(true) . '</p></div>';

        }

    }

	/**
     * recommendOS function
     *
     * @access public
     * @return string
     *
     */
    public function recommendOS($i=false, $system='') {

        $result = array();
        $os = '';
        $ico = ($i) ? "big" : "";

        if ($i) {

            if (prep(get_option('windows_xp')) == '1') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows XP';
            }

            if (prep(get_option('windows_vista')) == '1') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows Vista';
            }

            if (prep(get_option('windows_7')) == '1') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows 7';
            }

            if (prep(get_option('windows_8')) == '1') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 8';
            }

            if (prep(get_option('windows_81')) == '1') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 8.1';
            }
            
            if (prep(get_option('windows_10')) == '1') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 10';
            }

            if (prep(get_option('mac')) == '1') {
                $result[] = '<span class="icon-apple '.$ico.'"></span> Mac OS X';
            }
            
            if (prep(get_option('linux')) == '1') {
                $result[] = '<span class="icon-linux '.$ico.'"></span> Linux';
            }

        } else {

            if (prep(get_option('windows_xp')) == '1') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows XP';
            }

            if (prep(get_option('windows_vista')) == '1' && $system != 'Windows Vista') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows Vista';
            }

            if (prep(get_option('windows_7')) == '1' && $system != 'Windows 7') {
                $result[] = '<span class="icon-windows '.$ico.'"></span> Windows 7';
            }

            if (prep(get_option('windows_8')) == '1' && $system != 'Windows 8') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 8';
            }

            if (prep(get_option('windows_81')) == '1' && $system != 'Windows 8.1') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 8.1';
            }
            
            if (prep(get_option('windows_10')) == '1' && $system != 'Windows 10') {
                $result[] = '<span class="icon-windows8 '.$ico.'"></span> Windows 10';
            }

            if (prep(get_option('mac')) == '1' && $system != 'Mac OS X') {
                $result[] = '<span class="icon-apple '.$ico.'"></span> Mac OS X';
            }
            
            if (prep(get_option('linux')) == '1' && $system != 'Linux') {
                $result[] = '<span class="icon-linux '.$ico.'"></span> Linux';
            }

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
                                '/edge/i'           => prep(get_option('edge')),
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
                    $browser = 'Internet Explorer';
                    break;
                    case 'edge':
                    $icon = '<span class="icon-ie big"></span>';
                    $browser = 'Microsoft Edge';
                    break;
                    case 'firefox':
                    $icon = '<span class="icon-firefox big"></span>';
                    $browser = 'Firefox';
                    break;
                    case 'chrome':
                    $icon = '<span class="icon-chrome big"></span>';
                    $browser = 'Chrome';
                    break;
                    case 'opera':
                    $icon = '<span class="icon-opera big"></span>';
                    $browser = 'Opera';
                    break;
                    case 'safari':
                    $icon = '<span class="icon-safari big"></span>';
                    $browser = 'Safari';
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

                return '<div class="callout success"><p><span class="icon-checkmark big green"></span><strong>' . $icon . $browser . ' ('.$version.')' . '</strong></p>' . $this->recommendBrowser(false,$browser) . '</div>';

            } else {

                return '<div class="callout warning"><p><span class="icon-warning big yellow"></span><strong>' . $icon . $browser . ' (' . $clientBrowser[1] . ') - <span class="warning">UPDATE REQUIRED</span></strong></p><p>Your web browser browser is outdated. Please update <strong>' . $browser . '</strong> to version <strong>' .$version.' or greater</strong>.</p></div>';

            }

        } else {

            return '<div class="callout danger"><p><span class="icon-danger big red"></span><strong>Your web browser is not supported!</strong></p><p>Please try using any of the following web browsers:'. $this->recommendBrowser() .'</p></div>';

        }

    }

    /**
     * recommendBrowser function
     *
     * @access public
     * @return string
     *
     */
    public function recommendBrowser($i=false, $browser='') {

        $result = array();
        $browsers = '';
        $ico = ($i) ? "big" : "";

        if ($i) {

            if (prep(get_option('ie')) >= '1') {
                $result[] = '<span class="icon-ie '.$ico.'"></span> <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank">Internet Explorer</a><span class="icon-link"></span> <small>(version '. prep(get_option('ie')) .'+)</small>';
            }
            
            if (prep(get_option('edge')) >= '12') {
                $result[] = '<span class="icon-ie '.$ico.'"></span> <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank">Microsoft Edge</a><span class="icon-link"></span>.';
            }
            
            if (prep(get_option('firefox')) >= '1') {
                $result[] = '<span class="icon-firefox '.$ico.'"></span> <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Firefox</a><span class="icon-link"></span> <small>(version '. prep(get_option('firefox')) .'+)</small>';
            }

            if (prep(get_option('chrome')) >= '1') {
                $result[] = '<span class="icon-chrome '.$ico.'"></span> <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Chrome</a><span class="icon-link"></span> <small>(version '. prep(get_option('chrome')) .'+)</small>';
            }

            if (prep(get_option('opera')) >= '1') {
                $result[] = '<span class="icon-opera '.$ico.'"></span> <a href="http://www.opera.com/" target="_blank">Opera</a><span class="icon-link"></span> <small>(version '. prep(get_option('opera')) .'+)</small>';
            }

            if (prep(get_option('safari')) >= '1') {
                $result[] = '<span class="icon-safari '.$ico.'"></span> <a href="https://www.apple.com/safari/" target="_blank">Safari</a><span class="icon-link"></span> <small>(version '. prep(get_option('safari')) .'+)</small>';
            }

        } else {

            if (prep(get_option('ie')) >= '1' && $browser != 'Internet Explorer') {
                $result[] = '<span class="icon-ie '.$ico.'"></span> Internet Explorer '. prep(get_option('ie')) .'+';
            }
            
            if (prep(get_option('edge')) >= '12' && $browser != 'Microsoft Edge') {
                $result[] = '<span class="icon-ie '.$ico.'"></span> Microsoft Edge';
            }

            if (prep(get_option('firefox')) >= '1' && $browser != 'Firefox') {
                $result[] = '<span class="icon-firefox '.$ico.'"></span> Firefox '. prep(get_option('firefox')) .'+';
            }

            if (prep(get_option('chrome')) >= '1' && $browser != 'Chrome') {
                $result[] = '<span class="icon-chrome '.$ico.'"></span> Chrome '. prep(get_option('chrome')) .'+';
            }

            if (prep(get_option('opera')) >= '1' && $browser != 'Opera') {
                $result[] = '<span class="icon-opera '.$ico.'"></span> Opera '. prep(get_option('opera')) .'+';
            }

            if (prep(get_option('safari')) >= '1' && $browser != 'Safari') {
                $result[] = '<span class="icon-safari '.$ico.'"></span> Safari '. prep(get_option('safari')) .'+';
            }

        }



        for ($i = 0; $i < count($result); $i++) {
            $browsers .= '<li>' . $result[$i] . '</li>';
        }

        return '<ul class="browser">' . $browsers .'</ul>';

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

        return '<script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/script/check-js.js"></script><noscript><div class="callout danger"><p><span class="icon-danger big red"></span><span class="icon-javascript big"></span><strong>JavaScript is disabled!</strong> - Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';

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

        return '<script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/script/check-cookies.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big yellow"></span><strong>Cookies check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';

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

        return '<input id="checkJV" type="hidden" value="'.$jre.'" /><script type="text/javascript" src="http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://java.com/js/deployJava.js"></script><script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/script/check-java.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big yellow"></span><span class="icon-java big"></span><strong>Java check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';

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

        return '<input id="checkFL" type="hidden" value="'.$flash.'" /><script src="http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script><script type="text/javascript" src="'.SYSTEM_REQ_URL.'/assets/script/check-flash.js"></script><noscript><div class="callout warning"><p><span class="icon-cancel big yellow"></span><strong>Adobe Flash Player check failed!</strong> - JavaScript is required. Please <a href="http://enable-javascript.com/" target="_blank">enable</a><span class="icon-link"></span> JavaScript!</p></div></noscript>';

    }


    /**
     * Register and enqueue scripts and css
     */
    public function frontend_scripts() {

        wp_enqueue_style('system-requirements-check-frontend', '' . SYSTEM_REQ_URL . '/assets/css/system-requirements-check-frontend.css');

    }

} // end class System_Requirements_Check_Shortcode

new System_Requirements_Check_Shortcode();