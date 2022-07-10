(function ($) {
	"use strict";
	if (jQuery(".rt-nav-sidebar-menu")[0]) {
		jQuery('body').addClass('rt-side-menu');
	}
	jQuery(document).ready(function() {
		$( '.woocommerce-cart-form :input[name="update_cart"]' ).prop( 'disabled', false ).attr( 'aria-disabled', false );
	});
	jQuery(document).on("ready", function () {
	    jQuery('#welcome-user').on('shown.bs.modal', function () {
        var width = jQuery(window).width();
        if(width < 768){
            jQuery('#welcome-user').modal('hide')
        }
    });

		jQuery('.product-item .price').each(function () {
		if (jQuery(this).is(':empty')) {
		jQuery(this).remove();
		}
		});
		jQuery('.shop_single.product-type-variable .price').each(function () {
		if (jQuery(this).is(':empty')) {
		jQuery(this).remove();
		}
		});

		$(document).on('click', '.plus', function(e) { // replace '.quantity' with document (without single quote)
			let input = $(this).prev('input.qty');
			let val = parseInt(input.val());
			let step = input.attr('step');
			step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
			input.val( val + step ).change();
		});
		$(document).on('click', '.minus',  // replace '.quantity' with document (without single quote)
			function(e) {
			let input = $(this).next('input.qty');
			let val = parseInt(input.val());
			let step = input.attr('step');
			step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
			if (val > 0) {
				input.val( val - step ).change();
			}
		});
		function changePlaceholder() {
            $('.woocommerce-grouped-product-list-item__quantity .qty').attr('placeholder',
                '0');
        }
		jQuery('.product-item .price').each(function () {
		if (jQuery(this).is(':empty')) {
		jQuery(this).remove();
		}
		});

		jQuery(document).on('click', '.product .color-swatch > div', function () {
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active t');
			/* Change thumbnail */
			var image_src = jQuery(this).data('thumb');
			jQuery(this).closest('.product-wrapper').find('.thumbnail-wrapper img:first').attr('src', image_src).removeAttr('srcset sizes');

			/* Change price */
			var term_id = $(this).data('term_id');
			var variable_prices = $(this).parent().siblings('.variable-prices');
			var price_html = variable_prices.find('[data-term_id="' + term_id + '"]').html();
			jQuery(this).closest('.product').find('.thumbnail-wrapper .price').html(price_html).addClass('variation-price');
		});
		jQuery(document).on('click', '.product-item .color-swatch > div', function () {
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active t');
			/* Change thumbnail */
			var image_src = jQuery(this).data('thumb');
			jQuery(this).closest('.holder').find('.pic img:first').attr('src', image_src).removeAttr('srcset sizes');

			/* Change price */
			var term_id = $(this).data('term_id');
			var variable_prices = $(this).parent().siblings('.variable-prices');
			var price_html = variable_prices.find('[data-term_id="' + term_id + '"]').html();
			jQuery(this).closest('.product').find('.thumbnail-wrapper .price').html(price_html).addClass('variation-price');
		});
		jQuery(document).on('click', '.radiantthemes-shop-box .color-swatch > div', function () {
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active t');
			/* Change thumbnail */
			var image_src = jQuery(this).data('thumb');
			jQuery(this).closest('.holder').find('.pic img:first').attr('src', image_src).removeAttr('srcset sizes');

			/* Change price */
			var term_id = $(this).data('term_id');
			var variable_prices = $(this).parent().siblings('.variable-prices');
			var price_html = variable_prices.find('[data-term_id="' + term_id + '"]').html();
			jQuery(this).closest('.product').find('.thumbnail-wrapper .price').html(price_html).addClass('variation-price');
		});
		$(window).scroll(function () {
			var scrollTop = $(window).scrollTop();
			if (scrollTop > 249) {
				$('.rt-sticky-product-bar').addClass('sticky-active');
				$('.rt-sticky-product-bar').removeClass('fadeOutDown');
			} else {
				$('.rt-sticky-product-bar').addClass('fadeOutDown');
				$('.rt-sticky-product-bar').removeClass('sticky-active');

			}
		});

		var $form_modal = $('.cd-user-modal'),
			$form_login = $form_modal.find('#cd-login'),
			$form_signup = $form_modal.find('#cd-signup'),
			$form_forgot_password = $form_modal.find('#cd-reset-password'),
			$form_modal_tab = $('.cd-switcher'),
			$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
			$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
			$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
			$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
			$main_nav = $('.main-nav');

		//open modal
		$main_nav.on('click', function (event) {

			if ($(event.target).is($main_nav)) {
				// on mobile open the submenu
				$(this).children('ul').toggleClass('is-visible');
			} else {
				// on mobile close submenu
				$main_nav.children('ul').removeClass('is-visible');
				//show modal layer
				$form_modal.addClass('is-visible');
				//show the selected form
				($(event.target).is('.cd-signup')) ? signup_selected() : login_selected();
			}

		});

		//close modal
		$('.cd-user-modal').on('click', function (event) {
			if ($(event.target).is($form_modal) || $(event.target).is('.cd-close-form')) {
				$form_modal.removeClass('is-visible');
			}
		});
		//close modal when clicking the esc keyboard button
		$(document).keyup(function (event) {
			if (event.which == '27') {
				$form_modal.removeClass('is-visible');
			}
		});

		//switch from a tab to another
		$form_modal_tab.on('click', function (event) {
			event.preventDefault();
			($(event.target).is($tab_login)) ? login_selected() : signup_selected();
		});

		//hide or show password
		$('.hide-password').on('click', function () {
			var $this = $(this),
				$password_field = $this.prev('input');

			('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
			('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
			//focus and move cursor to the end of input field
			$password_field.putCursorAtEnd();
		});

		//show forgot-password form
		$forgot_password_link.on('click', function (event) {
			event.preventDefault();
			forgot_password_selected();
		});

		//back to login from the forgot-password form
		$back_to_login_link.on('click', function (event) {
			event.preventDefault();
			login_selected();
		});

		function login_selected() {
			$form_login.addClass('is-selected');
			$form_signup.removeClass('is-selected');
			$form_forgot_password.removeClass('is-selected');
			$tab_login.addClass('selected');
			$tab_signup.removeClass('selected');
		}

		function signup_selected() {
			$form_login.removeClass('is-selected');
			$form_signup.addClass('is-selected');
			$form_forgot_password.removeClass('is-selected');
			$tab_login.removeClass('selected');
			$tab_signup.addClass('selected');
		}

		function forgot_password_selected() {
			$form_login.removeClass('is-selected');
			$form_signup.removeClass('is-selected');
			$form_forgot_password.addClass('is-selected');
		}

		//REMOVE THIS - it's just to show error messages
		$form_login.find('input[type="submit"]').on('click', function (event) {
			event.preventDefault();
			$form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
		});
		$form_signup.find('input[type="submit"]').on('click', function (event) {
			event.preventDefault();
			$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
		});

    //Show or hide filters
	$('.rt-show-filter').click(function() {
	    $('#topsidebar').slideToggle("slow");
	    $('.rt-show-filter').hide(0);
	    $('.rt-hide-filter').show(0);
	});
	$('.rt-hide-filter').click(function() {
	    $('#topsidebar').slideToggle("slow");
	    $('.rt-show-filter').show(0);
	    $('.rt-hide-filter').hide(0);
	});
	//Side filter
	$('.rt-fly-filter').click(function() {
	    $('.widget-left').slideToggle("slow");
	    $('.rt-fly-filter').hide(0);
	    $('.rt-fly-hide-filter').show(0);
	});
	$('.rt-fly-hide-filter').click(function() {
	    $('.widget-left').slideToggle("slow");
	    $('.rt-fly-filter').show(0);
	    $('.rt-fly-hide-filter').hide(0);
	});




		$(".woocommerce-widget-layered-nav-dropdown select option").each(function () {
			//get values of all option
			var val = $(this).val();
			var base_url = window.location.origin+window.location.pathname;

			//do magic create boxes like checkbox
			$("form.woocommerce-widget-layered-nav-dropdown").append('<div class="selectbox" data-color="' + val + '"><a href="' + base_url + '?filter_color=' + val + '"><span style="background-color:' + val + '"></span></a></div>');

		});
		//remove empty selectbox
		$('.selectbox[data-color=""]').remove();

		//change select box on click

		var swiperWhy = new Swiper('.rt-gallery-main', {
			direction: 'vertical',
			spaceBetween: 10,
			loop: true,
			slidesPerView: 2,
			centeredSlides: true,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},

		});


		$(".showlogin").click(function () {
			$(".rt-login-info").toggle();
		});
		$("#accordion-description").addClass("show");
		$("#comment").attr("placeholder", "Your review *");
		$("#author").attr("placeholder", "Name  *");
		$("#email").attr("placeholder", "Email *");
		$("#calc_shipping_state_field span").css("width", "100%");
		$('select.rt-selectbox, select.mptt-navigation-select, .widget_archive select, .widget_categories select, .widget_text select, .wp-block-archives-dropdown select, .wp-block-categories-dropdown select , #search-box2 select , .mobile-menu-top select, .tinvwl-break-input-filed').each(function (index) {
			$(this).each(function () {
				var $el = $(this);
				$el.insertBefore($el.parent('.rt-select-wrapper'));
				$el.next('.rt-select-wrapper').remove();
				$el.css({
					'opacity': 0,
					'position': 'absolute',
					'left': 0,
					'right': 0,
					'top': 0,
					'bottom': 0
				});
				var $comboWrap = $('<span class="rt-select-wrapper" />').insertAfter($el);
				var $text = $('<span class="rt-select-text" />').appendTo($comboWrap);
				var $button = $('<span class="rt-select-button" /><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>').appendTo($comboWrap);
				$el.appendTo($comboWrap);
				$el.change(function () {
					$text.text($('option:selected', $el).text());
				});
				$text.text($('option:selected', $el).text());
				$el.comboWrap = $comboWrap;
			});
		});
		jQuery("#deal-hide").click(function () {
			jQuery("#rt-site-deal-container").hide();
		});



		var swiper = new Swiper('.related-product-box.swiper-container', {

			spaceBetween: 15,
			loop: true,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			},
			breakpoints: {
				0: {
					slidesPerView: 2,

				},
				640: {
					slidesPerView: 2,

				},
				768: {
					slidesPerView: 2,

				},
				1024: {
					slidesPerView: 5,

				},
			}
		});

		jQuery(".header-flyout-searchbar i, .header-flyout-searchbar span[class*='ti-']").on("click", function () {
			jQuery("body").toggleClass("flyout-searchbar-active");
		});
		jQuery(".flyout-search-close").on("click", function () {
			jQuery("body").removeClass("flyout-searchbar-active");
		});
		jQuery(".comments-area .comment-form > p input[type='submit']").each(function () {
			jQuery(this).replaceWith("<button type='submit'><span>" + jQuery(this).attr("value") + "</span></button>");
		});
		jQuery(".comments-area .comment-form > p input[type='reset']").each(function () {
			jQuery(this).replaceWith("<button type='reset'><span>" + jQuery(this).attr("value") + "</span></button>");
		});
		// jQuery("[data-toggle='tooltip']").tooltip();
		jQuery(".header-responsive-nav").each(function () {
			jQuery(this).sidr({
				side: 'right',
				speed: 600,
				displace: false,
				renaming: false,
				source: '.mobile-menu',
				name: 'mobile-menu',
				onOpen: function () {
					jQuery("body").addClass("mobile-menu-open");
				},
				onClose: function () {
					jQuery("body").removeClass("mobile-menu-open");
				},
			});
			jQuery(".mobile-menu-close, .overlay").on("click", function () {
				jQuery.sidr('close', 'mobile-menu');
			});
		});
		jQuery(".header-hamburger-menu").each(function () {
			jQuery(this).sidr({
				side: 'right',
				speed: 400,
				displace: false,
				renaming: false,
				source: '.hamburger-menu-holder',
				name: 'hamburger-menu',
				onOpen: function () {
					jQuery("body").addClass("hamburger-menu-open");
				},
				onClose: function () {
					jQuery("body").removeClass("hamburger-menu-open");
				},
			});
			jQuery(".hamburger-menu-close-lines").on("click", function () {
				jQuery.sidr('close', 'hamburger-menu');
			});
		});
		jQuery("body[data-header-style='header-style-three']").each(function () {
			jQuery(this).find(".vc_section, .vc_row").removeAttr("style data-vc-full-width data-vc-full-width-init data-vc-stretch-content");
		});
		jQuery(".responsive-sidemenu-open").each(function () {
			jQuery(this).sidr({
				side: 'left',
				speed: 600,
				displace: false,
				renaming: false,
				source: '.sidemenu-holder',
				name: 'sidemenu',
				onOpen: function () {
					jQuery("body").addClass("sidemenu-open");
				},
				onClose: function () {
					jQuery("body").removeClass("sidemenu-open");
				},
			});
			jQuery(".responsive-sidemenu-close").on("click", function () {
				jQuery.sidr('close', 'sidemenu');
			});
		});
		jQuery("body[data-header-style='header-style-three'] .nav li").on("click", function () {
			jQuery(this).children("ul").slideToggle(500);
		});
		jQuery(".header-sidebar-menu-open, .mobile-sidebar-menu-open").each(function () {
			jQuery(this).sidr({
				side: 'left',
				speed: 300,
				displace: false,
				renaming: false,
				source: '.sidemenu-holder',
				name: 'sidemenu',
				onOpen: function () {
					jQuery("body").addClass("sidemenu-open");
				},
				onClose: function () {
					jQuery("body").removeClass("sidemenu-open");
				},
			});
			jQuery(".sidemenu-close").on("click", function () {
				jQuery.sidr('close', 'sidemenu');
			});
		});
		jQuery("body[data-header-style='header-style-four'] .nav li").on("click", function () {
			jQuery(this).children("ul").slideToggle(500);
		});
		jQuery(".header-flyout-menu").on("click", function () {
			jQuery("body").addClass("flyout-menu-active");
		});
		jQuery(".flyout-menu-close").on("click", function () {
			jQuery("body").removeClass("flyout-menu-active");
		});
		jQuery("body[data-header-style='header-style-five'] .flyout-menu-nav li").on("click", function () {
			jQuery(this).children("ul").slideToggle(500);
		});
		jQuery(".header-slideout-menu").on("click", function () {
			jQuery("body").addClass("slideout-menu-active");
		});
		jQuery(".slideout-menu-close").on("click", function () {
			jQuery("body").removeClass("slideout-menu-active");
		});
		jQuery("body[data-header-style='header-style-fourteen'] .slideout-menu-nav li").on("click", function () {
			jQuery(this).children("ul").slideToggle(500);
		});
		jQuery(".header-flexi-menu").on("click", function () {
			jQuery("body").addClass("flexi-menu-active");
		});
		jQuery(".flexi-menu-close").on("click", function () {
			jQuery("body").removeClass("flexi-menu-active");
		});
		jQuery("body[data-header-style='header-style-seven'] .flexi-menu-nav li").on("click", function () {
			jQuery(this).children("ul").slideToggle(500);
		});
		jQuery(".sidr .menu-item-has-children").each(function () {
			jQuery(this).children("ul, .rt-mega-menu, div ul").css({
				"display": "none",
			});
			jQuery(this).append("<span class='radiantthemes-open-submenu'></span>");
			jQuery(this).find(".radiantthemes-open-submenu").on("click", function () {
				jQuery(this).parent(".menu-item-has-children").toggleClass("radiantthemes-menu-open");
				jQuery(this).parent(".menu-item-has-children").children("ul, .rt-mega-menu").slideToggle(700);
			});
		});
		jQuery("body[data-page-transition='1'] a:not(.fancybox):not(.video-link):not([data-fancybox])").each(function () {
			jQuery(this).on("click", function (event) {
				let PageLink = jQuery(this).attr("href");
				if ("#" == PageLink) { } else if (PageLink.startsWith("#")) { } else {
					event.preventDefault();
					jQuery("body").addClass("page-transition-active");
					setTimeout(function () {
						window.location.href = PageLink;
					}, 700);
				}
			});
		});
		jQuery(".wraper_shop_single.style-two .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'></div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'></div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".wraper_shop_single.style-three .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'></div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'></div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".wraper_shop_single.style-four .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'></div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'></div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".wraper_shop_single.style-five .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'></div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'></div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function (e) {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".wraper_shop_single.style-six .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});

		jQuery(".wraper_shop_single.style-one .shop_single .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});

		jQuery(".radiantthemes-cart .woocommerce-cart-form .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".rt-sticky-product-bar .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".rt-cart-box  .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});

		jQuery(window).on("scroll", function () {
			jQuery(".sticky-header").each(function () {
				if (jQuery(window).scrollTop() > (jQuery(this).innerHeight() + 30)) {
					jQuery(this).addClass("delayed-sticky-mode");
				} else {
					jQuery(this).removeClass("delayed-sticky-mode");
				}
				if (jQuery(window).scrollTop() > (jQuery(this).innerHeight() + 40)) {
					jQuery(this).addClass("delayed-sticky-mode-acivate");
					jQuery(".rt-main-toggle-menu-trigger span").addClass("sticky-toggle-menu");
					jQuery(".main-header .elementor-widget-radiant-custom-logo").addClass("menu-detail-box");
					jQuery(".main-header .primary").addClass("menu-detail-box");
					jQuery(".main-header .elementor-widget-radiant-custom-search").addClass("menu-detail-box");
					jQuery(".wraper_header").css({
						"padding-bottom": jQuery(this).innerHeight() + "px",
					});
				} else {
					jQuery(this).removeClass("delayed-sticky-mode-acivate");
					jQuery(".rt-main-toggle-menu-trigger span").removeClass("sticky-toggle-menu");
					jQuery(".main-header .elementor-widget-radiant-custom-logo").removeClass("menu-detail-box");
					jQuery(".main-header .primary").removeClass("menu-detail-box");
					jQuery(".main-header .elementor-widget-radiant-custom-search").removeClass("menu-detail-box");
					jQuery(".wraper_header").css({
						"padding-bottom": "0",
					});
				}
				if (jQuery(window).scrollTop() > jQuery(this).data("delay")) {
					jQuery(this).addClass("i-am-delayed-sticky");
				} else {
					jQuery(this).removeClass("i-am-delayed-sticky");
				}
			});
		});
		jQuery('a.woocommerce-review-link').click(function () {
			jQuery('a.nav-link').removeClass("active");
			jQuery('.tab-pane').removeClass("active show");
			jQuery('.reviews.tab-pane').addClass("active show");

			//jQuery('.nav-link li.active:last');
			jQuery('a.reviews').addClass("active");
		});
		jQuery("img").attr("data-no-retina", "");
		// jQuery(".radiantthemes-retina img").removeAttr("data-no-retina");
		const logoWidthDefault = jQuery(".radiantthemes-retina .logo-default img").attr("data-logoWidth");
		if (typeof logoWidthDefault !== "undefined") {
			jQuery(".radiantthemes-retina .logo-default img").css('width', logoWidthDefault + 'px');
		}
		const logoWidthDark = jQuery(".radiantthemes-retina .logo-rt-dark img").attr("data-logoWidth");
		if (typeof logoWidthDark !== "undefined") {
			jQuery(".radiantthemes-retina .logo-rt-dark img").css('width', logoWidthDark + 'px');
		}


		/* Change cart item quantity */
		$(document).on('change', '.hamburger-minicart .qty', function () {
			var $thisInput = $(this).parent().parent().parent().find('img');
			var product_qty = $(this).val();
			var currentVal = parseFloat(product_qty);
			var cart_item_key = $(this).attr('name').replace('cart[', '').replace('][qty]', '');
			$('.woocommerce-message').remove();
			var data = {
				action: 'radiant_woocommerce_ajax_add_to_cart',
				quantity_two: currentVal,
				cart_item_key: cart_item_key
			};
			$.ajax({
				type: 'POST',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (response) {
					$thisInput.removeClass('added').addClass('loading');
				},
				complete: function (response) {
					$thisInput.removeClass('loading').addClass('added');
				},
				success: function (response) {
					if (response.error & response.product_url) {
						swal({
							title: "Oh No!",
							text: "Sorry, some error occurred. Please try again.",
							icon: "error",
						});
					} else {
						$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
					}
				}
			});
		});
		$('#rt-shop-display-small-grid').on('click', function(e){

        $(this).addClass('active');
		$('#radiantthemes-shop')
		.removeClass('three-column')
		.removeClass('four-column')
		.removeClass('six-column')
		.addClass('five-column');
		$('#rt-shop-display-grid')
		.removeClass('active');
		$('#rt-shop-display-verysmall-grid')
		.removeClass('active');

		});
		$('#rt-shop-display-grid').on('click', function(e){

		 $(this).addClass('active');
		$('#radiantthemes-shop')
		.removeClass('three-column')
		.removeClass('five-column')
		.removeClass('six-column')
		.addClass('four-column');

		$('#rt-shop-display-small-grid')
		.removeClass('active');
		$('#rt-shop-display-verysmall-grid')
		.removeClass('active');

		});
		$('#rt-shop-display-verysmall-grid').on('click', function(e){

        $(this).addClass('active');
		$('#radiantthemes-shop')
		.removeClass('three-column')
		.removeClass('five-column')
		.removeClass('four-column')
		.addClass('six-column');

		$('#rt-shop-display-small-grid')
		.removeClass('active');
		$('#rt-shop-display-grid')
		.removeClass('active');

		});


	});

	jQuery(window).on("load", function () {
		jQuery(".mfp-content .variations_form .quantity input[type=number]").each(function () {
			jQuery(this).addClass("form-control");
			jQuery(this).parent().addClass("input-group");
			jQuery(this).before("<div class='input-group-addon quantity-decrease'>-</div>");
			jQuery(this).after("<div class='input-group-addon quantity-increase'>+</div>");
			jQuery(this).parent().find(".quantity-decrease").on("click", function () {
				if (jQuery(this).parent().find("input[type=number]").val() == jQuery(this).parent().find("input[type=number]").attr("min")) {
					e.preventDefault();
				} else {
					jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() - 1);
				}
			});
			jQuery(this).parent().find(".quantity-increase").on("click", function () {
				jQuery(this).parent().find("input[type=number]").val(+jQuery(this).parent().find("input[type=number]").val() + 1);
			});
		});
		jQuery(".mixblend-preloader").animate({
			width: "100%",
		}, 3000, function () {
			// Animation complete.
			jQuery(".container-preloader").animate({ height: 0 }, 1000);
		});
		setTimeout(function () {
			jQuery(".preloader").addClass("loaded");
		}, jQuery(".preloader").data("preloader-timeout"));
		setTimeout(function () {
			jQuery(".page-transition-layer").removeClass("i-am-active");
		}, 700);
		setTimeout(function () {
			// jQuery(".matchHeight").matchHeight();
		}, 2000);
		setTimeout(function () {
			// jQuery(".isotope-blog-style").isotope({
			// 	itemSelector: '.isotope-blog-style-item',
			// 	layoutMode: 'masonry',
			// });
		}, 100);
		if (jQuery(window).width() > 768) {
			jQuery(document).ready(StuckingFooter);
			jQuery(window).resize(StuckingFooter);

			function StuckingFooter() {
				jQuery(".footer-custom-stucking-container").css({
					"height": jQuery(".footer-custom-stucking-mode").innerHeight(),
				});
			};
		}
		if (jQuery.fn.owlCarousel) {
			jQuery('.blog-carousel').owlCarousel({
				stagePadding: 250,
				items: 1,
				loop: true,
				autoplay: true,
				autoplayTimeout: 6000,
				smartSpeed: 2500,
				lazyLoad: true,
				margin: 0,
				dots: false,
				responsive: {
					0: {
						items: 1,
						stagePadding: 0
					},
					600: {
						items: 2,
						margin: 10,
					},
					1000: {
						items: 2,
					}
				}
			});
		}
		if (jQuery.fn.owlCarousel) {
			jQuery('.landing-portfolio-carousel').owlCarousel({
				center: true,
				items: 1,
				loop: true,
				autoplay: true,
				autoplayTimeout: 6000,
				smartSpeed: 2500,
				lazyLoad: true,
				margin: 0,
				dots: false,
				responsive: {
					0: {
						items: 1,
						stagePadding: 0
					},
					600: {
						items: 2,
						margin: 10,
					},
					1000: {
						items: 2,
					}
				}
			});
		}
		setTimeout(function () {
			jQuery(".radiantthemes-counterup").each(function () {
				jQuery(this).text(jQuery(this).data("counterup-value"));
			});
		}, 1);
	});
	jQuery(window).on("scroll", function () {
		if (jQuery(this).scrollTop() > 100) {
			jQuery(".scrollup").addClass("active");
		} else {
			jQuery(".scrollup").removeClass("active");
		}
	});
	jQuery(".scrollup").on("click", function () {
		jQuery("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	jQuery.fn.putCursorAtEnd = function () {
		return this.each(function () {
			// If this function exists...
			if (this.setSelectionRange) {
				// ... then use it (Doesn't work in IE)
				// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
				var len = $(this).val().length * 2;
				this.setSelectionRange(len, len);
			} else {
				// ... otherwise replace the contents with itself
				// (Doesn't work in Google Chrome)
				$(this).val($(this).val());
			}
		});
	};
	// jQuery( document.body ).on( 'updated_cart_totals', function() {
	// 	location.reload();
	// });


})(jQuery);





