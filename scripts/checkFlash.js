$(document).ready( function() {
    
    var flashVersion = swfobject.getFlashPlayerVersion();
    var installedVersion = flashVersion.major.toString() + "." + flashVersion.minor.toString() + "." + flashVersion.release.toString();
    var checkedVersion = document.getElementById('checkFL').value;
    
    if (installedVersion === undefined || installedVersion === "0.0.0") {
    
        $( ".system_req_check" ).append("<div class=\"callout danger\"><p><span class=\"icon-danger big red\"></span><strong>Adobe Flash Player is not installed or enabled!</strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">install</a><span class=\"icon-link\"></span> or <a href=\"http://helpx.adobe.com/flash-player.html\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> Adobe Flash Player.</p></div>");
    
    } else if (checkedVersion <= installedVersion) {
    
        $( ".system_req_check" ).append("<div class=\"callout success\"><p><span class=\"icon-checkmark big green\"></span><strong>Adobe Flash Player ("+installedVersion+") is enabled!</strong></p></div>");
    
    } else {
    
        $( ".system_req_check" ).append("<div class=\"callout warning\"><p><span class=\"icon-warning big yellow\"></span><strong>Adobe Flash Player ("+installedVersion+") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">update</a><span class=\"icon-link\"></span> Adobe Flash Player.</p></div>");
    
    }
    
} );

