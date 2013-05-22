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
	var deplacement = 464; //valeur en pixels du déplacement de la frise date à chaque clic sur precedent ou suivant
	var pointeur = 1; //variable qui récupère l'index de l'année en cours

	var position = 1; //variable qui gère la position du curseur (début des puces blanches)
	var borne = 8; //borne pour rendre les puces actives (blanches)
	var max = Math.floor($('.conteneur_annees li').length/8)*8+1; //borne maximum de la position du curseur
	var largeur = new Array(23,44,65,86,107.5,129,150.5,172); //stocke les différentes largeurs utiles pour le curseur
	var arrondi_haut = 0; 
	var arrondi_bas = 0;
	var multiplicateur = 0;
	
	var premier = $('.conteneur_annees li:first-child a').html();


	if ($.url().param('annee')===undefined || $.url().param('annee')==premier){
		
		$('#annee_'+premier).addClass('actif');
		$('#puce-tag_1').addClass('super_actif');

		for(var i=2; i<=borne; i++){
			$('#puce-tag_'+i).addClass('actif');
		}
	}
	else{
		$('.span-tag').each(function(){
			if($.url().param('annee')==$(this).html()){
				var tableau_id=$(this).attr("id").split('_');
				pointeur = parseInt(tableau_id[1]);
			}
		});

		$('#annee_'+$.url().param('annee')).addClass('actif');
		$('#puce-tag_'+pointeur).addClass('super_actif');

		//On détermine les position de début et de fin du secteur

		arrondi_haut = Math.ceil(pointeur / 8);
		arrondi_bas = Math.floor(pointeur / 8);
		multiplicateur = arrondi_bas;
		position = (arrondi_haut*8)-7;

		if((arrondi_haut*8)>$('.conteneur_annees li').length){
			borne = ((arrondi_bas)*8)+($('.conteneur_annees li').length%8);
			//calcul de la longueur du curseur selon le reste de la division du nombre de puces par 8 (taille max du curseur)
			$('#curseur_large').css('width',largeur[($('.conteneur_annees li').length%8)-1]);
		}
		else{
			borne = arrondi_haut*8;
			$('#curseur_large').css('width',172);
		}
		
		for(var i=position; i<=borne; i++){
			$('#puce-tag_'+i).addClass('actif');
		}

		//pour déterminer le multiplicateur (différent selon si on a un multiple de 8 ou non)
		if(pointeur%8 == 0){
			multiplicateur = arrondi_bas-1;
		}

		//position du curseur
		$('#curseur_large').css('left', (168*multiplicateur)+13);

		//position frise dates
		$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
	}
	
	
	$('.precedent_tag').click(function(){
		if(position!=1){
			$('.puce-tag').removeClass('actif');
			$('#curseur_large').css('width',172);
			position = position-8;
			arrondi_haut = Math.ceil(position / 8);
			arrondi_bas = Math.floor(position / 8);
			multiplicateur = arrondi_bas;

			borne = arrondi_haut*8;
			
			for(var i=position; i<=borne; i++){
				$('#puce-tag_'+i).addClass('actif');
			}

			//position du curseur
			$('#curseur_large').css('left', (168*multiplicateur)+13);

			//position frise dates
			$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
		}
	});

	$('.suivant_tag').click(function(){
		if(position!=max){
			$('.puce-tag').removeClass('actif');

			position = position+8;
			arrondi_haut = Math.ceil(position / 8);
			arrondi_bas = Math.floor(position / 8);
			multiplicateur = arrondi_bas;

			if((arrondi_haut*8)>$('.conteneur_annees li').length){
				borne = ((arrondi_bas)*8)+($('.conteneur_annees li').length%8);
				//calcul de la longueur du curseur selon le reste de la division du nombre de puces par 8 (taille max du curseur)
				$('#curseur_large').css('width',largeur[($('.conteneur_annees li').length%8)-1]);
			}
			else{
				borne = arrondi_haut*8;
				$('#curseur_large').css('width',172);
			}

			for(var i=position; i<=borne; i++){
				$('#puce-tag_'+i).addClass('actif');
			}

			//position du curseur
			$('#curseur_large').css('left', (168*multiplicateur)+13);

			//position frise dates
			$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
		}
	});
	
});