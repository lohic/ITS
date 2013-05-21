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
		$('#filtres > .conteneur').toggle('fast');
	});

	$('#filtres').mouseleave(function(){
		$('#filtres > .conteneur').toggle('fast');
	});

	if($('.conteneur_annees li').length>8){
		$('#navigation_curseur').css('display','block');
	}

	/*gestion du slider pages categories et organisations*/
	var position_curseur = 9;
	var deplacement = 450;
	var largeur = 172;
	
	var premier = $('.conteneur_annees li:first-child a').html();

	if ($.url().param('annee')===undefined || $.url().param('annee')==premier){
		var position = 1;
		var new_position = 1;
		var borne = 8;
		var largeur = 172;
		$('#annee_'+premier).addClass('actif');
		$('#puce-tag_1').addClass('super_actif');

		for(var i=2; i<=borne; i++){
			$('#puce-tag_'+i).addClass('actif');
		}
	}
	else{
		/*$('#annee_'+$.url().param('annee')).addClass('actif');
		$('#puce-tag_'+$.url().param('annee')).addClass('super_actif');
		var borne_min = parseInt($.url().param('annee'))+1;
		if($.url().param('annee')>1960 && $.url().param('annee')<=1971){
			var position = 1960;
			var new_position = 1960;
			var borne = 1971;
			for(var i=1960; i<$.url().param('annee'); i++){
				$('#puce-tag_'+i).addClass('actif');
			}
			for(var j=borne_min; j<=1971; j++){
				$('#puce-tag_'+j).addClass('actif');
			}
		}
		if($.url().param('annee')>=1972 && $.url().param('annee')<=1983){
			var position = 1972;
			var new_position = 1972;
			var borne = 1983;
			for(var i=1972; i<$.url().param('annee'); i++){
				$('#puce-tag_'+i).addClass('actif');
			}
			for(var j=borne_min; j<=1983; j++){
				$('#puce-tag_'+j).addClass('actif');
			}
			$("#curseur_large").css('left',264);
			$('#frise.large ul').css('left',-672);
		}
		if($.url().param('annee')>=1984 && $.url().param('annee')<=1990){
			var position = 1984;
			var new_position = 1984;
			var borne = 1990;
			for(var i=1984; i<$.url().param('annee'); i++){
				$('#puce-tag_'+i).addClass('actif');
			}
			for(var j=borne_min; j<=1990; j++){
				$('#puce-tag_'+j).addClass('actif');
			}
			$("#curseur_large").css('left',515);
			$('#frise.large ul').css('left',-1344);
			$("#curseur_large").css('width',152);
		}*/
	}
	
	
	$('.precedent_tag').click(function(){
		if(position==1972){
			new_position=1960;
			borne = 1971;
			position_curseur = 13;
		}
		if(position==1984){
			new_position=1972;
			borne = 1983;
			position_curseur = 264;
			largeur = 256;
		}
		if(new_position!=position){
			$('.puce-tag').removeClass('actif');
			for(var i=new_position; i<=borne; i++){
				$('#puce-tag_'+i).addClass('actif');
			}
			$("#curseur_large").css('left',position_curseur);
			$("#curseur_large").css('width',largeur);

			var laPositionBis = $('#frise.large ul').position();
			laPositionBis = laPositionBis.left + (deplacement);
			$('#frise.large ul').css('left',laPositionBis);
		}

		position=new_position;
	});

	$('.suivant_tag').click(function(){
		if(position==1960){
			new_position=1972;
			borne = 1983;
			position_curseur = 264;
		}
		if(position==1972){
			new_position=1984;
			borne = 1990;
			position_curseur = 515;
			largeur = 152;
		}
		if(new_position!=position){
			$('.puce-tag').removeClass('actif');
			for(var i=new_position; i<=borne; i++){
				$('#puce-tag_'+i).addClass('actif');
			}
			$("#curseur_large").css('left',position_curseur);
			$("#curseur_large").css('width',largeur);

			var laPositionBis = $('#frise.large ul').position();
			laPositionBis = laPositionBis.left - (deplacement);
			$('#frise.large ul').css('left',laPositionBis);
		}

		position=new_position;
	});
	
});