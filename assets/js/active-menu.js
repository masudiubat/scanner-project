var currentURL = window.location;

if ( currentURL == 'http://localhost/scanner_project/home') {
    $( "#home" ).addClass( 'active' );
} else {
    $( "#home" ).removeClass( 'active' );
}