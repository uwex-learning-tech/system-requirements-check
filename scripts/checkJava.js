$(document).ready( function() {

    var installedVersion = deployJava.getJREs();
    var checkVersion = document.getElementById('checkJV').value;
    
    if (installedVersion === undefined || installedVersion.length === 0) {
    
        $( ".system_req_check" ).append("<div class=\"callout danger\"><p><span class=\"icon-danger big red\"></span><span class=\"icon-java big\"></span><strong>Java is not installed or enabled!</strong></p><p>Java version <strong>"+checkVersion+" or greater</strong> is required. Please <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">install</a><span class=\"icon-link\"></span> or <a href=\"http://java.com/en/download/help/enable_browser.xml\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> Java.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small></p></div>");
        
    } else if (installedVersion[0] >= checkVersion.toString()) {
    
        $( ".system_req_check" ).append("<div class=\"callout success\"><p><span class=\"icon-checkmark big green\"></span><span class=\"icon-java big\"></span><strong>Java ("+installedVersion[0]+") is enabled!</strong></p></div>");
        
    } else {
    
        $( ".system_req_check" ).append("<div class=\"callout warning\"><p><span class=\"icon-warning big yellow\"></span><span class=\"icon-java big\"></span><strong>Java ("+installedVersion+") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Java version <strong>"+checkVersion+" or greater</strong> is required. Please update <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">Java</a><span class=\"icon-link\"></span>.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small></div>");
        
    }

} );
