var RADIANT = {},
$ = jQuery.noConflict();
(function ($) {
window.onpageshow = function (t) {
	t.persisted && window.location.reload()
},
function (v, b) {
	"use strict";
	var c = v(document),
		y = v(b),
		d = v(".click-capture"),
		h = v("#wrapper"),
		w = v("#desktop-menu"),
		z = v(".rt-desktop-toggle-holder"),
		u = v("#mobile-menu"),
		i = (v(".rt-mobile-toggle-holder"), new MobileDetect(b.navigator.userAgent)),
		r = r || {};
	b.lazySizesConfig = b.lazySizesConfig || {}, b.lazySizesConfig.expand = 100, b.lazySizesConfig.loadMode = 1, b.lazySizesConfig.loadHidden = !1, gsap.defaults({
		ease: "power1.out"
	}), gsap.config({
		nullTargetWarn: !1
	}), r = {
		thb_scrolls: {},
		h_offset: 0,
		init: function () {
			var e, a = this;
			! function () {
				for (e in a) {
					var t;
					!a.hasOwnProperty(e) || void 0 !== (t = a[e]).selector && void 0 !== t.init && 0 < v(t.selector).length && t.init()
				}
			}()
		},
		header: {
			selector: ".rt-header",
			init: function () {
				var t = this;
				"on" === themeajax.settings.fixed_header_scroll && v(".rt-header.fixed").headroom({
					offset: 150
				}), y.on("scroll.fixed-header", function () {
					t.scroll(150)
				}).trigger("scroll.fixed-header")
			},
			scroll: function (t) {
				var e = "fixed-enabled";
				t < y.scrollTop() ? v(".rt-header.fixed").addClass(e) : v(".rt-header.fixed").removeClass(e)
			}
		},
		// header: {
		// 	selector: ".rt-sticky-product-bar",
		// 	init: function () {
		// 		var t = this;
		// 		"on" === themeajax.settings.fixed_header_scroll && v(".rt-sticky-product-bar.fixed").headroom({
		// 			offset: 150
		// 		}), y.on("scroll.fixed-header", function () {
		// 			t.scroll(150)
		// 		}).trigger("scroll.fixed-header")
		// 	},
		// 	scroll: function (t) {
		// 		var e = "fixed-enabled";
		// 		t < y.scrollTop() ? v(".rt-sticky-product-bar.fixed").addClass(e) : v(".rt-sticky-product-bar.fixed").removeClass(e)
		// 	}
		// },
		// sticky_addtocart: {
		// 	selector: ".rt-sticky-product-bar",
		// 	init: function () {
		// 		var t = this,
		// 			e = v(t.selector),
		// 			a = v(".single_add_to_cart_button", e);
		// 		y.on("scroll", _.debounce(function () {
		// 			i.mobile() || y.width() < 1068 || t.control()
		// 		}, 10)), a.hasClass("thb-select-options") && a.on("click", function () {
		// 			var t = v("form.cart", v(".thb-product-detail").eq(0)).offset().top - 100;
		// 			return gsap.to(y, {
		// 				duration: .5,
		// 				scrollTo: {
		// 					y: t,
		// 					autoKill: !1
		// 				}
		// 			}), !1
		// 		})
		// 	},
		// 	control: function () {
		// 		var t = v("form.cart", v(".thb-product-detail").eq(0)).offset().top - y.scrollTop(),
		// 			e = v(".footer").offset().top - 75 - (y.scrollTop() + y.outerHeight());
		// 		t < 200 && 0 < e ? p.hasClass("thb-sticky-active") || p.addClass("thb-sticky-active") : (e < 1 && p.hasClass("thb-sticky-active") || p.hasClass("thb-sticky-active")) && p.removeClass("thb-sticky-active")
		// 	}
		// },
		fullMenu: {
			selector: ".rt-main-menu",
			init: function () {
				var t = v(this.selector),
					e = t.find(".menu-item-has-children:not(.menu-item-mega-parent)"),
					a = t.find(".menu-item-has-children.menu-item-mega-parent");
				e.each(function () {
					var t = v(this),
						e = t.find(">.sub-menu, .sub-menu.thb_mega_menu"),
						a = e.find(">li>a"),
						o = (t.find(".thb_mega_menu li"), gsap.timeline({
							paused: !0,
							onStart: function () {
								gsap.set(e, {
									display: "block"
								})
							},
							onReverseComplete: function () {
								gsap.set(e, {
									display: "none"
								})
							}
						}));
					e.length && o.to(e, {
						duration: .2,
						autoAlpha: 1
					}, "start"), a.length && o.to(a, {
						duration: .05,
						opacity: 1,
						stagger: .015
					}, "start"), t.hoverIntent({
						sensitivity: 3,
						interval: 20,
						timeout: 70,
						over: function () {
							t.addClass("menuitemHover"), o.timeScale(1).restart()
						},
						out: function () {
							t.removeClass("menuitemHover"), o.timeScale(1.5).reverse()
						}
					})
				}), a.each(function () {
					var t = v(this),
						e = t.find(">.sub-menu, >.menu-item-mega-parent .sub-menu"),
						a = e.find(">li>a, .menu-item>a"),
						o = gsap.timeline({
							paused: !0,
							onStart: function () {
								gsap.set(e, {
									display: "flex"
								})
							},
							onReverseComplete: function () {
								gsap.set(e, {
									display: "none"
								})
							}
						});
					o.to(e, {
						duration: .2,
						autoAlpha: 1
					}, "start").to(a, {
						duration: .05,
						opacity: 1,
						x: 0,
						stagger: .015
					}, "start"), t.hoverIntent({
						sensitivity: 3,
						interval: 20,
						timeout: 70,
						over: function () {
							t.addClass("menuitemHover"), o.timeScale(1).restart()
						},
						out: function () {
							t.removeClass("menuitemHover"), o.timeScale(1.5).reverse()
						}
					})
				});
				var o = _.debounce(function () {
					a.find(">.sub-menu, >.menu-item-mega-parent .sub-menu").each(function () {
						var t, e = v(this);
						e.css("display", "flex"), e.offset().left <= 0 ? t = -1 * e.offset().left + 20 : e.offset().left + e.outerWidth() > v(b).outerWidth() && (t = -1 * Math.round(e.offset().left + e.outerWidth() - v(b).outerWidth() + 20)), e.hide(), e.css({
							marginLeft: t + "px"
						})
					})
				}, 20);
				y.on("resize.resizeMegaMenu", o).trigger("resize.resizeMegaMenu")
			}
		},
		mobileMenu: {
			selector: "#mobile-menu",
			init: function () {
				var t = v(this.selector);
				("thb-submenu" === t.data("behaviour") ? t.find(".rt-mobile-menu li.menu-item-has-children>a") : t.find(".rt-mobile-menu li.menu-item-has-children>a>span")).on("click", function (t) {
					var e = v(this),
						a = e.parents("a").length ? e.parents("a") : e,
						o = a.next(".sub-menu");
					a.hasClass("active") ? (a.removeClass("active"), o.slideUp("200")) : (a.addClass("active"), o.slideDown("200")), t.stopPropagation(), t.preventDefault()
				})
			}
		},
		mobile_toggle: {
			selector: ".rt-mobile-toggle-holder",
			init: function () {
				var t = v(this.selector),
					e = gsap.timeline({
						paused: !0,
						reversed: !0,
						onStart: function () {
							h.addClass("open-cc")
						},
						onReverseComplete: function () {
							h.removeClass("open-cc"), gsap.set(u, {
								clearProps: "transform"
							})
						}
					}),
					a = v(".rt-mobile-menu>li", u),
					o = v(".thb-secondary-menu>li", u),
					i = v(".menu-footer>*", u),
					n = v(".thb-social-links-container>a", u),
					s = v(".rt-toggle-close", u),
					r = "start+=" + (l = themeajax.settings.mobile_menu_animation_speed) / 3 * 2,
					l = 0 === l ? .005 : l;
				e.to(u, {
					duration: l,
					x: "0"
				}, "start").to(s, {
					duration: l,
					scale: 1
				}, "start+=0.2").to(d, {
					duration: l,
					autoAlpha: 1
				}, "start").to(a, {
					duration: l / 2,
					autoAlpha: 1,
					stagger: .05
				}, r).from(o.add(i).add(n), {
					duration: l / 2,
					autoAlpha: 0,
					stagger: .05
				}, r), t.on("click", function () {
					return e.reversed() ? e.timeScale(1).play() : e.timeScale(1.5).reverse(), !1
				}), c.keyup(function (t) {
					27 === t.keyCode && 0 < e.progress() && e.timeScale(1.5).reverse()
				}), d.add(s).on("click", function () {
					return 0 < e.progress() && e.timeScale(1.5).reverse(), !1
				})
			}
		},
		desktopMenu: {
			selector: "#desktop-menu",
			init: function () {
				var t = v(this.selector);
				("thb-submenu" === t.data("behaviour") ? t.find(".rt-mobile-menu li.menu-item-has-children>a") : t.find(".rt-mobile-menu li.menu-item-has-children>a>span")).on("click", function (t) {
					var e = v(this),
						a = e.parents("a").length ? e.parents("a") : e,
						o = a.next(".sub-menu");
					a.hasClass("active") ? (a.removeClass("active"), o.slideUp("200")) : (a.addClass("active"), o.slideDown("200")), t.stopPropagation(), t.preventDefault()
				})
			}
		},
		desktop_toggle: {
			selector: ".rt-desktop-toggle-holder",
			init: function () {
				var t = v(this.selector),
					e = gsap.timeline({
						paused: !0,
						reversed: !0,
						onStart: function () {
							h.addClass("open-cc")
						},
						onReverseComplete: function () {
							h.removeClass("open-cc"), gsap.set(u, {
								clearProps: "transform"
							})
						}
					}),
					a = v(".rt-mobile-menu>li", u),
					o = v(".thb-secondary-menu>li", u),
					i = v(".menu-footer>*", u),
					n = v(".thb-social-links-container>a", u),
					s = v(".rt-toggle-close", u),
					r = "start+=" + (l = themeajax.settings.mobile_menu_animation_speed) / 3 * 2,
					l = 0 === l ? .005 : l;
				e.to(u, {
					duration: l,
					x: "0"
				}, "start").to(s, {
					duration: l,
					scale: 1
				}, "start+=0.2").to(d, {
					duration: l,
					autoAlpha: 1
				}, "start").to(a, {
					duration: l / 2,
					autoAlpha: 1,
					stagger: .05
				}, r).from(o.add(i).add(n), {
					duration: l / 2,
					autoAlpha: 0,
					stagger: .05
				}, r), t.on("click", function () {
					return e.reversed() ? e.timeScale(1).play() : e.timeScale(1.5).reverse(), !1
				}), c.keyup(function (t) {
					27 === t.keyCode && 0 < e.progress() && e.timeScale(1.5).reverse()
				}), d.add(s).on("click", function () {
					return 0 < e.progress() && e.timeScale(1.5).reverse(), !1
				})
			}
		},
		widget_nav_menu: {
			selector: ".widget_product_categories",
			init: function () {
				v(this.selector).find(".cat-parent").each(function () {
					var t = v(this),
						e = v(">a", t),
						a = t.find(">.sub-menu, >.children");
					a.before('<div class="rt-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>'), v(".rt-arrow", t).on("click", function (t) {
						var e = v(this).parents("li");
						e.hasClass("active") ? (e.removeClass("active"), a.slideUp("200")) : (e.addClass("active"), a.slideDown("200")), t.stopPropagation(), t.preventDefault()
					}), "#" === e.attr("href") && e.on("click", function (t) {
						var e = v(this),
							a = e.next(".sub-menu");
						e.hasClass("active") ? (e.removeClass("active"), a.slideUp("200")) : (e.addClass("active"), a.slideDown("200")), t.preventDefault()
					})
				})
			}
		},
	}, v(function () {
		v("#vc_inline-anchor").length ? y.on("vc_reload", function () {
			r.init()
		}) : r.init()
	})
}(jQuery, this);


var themeajax = {"settings":{"mobile_menu_animation_speed":"0.3"}};


})(jQuery)
