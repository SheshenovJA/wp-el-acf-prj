//todo costile ebaniy
const $ = jQuery;
let front = {

    init: function () {
        this.events();
        console.log('hi, im called');
    },


    events: function () {

        $(document).scroll(function(){
            if($(this).scrollTop() > 0)
            {
                $('.header').addClass('fix-header');
            } else {
                $('.header').removeClass('fix-header');
            }
        });

        $('#main-carousel').flickity({
            prevNextButtons: false,
            pageDots: false,
            contain: true
        });

        $(".hamb").on('click', function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                $('.nav').css('top', '0');
            } else {
                $(this).removeClass('active');
                $('.nav').css('top', '-1000px');
            }
        });

    }

};

$(function () {
    front.init();
});

