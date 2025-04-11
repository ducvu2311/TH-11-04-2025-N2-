/**
 * Script custom for theme
 *
 * TABLE OF CONTENT
 *
 * Header: main menu
 * Header: main menu mobile
 * Sidebar: sticky sidebar
 * Feature: Preloading
 * Feature: Back to top
 * Custom select.
 */

(function ($) {
	"use strict";

	$(document).ready(function () {
		Edu_Press.ready();
	});

	$(window).load(function () {
		Edu_Press.load();
	});

	var Edu_Press = {

		/**
		 * Call functions when document ready
		 */
		ready: function () {
			this.header_menu();
			this.back_to_top();
			this.feature_preloading();
			this.sticky_sidebar();
			this.thim_social_share();
			this.header_menu_mobile();
			this.close_top_bar();
		},

		/**
		 * Call functions when window load.
		 */
		load: function () {
			// this.header_menu_mobile();
			this.thim_post_gallery();
		},

		thim_social_share: function () {
			$(document).on('click', '.social-share-single', function (e) {
				e.stopPropagation();
				$('.social-share-single').addClass('open');
			})

			$(document).on('click', '#main-content, .social-share-single.open', function (e) {
				e.stopPropagation();
				$('.social-share-single').removeClass('open');
			})

		},

		// CUSTOM FUNCTION IN BELOW
		thim_post_gallery: function () {
 			if (jQuery().flexslider) {
				$('.flexslider').flexslider({
					slideshow     : true,
					animation     : 'fade',
					pauseOnHover  : true,
					animationSpeed: 400,
					smoothHeight  : true,
					directionNav  : true,
					controlNav    : false
				});
			}
 		},

 		/**
		 * Mobile menu
		 */

		 header_menu_mobile: function () {
			$(document).on('click', '.menu-mobile-effect', function (e) {
				e.stopPropagation();
				$('body').toggleClass('mobile-menu-open')
			})

			$(document).on('click', '#main-content, .main-navigation .thim-ekits-menu__mobile__close, .elementor', function (e) {
				e.stopPropagation();
				$('body').removeClass('mobile-menu-open')
			})

			$('.navbar-main-menu li.menu-item-has-children > a, .main-navigation .menu li.menu-item-has-children > a').after('<span class="icon-toggle"><i class="tk tk-angle-right"></i></span>');
			$("span").remove(".thim-ekits-menu__icon");
			$('.navbar-main-menu > li.menu-item-has-children .icon-toggle, .main-navigation .menu > li.menu-item-has-children .icon-toggle').on('click', function () {
				if ($(this).next('ul.sub-menu').is(':hidden')) {
					$(this).next('ul.sub-menu').slideDown(200, 'linear');
				}
			});

			// $('.main-navigation > .inner-navigation').after('<li class="thim-ekits-menu__mobile__close"><i class="tk tk-times"></i></li>');
			$('.navbar-main-menu .sub-menu > li:first-child, .main-navigation .menu .sub-menu > li:first-child').before('<li class="thim-ekits-menu__mobile__backlink"><i class="tk tk-angle-left"></i>Back</li>');

			$(document).on('click', '.navbar-main-menu > li.menu-item-has-children .icon-toggle, .main-navigation .menu > li.menu-item-has-children .icon-toggle', function (e) {
				e.stopPropagation();
				$(this).next('ul.sub-menu').addClass('show');
			})

			$(document).on('click', '.thim-ekits-menu__mobile__backlink', function (e) {
				e.preventDefault();
				$(this).parent('ul.sub-menu').removeClass('show').slideUp(200, 'linear');
			})
		},

		/**
		 * Header menu sticky, scroll, v.v.
		 */
		header_menu: function () {
			var $header = $('.sticky-header #masthead'),
				off_Top = ($('#wrapper-container').length > 0) ? $('#wrapper-container').offset().top : 0,
				$topbar = $('#thim-header-topbar'),
				menuH = $header.outerHeight(),
				latestScroll = 0,
				startFixed = 2;
			var $imgLogo = $('.site-header .thim-logo img'),
				srcLogo = $($imgLogo).attr('src'),
				dataRetina = $($imgLogo).data('retina'),
				dataSticky = $($imgLogo).data('sticky'),
				dataMobile = $($imgLogo).data('mobile'),
				dataStickyMobile = $($imgLogo).data('sticky_mobile');
			if ($topbar.length) {
				if ($topbar.hasClass('style-overlay')) {
					$header.css({
						top: $topbar.outerHeight() + 'px'
					});
				}
				startFixed = $topbar.outerHeight();
			}
			if ($(window).scrollTop() > 2) {
				$header.removeClass('affix-top').addClass('affix')
			}
			if ($(window).outerWidth() < 769) {
				if (dataMobile != null) {
					$($imgLogo).attr('src', dataMobile);
				}
			} else {
				if (window.devicePixelRatio > 1 && dataRetina != null) {
					$($imgLogo).attr('src', dataRetina);
				}
			}
			$(window).scroll(function () {
				var current = $(this).scrollTop();
				if (current > startFixed) {
					$header.removeClass('affix-top').addClass('affix');
					if ($(window).outerWidth() < 769) {
						if (dataStickyMobile != null) {
							$($imgLogo).attr('src', dataStickyMobile);
						}
					} else {
						if (dataSticky != null) {
							$($imgLogo).attr('src', dataSticky);
						}
					}
				} else {
					$header.removeClass('affix').addClass('affix-top');
					if ($(window).outerWidth() < 769) {
						if (dataMobile != null) {
							$($imgLogo).attr('src', dataMobile);
						}
					} else {
						if (window.devicePixelRatio > 1 && dataRetina != null) {
							$($imgLogo).attr('src', dataRetina);
						} else if (srcLogo != null) {
							$($imgLogo).attr('src', srcLogo);
						}
					}
				}

				if (current > latestScroll && current > menuH + off_Top) {
					if (!$header.hasClass('menu-hidden')) {
						$header.addClass('menu-hidden');
					}
				} else {
					if ($header.hasClass('menu-hidden')) {
						$header.removeClass('menu-hidden');
					}
				}

				latestScroll = current;
			});
		},

		/**
		 * Back to top
		 */
		back_to_top: function () {
			var $element = $('#back-to-top');
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$element.addClass('scrolldown').removeClass('scrollup');
				} else {
					$element.addClass('scrollup').removeClass('scrolldown');
				}
			});

			$element.on('click', function () {
				$('html,body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		},

		/**
		 * Sticky sidebar
		 */
		sticky_sidebar: function () {
			var offsetTop = 20;

			if ($("#wpadminbar").length) {
				offsetTop += $("#wpadminbar").outerHeight();
			}
			if ($("#masthead.affix").length) {
				offsetTop += $("#masthead.affix").outerHeight();
			}

			if ($('.sticky-sidebar').length > 0) {
				$("aside.sticky-sidebar").theiaStickySidebar({
					"containerSelector"     : "",
					"additionalMarginTop"   : offsetTop,
					"additionalMarginBottom": "0",
					"updateSidebarHeight"   : false,
					"minWidth"              : "768",
					"sidebarBehavior"       : "modern"
				});
			}

		},

		/**
		 * feature: Preloading
		 */
		feature_preloading: function () {
			var $preload = $('#thim-preloading');
			if ($preload.length > 0) {
				$preload.fadeOut(1000, function () {
					$preload.remove();
				});
			}
		},

		// close top bar
		close_top_bar: function(){
			$(document).on('click', '.close-topbar', function (e) {
				e.stopPropagation();
				$('body').toggleClass('close-topbar')
			})
		}

	};

})(jQuery);
