/*
These functions make sure WordPress
and Foundation play nice together.
*/

jQuery(document).ready(function() {

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

	// Adds Flex Video to YouTube and Vimeo Embeds
	jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
		if ( jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5 ) {
		  jQuery(this).wrap("<div class='widescreen responsive-embed'/>");
		} else {
		  jQuery(this).wrap("<div class='responsive-embed'/>");
		}
	});
});

jQuery(document).ready(function() {

	var $ = jQuery;

	function navOffset() {
		var navHeight = $('.top-bar').outerHeight();
		$('.top-bar-offset').css('height', navHeight);
		// console.log(navHeight, 'resize');
	}
	navOffset();

  function parallaxBG() {
    var scrollPos = $(window).scrollTop(),
        bodyHeight = $('body').outerHeight();

    var posPercentage = 0 - ((scrollPos / bodyHeight) * 100);
    $('body').css('background-position', '100% '+posPercentage+'%');
    // console.log(posPercentage);
    // $('body').css
  }
  parallaxBG();

	$(window).on('scroll resize', function() {
		navOffset();
    parallaxBG();
	});

  var headerlightbox = $('.header-carousel a').simpleLightbox({}),
      floorplanlightbox = $('.floorplan-carousel a').simpleLightbox({});

  $('.header-carousel').slick({
    arrows: true,
    prevArrow: '<button type="button" class="slick-prev elegant-icon">#</button>',
    nextArrow: '<button type="button" class="slick-next elegant-icon">$</button>',
  });

  $('.floorplan-carousel').slick({
    arrows: true,
    adaptiveHeight: true,
    prevArrow: '<button type="button" class="slick-prev elegant-icon">#</button>',
    nextArrow: '<button type="button" class="slick-next elegant-icon">$</button>',
  });

  $('.casestudy-slider').each(function() {
    $(this).slick({
      arrows: true,
      adaptiveHeight: true,
      prevArrow: '<button type="button" class="slick-prev elegant-icon">#</button>',
      nextArrow: '<button type="button" class="slick-next elegant-icon">$</button>',
    });
  });

  $(".tabs").on("change.zf.tabs", function () {
    $('.casestudy-slider').each(function() {
      $(this).slick("setPosition");
    });
  });


  $('.featured-listing-slider').on('init', function(event, slick) {
    $('.listing-features .counter').text('01' + '/' + pad(slick.slideCount, 2));
  });

  var $featuredListingSlider = $('.featured-listing-slider').slick({
    arrows: true,
    adaptiveHeight: true,
    prevArrow: '<button type="button" class="slick-prev elegant-icon">#</button>',
    nextArrow: '<button type="button" class="slick-next elegant-icon">$</button>'
  });

  	$('.bb-slick-testimonials').slick({
      adaptiveHeight: false,
  		prevArrow: '<button type="button" class="slick-prev elegant-icon">#</button>',
  		nextArrow: '<button type="button" class="slick-next elegant-icon">$</button>'
  	}).on('setPosition', function (event, slick) {
        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
    });

  $('.featured-listing-slider').on('afterChange', function(event, slick, currentSlide, nextSlide) {
    var currSlide = $(this).slick('slickCurrentSlide') + 1;
    $('.listing-features .counter').text(pad(currSlide, 2) + '/' + pad(slick.slideCount, 2));
  });

  function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
  }

  $('.gray-header .subhead-menu a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(e) {
    e.stopImmediatePropagation();

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
        location.hostname == this.hostname) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - $('.top-bar-offset').outerHeight()
        }, 1000);
      }
    }
  });

  $('a[data-open]').click(function(e) {
    e.preventDefault();
  });
});
