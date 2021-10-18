jQuery(document).ready(function($){
	/*====================================
	Submit Event
	======================================*/

	
	$(".event-attributes label").text("Event Link");
	$(".event-attributes input").addClass("w-50 marginLeft15");
	
	/*====================================
	SCROLL BACK TO TOP
	======================================*/
	
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});
	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		// Body + Modular page + Bespoke page 
		$('body,html, .is-selected, .projects-container').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);		
	});
	
	
	/*====================================
	DROPDOWN STORIES
	======================================*/
	
	var new_dropdown = jQuery("#post_tag").children().remove();
	
	$(".taglistdropdow").each(function(){ 
		if($(this).data('tag') == $(this).data('url')) {
			selected = " selected='selected' ";
		}
		else {
			selected = "";
		}
		
		$("#post_tag").append('<option class="level-0" '+ selected +' value="'+ $(this).data('tag') +'">' + $(this).data('name') + '</option>');	
	});
	
	


	/* ==============================================
	  	Page Scroll to ID
	   ============================================== */ 
	
  	$('a.page-scroll').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
//              scrollTop: target.offset().top - 60
              scrollTop: target.offset().top
            }, 900);
            return false;
          }
        }
      });

	 
	 /* ==============================================
	Navbar Sqeezing
	============================================= */

	
	var scroll_start = 0;
	var startchange = $('#wrapper-navbar');
	var offset = startchange.offset();
	if (startchange.length){
		$(document).scroll(function() { 
			scroll_start = $(this).scrollTop();
			if(scroll_start > offset.top) {
				$("img.brand-logo").addClass('logo-squeezed');
			} else {
				$('img.brand-logo').removeClass('logo-squeezed');
			}
		});
	}
	 
	 
	/* ==============================================
	  	Homepage carousel item same height
	  =============================================== */

	var maxHeight = Math.max.apply(null, $(".owl-item .colophon").map(function() {
        return $(this).outerHeight();
    }).get());
    // set all divs to the same height
    maxHeight -= 4;
    $('.owl-item .featuredImage').css({ height: maxHeight + 'px'});

	$(window).on('resize', function(){
		setTimeout(function (){		
			maxHeight = Math.max.apply(null, $(".owl-item .colophon").map(function() {
		        return $(this).outerHeight();
		    }).get());
		    // set all divs to the same height
		    maxHeight -= 4;
			//alert('maxHeight : '+maxHeight);
		    $('.owl-item .featuredImage').css({ height: maxHeight + 'px'});
		}, 1000); // How long do you want the delay to be (in milliseconds)? 
	});

	/*====================================
	Twitter Bootstrap DropDown on Hover and Activating Click Event on Parent Item
	http://wpeden.com/tipsntuts/twitter-bootstrap-dropdown-on-hover-and-activating-click-event-on-parent-item/
	======================================*/
	
	if($(window).width()>769){
        $('.navbar .dropdown').hover(function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
        }, function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
        });

        $('.navbar .dropdown > a').click(function(){
            location.href = this.href;
        });

    }
	


	/*========================================================
	=            SIngle program - collapse        =
	========================================================*/ 

	/* $('a.scrollToProgBtn').click(function() { 
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
//              scrollTop: target.offset().top - 60
              scrollTop: target.offset().top
            }, 900);
          }
        }
      }); 

	$('a.scrollToProgBtn').click(function() {  
		$('#collapseProgrammes').collapse('toggle');	
	}
	*/
	
	
	/*========================================================
	=            Bring parent of <a href tag clickable       =
	========================================================
  
	$('.c-news_list_wrapper').on('click','.c-news-list_item',function(e){
		console.log('ok');
		e.preventDefault();
		var url = $("a.mainBtn", $(this)).attr("href");
        document.location = url;
	});
	
*/
	$('.c-news_list_wrapper').on('click','.c-news-list_item',function(e){	
	  window.location = $(this).find(".mainBtn").attr("href"); 
	  return false;
	});
	
	$('.sidelist-item-wrapper').on('click','.sidelist-item',function(e){
		console.log ("ddd");	
	  window.location = $(this).find(".mainBtn").attr("href"); 
	  return false;
	});

	$('.home .events-table').on('click','article',function(e){	
	  window.location = $(this).find("h4 a").attr("href"); 
	  return false;
	});


	$('.home .js-newsblock-click').on('click','article',function(e){	
	  window.location = $(this).find(".more-link").attr("href"); 
	  return false;
	});
	$('.home .js-eventblock-click').on('click','article',function(e){
	  window.location = $(this).find(".btn").attr("href");
	  return false;
	});
	$('article.library--item').on('click','article',function(e){
	  window.location = $(this).find(".btn").attr("href");
	  return false;
	});
	


	/*========================================================
	=           Prog & Proj support page : scroll to chapter      =
	======================================================== */
	
	$('[data-spy="affix"]').on('affixed.bs.affix', function () {
        // from http://stackoverflow.com/questions/6551429/adjust-a-width-based-on-parent-w-jquery
        $(".affix").css("width",$(".affix").parent().css("width").replace('px','') - 30);
    })
	
	
	$('body').scrollspy({ target: '#chapter-navbar' })
	
	
	/*====================================
	Squeezebox Portfolio Template
	https://codyhouse.co/gem/squeezebox-portfolio-template/
	======================================*/


	var intro = $('.cd-intro-block'),
		projectsContainer = $('.cd-projects-wrapper'),
		projectsSlider = projectsContainer.children('.cd-slider'),
		//singleProjectContent = $('.cd-project-content'),
		sliderNav = $('.cd-slider-navigation');

	var resizing = false;
	
	//if on desktop - set a width for the projectsSlider element
	/* */
	setSliderContainer();
	$(window).on('resize', function(){
		//on resize - update projectsSlider width and translate value
		if( !resizing ) {
			(!window.requestAnimationFrame) ? setSliderContainer() : window.requestAnimationFrame(setSliderContainer);
			resizing = true;
		}
	}); 

	if ( $( 'a[data-action="show-projects"]' ).length ) {
		//$('#collapseProgrammes').collapse('hide');
		
		//show the programmes slider if user clicks the View other programmes button
		intro.on('click', 'a[data-action="show-projects"]', function(event) {
			
			// Scroll to programmes slider section
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	          var target = $(this.hash);
	          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	          if (target.length) {
	            $('html,body').animate({
					scrollTop: target.offset().top + 60
	            }, 900);
	          }
	        }
			//projects slider is visible - hide slider and show the intro panel
			if( intro.hasClass('projects-visible') && !$(event.target).is('a[data-action="show-projects"]') ) {
				intro.removeClass('projects-visible');
				projectsContainer.removeClass('projects-visible');
			} else {
				event.preventDefault();
				intro.addClass('projects-visible');
				projectsContainer.addClass('projects-visible');
				//animate single project - entrance animation
				setTimeout(function(){
					showProjectPreview(projectsSlider.children('li').eq(0));
				}, 200);
			}
		});
	} else {
		// Manually launch 
		projectsContainer.addClass('projects-visible');
		//animate single project - entrance animation
		setTimeout(function(){
			showProjectPreview(projectsSlider.children('li').eq(0));
		}, 200);
		
	}	
	
