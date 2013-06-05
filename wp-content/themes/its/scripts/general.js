$(document).ready(function(){
	/*if($.url().param('annees')!=undefined || $.url().param('types')!=undefined || $.url().param('auteurs')!=undefined || $.url().param('couleurs')!=undefined || $.url().param('mots_cles')!=undefined) {
		$('#filtres > div.conteneur').css('display','block');
	}*/
	/*** masquer le paragraphe catégories sur les résultats de recherche si rien à afficher ***/
	/*$('.categories_et_tags').each(function(){
		if($(this).find('.tags').text()==""){
			if($(this).find('.categories > a').eq(0).text()=="Non classé" || ($(this).find('.categories > a').eq(0).text()=="Catégories mères" && $(this).find('.categories > a').eq(1).text()=="")){
				$(this).css('display','none');
				$(this).siblings('h3.date').css('marginTop', '2px');
			}
		}
	});*/
	/*** fin masquer le paragraphe catégories sur les résultats de recherche si rien à afficher ***/


	/*** Survol bloc actualités home ***/
	$("#actualites").mouseenter(function(){
		$(this).addClass('actualites_over');
	});
	$('#actualites').mouseleave(function(){
		$(this).removeClass('actualites_over');
	});

	$("#actualites").click(function(){
		var chemin_actu = $("#actualites p.suite a").attr('href');
		$(location).attr('href',chemin_actu);
	});
	/*** fin Survol bloc actualités home ***/

	/* clic sur le bouton recherche de la home
	$('a.recherche').click(function(){
		$('#recherche #s').focus();
	});
	/* Fin clic sur le bouton recherche de la home*/

	/*Survol d'une miniature sur la page iconographie*/
	$('#liste_images figure').mouseenter(function(){
		$(this).find('.grand_format > img').attr("src",$(this).data("its-url"));
	});

	$('#liste_images figure').mousemove(function(e){
		$(this).find('.grand_format').css('left',e.pageX+10);
		$(this).find('.grand_format').css('top',e.pageY+10);
	});
	/*Fin Survol d'une miniature sur la page iconographie*/

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

	/*gestion du slider pages categories et organisations*/
	if($('.conteneur_annees li').length>8){
		$('#navigation_curseur').css('display','block');
	}
	var deplacement = 458; //valeur en pixels du déplacement de la frise date à chaque clic sur precedent ou suivant
	var pointeur = 1; //variable qui récupère l'index de l'année en cours

	var position = 1; //variable qui gère la position du curseur (début des puces blanches)
	var borne = 8; //borne pour rendre les puces actives (blanches)
	var max = Math.floor($('.conteneur_annees li').length/8)*8+1; //borne maximum de la position du curseur
	var largeur = 0; // largeur du curseur
	var arrondi_haut = 0; 
	var arrondi_bas = 0;
	var multiplicateur = 0;

	//On détermine la largeur du curseur quand on arrive sur la page
	var position_depart = $('li.puce-tag').eq(0).position();
	var position_fin = $('li.puce-tag').eq(7).position();
	if(position_fin!=undefined && position_depart!=undefined){
		largeur = position_fin.left - position_depart.left + 24;
	}
	$('#curseur_large').css('width',largeur);
	
	var premier = $('.conteneur_annees li:first-child a').html();

	if ($.url().param('annee')=="regards"){
		$('a#regards').addClass('actif');
	}
	else{
		$('a#regards').removeClass('actif');
	}

	if ($.url().param('annee')===undefined || $.url().param('annee')==premier){
		
		$('#annee_'+premier).addClass('actif');
		$('li.puce-tag').eq(0).addClass('super_actif');

		for(var i=1; i<borne; i++){
			$('li.puce-tag').eq(i).addClass('actif');
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
		$('li.puce-tag').eq(pointeur-1).addClass('super_actif');

		//On détermine les position de début et de fin du secteur

		arrondi_haut = Math.ceil(pointeur / 8);
		arrondi_bas = Math.floor(pointeur / 8);
		multiplicateur = arrondi_bas;
		position = (arrondi_haut*8)-7;

		if((arrondi_haut*8)>$('.conteneur_annees li').length){
			borne = ((arrondi_bas)*8)+($('.conteneur_annees li').length%8);
		}
		else{
			borne = arrondi_haut*8;
		}

		position_depart = $('li.puce-tag').eq(position-1).position();
		position_fin = $('li.puce-tag').eq(borne-1).position();
		largeur = position_fin.left - position_depart.left + 24;
		$('#curseur_large').css('width',largeur);
		
		for(var i=position-1; i<borne; i++){
			$('li.puce-tag').eq(i).addClass('actif');
		}

		//pour déterminer le multiplicateur (différent selon si on a un multiple de 8 ou non)
		if(pointeur%8 == 0){
			multiplicateur = arrondi_bas-1;
		}

		//position du curseur
		$('#curseur_large').css('left', position_depart.left-6);

		//position frise dates
		$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
	}
	
	
	$('.precedent_tag').click(function(){
		if(position!=1){
			$('.puce-tag').removeClass('actif');

			position = position-8;
			arrondi_haut = Math.ceil(position / 8);
			arrondi_bas = Math.floor(position / 8);
			multiplicateur = arrondi_bas;

			borne = arrondi_haut*8;
			
			for(var i=position-1; i<borne; i++){
				$('li.puce-tag').eq(i).addClass('actif');
			}

			position_depart = $('li.puce-tag').eq(position-1).position();
			position_fin = $('li.puce-tag').eq(borne-1).position();
			largeur = position_fin.left - position_depart.left + 24;
			$('#curseur_large').css('width',largeur);

			//position du curseur
			$('#curseur_large').css('left', position_depart.left-6);

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
			}
			else{
				borne = arrondi_haut*8;
				$('#curseur_large').css('width',172);
			}

			position_depart = $('li.puce-tag').eq(position-1).position();
			position_fin = $('li.puce-tag').eq(borne-1).position();
			largeur = position_fin.left - position_depart.left + 24;
			$('#curseur_large').css('width',largeur);

			for(var i=position-1; i<borne; i++){
				$('li.puce-tag').eq(i).addClass('actif');
			}

			//position du curseur
			$('#curseur_large').css('left', position_depart.left-6);

			//position frise dates
			$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
		}
	});
	/* Fin de la gestion du slider*/


	$('#filtres').mouseenter(function(){
		$('#filtres > .conteneur').toggle('fast');
	});

	$('#filtres').mouseleave(function(){
		$('#filtres > .conteneur').toggle('fast');
	});


	/*AJAX sur iconographie*/
	function reinitialisation(){
		$('#filtres').mouseenter(function(){
			$('#filtres > .conteneur').toggle('fast');
		});

		$('#filtres').mouseleave(function(){
			$('#filtres > .conteneur').toggle('fast');
		});

		$('#liste_images figure').mouseenter(function(){
			$(this).find('.grand_format > img').attr("src",$(this).data("its-url"));
		});
	}

	function initialisation(){
		$('#filtre_date li > a').click(function(e){
			var longueur=parametres['annees'].length;
			parametres['annees'][longueur]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});

		$('#filtre_type li > a').click(function(e){
			var longueur=parametres['types'].length;
			parametres['types'][longueur]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});

		$('#filtre_auteur li > a').click(function(e){
			var longueur=parametres['auteurs'].length;
			parametres['auteurs'][longueur]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});

		$('#filtre_couleur li > a').click(function(e){
			var longueur=parametres['couleurs'].length;
			parametres['couleurs'][longueur]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});

		$('#filtre_mots li > a').click(function(e){
			var longueur=parametres['mots'].length;
			parametres['mots'][longueur]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});

		$('.lien_filtre_actif').click(function(e){
			var test = jQuery.inArray($(this).html(), parametres['annees']);
			if(test!=-1){
				parametres['annees'].splice(test,1);
			}
			test = jQuery.inArray($(this).html(), parametres['types']);
			if(test!=-1){
				parametres['types'].splice(test,1);
			}
			test = jQuery.inArray($(this).html(), parametres['auteurs']);
			if(test!=-1){
				parametres['auteurs'].splice(test,1);
			}
			test = jQuery.inArray($(this).html(), parametres['couleurs']);
			if(test!=-1){
				parametres['couleurs'].splice(test,1);
			}
			test = jQuery.inArray($(this).html(), parametres['mots']);
			if(test!=-1){
				parametres['mots'].splice(test,1);
			}
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs':parametres['couleurs'],
					'mots':parametres['mots'],
				}, 
				function(response){
					$('#container').html(response);
					initialisation();
					reinitialisation();
				}
			);
			e.preventDefault();
		});
	}

	var parametres = new Array();
	parametres['annees'] = new Array();
	parametres['types'] = new Array();
	parametres['auteurs'] = new Array();
	parametres['couleurs'] = new Array();
	parametres['mots'] = new Array();

	if($.url().param('annees')!=undefined){
		for(var i = 0, len = $.url().param('annees').length; i < len; ++i) {
	      	parametres['annees'][i]=$.url().param('annees')[i];
	    }
	}
	
	if($.url().param('types')!=undefined){
	    for(var i = 0, len = $.url().param('types').length; i < len; ++i) {
	      	parametres['types'][i]=$.url().param('types')[i];
	    }
	}

    if($.url().param('auteurs')!=undefined){
	    for(var i = 0, len = $.url().param('auteurs').length; i < len; ++i) {
	      	parametres['auteurs'][i]=$.url().param('auteurs')[i];
	    }
	}

    if($.url().param('couleurs')!=undefined){
	    for(var i = 0, len = $.url().param('couleurs').length; i < len; ++i) {
	      	parametres['couleurs'][i]=$.url().param('couleurs')[i];
	    }
	}

    if($.url().param('mots')!=undefined){
	    for(var i = 0, len = $.url().param('mots').length; i < len; ++i) {
	      	parametres['mots'][i]=$.url().param('mots')[i];
	    }
	}


	initialisation();

	
});