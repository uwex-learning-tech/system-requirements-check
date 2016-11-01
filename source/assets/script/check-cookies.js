function ready( fn ) {
    
    if ( document.readyState !== 'loading' ) {
        fn();
    } else if ( document.addEventListener ) {
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
    
    var systemRC = document.getElementsByClassName( 'system_req_check' )[0];
    var node = document.createElement( 'div' );
    
    if ( node.classList ) {
        node.classList.add( 'callout' );
    } else {
        node.className += ' callout';
    }
    
    systemRC.appendChild( node );
    
    if ( navigator.cookieEnabled ) {
        
        if ( node.classList ) {
            node.classList.add( 'success' );
        } else {
            node.className += ' success';
        }
        
        node.innerHTML = "<p><span class=\"icon-checkmark big green\"></span><strong>Cookies are enabled!</strong></p>";
    
    } else {
        
        if ( node.classList ) {
            node.classList.add( 'danger' );
        } else {
            node.className += ' danger';
        }
        
        node.innerHTML = "<p><span class=\"icon-danger big red\"></span><strong>Cookies are disabled!</strong> - Please <a href=\"http://www.wikihow.com/Enable-Cookies-in-Your-Internet-Web-Browser\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> cookies.</p>";
    
    }
    
} );