/*	
	intro.on('click', function(event) {
		//projects slider is visible - hide slider and show the intro panel
		if( intro.hasClass('projects-visible') && !$(event.target).is('a[data-action="show-projects"]') ) {
			intro.removeClass('projects-visible');
			projectsContainer.removeClass('projects-visible');
		}
	});
*/

	//select a single project - open project-content panel
	projectsContainer.on('click', '.cd-slider a', function(event) {
		var mq = checkMQ();
		//event.preventDefault();
		if( $(this).parent('li').next('li').is('.current') && (mq == 'desktop') ) {
			prevSides(projectsSlider);
		} else if ( $(this).parent('li').prev('li').prev('li').prev('li').is('.current')  && (mq == 'desktop') ) {
			nextSides(projectsSlider);
		} else {
			// singleProjectContent.addClass('is-visible');
		}
	});

	//close single project content
	/*
		singleProjectContent.on('click', '.close', function(event){
		event.preventDefault();
		singleProjectContent.removeClass('is-visible');
	});
	*/

	//go to next/pre slide - clicking on the next/prev arrow
	sliderNav.on('click', '.next', function(){
		nextSides(projectsSlider);
	});
	sliderNav.on('click', '.prev', function(){
		prevSides(projectsSlider);
	});

	//go to next/pre slide - keyboard navigation
	$(document).keyup(function(event){
		var mq = checkMQ();
		if(event.which=='37' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) {
			prevSides(projectsSlider);
		} else if( event.which=='39' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) {
			nextSides(projectsSlider);
		} /* else if(event.which=='27' && singleProjectContent.hasClass('is-visible')) {
			singleProjectContent.removeClass('is-visible');
		} */
	});

	projectsSlider.on('swipeleft', function(){
		var mq = checkMQ();
		if( !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) nextSides(projectsSlider);
	});

	projectsSlider.on('swiperight', function(){
		var mq = checkMQ();
		if ( !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) prevSides(projectsSlider);
	});

	function showProjectPreview(project) {
		if(project.length > 0 ) {
			setTimeout(function(){
				project.addClass('slides-in');
				showProjectPreview(project.next());
			}, 50);
		}
	}

	function checkMQ() {
		//check if mobile or desktop device
		if( $('.cd-projects-wrapper').length ) {
			return window.getComputedStyle(document.querySelector('.cd-projects-wrapper'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
		}
	}

	function setSliderContainer() {
		var mq = checkMQ();
		if(mq == 'desktop') {
			var	slides = projectsSlider.children('li'),
				slideWidth = slides.eq(0).width(),
				marginLeft = Number(projectsSlider.children('li').eq(1).css('margin-left').replace('px', '')),
				sliderWidth = ( slideWidth + marginLeft )*( slides.length + 1 ) + 'px',
				slideCurrentIndex = projectsSlider.children('li.current').index();
			projectsSlider.css('width', sliderWidth);
			( slideCurrentIndex != 0 ) && setTranslateValue(projectsSlider, (  slideCurrentIndex * (slideWidth + marginLeft) + 'px'));
		} else {
			projectsSlider.css('width', '');
			setTranslateValue(projectsSlider, 0);
		}
		resizing = false;
	}

	function nextSides(slider) {
		var actual = slider.children('.current'),
			index = actual.index(),
			following = actual.nextAll('li').length,
			width = actual.width(),
			marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

		index = (following > 4 ) ? index + 3 : index + following - 2;
		//calculate the translate value of the slider container
		translate = index * (width + marginLeft) + 'px';

		slider.addClass('next');
		setTranslateValue(slider, translate);
		slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			updateSlider('next', actual, slider, following);
		});

		if( $('.no-csstransitions').length > 0 ) updateSlider('next', actual, slider, following);
	}

	function prevSides(slider) {
		var actual = slider.children('.previous'),
			index = actual.index(),
			width = actual.width(),
			marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

		translate = index * (width + marginLeft) + 'px';

		slider.addClass('prev');
		setTranslateValue(slider, translate);
		slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			updateSlider('prev', actual, slider);
		});

		if( $('.no-csstransitions').length > 0 ) updateSlider('prev', actual, slider);
	}

	function updateSlider(direction, actual, slider, numerFollowing) {
		if( direction == 'next' ) {
			
			slider.removeClass('next').find('.previous').removeClass('previous');
			actual.removeClass('current');
			if( numerFollowing > 4 ) {
				actual.addClass('previous').next('li').next('li').next('li').addClass('current');
			} else if ( numerFollowing == 4 ) {
				actual.next('li').next('li').addClass('current').prev('li').prev('li').addClass('previous');
			} else {
				actual.next('li').addClass('current').end().addClass('previous');
			}
		} else {
			
			slider.removeClass('prev').find('.current').removeClass('current');
			actual.removeClass('previous').addClass('current');
			if(actual.prevAll('li').length > 2 ) {
				actual.prev('li').prev('li').prev('li').addClass('previous');
			} else {
				( !slider.children('li').eq(0).hasClass('current') ) && slider.children('li').eq(0).addClass('previous');
			}
		}
		
		updateNavigation();
	}

	function updateNavigation() {
		//update visibility of next/prev buttons according to the visible slides
		var current = projectsContainer.find('li.current');
		(current.is(':first-child')) ? sliderNav.find('.prev').addClass('inactive') : sliderNav.find('.prev').removeClass('inactive');
		(current.nextAll('li').length < 3 ) ? sliderNav.find('.next').addClass('inactive') : sliderNav.find('.next').removeClass('inactive');
	}

	function setTranslateValue(item, translate) {
		item.css({
		    '-moz-transform': 'translateX(-' + translate + ')',
		    '-webkit-transform': 'translateX(-' + translate + ')',
			'-ms-transform': 'translateX(-' + translate + ')',
			'-o-transform': 'translateX(-' + translate + ')',
			'transform': 'translateX(-' + translate + ')',
		});
	}
	
	
	if ( $( ".cd-projects-wrapper" ).length ) {
		
	    
	    //if on desktop - set a width for the projectsSlider element
		setSliderContainer();
		$(window).on('resize', function(){
			//on resize - update projectsSlider width and translate value
			if( !resizing ) {
				(!window.requestAnimationFrame) ? setSliderContainer() : window.requestAnimationFrame(setSliderContainer);
				resizing = true;
			}
		});
	    
	    /* Manually launch 	
		
		projectsContainer.addClass('projects-visible');
		//animate single project - entrance animation
		setTimeout(function(){
			showProjectPreview(projectsSlider.children('li').eq(0));
		}, 200);*/
	
	} 
	
	/*========================================================
	=            NEWSLETTER FORM                             =
	======================================================== */
    $('#newsletterForm').submit(function (e) {
		e.preventDefault();
		$.getJSON(
		this.action + "?callback=?",
		$(this).serialize(),
		function (data) {
		  if (data.Status === 400) {
		    	//alert("Error: " + data.Message);
		        $("div.notify-msg").fadeOut();
		    	$("div.no-notify").fadeOut(300, function () {
		        	$("div#notify-failed").fadeIn().delay(3200).fadeOut(300, function (){
		            	$("div.no-notify").fadeIn()
		            });
		      	});
		  } else { // 200
			    //alert("Success: " + data.Message);
				$("div.notify-msg").fadeOut();
				$("div.no-notify").fadeOut(300, function () {
				  	$("div#notify-success").fadeIn().delay(3200).fadeOut(300, function (){
				      	$("div.no-notify").fadeIn();$("#fieldEmail").delay(1200).val("");
				    });
				});
				/* _gaq.push(['_trackEvent', 'Newsletter Inscription' ,'Mailinglist +1' ,'']); */
		  }
		});
    });
	
});




