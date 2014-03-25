var flashVersion = swfobject.getFlashPlayerVersion();
var installedVersion = flashVersion.major.toString() + "." + flashVersion.minor.toString() + "." + flashVersion.release.toString();
var checkedVersion = document.getElementById('checkFL').value;

if (installedVersion === undefined || installedVersion === "0.0.0") {

    document.write("<div class=\"callout danger\"><p><span class=\"icon-danger big\"></span><strong>Adobe Flash Player is not installed or enabled!</strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <span class=\"icon-link\"></span><a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">install</a> or <span class=\"icon-link\"></span><a href=\"http://helpx.adobe.com/flash-player.html\" target=\"_blank\">enabled</a> Adobe Flash Player.</p></div>");

} else if (checkedVersion <= installedVersion) {

    document.write("<div class=\"callout success\"><p><span class=\"icon-checkmark big\"></span><strong>Adobe Flash Player ("+installedVersion+") is enabled!</strong></p></div>");

} else {

    document.write("<div class=\"callout warning\"><p><span class=\"icon-warning big\"></span><strong>Adobe Flash Player ("+installedVersion+") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Adobe Flash Player version <strong>"+checkedVersion+" or greater</strong> is required. Please <span class=\"icon-link\"></span><a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">update</a> Adobe Flash Player.</p></div>");

}