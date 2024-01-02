$(document).ready(function () {
    $('.nav_link li a').click(function () {}, function () {
        $('.nav_link li a::before').css("transform", "scaleX(0)");
    });

    $('.logo').click(function () {
        $('html, body').animate({
            scrollTop: $("#section1").offset().top
        }, 750);
        
    });

    $('.home').click(function () {
        $('html, body').animate({
            scrollTop: $("#section1").offset().top
        }, 750);
        
    });

    $('.about').click(function () {
        $('html, body').animate({
            scrollTop: $("#section2").offset().top
        }, 1000);
        
    });

    $('.scroll_down_container').click(function () {
        $('html, body').animate({
            scrollTop: $("#padding").offset().top
        }, 1000);
        
    });

    $('#enter').hover(function () {
        $('.arrow_right_svg').addClass('transform_right');
    }, function () {
        $('.arrow_right_svg').removeClass('transform_right');
    });

    $(window).scroll( function(){
        var bottom_of_element = $('#padding').offset().top + $('#padding').outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        if( bottom_of_window > bottom_of_element ){
            $('.feature1').delay(100).animate({'opacity':'1','margin-top':'0px'}, 750);
            $('.feature2').delay(300).animate({'opacity':'1','margin-top':'0px'}, 750);
            $('.feature3').delay(500).animate({'opacity':'1','margin-top':'0px'}, 750);
        }
    });
        
});
