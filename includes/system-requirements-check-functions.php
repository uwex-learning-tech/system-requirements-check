<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function prep_option($arg) {

    if (empty($arg)) return '0';
    
    $arg = trim($arg);
    $arg = htmlentities($arg, ENT_QUOTES);
    return $arg;

}

function getOS() {

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array = array('/windows nt 6.3/i'     =>  'Windows 8.1',
                      '/windows nt 6.2/i'     =>  'Windows 8',
                      '/windows nt 6.1/i'     =>  'Windows 7',
                      '/windows nt 6.0/i'     =>  'Windows Vista',
                      '/macintosh|mac os x/i' =>  'Mac OS X'
                      );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {

            $os_platform = $value;

        }

    }

    return $os_platform;
    
}

function getBrowser() {

    // http://www.php.net/get_browser
    global $user_agent;

    $browser = get_browser(null,true);
    $broswerInfo = array('browser' => $browser['browser'],
                         'major' => $browser['majorver'],
                         'version' => $browser['version'],
                         'minor' => $browser['minorver']);

    return $browser['version'];

}

?>