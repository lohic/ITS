$(document).ready(function(){
	/*if($.url().param('annees')!=undefined || $.url().param('types')!=undefined || $.url().param('auteurs')!=undefined || $.url().param('couleurs')!=undefined || $.url().param('mots_cles')!=undefined) {
		$('#filtres > div.conteneur').css('display','block');
	}*/
	/*gestion des commentaires*/
	$('h3#respond').click(function(){
		$('#commentform').toggle();
	});

	$('h3#comments').click(function(){
		$('.commentlist').toggle();
		$('#comments_bis').toggle();
		$(this).toggle();
	});

	$('h3#comments_bis').click(function(){
		$('.commentlist').toggle();
		$('#comments').toggle();
		$(this).toggle();
	});
	/*Fin de la gestion des commentaires*/

	$('#filtres').mouseenter(function(){
		$('#filtres > .conteneur').toggle();
	});

	$('#filtres').mouseleave(function(){
		$('#filtres > .conteneur').toggle();
	});
});