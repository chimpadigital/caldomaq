
(function($){
	"use strict";

	

	$(window).on('elementor/frontend/init', function () {
		
		elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_product_filter.default', function(){
			if( $('.ovacrs_product_filter .tab-content .tab-pane').length > 0 ){  
				 $('.ovacrs_product_filter .tab-content .tab-pane .owl-carousel').each(function(){

				 	var total_columns_slide = $(this).data('total_columns_slide');
				 	var show_dots = $(this).data('show_dots');
				 	var rtl = false;
				 	if( $('body').hasClass('rtl') ){
				 		rtl = true;
				 	}
				 	
				 	$(this).owlCarousel({
					    loop:false,
					    margin: 30,
					    nav:false,
				    	dots: show_dots,
				    	rtl: rtl,
					    responsive:{
					        0:{
					            items:1
					        },
					        768:{
					            items: 2
					        },
					        1200:{
					        	items: total_columns_slide
					        }
					    }
					});
				 	
					
				});

				var owl = $('.ovacrs_product_filter .tab-content .tab-pane .owl-carousel');
				owl.owlCarousel();
				
				$('.carousel-control-next').click(function() {
				    owl.trigger('next.owl.carousel');
				})
				
				$('.carousel-control-prev').click(function() {
				    
				    owl.trigger('prev.owl.carousel', [300]);
				})
			}

			$('.ovacrs_product_filter .tab-content .owl-carousel').each(function(){
				var $cat_slug = $(this).data('cat_slug');
				var $total_items = $(this).data('total_items');

				$( '.ovacrs_product_filter ul.nav li .total_items' ).each(function(){
					if( $(this).hasClass( $cat_slug ) ){
						$(this).empty().append( $total_items );
					}
				});

			});
			$( '.ovacrs_product_filter ul.nav li a.nav-link' ).click(function(){
				$(this).parent().parent().find('li a').removeClass('current');
				$(this).parent().parent().find('li .total_items').removeClass('current');
			});
			


		});



		/* Testimonials */
		elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_testimonial.default', function(){
		 	if( $('.ovacrs_testimonial').length > 0 ){
			 	$('.ovacrs_testimonial').each(function(){

		            var auto_slider = $(this).data('auto_slider');
		            var duration = $(this).data('duration');
		            var pagination = $(this).data('pagination');
		            var loop = $(this).data('loop');
		            var count = $(this).data('count');

		            var count_ipad = $(this).data('count_ipad');
		            var count_mobile = $(this).data('count_mobile');

		            var rtl = false;
				 	if( $('body').hasClass('rtl') ){
				 		rtl = true;
				 	}
		            

		            $(this).owlCarousel({
		                autoplay: auto_slider,
		                autoplayHoverPause: true,
		                loop: loop,
		                margin: 30,
		                rtl: rtl,
		                dots: pagination,
		                autoplayTimeout: duration,
		                responsiveRefreshRate: 100,
		                responsive: {
		                    0:    {items: count_mobile},
		                    479:  {items: count_mobile},
		                    768:  {items: count_ipad},
		                    991:  {items: count},
		                    1024: {items: count}
		                }
		            });
		        });
	        }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_product_slider.default', function(){

		 	if( $('.ovacrs_product_slider_slick').length > 0 ){

		 		$( '.ovacrs_product_slider_slick' ).each(function(){

		 			var slidestoshow = $(this).data('slidestoshow');
		 			var total_item = $(this).data('total_item');
		 			var centermode_setting = $(this).data('centermode');
		 			var autoplay = $(this).data('autoplay');
		 			var autoplayspeed = $(this).data('autoplayspeed');
		 			var show_nav = $(this).data('show_nav');
		 			var show_dots = $(this).data('show_dots');

		 			if( total_item > slidestoshow ){
		 				var centerMode = centermode_setting;
		 			}else{
		 				var centerMode = false;
		 			}

		 			var rtl = false;
				 	if( $('body').hasClass('rtl') ){
				 		rtl = true;
				 	}

		 			$(this).slick({
					  slidesToShow: slidestoshow,
					  slidesToScroll: 1,
					  focusOnSelect: true,
					  dots: show_dots,
					  arrows: show_nav,
					  centerMode: centerMode,
					  autoplay: autoplay,
					  rtl: rtl,
  					  autoplaySpeed: autoplayspeed,
  					  responsive: [
  					  		{
						      breakpoint: 1200,
						      settings: {
						        slidesToShow: 2
						      }
						    },
						    
						    {
						      breakpoint: 767,
						      settings: {
						        slidesToShow: 1,
						      }
						    },
						    {
						      breakpoint: 480,
						      settings: {
						        slidesToShow: 1,
						        centerMode: false
						      }
						    }
					    ]
					  
					});
		 		});

			}
	        
     	});

        elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_skill.default', function(){

        	$(document).ready(function(){
        		if( $('.ovacrs_count').length > 0 ){

        			$('.ovacrs_count').each(function () {
        				$(this).waypoint(function(direction){

	        				var speedtime = parseInt( $(this).data('speedtime') );
						    $(this).prop('Counter', 0).animate({
						            Counter: parseInt( $(this).data('value') )
						        }, {
						        duration: speedtime,
						        easing: 'swing',
						        step: function (now) {                      
						            $(this).text(Math.ceil(this.Counter));
						        }
						    });

					    },
					    { offset: '70%'}
					    );
					});
	   
	        	}
        	});

		});


        /* Team */
        elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_team.default', function(){
		 	if( $('.ovacrs_team').length > 0 ){
			 	$('.ovacrs_team').each(function(){

		            var auto_slider = $(this).data('auto_slider');
		            var duration = $(this).data('duration');
		            var pagination = $(this).data('pagination');
		            var loop = $(this).data('loop');
		            var count = $(this).data('count');

		            var count_ipad = $(this).data('count_ipad');
		            var count_mobile = $(this).data('count_mobile');
		            
		            var rtl = false;
				 	if( $('body').hasClass('rtl') ){
				 		rtl = true;
				 	}

		            $(this).owlCarousel({
		                autoplay: auto_slider,
		                autoplayHoverPause: true,
		                loop: loop,
		                margin: 30,
		                rtl: rtl,
		                dots: pagination,
		                autoplayTimeout: duration,
		                responsiveRefreshRate: 100,
		                responsive: {
		                    0:    {items: count_mobile},
		                    460:  {items: count_ipad},
		                    768:  {items: count_ipad},
		                    991:  {items: count},
		                    1024: {items: count}
		                }
		            });
		        });
	        }
        });
		
        /* Poup Video */
        elementorFrontend.hooks.addAction('frontend/element_ready/ovacrs_video_popup.default', function(){
		 	if( $("a[data-rel^='prettyPhoto']").length > 0 ){
			 	$("a[data-rel^='prettyPhoto']").prettyPhoto();
		        }
	        });

	        /* Map */
	   	elementorFrontend.hooks.addAction( 'frontend/element_ready/ovacrs_map.default', function(){

	   		

	   		if( typeof vehicle_data != 'undefined' ){

	   			var i = 0;
	   			var zoom_map = 10;
	   			var readmore_text = '';
	   			var icon1, icon2, icon3, icon4, icon5;

	   			if( typeof attr_map != 'undefined' ){
	   				var attr_map_val = JSON.parse( attr_map );

	   				zoom_map = attr_map_val['zoom_map'];
	   				readmore_text = attr_map_val['readmore_text'];
	   				icon1 = attr_map_val['icon1'];
	   				icon2 = attr_map_val['icon2'];
	   				icon3 = attr_map_val['icon3'];
	   				icon4 = attr_map_val['icon4'];
	   				icon5 = attr_map_val['icon5'];
	   			}
	   			
	   			
	   			var marker, loc, Clusterer;
			    var markers = [];
		   		var mapIWcontent = '';

	   			// Get Data Vehicle
	   			var obj_vehicles = JSON.parse( vehicle_data );



	   			var bounds = new google.maps.LatLngBounds();
			    var mapOptionsFirst = {
			        zoom: parseInt(zoom_map),
			        minZoom: 3,
			        center: new google.maps.LatLng(parseFloat(obj_vehicles[0]['lat']), parseFloat(obj_vehicles[0]['lon']) ),
			        mapTypeId: google.maps.MapTypeId.ROADMAP,
			       
			        styles: [],
			        scrollwheel: false,
			    };

			    var mapObject = new google.maps.Map(document.getElementById('map'), mapOptionsFirst);

			    google.maps.event.addListener(mapObject, 'domready', function () {

			    });
			    google.maps.event.addListener(mapObject, 'click', function () {
			        closeInfoBox();
			    });

		   		
		   		var contentString = '' + '' +
			    '<div class="iw-container"' +
			    '<div class="iw-content">' +
			    '' + mapIWcontent +
			    '</div>' +
			    '<div class="iw-bottom-gradient"></div>' +
			    '</div>' +
			    '' +
			    '';

		   		var infowindow = new google.maps.InfoWindow({
			        content: contentString,
			        maxWidth: 350
			    });

		   		
        		obj_vehicles.forEach(function (item) {

        			marker = new google.maps.Marker({
	                    position: new google.maps.LatLng(item.lat, item.lon),
	                    map: mapObject
	                    // icon: item.fa_icon //,
	                });
	                loc = new google.maps.LatLng(item.lat, item.lon);
                	bounds.extend(loc);

                	if ('undefined' === typeof markers[i]) markers[i] = [];
	                markers[i].push(marker);
		   			i++;



			   		google.maps.event.addListener(marker, 'click', (function () {
			   			
	                    closeInfoBox();
	                    var mapIWcontent = '' +
	                        '' +
	                        '<div class="map-info-window">' +
	                        '<div class="thumbnail no-border no-padding thumbnail-car-card">' +
	                        '<div class="media">' +
	                        '<a  class="media-link" href="#">' +
	                        '<img style="max-width: 350px" src="' + item.img + '" alt=""/>' +
	                        '</a>' +
	                        '</div>' +
	                        '<div class="caption text-center">' +
	                         '<div class="buttons">' +
	                        '<a class="ireca_btn  btn_tran dashed btn_white btn_price" href="' +
	                        item.url + '">' +item.price+'</a>' +
	                        '</div>' +
	                        '<h2 class="caption-title"><a href="' +
	                        item.url + '">' + item.title + '</a></h2>' +
	                        '<div class="caption-text"> </div>' +
	                       
	                        '<table class="table">' +
	                        '<tr>' +item.feature +
	                        '</tr>' +
	                        '</table>' +
	                        '</div>' +
	                        '</div>' +
	                        '<div style="border-top-width: 24px; position: absolute; ; margin-top: 0px; z-index: 0; left: 129px;"><div style="position: absolute; overflow: hidden; left: -6px; top: -1px; width: 16px; height: 30px;"><div style="position: absolute; left: 6px; transform: skewX(22.6deg); transform-origin: 0px 0px 0px; height: 24px; width: 10px; box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 6px; z-index: 1; background-color: rgb(255, 255, 255);"></div></div><div style="position: absolute; overflow: hidden; top: -1px; left: 10px; width: 16px; height: 30px;"><div style="position: absolute; left: 0px; transform: skewX(-22.6deg); transform-origin: 10px 0px 0px; height: 24px; width: 10px; box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 6px; z-index: 1; background-color: rgb(255, 255, 255);"></div></div></div>' +

	                        '</div>' +

	                        '';
	                    var contentString = '' +
	                        '' +
	                        '<div class="iw-container">' +
	                        '<div class="iw-content">' +
	                        '' + mapIWcontent +
	                        '</div>' +
	                        '<div class="iw-bottom-gradient"></div>' +
	                        '</div>' +
	                        '' +
	                        '';
	                    infowindow.close();
	                    infowindow = new google.maps.InfoWindow({
	                        content: contentString,
	                        title: item.title
	                        , maxWidth: 350
	                        , maxHeight: 500
	                    });
	                    infowindow.close();
	                    infowindow.open(map, this);
	                
	                }));

		   		});
		   		


        		//options
			    var mcOptions = {
			        gridSize: 20,
			        maxZoom: 20,
			        styles: [{
			            height: 53,
			            url:icon1,
			            width: 52
			        }, {
			            height: 56,
			            url:icon2,
			            width: 55
			        }, {
			            height: 66,
			            url:icon3,
			            width: 65
			        }, {
			            height: 78,
			            url:icon4,
			            width: 77
			        }
			        , {
			            height: 90,
			            url:icon5,
			            width: 89
			        }
			        ]

			    };


			    // New markerCluster
			    Clusterer = new MarkerClusterer(mapObject, [], mcOptions);

			    for (var key in markers){
		            //add  markers to Clusterer
		            // obj_vehicles.forEach(function (item) {
		        		Clusterer.addMarkers(markers[key], true);
		        	// });
		        }

		  //       google.maps.event.addListener(Clusterer, "clusterclick", function(cluster, e) {
				// 	setTimeout(function() { Clusterer.redraw(); }, 100);
				// });


			    function closeInfoBox() {
				    jQuery('div.infoBox').remove();
				};


			
			}// typeof vehicle
	    });
      


   	});

})(jQuery);