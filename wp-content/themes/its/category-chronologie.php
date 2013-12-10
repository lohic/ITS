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
	$actu->start	= '%%new Date('. get_the_date('Y,m,d ') .')%%';
	$actu->type		= get_field('type');

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
		'minHeight' : 500,
		'maxHeight' : 700,
        'start': new Date(1954, 0, 1),
        'end': new Date(<?php 	$date = date_create();
								date_modify($date, '+1 year');
								echo date_format($date, 'Y,m,d');?>),
        'cluster': false,
        'box.align': 'left',
        'style': 'dot',
        'axisOnTop': true,
		'zoomMin' : 1000*60*60*24*4,
		'zoomMax' : 1000*60*60*24*31*12*10,
		'min' : new Date(1954, 0, 1),
		'max' : new Date(<?php 	$date = date_create();
								date_modify($date, '+1 year');
								echo date_format($date, 'Y,m,d');?>),
		'stackEvents' : true,
        'locale' : 'fr',
        'showNavigation': true ,
		//'showMinorLabels' : false,
        // 'editable': true
        'eventMargin' : 10,
    };

    // Instantiate our timeline object.
    timeline = new links.Timeline(document.getElementById('mytimeline'));

    // Draw our timeline with the created data and options
    timeline.draw(data, options);
}

$(document).ready(function(){
    drawVisualization();

    $('div.timeline-event-content h4').mouseenter(function(){
        $(this).parent().find('p').show();
    });

    $('div.timeline-event-content h4').mouseleave(function(){
        $(this).parent().find('p').hide();
    });

});