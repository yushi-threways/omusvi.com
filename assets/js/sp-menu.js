$(function() {
    $('.sw-Nav_OpenBtn').on('click', function () {
        $('html').toggleClass('menu-opend');
        $(this).toggleClass('open');
        $('.sw-Nav_Side').toggleClass('open-side');
    });
});