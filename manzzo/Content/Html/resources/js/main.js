if ($(window).scrollTop() >= $('header').height()) {
    $('#sticker').addClass('fixed');
} else {
    $('#sticker').removeClass('fixed');
}
$(window).scroll(function () {
    if ($(window).scrollTop() >= $('header').height()) {
        $('#sticker').addClass('fixed');
    } else {
        $('#sticker').removeClass('fixed');
    }
});
function showBtnToTop() {
    if ($(window).scrollTop() >= $('header').height()) {
        $('#btn-to-top').stop(0).fadeIn(300);
    } else {
        $('#btn-to-top').stop(0).fadeOut(300);
    }
}

$('#btn-to-top').click(function (e) {
    e.preventDefault();
    $('html,body').animate({ scrollTop: 0 }, 500);
});
showBtnToTop();
$(window).scroll(function () {
    showBtnToTop();
});
$(document).on('click', '#sticker ul.main-menu > li>.fa.fa-angle-down', function () {
    $(this).stop(0).addClass('fa-angle-up').removeClass('fa-angle-down');
    $(this).parent().children('ul').stop(0).slideDown(300);
});
$(document).on('click', '#sticker ul.main-menu > li>.fa.fa-angle-up', function () {
    $(this).stop(0).addClass('fa-angle-down').removeClass('fa-angle-up');
    $(this).parent().children('ul').stop(0).slideUp(300);
});
if ($(window).width() <= 1024) {
    $('#sticker').stop(0).css({ 'max-height': $(window).height() - $('header').height() });
    $('#btn-show-menu').click(function () {
        if ($('#sticker').is(':visible')) {
            $('body').stop(0).removeClass('overflow');
            $('#overlay').addClass('hidden');
            $('#sticker').stop(0).slideUp(300);
        } else {
            $('body').stop(0).addClass('overflow');
            $('#overlay').removeClass('hidden');
            $('#sticker').stop(0).slideDown(300);
        }
    });
    $('#overlay').click(function () {
        $('body').stop(0).removeClass('overflow');
        $('#overlay').addClass('hidden');
        $('#sticker').stop(0).slideUp(300);
    });
}

//Facebook share button
$('a.share').click(function (e) {
    e.preventDefault();
    var $link = $(this);
    var href = $link.attr('href');
    var network = $link.attr('data-network');
    var networks = {
        facebook: { width: 600, height: 300 },
        twitter: { width: 600, height: 300 },
        google: { width: 515, height: 490 },
    };
    var popup = function (network) {
        var options = 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,';
        window.open(href, '', options + 'height=' + networks[network].height + ',width=' + networks[network].width);
    }
    popup(network);
});