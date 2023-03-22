$(function () {
var hash = window.location.hash;
if (hash) {
    $('.nav-tabs a[href="' + hash + '"]').tab("show");
}
});
