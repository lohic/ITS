var timeline;
var data;

// Called when the Visualization API is loaded.
function drawVisualization() {
    // Create a JSON data table
    data = [];
	
    /// 1960
    
    data.push({
        //"group":"repere",
        "start" : new Date(1960,2,13),
        "content" : "la Gerboise bleue",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,2,21),
        "content" : "massacre de Sharpeville  en Afrique du Sud",
    });

    data.push({
        //"group":"PSU",
        "start" : new Date(1960,4,3),
        "content" : "NAISSANCE DU PARTI SOCIALISTE UNIFI&Eacute; (PSU)",
    });

    data.push({
        //"group":"PSU",
        "start" : new Date(1960,4,4),
        "content" : "CONF&Eacute;RENCE NATIONALE &Eacute;TUDIANTE PSU",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,4,15),
        "content" : "Naissance du Comit&eacute;</br>de coordination des &eacute;tudiants</br>non-violents en Caroline du Nord</br>soutenu par Martin Luther King.",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,4,8),
        "end" : new Date(1960,4,13),
        "content" : "49&egrave;me CONGR&Egrave;S DE L'UNEF &Agrave; LYON ",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,6,6),
        "content" : "COMMUNIQU&Eacute; UNEF - UGEMA ANNONCANT LE RETABLISSEMENT DES RELATIONS ENTRE CES DEUX ORGANISATIONS",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,6,19),
        "content" : "AG EXTRAORDINAIRE DE L'UNEF</br>UN SEUL POINT A L'ORDRE DU JOUR",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,10,27),
        "content" : "MANIFESTATION UNITAIRE CONTRE LA GUERRE D'ALGERIE",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,11,19),
        "content" : "TRACT EDITE PAR LE PSU DISTRIBUE A EPINAL LE 26 NOVEMBRE 1960 PAR RAYMOND DERRUAU ET MARC MANGENOT",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1960,12,16),
        "end" : new Date(1960,12,17),
        "content" : "CONFERENCE NATIONALE EXTRAORDINAIRE DES ETUDIANTS DU PSU",
    });

    /// 1961
    data.push({
        //"group":"repere",
        "start" : new Date(1961,1,8),
        "content" : "Referendum visant a statuer</br>sur l'autodetermination</br>des populations algeriennes</br>organise simultanement en France </br>et en Algerie. ",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,3,24),
        "end" : new Date(1961,3,26),
        "content" : "1er CONGRES DU PSU A CLICHY",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,3,31),
        "content" : "Assassinat de Camille Blanc, Maire d'Evian",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,4,17),
        "content" : "Debarquement americain dit de la Baie des Cochons a Cuba.",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,4,20),
        "content" : "50eme CONGRES DE l'UNEF A CAEN",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,3,31),
        "end" : new Date(1961,4,1),
        "content" : "2eme CONFERENCE NATIONALE ANNUELLE ORDINAIRE DES ESU",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,4,8),
        "content" : "CREATION DE LA FNEF",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,5,7),
        "content" : "2eme CONFERENCE NATIONALE DES JSU",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,5,31),
        "content" : "<h4>Declaration de l'independance</br>de l'Afrique du Sud</h4><p>qui devient desormais</br>la Republique sud-africaine</br>et sort du Commonwealth.</p>",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,8,12),
        "content" : "Debut de la construction du  Mur de Berlin par les autorites de la Republique democratique allemande (RDA)",
    });

    data.push({
        //"group":"repere",
        "start" : new Date(1961,9,1),
        "content" : "Conference des Non-alignes a Belgrade: vingt-cinq pays non-alignes se reunissent a Belgrade suite a l'invitation de Tito, president de Yougoslavie.",
    });


    // specify options
    var options = {
        'width':  '100%',
        'height': 'auto',
		'minHeight' : 500,
        //'start': new Date(2012, 0, 1),
        //'end': new Date(2012, 11, 31),
        //'cluster': true,
        //'layout': "box",
        'axisOnTop': true,
		'intervalMin' : 1000*60*60*24,
		'min' : new Date(1955, 0, 1),
		'max' : new Date(2013, 11, 31),
		'stackEvents' : true,
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