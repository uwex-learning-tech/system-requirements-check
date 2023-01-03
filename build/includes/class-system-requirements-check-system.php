<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

/**
 * System_Requirements_Check_System class
 */
class System_Requirements_Check_System {

    private $agent;
    private $os_array;
    private $bro_array;
    
    /**
     * constructor
     *
     * @param none
     * @return none
     *
     */
    public function __construct() {
    
        $this->agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $this->os_array = array(
            '/windows nt 10.0/i',
            '/windows nt 6.3/i',
            '/windows nt 6.2/i',
            '/windows nt 6.1/i',
            '/windows nt 6.0/i',
            '/windows nt 5.1/i',
            '/macintosh|mac os x/i',
            '/linux/i'
        );      
        $this->bro_array = array(
            'firefox',
            'msie',
            'trident',
            'edge|edg',
            'opera',
            'chrome|crios',
            'safari'
        );
                
    }
    
    /**
     * getOS function
     *
     * @param none
     * @return string
     *
     */
    public function getAgent() {
    
        return $this->agent;
    
    }
    
    /**
     * getOS function
     *
     * @param none
     * @return string
     *
     */
    public function getOS() {
    
        $os_platform  = '';
    
        foreach ($this->os_array as $value) { 
    
            if (preg_match($value, $this->agent)) {
    
                $os_platform = $value;
    
            }
    
        }
    
        return $os_platform;
    
    }
    
    /**
     * getBrowser function
     *
     * @param none
     * @return array
     *
     */
    public function getBrowser() {
    
        $browser  = array();
    
        foreach($this->bro_array as $bro) {
    
            if (preg_match("#($bro)#", $this->agent, $matchBroswer)) {
                
                if ($matchBroswer[0] == "crios") {
                    $browser[] = "chrome";
                } else if ($matchBroswer[0] == "edg") {
                    $browser[] = "edge";
                } else {
                    $browser[] = $matchBroswer[0];
                }
                
                if (preg_match("#(($bro)|(version))[/ ]?([0-9.]*)".(($bro=='opera')?'$':'')."#", $this->agent, $matchVersion)) {
                    //var_dump($matchVersion);
                    $browser[] = $matchVersion[4];
                }
                
                break;
    
            }
    
        }
    
        return $browser;
    
    }

} // end class