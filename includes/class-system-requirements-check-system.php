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
        
        $this->os_array = array('/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/macintosh|mac os x/i' =>  'Mac OS X'
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
    
    /**
     * getJAVA function
     *
     * @param none
     * @return string
     *
     */
     public function getJAVA($ver) {
         
         return '<script type="text/javascript" src="http://java.com/js/deployJava.js"></script> <script type="text/javascript"> var installedVersion = deployJava.getJREs(); var checkVersion = "'.$ver.'"; if (installedVersion === undefined || installedVersion.length === 0) { document.write("<div class=\"system_req_check callout danger\"><p><span class=\"icon-danger big\"></span><strong>Java is not installed or enabled!</strong></p><p>Java version <strong>"+checkVersion+" or greater</strong> is required. Please <span class=\"icon-link\"></span><a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">install</a> or <span class=\"icon-link\"></span><a href=\"http://java.com/en/download/help/enable_browser.xml\" target=\"_blank\">enable</a> Java.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small></p></div>"); } else if (installedVersion[0] >= checkVersion.toString() ) { document.write("<div class=\"system_req_check callout success\"><p><span class=\"icon-thumbsup big\"></span><strong>Java ("+installedVersion[0]+") is enabled!</strong></p></div>"); } else { document.write("<div class=\"system_req_check callout warning\"><p><span class=\"icon-warning big\"></span><strong>Java ("+installedVersion+") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Java version <strong>"+checkVersion+" or greater</strong> is required. Please update <span class=\"icon-link\"></span><a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">Java</a>.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small></div>"); } </script>';
         
     }
     
     /**
     * getJS function
     *
     * @param none
     * @return string
     *
     */
     public function getJS() {
         
         return '<script type="text/javascript">document.write("<div class=\"system_req_check callout success\"><p><span class=\"icon-thumbsup big\"></span><strong>JavaScript is enabled!</strong></p></div>");</script><noscript><div class="system_req_check callout danger"><p><span class="icon-danger big"></span><strong>JavaScript is disabled!</strong> - Please <span class="icon-link"></span><a href="http://enable-javascript.com/" target="_blank">enabled</a> JavaScript!</p></div></noscript>';
         
     }
     
     /**
     * getCookie function
     *
     * @param none
     * @return string
     *
     */
     public function getCookie() {
         
         return '<script type="text/javascript">if (navigator.cookieEnabled) { document.write("<div class=\"system_req_check callout success\"><p><span class=\"icon-thumbsup big\"></span><strong>Cookie is enabled!</strong></p></div>"); } else { document.write("<div class=\"system_req_check callout danger\"><p><span class=\"icon-danger big\"></span><strong>Cookie is disabled!</strong> - Please <span class=\"icon-link\"></span><a href=\"http://www.wikihow.com/Enable-Cookies-in-Your-Internet-Web-Browser\" target=\"_blank\">enable</a> cookie.</p></div>") }</script>';
         
     }
     
     /**
     * getCookie function
     *
     * @param none
     * @return string
     *
     */
     public function getFlash($ver) {
         
         return '<script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script><script type="text/javascript">var flashVersion = swfobject.getFlashPlayerVersion(); var installedVersion = flashVersion.major.toString() + "." + flashVersion.minor.toString() + "." + flashVersion.release.toString(); var checkedVersion = "'.$ver.'"; if (installedVersion === undefined || installedVersion === "0.0.0") { document.write("<div class=\"system_req_check callout danger\"><p><span class=\"icon-danger big\"></span><strong>Adobe Flash Player is not installed or enabled!</strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <span class=\"icon-link\"></span><a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">install</a> or <span class=\"icon-link\"></span><a href=\"http://helpx.adobe.com/flash-player.html\" target=\"_blank\">enabled</a> Adobe Flash Player.</p></div>"); } else if (checkedVersion <= installedVersion) { document.write("<div class=\"system_req_check callout success\"><p><span class=\"icon-thumbsup big\"></span><strong>Adobe Flash Player ("+installedVersion+") is enabled!</strong></p></div>"); } else { document.write("<div class=\"system_req_check callout warning\"><p><span class=\"icon-warning big\"></span><strong>Adobe Flash Player ("+installedVersion+") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <span class=\"icon-link\"></span><a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">update</a> Adobe Flash Player.</p></div>"); } </script>';
         
     }
     
     

} // end class