/*========================================================
=            MODAL NEWSLETTER AFTER SECONDS OF IDLE      =
======================================================== */
/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));

idleTimer = null;
idleState = false;
idleWait = 7500;

    jQuery(document).ready(function($){
    
        $('*').bind('mousemove keydown scroll', function () {
        
            clearTimeout(idleTimer);
                    
            // if (idleState == true) { 
                // Reactivated event
               // $("body").append("<p>Welcome Back.</p>");            
            // } 
            
            idleState = false;
            idleTimer = setTimeout(function () { 
                
                // Idle Event
                //$("body").append("<p>You've been idle for " + idleWait/1000 + " seconds.</p>");                
                var visits = jQuery.cookie('NoMoreTesimSubscr') || 0;
                visits++;
                jQuery.cookie('NoMoreTesimSubscr', visits, { expires: 1, path: '/' });

//              console.debug(jQuery.cookie('NoMoreTesimSubscr'));
				
                
                if (jQuery.cookie('NoMoreTesimSubscr') > 1 ) {
                    // console.log('ok < 1');                                    
                } else {
		         	jQuery('#newsletter-modal').fadeIn();
				 	jQuery('#newsletter-modal').addClass('show');   
		            //console.log('ok < 1');
                }
                idleState = true; }, idleWait);
        });
        $("body").trigger("mousemove");
        
        $('#newsletter-modal a.btnclose').click(function(){
	      	$('#newsletter-modal').fadeOut();
	  	});
        
    });


