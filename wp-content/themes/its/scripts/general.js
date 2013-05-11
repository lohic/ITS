$(document).ready(function(){
	/*gestion du slider agenda*/
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
	
});