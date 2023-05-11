$(function () {
    var hash = window.location.hash;
    if (hash) {
        $('.nav-tabs a[href="' + hash + '"]').tab("show");
    }
});

$(document).ready(function () {
    $('#sidebar-collapse-desktop, #sidebar-collapse-mobile').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#navbar').toggleClass('active');
    });
});

$(document).ready(function () {
    $( 'ul[ mobile-nav-style=' + 'vertical' + ']' ).addClass( 'vertical-view' );
    $( 'ul[ mobile-nav-style=' + 'horizontal' + ']' ).addClass( 'horizontal-view' );    
});