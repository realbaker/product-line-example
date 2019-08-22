/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {
  if(document.getElementById('product-anchors')){
    var waypoint = new Waypoint({
      element: document.getElementById('product-anchors'),
      handler: function(direction) {
        if(direction === 'down'){
          $('#menu-item-4').addClass('section-active');
        }
        if(direction === 'up'){
          $('#menu-item-4').removeClass('section-active');
        }
      }, offset: 69
    }); 
  }
  
  $('#menu-item-4 a').on('click', function(){
    $('.collapsed').slideUp();
  });
  
  $('#menu-main-navigation').slimmenu(
  {
      resizeWidth: '1174',
      collapserTitle: '',
      animSpeed: 'medium',
      easingEffect: null,
      indentChildren: false,
      childrenIndenter: '&nbsp;'
  });
  
  var $slick_slider = '';
  $slick_slider = $('.page-blocks-wrapper');
  var settings = {
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    asNavFor: '.page-blocks-nav-mobile'
  };
  
  var $slick_slider_2 = '';
  $slick_slider_2 = $('.product-anchor-list');
  var settings_2 = {
    slidesToShow: 2,
    swipeToSlide: true,
    dots: false,
    arrows:false,
    mobileFirst: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2
        }
      }
    ]
  };
  
  var $slick_slider_3 = ''
  $slick_slider_3 = $('.mobile-grid-slider');
  var settings_3 = {
    slidesToShow: 1,
    slidesToScroll: 1,
  };
  
  $slick_slider_3.slick(settings_3);
  
  if ($(window).width() < 768) {
    $slick_slider.slick(settings);
    $slick_slider_2.slick(settings_2);
  }

  // reslick only if it's not slick()
  $(window).on('resize', function() {
    if ($(window).width() > 767) {
      if ($slick_slider.hasClass('slick-initialized')) {
        $slick_slider.slick('unslick');
      }
      if($slick_slider_2.hasClass('slick-initialized')) {
        $slick_slider_2.slick('unslick');
      }
      return;
    }

    if (!$slick_slider.hasClass('slick-initialized')) {
      return $slick_slider.slick(settings);
    }
    if (!$slick_slider_2.hasClass('slick-initialized')) {
      return $slick_slider_2.slick(settings_2);
    }
  });
  
  $('.page-blocks-nav-mobile').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    asNavFor: '.page-blocks-wrapper',
    dots: false,
    arrows:false,
    centerMode: true,
    centerPadding: '20px',
    focusOnSelect: true
  });
  
  /*$('.launch-video').magnificPopup({
    type: 'iframe',
      iframe: {
         patterns: {
           youtube: {
             index: 'youtube.com', 
             id: 'v=', 
             src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
            }
         }
       }
  });
*/
  


  jQuery('a[href*="youtube.com/watch"], button[href*="youtube.com/watch"]').magnificPopup({
	   type: 'iframe',
	   iframe: {
	     patterns: {
	       youtube: {
	       	index: 'youtube.com', 
	       	id: 'v=', 
	       	src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1&enablejsapi=1'
	       }
	     }
	   },
    callbacks: {
      open: function() {
        if(ytTracker != null) {
          ytTracker.init();
        }
      }
    }
	});     
  
  
  
  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();
  
  $('a[href="#"]').on('click',function(e){
    e.preventDefault();
  });
  
  /* Smooth Scrolling on anchors */
  $('a[href^="#"], .home a[href^="/#"]')
    .not('[href="#"]')
    .not('[href="#more"]')
  
    .on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
  
  /* Product Toggle Content */
  $('.product-row').each(function(){
    $(this).find('.product-toggle').on('click', function(){
      $(this).parent().parent().parent().addClass('drop-open');
      $(this).parent().parent().parent().find('.show-more-content').fadeToggle();
      $(this).text($(this).text() === 'Show More' ? 'Show Less' : 'Show More');
    });
    $(this).find('.show-more-close, .show-less-ribbon').on('click',function(){
      $(this).parent().fadeOut(function(){
        $(this).parent().find('.product-toggle').text('Show More');
      });
      $(this).parent().removeClass('drop-open');
    });
  });
  
  /* Smooth Scrolling on show more */
  $('a[href^="#more"]')
  
    .on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top-100
	    }, 900, 'swing', function () {
	    });
	});
  

  /* Video Play on pages */
  $('.page-video video').click(function() {
    this.paused ? this.play() : this.pause();
    $('#button-with-poster').hide();
  });
  $('#button-with-poster').click(function(){
    $('.page-video video').get(0).play();
    $(this).hide();
  });
  
  $('.shop-gerbergear a, .inner-header a .white-btn').on('click', function(){
    ga('send', 'event', 'UserAction', 'Shop Click', 'Shop Click');
  });
  
  $('.social-links li a').each(function(){
    var $title = $(this).attr('title');
    $(this).on('click', function(){
      ga('send', 'event', 'UserAction', 'Footer Link Click', $title);
    });
  });
  
  $('.product-toggle').each(function(){
    var $productName = $(this).attr('title');
    $(this).on('click', function(){
      ga('send', 'event', 'Click', 'Open Product Detail', $productName);
    });
  });

}); /* end of as page load scripts */