/* ==============================================
	  	Homepage 4 sectors
	   ============================================== */

jQuery(document).ready(function($){
	
	//cache DOM elements
	var themesContainer = $('.themes-jumbotron-container'),
		themesWrapper = themesContainer.find('.themes-jumbotron-wrapper'),
		themesPreviews = themesWrapper.children('li'),

		//if browser doesn't support CSS transitions...
		transitionsNotSupported = ( $('.no-csstransitions').length > 0);    
    
	//check if background-images have been loaded and show project previews
	themesPreviews.children('a').bgLoaded({
	  	afterLoaded : function(){
		  	console.log("bg is loaded")
	   		showThemes(themesPreviews.eq(0));
	  	}
	});

	function showThemes(themesPreviews) {
		if(themesPreviews.length > 0 ) {
			setTimeout(function(){
				themesPreviews.addClass('bg-loaded');
				showThemes(themesPreviews.next());
			}, 150);
		}
	}
});




/* ==============================================
	  	Homepage 4 sectors
	   ============================================== */ 

jQuery(document).ready(function($){
	//cache DOM elements
	var projectsContainer = $('.cd-projects-container'),
		projectsPreviewWrapper = projectsContainer.find('.cd-projects-previews'),
		projectPreviews = projectsPreviewWrapper.children('li'),
		projects = projectsContainer.find('.cd-projects'),
		navigationTrigger = $('.cd-nav-trigger'),
		navigation = $('.cd-primary-nav'),
		//if browser doesn't support CSS transitions...
		transitionsNotSupported = ( $('.no-csstransitions').length > 0);

	var animating = false,
		//will be used to extract random numbers for projects slide up/slide down effect
		numRandoms = projects.find('li').length, 
		uniqueRandoms = [];

	//open project
	projectsPreviewWrapper.on('click', 'a', function(event){
		event.preventDefault();
		if( animating == false ) {
			animating = true;
			navigationTrigger.add(projectsContainer).addClass('project-open');
			openProject($(this).parent('li'));
		}
	});

	navigationTrigger.on('click', function(event){
		event.preventDefault();
		
		if( animating == false ) {
			animating = true;
			if( navigationTrigger.hasClass('project-open') ) {
				//close visible project
				navigationTrigger.add(projectsContainer).removeClass('project-open');
				closeProject();
			} /*
else if( navigationTrigger.hasClass('nav-visible') ) {
				//close main navigation
				navigationTrigger.removeClass('nav-visible');
				navigation.removeClass('nav-clickable nav-visible');
				if(transitionsNotSupported) projectPreviews.removeClass('slide-out');
				else slideToggleProjects(projectsPreviewWrapper.children('li'), -1, 0, false);
			} else {
				//open main navigation
				navigationTrigger.addClass('nav-visible');
				navigation.addClass('nav-visible');
				if(transitionsNotSupported) projectPreviews.addClass('slide-out');
				else slideToggleProjects(projectsPreviewWrapper.children('li'), -1, 0, true);
			}
*/
		}	

		if(transitionsNotSupported) animating = false;
	});

	//scroll down to project info
/*
	projectsContainer.on('click', '.scroll', function(){
		projectsContainer.animate({'scrollTop':$(window).height()}, 500); 
	});
*/

	//check if background-images have been loaded and show project previews
	projectPreviews.children('a').bgLoaded({
	  	afterLoaded : function(){
	   		showPreview(projectPreviews.eq(0));
	  	}
	});

	function showPreview(projectPreview) {
		if(projectPreview.length > 0 ) {
			setTimeout(function(){
				projectPreview.addClass('bg-loaded');
				showPreview(projectPreview.next());
			}, 150);
		}
	}

	function openProject(projectPreview) {
		var projectIndex = projectPreview.index();
		projects.children('li').eq(projectIndex).add(projectPreview).addClass('selected');
		
		if( transitionsNotSupported ) {
			projectPreviews.addClass('slide-out').removeClass('selected');
			projects.children('li').eq(projectIndex).addClass('content-visible');
			animating = false;
		} else { 
			slideToggleProjects(projectPreviews, projectIndex, 0, true);
		}
	}

	function closeProject() {
		projects.find('.selected').removeClass('selected').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$(this).removeClass('content-visible').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
			slideToggleProjects(projectsPreviewWrapper.children('li'), -1, 0, false);
		});

		//if browser doesn't support CSS transitions...
		if( transitionsNotSupported ) {
			projectPreviews.removeClass('slide-out');
			projects.find('.content-visible').removeClass('content-visible');
			animating = false;
		}
	}

	function slideToggleProjects(projectsPreviewWrapper, projectIndex, index, bool) {
		if(index == 0 ) createArrayRandom();
		if( projectIndex != -1 && index == 0 ) index = 1;

		var randomProjectIndex = makeUniqueRandom();
		if( randomProjectIndex == projectIndex ) randomProjectIndex = makeUniqueRandom();
		
		if( index < numRandoms - 1 ) {
			projectsPreviewWrapper.eq(randomProjectIndex).toggleClass('slide-out', bool);
			setTimeout( function(){
				//animate next preview project
				slideToggleProjects(projectsPreviewWrapper, projectIndex, index + 1, bool);
			}, 150);
		} else if ( index == numRandoms - 1 ) {
			//this is the last project preview to be animated 
			projectsPreviewWrapper.eq(randomProjectIndex).toggleClass('slide-out', bool).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				if( projectIndex != -1) {
					projects.children('li.selected').addClass('content-visible');
					projectsPreviewWrapper.eq(projectIndex).addClass('slide-out').removeClass('selected');
				} else if( navigation.hasClass('nav-visible') && bool ) {
					navigation.addClass('nav-clickable');
				}
				projectsPreviewWrapper.eq(randomProjectIndex).off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
				animating = false;
			});
		}
	}

	//http://stackoverflow.com/questions/19351759/javascript-random-number-out-of-5-no-repeat-until-all-have-been-used
	function makeUniqueRandom() {
	    var index = Math.floor(Math.random() * uniqueRandoms.length);
	    var val = uniqueRandoms[index];
	    // now remove that value from the array
	    uniqueRandoms.splice(index, 1);
	    return val;
	}

	function createArrayRandom() {
		//reset array
		uniqueRandoms.length = 0;
		for (var i = 0; i < numRandoms; i++) {
            uniqueRandoms.push(i);
        }
	}
});

 /*
 * BG Loaded
 * Copyright (c) 2014 Jonathan Catmull
 * Licensed under the MIT license.
 */
 (function($){
 	$.fn.bgLoaded = function(custom) {
	 	var self = this;

		// Default plugin settings
		var defaults = {
			afterLoaded : function(){
				this.addClass('bg-loaded');
			}
		};

		// Merge default and user settings
		var settings = $.extend({}, defaults, custom);

		// Loop through element
		self.each(function(){
			var $this = $(this),
				bgImgs = $this.css('background-image').split(', ');
			$this.data('loaded-count',0);
			$.each( bgImgs, function(key, value){
				var img = value.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
				$('<img/>').attr('src', img).load(function() {
					$(this).remove(); // prevent memory leaks
					$this.data('loaded-count',$this.data('loaded-count')+1);
					if ($this.data('loaded-count') >= bgImgs.length) {
						settings.afterLoaded.call($this);
					}
				});
			});

		});
	};
})(jQuery);