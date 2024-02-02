/*
 Theme Name: Rafter
 Theme URI: http://themejunction.net/html/rafter/demo
 Author: Theme-Junction
 Author URI: https://themeforest.net/user/theme-junction/portfolio
 Description: Rafter - Roofing Services HTML5 Template
 Version: 1.0.0
 License:
 License URI:
*/

/*==================================
    [Table of contents]
===================================
    01. All Carousels
    02. Back To Top
    03. Sticky Header
    04. Data Image
	05. Hamburger Menu
	06. Offcanvas Menu
	07. Search Bar
	08. Mobile Menu
	09. Portfolio Filter
	10. Services Filter
	11. Accordion Js
	12. Magnific Popup
	13. FancyBox
	14. WOW
	15. Counter Up
	16. Preloader
	17. Form Submission
*/

(function ($) {
	"use strict";

	$(document).ready(function () {
		/*==========================
			01. All Carousels
		============================*/
		var swiper = new Swiper(".hero_slider_thumb", {
			spaceBetween: 0,
			slidesPerView: 3,
			freeMode: true,
			watchSlidesProgress: true,
		});
		var swiper2 = new Swiper(".hero_slider", {
			spaceBetween: 0,
			effect: "fade",
			loop: true,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			autoplay: {
				delay: 6000,
			},
			thumbs: {
				swiper: swiper,
			},
		});

		var heroSlider2 = $(".hero-slider-4");
		heroSlider2.owlCarousel({
			items: 1,
			nav: true,
			dots: false,
			loop: true,
			autoplayTimeout: 6000,
			autoplay: true,
			smartSpeed: 2000,
			navText: [
				'<i class="fa-light fa-arrow-left-long"></i>',
				'<i class="fa-light fa-arrow-right-long"></i>',
			],
			responsive: {
				0: {
					nav: false,
				},
				768: {
					nav: true,
				},
			},
			onInitialized: function (event) {
				var $firstAnimatingElements = $(".owl-item", heroSlider2)
					.eq(event.item.index)
					.find("[data-animation]");
				doAnimations($firstAnimatingElements);
			},
		});

		// /*** Animation */
		heroSlider2.on("changed.owl.carousel", function (event) {
			var $firstAnimatingElements = $(".owl-item", heroSlider2)
				.eq(event.item.index)
				.find("[data-animation]");
			doAnimations($firstAnimatingElements);
		});

		function doAnimations(elements) {
			var animationEndEvents =
				"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
			elements.each(function () {
				var $this = $(this);
				var $animationDelay = $this.data("delay");
				var $animationType = "animated " + $this.data("animation");
				$this.css({
					"animation-delay": $animationDelay,
					"-webkit-animation-delay": $animationDelay,
				});
				$this.addClass($animationType).one(animationEndEvents, function () {
					$this.removeClass($animationType);
				});
			});
		}

		$(".slider-test").owlCarousel({
			items: 3,
			nav: false,
			loop: true,
			margin: 30,
			autoplayTimeout: 8000,
			autoplay: false,
			dots: true,
			responsive: {
				// breakpoint from 0 up
				0: {
					items: 1,
				},
				// breakpoint from 480 up
				480: {
					items: 1,
				},
				// breakpoint from 768 up
				768: {
					items: 2,
				},
				// breakpoint from 1080 up
				1200: {
					items: 3,
				},
			},
		});
		$(".tj-slider").owlCarousel({
			items: 1,
			nav: true,
			loop: true,
			margin: 30,
			autoplayTimeout: 8000,
			autoplay: true,
			dots: false,
			navText: [
				'<i class="fa-solid fa-angle-left"></i>',
				'<i class="fa-solid fa-angle-right"></i>',
			],
		});

		$(".client__slider").owlCarousel({
			items: 1,
			nav: true,
			loop: true,
			margin: 30,
			autoplayTimeout: 8000,
			autoplay: true,
			dots: false,
			navText: [
				'<i class="fa-solid fa-angle-left"></i>',
				'<i class="fa-solid fa-angle-right"></i>',
			],
		});

		$(".client_say").owlCarousel({
			items: 3,
			nav: false,
			loop: true,
			margin: 30,
			autoplayTimeout: 8000,
			autoplay: true,
			dots: true,
			responsive: {
				// breakpoint from 0 up
				0: {
					items: 1,
				},
				// breakpoint from 480 up
				480: {
					items: 1,
				},
				// breakpoint from 768 up
				768: {
					items: 2,
				},
				// breakpoint from 1080 up
				1200: {
					items: 2,
				},
				1400: {
					items: 3,
				},
			},
		});
		$(".working_success-widget").owlCarousel({
			items: 1,
			nav: false,
			loop: true,
			margin: 20,
			autoplayTimeout: 2000,
			autoplay: true,
			dots: true,
			responsive: {
				// breakpoint from 0 up
				0: {
					items: 1,
				},
				// breakpoint from 480 up
				480: {
					items: 1,
				},
				// breakpoint from 768 up
				768: {
					items: 2,
				},
				// breakpoint from 1080 up
				1080: {
					items: 3,
				},
				// breakpoint from 1080 up
				1200: {
					items: 3,
				},
				// breakpoint from 1080 up
				1500: {
					items: 4,
				},
			},
		});

		var swiper = new Swiper(".tj-single-feature", {
			spaceBetween: 0,
			slidesPerView: 1,
			loop: true,
			speed: 1000,
			autoplay: {
				delay: 5000,
			},
			// pagination
			pagination: {
				el: ".feature_pagination",
				clickable: true,
			},
		});

		/*==========================
				02. Back To Top
		============================*/
		$.scrollUp({
			scrollName: "scrollUp", // Element ID
			topDistance: "1110", // Distance from top before showing element (px)
			topSpeed: 2000, // Speed back to top (ms)
			animation: "slide", // Fade, slide, none
			animationInSpeed: 300, // Animation in speed (ms)
			animationOutSpeed: 300, // Animation out speed (ms)
			scrollText: '<i class="fal fa-angle-up"></i>', // Text for element
			activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		});

		/*==========================
				03. Sticky Header
		============================*/
		$(window).scroll(function () {
			var Width = $(document).width();

			if ($("body").scrollTop() > 100 || $("html").scrollTop() > 100) {
				$(
					".header-1.is-sticky, .header-3.is-sticky, .header-5.is-sticky"
				).addClass("sticky");
			} else {
				$(
					".header-1.is-sticky, .header-3.is-sticky, .header-5.is-sticky"
				).removeClass("sticky");
			}
		});

		/*==========================
				04. Data Image
		============================*/
		$("[data-bg-image]").each(function () {
			var $this = $(this),
				$image = $this.data("bg-image");
			$this.css("background-image", "url(" + $image + ")");
		});

		/*==========================
				05. Hamburger Menu
		============================*/
		$("#hamburger, #hamburger2").on("click", function () {
			$(".hamburger-area").addClass("opened");
			$(".body-overlay").addClass("opened");
		});
		$(".hamburger_close_btn").on("click", function () {
			$(".hamburger-area").removeClass("opened");
			$(".body-overlay").removeClass("opened");
		});

		$(".body-overlay").on("click", function () {
			$(".hamburger-area").removeClass("opened");
			$(".body-overlay").removeClass("opened");
			$(".offset_canvas").removeClass("show");
		});
		/*==========================
				06. Offcanvas Menu
		============================*/
		$(".offset-canvas").on("click", function () {
			$(".offset_canvas").addClass("show");
			$(".body-overlay").addClass("opened");
		});

		$(".close-offset").on("click", function () {
			$(".offset_canvas").removeClass("show");
			$(".body-overlay").removeClass("opened");
		});

		/*==========================
				07. Search Bar
		============================*/
		$(".search-btn").on("click", function () {
			$(".search_popup").addClass("search-opened");
			$(".search-popup-overlay").addClass("search-popup-overlay-open");
		});

		$(".search_close_btn").on("click", function () {
			$(".search_popup").removeClass("search-opened");
			$(".search-popup-overlay").removeClass("search-popup-overlay-open");
		});
		$(".search-popup-overlay").on("click", function () {
			$(".search_popup").removeClass("search-opened");
			$(this).removeClass("search-popup-overlay-open");
		});

		/*==========================
				08. Mobile Menu
		============================*/
		$("#mobile-menu").meanmenu({
			meanMenuContainer: ".mobile_menu",
			meanScreenWidth: "991",
			meanExpand: ['<i class="fa-light fa-angle-right"></i>'],
		});

		/* =============================================
				09. Portfolio Filter
		===============================================*/
		$(".grids").imagesLoaded(function () {
			var $grid = $(".grids").isotope({
				itemSelector: ".grid-item",
				percentPosition: true,
				masonry: {
					columnWidth: ".grid-item",
				},
			});

			$(".project-cat-filter").on("click", "button", function () {
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});

			$(".project-cat-filter").click(function () {
				$("button").removeClass("active");
				$(this).addClass("active");
			});
		});

		$(".grid").imagesLoaded(function () {
			var $grid = $(".grid").isotope({
				layoutMode: "fitRows",
				itemSelector: ".grid-item",
				percentPosition: true,
				fitRows: {
					gutter: ".gutter-sizer",
				},
			});

			$(".project-cat-filter").on("click", "button", function () {
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});

			$(".project-cat-filter").click(function () {
				$("button").removeClass("active");
				$(this).addClass("active");
			});
		});

		/* =============================================
				10. Services Filter
		===============================================*/
		$(".service-filter-btn").click(function () {
			$(".service-filter-btn").removeClass("active");
			$(".tab-item-widget div").removeClass("active");

			$(this).addClass("active");
			$("." + $(this).attr("id")).addClass("active");
		});

		/* =============================================
				11. Accordion Js
		===============================================*/
		$(".accordion-item").click(function () {
			$(".accordion-item").removeClass("active");
			$(this).addClass("active");
		});

		/* =============================================
				12. Magnific Popup
		===============================================*/
		if ($(".popup-video").length > 0) {
			$(".popup-video").magnificPopup({
				type: "iframe",
				mainClass: "mfp-fade",
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false,
			});
		}

		/* =============================================
				13. FancyBox
		===============================================*/
		$(".lightbox-image").fancybox({
			openEffect: "fade",
			closeEffect: "fade",
			scrolling: "false",
		});
		$(".popup-project").fancybox({
			openEffect: "fade",
			closeEffect: "fade",
		});

		/* =============================================
				14. WOW
		===============================================*/
		if ($(".wow").length) {
			var wow = new WOW({
				boxClass: "wow",
				animateClass: "animated",
				mobile: true,
				live: true,
			});
			wow.init();
		}

		/* =============================================
				15. Counter Up
		===============================================*/
		$(".counter").counterUp({
			delay: 10,
			time: 1000,
		});
	}); // end document ready function

	/* =============================================
				16. Preloader
	===============================================*/
	$(window).load(function () {
		$("#loading").fadeOut(300);
	});
	if ($("#loading").length > 0) {
		$(".closeLoader").each(function () {
			$(this).on("click", function (e) {
				e.preventDefault();
				$("#loading").fadeOut(500);
			});
		});
	}
	$(".closeLoader").on("click", function () {
		$("#loading").fadeOut(500);
	});

	/* =============================================
				17. Form Submission
	===============================================*/
	if ($("#contact-form").length > 0) {
		$("#contact-form").validate({
			rules: {
				confname: "required",
				conEmail: {
					required: true,
					email: true,
				},
				conSubject: "required",
			},

			messages: {
				confname: "Enter your first name.",
				conEmail: "Enter a valid email.",
				conSubject: "Enter your Subject.",
			},
			submitHandler: function (form) {
				// start ajax request
				$.ajax({
					type: "POST",
					url: "assets/mail/contact-form.php",
					data: $("#contact-form").serialize(),
					cache: false,
					success: function (data) {
						if (data == "Y") {
							$("#message_sent").modal("show");
							$("#contact-form").trigger("reset");
						} else {
							$("#message_fail").modal("show");
						}
					},
				});
			},
		});
	}

	// inspection 1 form
	if ($("#inspection-form").length > 0) {
		$("#inspection-form").validate({
			rules: {
				inName: "required",
				inEmail: {
					required: true,
					email: true,
				},
				inLocation: "required",
			},

			messages: {
				inName: "Enter your full name.",
				inEmail: "Enter a valid email.",
				inLocation: "Enter your current location.",
			},
			submitHandler: function (form) {
				// start ajax request
				$.ajax({
					type: "POST",
					url: "assets/mail/inspection1-form.php",
					data: $("#inspection-form").serialize(),
					cache: false,
					success: function (data) {
						if (data == "Y") {
							$("#message_sent").modal("show");
							$("#inspection-form").trigger("reset");
						} else {
							$("#message_fail").modal("show");
						}
					},
				});
			},
		});
	}

	// inspection 2 form
	if ($("#inspection2-form").length > 0) {
		$("#inspection2-form").validate({
			rules: {
				inName: "required",
				inEmail: {
					required: true,
					email: true,
				},
				inLocation: "required",
			},

			messages: {
				inName: "Enter your full name.",
				inEmail: "Enter a valid email.",
				inLocation: "Enter your current location.",
			},
			submitHandler: function (form) {
				// start ajax request
				$.ajax({
					type: "POST",
					url: "assets/mail/inspection2-form.php",
					data: $("#inspection2-form").serialize(),
					cache: false,
					success: function (data) {
						if (data == "Y") {
							$("#message_sent").modal("show");
							$("#inspection2-form").trigger("reset");
						} else {
							$("#message_fail").modal("show");
						}
					},
				});
			},
		});
	}

	// inspection 3 form
	if ($("#inspection3-form").length > 0) {
		$("#inspection3-form").validate({
			rules: {
				inName: "required",
				inEmail: {
					required: true,
					email: true,
				},
				inLocation: "required",
			},

			messages: {
				inName: "Enter your full name.",
				inEmail: "Enter a valid email.",
				inLocation: "Enter your current location.",
			},
			submitHandler: function (form) {
				// start ajax request
				$.ajax({
					type: "POST",
					url: "assets/mail/inspection3-form.php",
					data: $("#inspection3-form").serialize(),
					cache: false,
					success: function (data) {
						if (data == "Y") {
							$("#message_sent").modal("show");
							$("#inspection3-form").trigger("reset");
						} else {
							$("#message_fail").modal("show");
						}
					},
				});
			},
		});
	}
})(jQuery); // End jQuery
