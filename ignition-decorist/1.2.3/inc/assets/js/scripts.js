/**
 * Front-end theme scripts
 *
 * @since 1.0.0
 */

jQuery( function ( $ ) {
	'use strict';

	var $window = $( window );
	var $body   = $( 'body' );
	var isRTL   = $body.hasClass('rtl');

	/* -----------------------------------------
	 Sticky Header
	 ----------------------------------------- */
	var $header = $('.header-sticky');
	var $headMast = $('.header-sticky .head-mast');
	var $headMastNavigation = $('.header-sticky .head-mast-navigation');
	var breakpoint = $header.data('mobile-breakpoint');

	var onStick = function () {
		var $logoImg = $('.site-branding img');
		var logoNormalUrl = $logoImg.data('logo');
		var headerTransparent = $('.header-fixed').length > 0;

		if (!headerTransparent || !logoNormalUrl) {
			return;
		}

		$logoImg.attr('src', logoNormalUrl);
	};

	var onUnstick = function () {
		var $logoImg = $('.site-branding img');
		var logoAltUrl = $logoImg.data('logo-alt');
		var headerTransparent = $('.header-fixed').length > 0;

		if (!headerTransparent || !logoAltUrl) {
			return;
		}

		$logoImg.attr('src', logoAltUrl);
	};

	if ($.fn.sticky && $header.length > 0) {
		function stickyInit () {
			if ($window.width() > breakpoint) {
				// Desktop - Main navigation should be sticky

				if ($headMast.unstick) {
					$headMast.unstick();
					$headMast.removeClass('sticky-fixed');
				}

				$headMastNavigation.sticky({
					className: 'sticky-fixed',
					topSpacing: 0,
					responsiveWidth: true,
					dynamicHeight: false,
				});

			} else {
				// Mobile - Mast head should be sticky
				if ($headMastNavigation.unstick) {
					$headMastNavigation.unstick();
					$headMastNavigation.removeClass('sticky-fixed');
				}

				$headMast.sticky({
					className: 'sticky-fixed',
					topSpacing: 0,
					responsiveWidth: true,
					dynamicHeight: false,
				});

				$headMast.on( 'sticky-start', onStick );
				$headMast.on( 'sticky-end', onUnstick );
			}
		}

		stickyInit();

		// Dummy resize throttle
		var resizeTimer;

		window.addEventListener('resize', function () {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function () {
				stickyInit();
			}, 350);

			stickyInit();
		});
	}

	if ($.fn.shyheader && $header.length > 0) {
		$headMast.wrap($('<div />', { class: 'head-mast-sticky-container'}));
		$headMastNavigation.wrap($('<div />', { class: 'head-mast-navigation-sticky-container'}));

		function shyHeaderStickyInit () {
			if ($window.width() > breakpoint) {
				// Desktop - Main navigation should be sticky

				if ($headMast.data('shyheader')) {
					$headMast.data('shyheader').destroy();
				}

				if (!$headMastNavigation.data('shyheader')) {
					$headMastNavigation.shyheader({
						classname: 'sticky-hidden',
						container: 'head-mast-navigation-sticky-container',
					});
				}
			} else {
				// Mobile - Mast head should be sticky

				if ($headMastNavigation.data('shyheader')) {
					$headMastNavigation.data('shyheader').destroy();
				}

				if (!$headMast.data('shyheader')) {
					$headMast.shyheader({
						classname: 'sticky-hidden',
						container: 'head-mast-sticky-container',
						onStick: onStick,
						onUnstick: onUnstick
					});
				}
			}
		}

		shyHeaderStickyInit();

		// Dummy resize throttle
		var resizeTimer;

		window.addEventListener('resize', function () {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function () {
				shyHeaderStickyInit();
			}, 350);

			shyHeaderStickyInit();
		});
	}

	/* -----------------------------------------
	 Search bar
	 ----------------------------------------- */
	// Fill in existing search query params from the URL
	if (window.URLSearchParams) {
		var $searchInput = $('.category-search-input');
		var $categoriesSelect = $('.category-search-select');

		var urlParams = new URLSearchParams(window.location.search);
		var productCat = urlParams.get('product_cat');
		var searchTerm = urlParams.get('s');

		if (productCat || searchTerm) {
			$searchInput.val(searchTerm || '');
			$categoriesSelect.val(productCat || '');
		}
	}

	/* -----------------------------------------
	 Post Type Block Slideshows
	 ----------------------------------------- */
	(function () {
		if (!$.fn.slick) {
			return;
		}

		var $entryFeaturedSlide = $('.is-style-ignition-decorist-post-types-slideshow > .row-items, .is-style-ignition-decorist-post-types-slideshow .wc-block-grid__products ');

		$entryFeaturedSlide.each(function () {
			var $this = $(this);
			var $parent = $this;

			if ($this.hasClass('wc-block-grid__products')) {
				$parent = $this.parents('.is-style-ignition-decorist-post-types-slideshow');
			}

			var columnsClass = $parent.attr('class').split(' ').find(function (className) {
				return className.includes('row-columns-') || (className.includes('has-') && className.includes('-columns'));
			}) || '';
			var slidesNo = 3;

			if (columnsClass && columnsClass.includes('has-')) {
				// WC blocks
				slidesNo = Number(columnsClass.split('-')[1]);

			} else if (columnsClass && columnsClass.includes('row-columns-')) {
				// Post Types Block
				slidesNo = Number(columnsClass.split('-').pop());
			}

			$this.slick({
				dots: false,
				slidesToShow: slidesNo || 3,
				slidesToScroll: slidesNo || 3,
				rtl: isRTL,
				prevArrow: '<button type="button" class="slick-prev"><span class="ignition-icons ignition-icons-angle-left"></span></button>',
				nextArrow: '<button type="button" class="slick-next"><span class="ignition-icons ignition-icons-angle-right"></span></i></button>',
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 4 === slidesNo ? slidesNo : 3,
							slidesToScroll: 4 === slidesNo ? slidesNo : 3,
						},
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1 === slidesNo ? 1 : 2,
							slidesToScroll: 1 === slidesNo ? 1 : 2,
						},
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
				],
			});
		});
	})();
} );
