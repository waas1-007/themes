(function( $ ) {
    "use strict";
/*----------------------------------------------------------------------*/
/* =  Preloader
/*----------------------------------------------------------------------*/
    $(window).on('load', function () {
        anime.timeline({
                targets: '.rt-preloader',
                easing: 'easeOutQuad',
            })
            .add({
                height: ['100vh', '0vh'],
                duration: 700,
                delay: 2000,
            })
            .add({
                offset: '-=400',
                complete: function (anim) {
                    document.querySelector('.rt-preloader').remove();
                }
            })
            .add({
                offset: '-=1300',
                targets: '.preloader-wrapper',
                top: 0,
                duration: 700,
            })

        anime.timeline({
                easing: 'easeOutQuad',
            })
            .add({
                targets: '.rt-preloader .txt',
                delay: 100,
                opacity: 1,
                duration: 700,
                translateY: ["30px", "0px"],
            })
            .add({
                targets: '.rt-preloader .rt-progress',
                offset: '-=400',
                opacity: 1,
                duration: 700,
            })
            .add({
                targets: ".rt-preloader .rt-progress .bar-loading",
                offset: '-=400',
                duration: 2000,
                width: ["0", "100%"],
            })
            .add({
                targets: '.rt-preloader .loading',
                offset: '-=900',
                opacity: 0,
                duration: 1000,
                translateY: ["0", "-100px"],
            })
    });
})(jQuery);