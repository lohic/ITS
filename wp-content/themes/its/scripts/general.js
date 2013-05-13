$(document).ready(function(){
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

	$('#filtres p.filtre').click(function(){
		$('#filtres > .conteneur').toggle();
	});

	$('#liste_images figure .miniature img').each(function(){
		var margeLeft = (124-$(this).width())/2;
		$(this).css('marginLeft',margeLeft);

		var margeTop = (124-$(this).height())/2;
		$(this).css('marginTop',margeTop);
	});

	$('#meme_theme figure .miniature img').each(function(){
		var margeLeft = (124-$(this).width())/2;
		$(this).css('marginLeft',margeLeft);

		var margeTop = (124-$(this).height())/2;
		$(this).css('marginTop',margeTop);
	});
	/*Fin de la gestion des commentaires*/
	
});