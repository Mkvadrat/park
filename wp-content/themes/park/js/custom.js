$(document).ready(function () {
    $(".slider .owl-carousel").owlCarousel({
        items: 1,
        dots: true
    });

    $(".testimonial__carousel .owl-carousel").owlCarousel({
        items: 1,
        margin: 20,
        nav: true,
        navText: ["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>", "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"]
    });

    $(".section__related .owl-carousel").owlCarousel({
        items: 2,
        margin: 30,
        nav: true,
        navText: ["<img src='img/left-arrow.svg'/>", "<img src='img/right-arrow.svg'/>"],
        responsive: {
            0: {
                items: 1
            },
            1200: {
                items: 2,
                margin: 20
            }
        }
    });

    $('[data-fancybox="gallery"]').fancybox();

    $('#hamburger').on('click', function () {
        $(this).toggleClass('active__btn');
        $('body').toggleClass('open__menu');
    });
    $(document).mouseup(function (e) {
        var container = $("#header");
        if (container.has(e.target).length === 0) {
            $('body').removeClass('open__menu');
        }
    });


    $('.toggle__booking').on('click', function () {
        $('.booking__block').toggleClass('open');
    });
    $(document).mouseup(function (e) {
        var container = $(".booking__block");
        if (container.has(e.target).length === 0) {
            $('.booking__block').removeClass('open');
        }
    });

});