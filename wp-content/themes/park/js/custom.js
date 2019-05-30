$(document).ready(function () {
    $(".slider .owl-carousel").owlCarousel({
        items: 1,
        dots: true,
		loop: true,
		autoplay: true,
		autoplayTimeout: 4000,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut'
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
        navText: ["<img src='/wp-content/themes/park/img/left-arrow.svg'/>", "<img src='/wp-content/themes/park/img/right-arrow.svg'/>"],
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
    
    //Якорь
    $("a.scrollto").click(function() {
      var elementClick = $(this).attr("href")
      var destination = $(elementClick).offset().top;
      jQuery("html:not(:animated),body:not(:animated)").animate({
        scrollTop: destination
      }, 800);
      return false;
    });
    
    //Отзывы
    $('.check__block *[name="confirm"]').on('change', function () {
        if ($(this).is(':checked')) {
            $('.button__group *[type="submit"]').removeAttr('disabled');
        } else {
            $('.button__group *[type="submit"]').attr('disabled', 'disabled');
        }
    });
    
    $('.check__block *[name="confirm"]').prop( "checked", false );
    
    $('.button__group *[type="submit"]').attr('disabled', 'disabled');
    
    $(".fancybox-inline").fancybox({
        touch: false
    });
    
    var value_autoload = $('select[name="rooms"] :selected').val();
    
    var post_id_autoload = value_autoload.split('-');
    
    $('input[name="comment_post_ID"]').val(post_id_autoload[1]);
    
    $('select[name="rooms"]').on('change', function () {
        var value = $('select[name="rooms"] :selected').val();
        
        var post_id = value.split('-');
        
        $('input[name="comment_post_ID"]').val(post_id[1]);
    });
});