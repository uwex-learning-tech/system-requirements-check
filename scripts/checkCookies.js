$(document).ready( function() {
    
    if (navigator.cookieEnabled) {
    
        $( ".system_req_check" ).append( "<div class=\"callout success\"><p><span class=\"icon-checkmark big green\"></span><strong>Cookies are enabled!</strong></p></div>" );
    
    } else {
        
        $( ".system_req_check" ).append( "<div class=\"callout danger\"><p><span class=\"icon-danger big red\"></span><strong>Cookies are disabled!</strong> - Please <a href=\"http://www.wikihow.com/Enable-Cookies-in-Your-Internet-Web-Browser\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> cookies.</p></div>" );
    
    }
    
} );