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
    
    var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;
    
    var disableCheck = document.getElementById( 'disableCheckScreen' ).value;
    
    if ( node.classList ) {
        node.classList.add( 'callout' );
    } else {
        node.className += ' callout';
    }
    
    systemRC.appendChild( node );
    
    if ( disableCheck === '0' ) {
        
        var targetScreenWidth = document.getElementById( 'checkScreenW' ).value;
        var targetScreenHeight = document.getElementById( 'checkScreenH' ).value;
        
        if ( screenWidth < targetScreenWidth ) {
            
            if ( screenHeight < targetScreenHeight ) {
                
                if ( node.classList ) {
                    node.classList.add( 'danger' );
                } else {
                    node.className += ' danger';
                }
                
                node.innerHTML = "<p><span class=\"icon-danger big red\"></span> <span class=\"icon-display big\"></span><strong>Screen resolution (" + screenWidth + "&times;" + screenHeight + ") is not optimal for viewing.</strong></p><p>Recommended screen resolution is " + targetScreenWidth + "&times;" + targetScreenHeight + " or greater.</p>";
                
            } else {
                
                if ( node.classList ) {
                    node.classList.add( 'warning' );
                } else {
                    node.className += ' warning';
                }
                
                node.innerHTML = "<p><span class=\"icon-warning big yellow\"></span> <span class=\"icon-display big\"></span><strong>Screen resolution (" + screenWidth + "&times;" + screenHeight + ") may not be optimal for viewing.</strong></p><p>Recommended screen resolution is " + targetScreenWidth + "&times;" + targetScreenHeight + " or greater.</p>";
                
            }
            
        } else {
            
            if ( node.classList ) {
                node.classList.add( 'success' );
            } else {
                node.className += ' success';
            }
            
            node.innerHTML = "<p><span class=\"icon-checkmark big green\"></span> <span class=\"icon-display big\"></span><strong>Screen resolution (" + screenWidth + "&times;" + screenHeight + ") is optimal for viewing.</strong></p><p>Recommended screen resolution is " + targetScreenWidth + "&times;" + targetScreenHeight + " or greater.</p>";
            
        }
        
    } else {
        
        if ( node.classList ) {
            node.classList.add( 'success' );
        } else {
            node.className += ' success';
        }
        
        node.innerHTML = "<p><span class=\"icon-display big\"></span><strong>Screen Resolution: " + screenWidth + "&times;" + screenHeight + "</strong></p>";
        
    }
        
} );