function ready( fn ) {
    
    if ( document.readyState !== 'loading' ) {
        fn();
    } else if ( document.addEventListener() ) {
        document.addEventListener( 'DOMContentLoaded', fn);
    } else {
        document.attachEvent( 'onreadystatechange', function() {
            if ( document.readyState !== 'loading' ) {
                fn();
            }
        } );
    }
    
}

ready( function() {
    
    var systemRC = document.getElementsByClassName( 'system_req_check' );
    
    if ( navigator.cookieEnabled ) {
        
        systemRC.appendChild( "<div class=\"callout success\"><p><span class=\"icon-checkmark big green\"></span><strong>Cookies are enabled!</strong></p></div>" );
    
    } else {
        
        systemRC.appendChild( "<div class=\"callout danger\"><p><span class=\"icon-danger big red\"></span><strong>Cookies are disabled!</strong> - Please <a href=\"http://www.wikihow.com/Enable-Cookies-in-Your-Internet-Web-Browser\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> cookies.</p></div>" );
    
    }
    
} );