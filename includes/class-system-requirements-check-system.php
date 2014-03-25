<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly


/**
 * System_Requirements_Check_System class
 */
class System_Requirements_Check_System {

    private $agent;
    private $os_array;
    private $bro_array;
    
    public function __construct() {
    
        $this->agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
        $this->os_array = array('/windows nt 6.3/i'     =>  '<span class="icon-windows8 big"></span>Windows 8.1',
                                '/windows nt 6.2/i'     =>  '<span class="icon-windows8 big"></span>Windows 8',
                                '/windows nt 6.1/i'     =>  '<span class="icon-windows big"></span>Windows 7',
                                '/windows nt 6.0/i'     =>  '<span class="icon-windows big"></span>Windows Vista',
                                '/macintosh|mac os x/i' =>  '<span class="icon-apple big"></span>Mac OS X'
                                );
                                
        $this->bro_array = array('firefox','msie', 'trident', 'opera','chrome','safari');
                                
    }
    
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
    
        $os_platform  = "Unsupported Operating System";

        foreach ($this->os_array as $regex => $value) { 
        
            if (preg_match($regex, $this->agent)) {
            
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
        
            if (preg_match("#($bro)[/ ]?([0-9.]*)#", $this->agent, $match)) {
            
                $browser[] = $match[1];
                $browser[] = $match[2];
                break;
                
            }
            
        }
        
        return $browser;
        
    } 

} // end class




