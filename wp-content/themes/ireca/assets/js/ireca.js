(function($){
	"use strict";
	$(document).ready(function(){
		
		var cal_lang = $('body').data( 'lang' );
		$.datetimepicker.setLocale( cal_lang );

		var disweek = $('body').data( 'disweek' );
		var disweek_arr = disweek.split(',').map(function(item) {
		    return parseInt(item, 10);
		});


		var time = $( 'body' ).data( 'time' );
		var time_arr = 	time.replace(/ /g,'').split( ',' );

		$('.ovacrs_datetimepicker').each(function(){

			var hour_default = $(this).data('hour_default');
			var time_step = $(this).data('time_step');
			var dateformat = $(this).data('dateformat');
			
			var today = new Date();
			

	        var datePickerOptions = {
	            format: dateformat,
	            firstDay: 1,
            	step: time_step,
            	minDate: today,
            	allowTimes: time_arr,
            	disabledWeekDays: disweek_arr,
            	defaultTime: hour_default
	        }
	        $(this).datetimepicker(datePickerOptions);
	        
	    });

	    /* Select 2 */
		$('select').select2({ 
			width: '100%'
		});

		if( $('#request_booking').length > 0 ) {
			$('#request_booking').validate();
		}

		if( $( '#booking_form' ).length > 0 ){
			$('#booking_form').validate();
		}

		if( $( '.ovacrs_search' ).length > 0 ){
			$('.ovacrs_search').validate();
		}

		if( $( '.widget_nav_menu ul li' ).length > 0 ){
			$( '.widget_nav_menu ul li a:empty' ).parent().css('display','none');
		}

		

		$('#request_booking .submit').on( "click", function(){
			var mesg = $(this).parent().data('mesg_required');	
			$.extend($.validator.messages, {
			    required: mesg,
			    remote: "Please fix this field.",
			    email: "Please enter a valid email address.",
			    url: "Please enter a valid URL.",
			    date: "Please enter a valid date.",
			    dateISO: "Please enter a valid date (ISO).",
			    number: "Please enter a valid number.",
			    digits: "Please enter only digits.",
			    creditcard: "Please enter a valid credit card number.",
			    equalTo: "Please enter the same value again.",
			    accept: "Please enter a value with a valid extension.",
			    maxlength: $.validator.format("Please enter no more than {0} characters."),
			    minlength: $.validator.format("Please enter at least {0} characters."),
			    rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
			    range: $.validator.format("Please enter a value between {0} and {1}."),
			    max: $.validator.format("Please enter a value less than or equal to {0}."),
			    min: $.validator.format("Please enter a value greater than or equal to {0}.")
			});
		});

		$('#booking_form .submit').on( "click", function(){
			var mesg = $(this).parent().data('mesg_required');	
			$.extend($.validator.messages, {
			    required: mesg,
			    remote: "Please fix this field.",
			    email: "Please enter a valid email address.",
			    url: "Please enter a valid URL.",
			    date: "Please enter a valid date.",
			    dateISO: "Please enter a valid date (ISO).",
			    number: "Please enter a valid number.",
			    digits: "Please enter only digits.",
			    creditcard: "Please enter a valid credit card number.",
			    equalTo: "Please enter the same value again.",
			    accept: "Please enter a value with a valid extension.",
			    maxlength: $.validator.format("Please enter no more than {0} characters."),
			    minlength: $.validator.format("Please enter at least {0} characters."),
			    rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
			    range: $.validator.format("Please enter a value between {0} and {1}."),
			    max: $.validator.format("Please enter a value less than or equal to {0}."),
			    min: $.validator.format("Please enter a value greater than or equal to {0}.")
			});
		});

		$('.ovacrs_search .submit').on( "click", function(){
			var mesg = $(this).parent().data('mesg_required');	
			$.extend($.validator.messages, {
			    required: mesg,
			    remote: "Please fix this field.",
			    email: "Please enter a valid email address.",
			    url: "Please enter a valid URL.",
			    date: "Please enter a valid date.",
			    dateISO: "Please enter a valid date (ISO).",
			    number: "Please enter a valid number.",
			    digits: "Please enter only digits.",
			    creditcard: "Please enter a valid credit card number.",
			    equalTo: "Please enter the same value again.",
			    accept: "Please enter a value with a valid extension.",
			    maxlength: $.validator.format("Please enter no more than {0} characters."),
			    minlength: $.validator.format("Please enter at least {0} characters."),
			    rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
			    range: $.validator.format("Please enter a value between {0} and {1}."),
			    max: $.validator.format("Please enter a value less than or equal to {0}."),
			    min: $.validator.format("Please enter a value greater than or equal to {0}.")
			});
		});
	    
	 
		/* Calendar */
		if( typeof order_time != 'undefined' ){
			var events = JSON.parse( order_time );
			$('.ireca__product_calendar').each(function(){
				var nav = $(this).data('nav');
				var default_view = $(this).data('default_view');
				var more_text = $(this).data( 'more_text' );
				$(this).fullCalendar({
			      header: {
			        left: 'prev,next today ',
			        center: 'title',
			        right: nav
			      },
			      
			      defaultView: default_view,
			      eventLimit: true,
			      events: events,
			      eventLimitText: more_text,
			      showNonCurrentDates: true,
			      locale: cal_lang,
			      views: {
				    month: {
				      eventLimit: 1 /* adjust to 6 only for agendaWeek/agendaDay */
				    },
				    agenda: {
				      eventLimit: 1 /* adjust to 6 only for agendaWeek/agendaDay */
				    },
				    week:{
				    	eventLimit: 1	
				    }
				  }
			    });
			});
		
		}

	});

	if( $("a[data-rel^='videoprettyPhoto']").length > 0 ){
	 	$("a[data-rel^='videoprettyPhoto']").prettyPhoto({
	 		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
	 		default_width: 720,
	 		default_height: 405
	 	});
    }


   

    if( $("a[data-gal^='prettyPhoto']").length > 0 ){
	 	$("a[data-gal^='prettyPhoto']").prettyPhoto({
	 		hook: 'data-gal', 
	 		theme: 'light_square',
	 		show_title: false,
	 		allow_resize: true,
	 		autoplay_slideshow:true,
	 		horizontal_padding: 20,
	 		
	 	});
    }

    if( $('.ireca-thumbnails').length > 0 ){
        $('.ireca-thumbnails').each(function(){

        	var rtl = false;
		 	if( $('body').hasClass('rtl') ){
		 		rtl = true;
		 	}

            $(this).owlCarousel({
                autoplay: true,
                autoplayHoverPause: true,
                loop: false,
                margin: 30,
                dots: true,
                nav: true,
                rtl: rtl,
                responsive: {
                    0:    {items: 2},
                    479:  {items: 2},
                    768:  {items: 3},
                    1024: {items: 4}
                }
            });
        });
    }
       



	
	
	/* Popup */
	$('[data-popup-open]').on('click', function(e)  {
		var targeted_popup_class = $(this).attr('data-popup-open');
		$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
		e.preventDefault();
	});
	$('[data-popup-close]').on('click', function(e)  {
		var targeted_popup_class = $(this).attr('data-popup-close');
		$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
		e.preventDefault();
	});

		
	/* Scroll */
	$('.scroll')
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .on( "click", function(event) {
	    // On-page links
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      /* Figure out element to scroll to */
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      /* Does a scroll target exist? */
	      if (target.length) {
	        /* Only prevent default if animation is actually gonna happen */
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000, function() {
	          /* Callback after animation */
	          /* Must change focus! */
	          var $target = $(target);
	          $target.focus();
	          if ($target.is(":focus")) { /* Checking if the target was focused*/
	            return false;
	          } else {
	            $target.attr('tabindex','-1'); /* Adding tabindex for elements not focusable*/
	            $target.focus(); /* Set focus again */
	          };
	        });
	      }
	    }
	  });


	/* Scroll to top */
	function scrollUp(options) {
	           
	    var defaults = {
	        scrollName: 'scrollUp', 
	        topDistance: 600, 
	        topSpeed: 800, 
	        animation: 'fade', 
	        animationInSpeed: 200, 
	        animationOutSpeed: 200, 
	        scrollText: '<i class="arrow_carrot-up"></i>', 
	        scrollImg: false, 
	        activeOverlay: false 
	    };

	    var o = $.extend({}, defaults, options),
	            scrollId = '#' + o.scrollName;


	    $('<a/>', {
	        id: o.scrollName,
	        href: '#top',
	        title: o.scrollText
	    }).appendTo('body');


	    if (!o.scrollImg) {

	        $(scrollId).html(o.scrollText);
	    }


	    $(scrollId).css({'display': 'none', 'position': 'fixed', 'z-index': '2147483647'});


	    if (o.activeOverlay) {
	        $("body").append("<div id='" + o.scrollName + "-active'></div>");
	        $(scrollId + "-active").css({'position': 'absolute', 'top': o.topDistance + 'px', 'width': '100%', 'border-top': '1px dotted ' + o.activeOverlay, 'z-index': '2147483647'});
	    }


	    $(window).scroll(function () {
	        switch (o.animation) {
	            case "fade":
	                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed));
	                break;
	            case "slide":
	                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed));
	                break;
	            default:
	                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0));
	        }
	    });

	    
	    $(scrollId).on( "click", function (event) {
	        $('html, body').animate({scrollTop: 0}, o.topSpeed);
	        event.preventDefault();
	    });

	}
	scrollUp();

	
	/* Stick Menu When Scroll Page */
	function ireca_scroll(){
		if( $('.ovamenu_shrink').length > 0 ){
			
			var header = $('.ovamenu_shrink');
			var scroll = $(window).scrollTop();

			if (scroll >= 250) {
	             header.addClass('active_fixed');
	        } else{
	            header.removeClass('active_fixed');
	        }

		}
	}
	$(window).scroll(function () { ireca_scroll(); });

       

})(jQuery);
