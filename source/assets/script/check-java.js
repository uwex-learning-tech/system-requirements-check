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
    var installedVersion = deployJava.getJREs();
    var checkVersion = document.getElementById( 'checkJV' ).value;
    var node = document.createElement( 'div' );
    
    if ( node.classList ) {
            node.classList.add( 'callout' );
    } else {
        node.className += ' callout';
    }
    
    systemRC.appendChild( node );
    
    if ( installedVersion === undefined || installedVersion.length === 0 ) {
        
        if ( node.classList ) {
            node.classList.add( 'danger' );
        } else {
            node.className += ' danger';
        }
        
        node.innerHTML = "<p><span class=\"icon-danger big red\"></span><span class=\"icon-java big\"></span><strong>Java is not installed or enabled!</strong></p><p>Java version <strong>" + checkVersion + " or greater</strong> is required. Please <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">install</a><span class=\"icon-link\"></span> or <a href=\"http://java.com/en/download/help/enable_browser.xml\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> Java.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small></p>";
        
    } else if ( installedVersion[0] >= checkVersion.toString() ) {
    
        if ( node.classList ) {
            node.classList.add( 'success' );
        } else {
            node.className += ' success';
        }
        
        node.innerHTML = "<p><span class=\"icon-checkmark big green\"></span><span class=\"icon-java big\"></span><strong>Java (" + installedVersion[0] + ") is enabled!</strong></p>";
        
    } else {
    
        if ( node.classList ) {
            node.classList.add( 'warning' );
        } else {
            node.className += ' warning';
        }
        
        node.innerHTML = "<p><span class=\"icon-warning big yellow\"></span><span class=\"icon-java big\"></span><strong>Java (" + installedVersion + ") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Java version <strong>" + checkVersion + " or greater</strong> is required. Please update <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">Java</a><span class=\"icon-link\"></span>.<br /><small><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</small>";
        
    }
    
} );