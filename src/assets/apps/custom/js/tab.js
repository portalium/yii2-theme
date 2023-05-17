$(function () {
    var hash = window.location.hash;
    if (hash) {
        $('.nav-tabs a[href="' + hash + '"]').tab("show");
    }
});

$(document).ready(function () {
    $.pjax.defaults.timeout = 10000;
    console.log('pjax timeout: ' + $.pjax.defaults.timeout);
    $('#sidebar-collapse-desktop, #sidebar-collapse-mobile').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#main').toggleClass('active');
    });
});

$(document).ready(function () {
    $( 'ul[ direction=' + 'vertical' + ']' ).addClass( 'vertical-view' );
    $( 'ul[ direction=' + 'horizontal' + ']' ).addClass( 'horizontal-view' );    
});