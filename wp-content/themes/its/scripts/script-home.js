$(document).ready(function(){
	$('#agenda article').mouseenter(function(){
		$('#agenda').css('height','100%');
	});

	$('#agenda article').mouseleave(function(){
		$('#agenda').css('height','300');
	});
	/*gestion du slider agenda*/
	$("#puce_1").addClass('actif');
	$("#puce_2").addClass('actif');
	$("#puce_3").addClass('actif');
	
	var limite = $('.standard').length;
	var largeur = 237*limite+1;
	$('#agenda .conteneur').css('width',largeur);
	var position = 2;
	var new_position = 2;
	var precedent = 0;
	var suivant = limite;
	$('.standard').click(function(){
		$('.standard').removeClass('actif');
		var tableau_id=$(this).attr("id").split('_');
		var pointeur = parseInt(tableau_id[1]);
		
		if(pointeur!=limite){
			if(pointeur!=1){
				suivant = pointeur + 1;
				precedent = pointeur - 1;
				new_position = pointeur;
			}
			else{
				suivant = pointeur + 1;
				precedent = pointeur + 2;
				new_position = suivant;
			}
		}
		else{
			suivant = pointeur - 2;
			precedent = pointeur - 1;
			new_position = precedent;
		}

		if(new_position!=position){
			var deplacement = new_position - position;
			position = new_position;
			var laPosition = $("#curseur").position();
			laPosition = laPosition.left + (deplacement * 18);
			$("#curseur").css('left',laPosition);
			var laPositionBis = $("#agenda .conteneur").position();
			laPositionBis = laPositionBis.left - (deplacement * 237);
			$("#agenda .conteneur").css('left',laPositionBis);
		}
		
		$(this).addClass('actif');
		$('#puce_'+precedent).addClass('actif');
		$('#puce_'+suivant).addClass('actif');
	});

	$('.precedent').click(function(){
		var tableau_id=$('.standard.actif')[1].id.split('_');
		$('.standard').removeClass('actif');
		var pointeur = parseInt(tableau_id[1]);

		if((pointeur-3) <= 1){
			pointeur = 1;
			suivant = pointeur + 1;
			precedent = pointeur + 2;
			new_position = suivant;
		}
		else{
			pointeur = pointeur-3;
			suivant = pointeur + 1;
			precedent = pointeur - 1;
			new_position = pointeur;
		}

		if(new_position!=position){
			var deplacement = new_position - position;
			position = new_position;
			var laPosition = $("#curseur").position();
			laPosition = laPosition.left + (deplacement * 18);
			$("#curseur").css('left',laPosition);
			var laPositionBis = $("#agenda .conteneur").position();
			laPositionBis = laPositionBis.left - (deplacement * 237);
			$("#agenda .conteneur").css('left',laPositionBis);
		}
		
		$('#puce_'+pointeur).addClass('actif');
		$('#puce_'+precedent).addClass('actif');
		$('#puce_'+suivant).addClass('actif');
	});

	$('.suivant').click(function(){
		var tableau_id=$('.standard.actif')[1].id.split('_');
		$('.standard').removeClass('actif');
		var pointeur = parseInt(tableau_id[1]);

		if((pointeur+3) >= limite){
			pointeur = limite;
			suivant = pointeur - 2;
			precedent = pointeur - 1;
			new_position = precedent;
		}
		else{
			pointeur = pointeur+3;
			suivant = pointeur + 1;
			precedent = pointeur - 1;
			new_position = pointeur;
		}

		if(new_position!=position){
			var deplacement = new_position - position;
			position = new_position;
			var laPosition = $("#curseur").position();
			laPosition = laPosition.left + (deplacement * 18);
			$("#curseur").css('left',laPosition);
			var laPositionBis = $("#agenda .conteneur").position();
			laPositionBis = laPositionBis.left - (deplacement * 237);
			$("#agenda .conteneur").css('left',laPositionBis);
		}
		
		$('#puce_'+pointeur).addClass('actif');
		$('#puce_'+precedent).addClass('actif');
		$('#puce_'+suivant).addClass('actif');
	});

});