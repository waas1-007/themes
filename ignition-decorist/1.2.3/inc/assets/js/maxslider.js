jQuery(window).on('load', function () {
	'use strict';

	var $body = jQuery('body');
	var isRTL = $body.hasClass('rtl');

	/* -----------------------------------------
	 Hero Slideshow
	 ----------------------------------------- */
	if (jQuery.fn.slick) {
		var $ignitionSlideshow = jQuery('.ignition-slideshow');

		if ($ignitionSlideshow.length) {
			$ignitionSlideshow.each(function () {
				var $this = jQuery(this);
				var navigation = $this.data('navigation');
				var effect = $this.data('effect');
				var speed = $this.data('slide-speed');
				var auto = $this.data('autoslide');
				var $arrowWrap = $this.find('.ignition-slideshow-arrows');
				var $dotsWrap = $this.find('.ignition-slideshow-dots');

				$this.slick({
					dots: navigation === 'dots' || navigation === 'all',
					arrows: navigation === 'arrows' || navigation === 'all',
					fade: effect === 'fade',
					autoplaySpeed: speed,
					autoplay: auto === true,
					rtl: isRTL,
					appendDots: $dotsWrap,
					appendArrows: $arrowWrap,
					prevArrow: '<button type="button" class="slick-prev"><span class="ignition-icons ignition-icons-angle-left"></span></button>',
					nextArrow: '<button type="button" class="slick-next"><span class="ignition-icons ignition-icons-angle-right"></span></button>',
				});

				$this.on('beforeChange', function (event, slick, currentSlideIndex, nextSlideIndex) {
					var $slide = jQuery(slick.$slides[nextSlideIndex]);
					var $dots = $slide.find('.ignition-slideshow-dots li');
					var $activeDot = $dots.eq(nextSlideIndex);

					$activeDot.addClass('ci-slick-active');
				});

				$this.find('.slick-prev')
					.on('click', function () {
						$this.slick('slickPrev');
					});
				$this.find('.slick-next')
					.on('click', function () {
						$this.slick('slickNext');
					});
			});
		}
	}
});
