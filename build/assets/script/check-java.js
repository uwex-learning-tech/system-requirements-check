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
    
    if ( installedVersion[0] !== undefined ) {
        
        var installed = installedVersion[0].replace(/[^0-9]/gi, '');
        var target = checkVersion.replace(/[^0-9]/gi, '');
        
        if ( installed >= target ) {
    
            if ( node.classList ) {
                node.classList.add( 'success' );
            } else {
                node.className += ' success';
            }
            
            node.innerHTML = "<p><span class=\"icon-checkmark big green\"></span><span class=\"icon-java big\"></span><strong>Java (" + installedVersion[0] + ") is installed!</strong></p><p class='notes'><strong>Notes:</strong> for Safari users, Java may not be enabled even it is installed. Please double check your Safari Preferences.</p>";
            
        } else {
        
            if ( node.classList ) {
                node.classList.add( 'warning' );
            } else {
                node.className += ' warning';
            }
            
            node.innerHTML = "<p><span class=\"icon-warning big yellow\"></span><span class=\"icon-java big\"></span><strong>Java (" + installedVersion[0] + ") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Java version <strong>" + checkVersion + " or greater</strong> is required. Please update <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">Java</a><span class=\"icon-link\"></span>.<p class='notes'><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</p>";
            
        }
        
    } else {
        
        if ( node.classList ) {
            node.classList.add( 'danger' );
        } else {
            node.className += ' danger';
        }
        
        node.innerHTML = "<p><span class=\"icon-danger big red\"></span><span class=\"icon-java big\"></span><strong>Java is not installed or enabled!</strong></p><p>Java version <strong>" + checkVersion + " or greater</strong> is required. Please <a href=\"http://java.com/en/download/help/index_installing.xml\" target=\"_blank\">install</a><span class=\"icon-link\"></span> or <a href=\"http://java.com/en/download/help/enable_browser.xml\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> Java.</p><p class='notes'><strong>Note:</strong> Java 7 (version 1.7.0 or greater) is not supported by 32-bit Google Chrome.</p>";
        
    }
    
} );