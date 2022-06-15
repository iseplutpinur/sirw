/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Mobile Menu Js
03. Sidebar Js
04. Cart Toggle Js
05. Search Js
06. Sticky Header Js
07. Data Background Js
08. Testimonial Slider Js
09. Slider Js (Home 3)
10. Brand Js
11. Tesimonial Js
12. Course Slider Js
13. Masonary Js
14. Wow Js
15. Data width Js
16. Cart Quantity Js
17. Show Login Toggle Js
18. Show Coupon Toggle Js
19. Create An Account Toggle Js
20. Shipping Box Toggle Js
21. Counter Js
22. Parallax Js
23. InHover Active Js
****************************************************/

(function ($) {
	"use strict";

	//===== Prealoder
	$(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
    
    //===== Search
    $('#search').on('click', function(){
        $(".search-box").fadeIn(600);
    });
    $('.closebtn').on('click', function(){
        $(".search-box").fadeOut(600);
    });

	//color mode activation
	var styleMode = document.querySelector('meta[name="theme-style-mode"]').content;
	var cookieKey = styleMode == 1 ? "client_dark_mode_style_cookie" : "client_light_mode_style_cookie";

	if (Cookies.get(cookieKey) == "dark") {
		$("body").removeClass("active-light-mode");
		$("body").addClass("active-dark-mode");
	} else if (Cookies.get(cookieKey) == "light") {
		$("body").removeClass("active-dark-mode");
		$("body").addClass("active-light-mode");
	} else {
		if (styleMode == 1) {
			$("body").addClass("active-light-mode");
		} else {
			$("body").addClass("active-dark-mode");
		}
	}


	////////////////////////////////////////////////////
	// 02. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "991",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

	////////////////////////////////////////////////////
	// 02. Mobile Menu Js
	$('#mobile-menu-6').meanmenu({
		meanMenuContainer: '.mobile-menu-6',
		meanScreenWidth: "999999991",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

    ////////////////////////////////////////////////////
    // 03. Sidebar Js
	$(".sidebar-toggle-btn").on("click", function () {
		$(".sidebar__area").addClass("sidebar-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".sidebar__close-btn").on("click", function () {
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 04. Body overlay Js
	$(".body-overlay").on("click", function () {
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
    // 05. Search Js
	$(".search-toggle").on("click", function () {
		$(".search__area").addClass("opened");
	});
	$(".search-close-btn").on("click", function () {
		$(".search__area").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 06. Sticky Header Js
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 200) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});


	////////////////////////////////////////////////////
	// 07. Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});
	
	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).attr("data-bg-color"));
    });

	////////////////////////////////////////////////////
	// 07. Nice Select Js
	$('select').niceSelect();


	////////////////////////////////////////////////////
	// 00. Slick Select Js
	$('.active-class').slick({
		dots: true,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
		  {
			breakpoint: 1024,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 3,
			  infinite: true,
			  dots: true
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 2
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	////////////////////////////////////////////////////
	// 08. slider__active Slider Js
	if (jQuery(".slider__active").length > 0) {
		let sliderActive1 = ".slider__active";
		let sliderInit1 = new Swiper(sliderActive1, {
			// Optional parameters
			slidesPerView: 1,
			slidesPerColumn: 1,
			paginationClickable: true,
			loop: true,
			effect: 'fade',

			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: ".main-slider-paginations",
				// dynamicBullets: true,
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			a11y: false,
		});

		function animated_swiper(selector, init) {
			let animated = function animated() {
				$(selector + " [data-animation]").each(function () {
					let anim = $(this).data("animation");
					let delay = $(this).data("delay");
					let duration = $(this).data("duration");

					$(this)
						.removeClass("anim" + anim)
						.addClass(anim + " animated")
						.css({
							webkitAnimationDelay: delay,
							animationDelay: delay,
							webkitAnimationDuration: duration,
							animationDuration: duration,
						})
						.one(
							"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
							function () {
								$(this).removeClass(anim + " animated");
							}
						);
				});
			};
			animated();
			// Make animated when slide change
			init.on("slideChange", function () {
				$(sliderActive1 + " [data-animation]").removeClass("animated");
			});
			init.on("slideChange", animated);
		}

		animated_swiper(sliderActive1, sliderInit1);
	}

	var sliderr = new Swiper('.blog-slider-active-15', {
		slidesPerView: 2,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".blog-slider-15-pagination",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: ".blog-slider-button-next",
			prevEl: ".blog-slider-button-prev",
		},
		breakpoints: {
			'1200': {
				slidesPerView: 2,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	var slider = new Swiper('.blog-slider-active', {
		slidesPerView: 3,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".blog-slider-pagination",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: ".blog-slider-button-next-1",
			prevEl: ".blog-slider-button-prev-1",
		},
		breakpoints: {
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 00. postbox__slider
	$('.postbox__slider').slick({
		dots: false,
		infinite: true,
		fade: true,
		speed: 500,
		slidesToShow: 1,
		centerMode: false,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
	});

	////////////////////////////////////////////////////
    // 09. Masonary Js
	$('.grid').imagesLoaded( function() {
		
		var $grid = $(".grid").isotope({
			// options
		});
		// filter items on button click
		$(".filter-button-group").on("click", "button", function () {
			var filterValue = $(this).attr("data-filter");
			$grid.isotope({ filter: filterValue });
		});

		//for menu active class
		$(".tpproject__menu button").on("click", function (event) {
			$(this).siblings(".active").removeClass("active");
			$(this).addClass("active");
			event.preventDefault();
		});
	});

	/* magnificPopup img view */
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: false
		}
	});

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	////////////////////////////////////////////////////
	// 10. Wow Js
	new WOW().init();

	
	////////////////////////////////////////////////////
	//00. Cart Quantity Js
	$(".cart-minus").on("click", function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$(".cart-plus").on("click", function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	});

	////////////////////////////////////////////////////
	// 11. Show Login Toggle Js
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 12. Show Coupon Toggle Js
	$('#showcoupon').on('click', function () {
		$('#checkout_coupon').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 13. Create An Account Toggle Js
	$('#cbox').on('click', function () {
		$('#cbox_info').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 14. Shipping Box Toggle Js
	$('#ship-box').on('click', function () {
		$('#ship-box-info').slideToggle(1000);
	});

	////////////////////////////////////////////////////
	// 15. Counter Js
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});

	////////////////////////////////////////////////////
	// 16. Parallax Js
	if ($('.scene').length > 0) {
		$('.scene').parallax({
			scalarX: 10.0,
			scalarY: 15.0,
		});
	};

	////////////////////////////////////////////////////
	// 17. InHover Active Js
	$('.hover__active').on('mouseenter', function () {
		$(this).addClass('active').parent().siblings().find('.hover__active').removeClass('active');
	});

	////////////////////////////////////////////////////
	// 18. tpbrand__slider Active Js
	$('.tpbrand__slider-active').slick({
        dots: false,
        infinite: true,
        speed: 500,
		slidesToShow: 5,
		slidesToScroll: 5,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
		responsive: [
			{
				breakpoint: 1920,
				settings: {
				  slidesToShow: 5,
				  slidesToScroll: 5,
				  infinite: true,
				  dots: false,
				}
			  },
			{
			  breakpoint: 1200,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 4,
				infinite: true,
				dots: false,
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 3
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
				breakpoint: 575,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1
				}
			}
		  ]
    });

	////////////////////////////////////////////////////
	// 00. testimonial vertical slider
	$('.test-content-slide').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.test-thumb-slide'
	});
	$('.test-thumb-slide').slick({
	slidesToShow: 4,
	slidesToScroll: 1,
	vertical: true,
	asNavFor: '.test-content-slide',
	dots: false,
	arrows: true,
	prevArrow: '<button type="button" class="tp-slick-prev"><i class="fa-solid fa-arrow-up"></i></button>',
	nextArrow: '<button type="button" class="tp-slick-next"><i class="fa-solid fa-arrow-down"></i></button>',
	centerMode: false,
	focusOnSelect: true,
	});

	////////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tp-slide-active').slick({
		dots: true,
		infinite: false,
		speed: 300,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 700,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	////////////////////////////////////////////////////
	// 00. tp-agency-slide-active
	$('.tp-agency-slide-active').slick({
		dots: false,
		infinite: true,
		fade: true,
		speed: 500,
		slidesToShow: 1,
		centerMode: false,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
	});

	////////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tp-agency-ts-active').slick({
		dots: false,
		infinite: false,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 700,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpfrn-slide-active').slick({
		dots: false,
		infinite: false,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 3,
		slidesToScroll: 1,
		appendArrows: $(".trfrn-arrow-display"),
		responsive: [
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 700,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpfrn-ts-slider-active').slick({
		dots: false,
		infinite: false,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 2,
		slidesToScroll: 1,
		appendArrows: $(".trfrn-arrow-display2"),
		responsive: [
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 700,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	////////////////////////////////////////////////////
	// 00. tp-agency-slide-active
	$('.tpbs-slider-active').slick({
		dots: true,
		infinite: false,
		fade: true,
		speed: 500,
		arrows: false,
		slidesToShow: 1,
		centerMode: false,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpbs-services__slider-active').slick({
		dots: false,
		infinite: true,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 4,
		slidesToScroll: 1,
		appendArrows: $(".tpbss-arrow-display"),
		responsive: [
		  {
			breakpoint: 1400,
			settings: {
			  slidesToShow: 4,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 576,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	////////////////////////////////////////////////////
	// 00. tpbrand__slider Active Js
	$('.tpbs-brand-slider-active').slick({
        dots: false,
        infinite: true,
        speed: 500,
		slidesToShow: 5,
		slidesToScroll: 5,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
		responsive: [
			{
				breakpoint: 1920,
				settings: {
				  slidesToShow: 5,
				  slidesToScroll: 5,
				}
			  },
			  {
				breakpoint: 1400,
				settings: {
				  slidesToShow: 4,
				  slidesToScroll: 2,
				}
			  },
			{
			  breakpoint: 1200,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 2,
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 3
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
				breakpoint: 575,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1
				}
			}
		  ]
    });

	////////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpbs-ts-slider-active').slick({
		dots: true,
		infinite: false,
		speed: 500,
		arrows: false,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="far fa-long-arrow-right"></i></button>',
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 700,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpm-ts-slider-active').slick({
		dots: true,
		infinite: true,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 3,
		slidesToScroll: 1,
		centerMode: true,
		appendArrows: $(".tpbss-arrow-display"),
		responsive: [
		  {
			breakpoint: 1400,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 576,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpblog__slider-active').slick({
		dots: true,
		infinite: true,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 3,
		slidesToScroll: 1,
		centerMode: true,
		appendArrows: $(".tpbss-arrow-display"),
		responsive: [
		  {
			breakpoint: 1400,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 576,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	////////////////////////////////////////////////////
    // 00. Creative Masonary Js
	if ($('.grid-masonry').length > 0) {
		$('.grid-masonry').imagesLoaded( function() {
			
			var $grid = $(".grid-masonry").isotope({
				itemSelector: '.grid-item',
				percentPosition: true,
			});
			// filter items on button click
			$(".filter-button-group").on("click", "button", function () {
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});
	
			//for menu active class
			$(".tp-creative__menu button").on("click", function (event) {
				$(this).siblings(".active").removeClass("active");
				$(this).addClass("active");
				event.preventDefault();
			});
		});
	};

	////////////////////////////////////////////////////
    // 00. Creative Masonary Js
	if ($('.grid-masonry-2').length > 0) {
		$('.grid-masonry-2').imagesLoaded( function() {
			
			var $grid = $(".grid-masonry-2").isotope({
				itemSelector: '.grid-item',
				percentPosition: true,
				masonry: {
					// use element for option
					columnWidth: 1
				  }
			});
			// filter items on button click
			$(".filter-button-group").on("click", "button", function () {
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});
	
			//for menu active class
			$(".tp-creative__menu button").on("click", function (event) {
				$(this).siblings(".active").removeClass("active");
				$(this).addClass("active");
				event.preventDefault();
			});
		});
	};

	////////////////////////////////////////////////////
	// 00. tp-agency-slide-active
	$('.tppotestimonial-slider-active').slick({
		dots: false,
		infinite: false,
		fade: true,
		speed: 500,
		arrows: true,
		slidesToShow: 1,
		centerMode: false,
		prevArrow: '<button type="button" class="tp-slick-prev"><i class="fal fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next"><i class="fal fa-chevron-right"></i></button>',
	});

	///////////////////////////////////////////////////
	// 00. tp-slide-active
	$('.tpblog__slider-active-2').slick({
		dots: true,
		infinite: true,
		speed: 500,
		prevArrow: '<button type="button" class="tp-slick-prev trfrn-arrow-style"><i class="fa-light fa-chevron-left"></i></button>',
		nextArrow: '<button type="button" class="tp-slick-next trfrn-arrow-style"><i class="fa-light fa-chevron-right"></i></button>',
		slidesToShow: 3,
		slidesToScroll: 1,
		centerMode: false,
		appendArrows: $(".tpbss-arrow-display"),
		responsive: [
		  {
			breakpoint: 1400,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 1200,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 576,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	// Jquery Appear raidal
	if (typeof ($.fn.knob) != 'undefined') {
		$('.knob').each(function () {
		var $this = $(this),
		knobVal = $this.attr('data-rel');

		$this.knob({
		'draw': function () {
			$(this.i).val(this.cv + '%')
		}
		});

		$this.appear(function () {
		$({
			value: 0
		}).animate({
			value: knobVal
		}, {
			duration: 2000,
			easing: 'swing',
			step: function () {
			$this.val(Math.ceil(this.value)).trigger('change');
			}
		});
		}, {
		accX: 0,
		accY: -150
		});
	});
	}

	// Jquery Appear
	//----------------------------------------------------------------------------------------
	if ($('.progress-bar').length) {
		$('.progress-bar').appear(function () {
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width', percent + '%');
		}, {
			accY: 0
		});
	}

	$('[data-countdown]').each(function() {

        var $this = $(this),
            finalDate = $(this).data('countdown');

        $this.countdown(finalDate, function(event) {

            $this.html(event.strftime('<div class="cdown day"><span class="time-count">%-D</span> <p>Days</p></div> <div class="cdown hour"><span class="time-count">%-H</span> <p>Hrs</p></div> <div class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></div> <div class="cdown second"> <div><span class="time-count">%S</span> <p>Sec</p></div>'));

        });

    });

})(jQuery);