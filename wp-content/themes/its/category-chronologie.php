//javascript
//
//
var timeline;
var data;

// Called when the Visualization API is loaded.
function drawVisualization() {

	var data = <?php						

	//$json = new stdClass();
	$json = array();

	global $query_string;
	query_posts( $query_string . '&posts_per_page=-1' );

	if ( have_posts() ) :
		while( have_posts() ) :
			the_post();

	//get_template_part( 'boucle', '' );

	$actu = new stdClass();
	$actu->content	= get_the_title();
	$actu->start	= '%%new Date('. timeline_date('Y,m,d ') .')%%';
	$actu->type		= get_field('type');
	$actu->url		= get_permalink();

	$end = get_field('date_de_fin');
	if( !empty( $end ) ) {
		$actu->end	= '%%new Date('. $end .')%%';
		$actu->type	= 'range';
	}

	$json[] = $actu;

		endwhile;
	endif;

	$json = json_encode($json);

	$json = preg_replace("/(('|\")%%|%%(\"|'))/",'', $json);

	echo $json;
	?>;



    // specify options
    var options = {
        'width':  '100%',
        'height': 'auto',
		'minHeight' : 350,
		'maxHeight' : 700,
        'start': new Date(1954, 0, 1),
        'end': new Date(1990, 11, 31),
        'cluster': false,
        'box.align': 'right',
        'style': 'box',
        'axisOnTop': true,
		//'zoomMin' : 1000*60*60*24*4,
        'zoomMin' : 1000*60*60*24*31*12*3,
        //'zoomMax' : 1000*60*60*24*31*12*10,
		'zoomMax' : 1000*60*60*24*31*12*3,
		'min' : new Date(1954, 0, 1),
		'max' : new Date(<?php 	$date = date_create();
								date_modify($date, '+1 year');
								echo date_format($date, 'Y,m,d');?>),
		'stackEvents' : true,
        'locale' : 'fr',
        'showNavigation': true ,
        'showCurrentTime':false,
		//'showMinorLabels' : false,
        // 'editable': true
        'eventMargin' : 10,
    };

    // Make a callback function for the select event
    var onselect = function (event) {
        var row = undefined;
        var sel = timeline.getSelection();
        if (sel.length) {
            if (sel[0].row != undefined) {
                var row = sel[0].row;
            }
        }

        if (row != undefined) {
            //var content = data.getValue(row, 2);
            console.log( data[row].url );
            
            $('#event_detail').empty();

            if( $('#event_detail').css('display') == 'none' ) {



	            //$('#mytimeline').css('margin-right','300px');
	        	$('#mytimeline').animate({
	        		'margin-right' : 300
	        	},500, function(){
	        		$('#event_detail').slideDown('slow', function(){

	        			$( "#event_detail" ).load( data[row].url+" article.post" );
	        		});
	        	});
	            
	        }else{
	        	$( "#event_detail" ).load( data[row].url+" article.post" );
	        }
            /*document.getElementById("txtContent").value = content;
            document.getElementById("info").innerHTML += "event " + row + " selected<br>";*/

        }else{

            if( $('#event_detail').css('display') != 'none' ) {

            	$('#event_detail')
            	.empty()
            	.slideUp('slow',function(){

            		$('#mytimeline').animate({
		        		'margin-right' : 0
		        	},500,function(){
		        		timeline.redraw();
		        	});

            	});
        		

            }
        }
    };

    // Instantiate our timeline object.
    timeline = new links.Timeline(document.getElementById('mytimeline'));

    links.events.addListener(timeline, 'select', onselect);

    // Draw our timeline with the created data and options
    timeline.draw(data, options);

    timeline.setVisibleChartRange(new Date(1959,0,1),new Date(1963,0,1));

    
}

$(document).ready(function(){
	$('#event_detail').hide();
    drawVisualization();

    $('div.timeline-event-content h4').mouseenter(function(){
        $(this).parent().find('p').show();
    });

    $('div.timeline-event-content h4').mouseleave(function(){
        $(this).parent().find('p').hide();
    });

});