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
        node.classList.add( 'success' );
    } else {
        node.className += ' callout success';
    }
    
    systemRC.appendChild( node );
    node.innerHTML = '<p><span class=\"icon-checkmark big green\"></span><span class=\"icon-javascript big\"></span><strong>JavaScript is enabled!</strong></p>';

    
} );