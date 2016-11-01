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
    var flashVersion = swfobject.getFlashPlayerVersion();
    var installedVersion = flashVersion.major.toString() + "." 
        + flashVersion.minor.toString() + "." + flashVersion.release.toString();
    var checkedVersion = document.getElementById( 'checkFL' ).value;
    
    if ( node.classList ) {
        node.classList.add( 'callout' );
    } else {
        node.className += ' callout';
    }
    
    systemRC.appendChild( node );
    
    if ( installedVersion === undefined || installedVersion === "0.0.0" ) {
        
        if ( node.classList ) {
            node.classList.add( 'danger' );
        } else {
            node.className += ' danger';
        }
        
        node.innerHTML = "<p><span class=\"icon-danger big red\"></span><strong>Adobe Flash Player is not installed or enabled!</strong></p><p>Adobe Flash Player version <strong>" + checkedVersion + " or greater</strong> is required. Please <a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">install</a><span class=\"icon-link\"></span> or <a href=\"http://helpx.adobe.com/flash-player.html\" target=\"_blank\">enable</a><span class=\"icon-link\"></span> Adobe Flash Player.</p>";
    
    } else if ( checkedVersion <= installedVersion ) {
        
        if ( node.classList ) {
            node.classList.add( 'success' );
        } else {
            node.className += ' success';
        }
        
        node.innerHTML = "<p><span class=\"icon-checkmark big green\"></span><strong>Adobe Flash Player (" + installedVersion + ") is enabled!</strong></p>" ;
    
    } else {
    
        if ( node.classList ) {
            node.classList.add( 'warning' );
        } else {
            node.className += ' warning';
        }
        
        node.innerHTML = "<p><span class=\"icon-warning big yellow\"></span><strong>Adobe Flash Player (" + installedVersion + ") is outdated! - <span class=\"warning\">UPDATE REQUIRED</span></strong></p><p>Adobe Flash Player version <strong>" + checkedVersion + " or greater</strong> is required. Please <a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">update</a><span class=\"icon-link\"></span> Adobe Flash Player.</p>";
    
    }
    
} );