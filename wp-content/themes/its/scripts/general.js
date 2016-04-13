var multiplicateur = 0;
function slideImage(identifiant, borne) {
	multiplicateur++;
	if(multiplicateur>=borne){
		multiplicateur = 0;
	}
	var deplacement = -200*multiplicateur;
	$('#galerie_'+identifiant).animate({left:deplacement},500);
	$('#galerie_'+identifiant).siblings('.nav_gallerie_sidebar').find('li').removeClass('actif');
	$('#galerie_'+identifiant).siblings('.nav_gallerie_sidebar').find('li').eq(multiplicateur).addClass('actif');
}
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


	$articleMaxHeight = 250;
	$('#agenda article').each(function(){
		if($(this).outerHeight(true) > $articleMaxHeight){
			$articleMaxHeight = $(this).outerHeight(true) + 25;
		}
	})

	console.log('articleMaxHeight',$articleMaxHeight);

	$("#actualites").css({
		'margin-top' : $articleMaxHeight
	});



	/*** Survol bloc actualités et regards home ***/
	$("#actualites").click(function(){
		var chemin_actu = $("#actualites p.suite a").attr('href');
		$(location).attr('href',chemin_actu);
	});
	$("section#regards article").click(function(){
		var chemin_actu = $("section#regards article a.suite").attr('href');
		$(location).attr('href',chemin_actu);
	});
	/*** fin Survol bloc actualités et regards home ***/

	/*** Slider image de la sidebar ***/
	$('.rsg_item').each(function(){
		$(this).html( $(this).find('img') );
	});

	var compteur_galeries = 1;
	$('.rsgallery').each(function(){
		$(this).attr('id','galerie_'+compteur_galeries);
		$(this).wrap('<div class="conteneur_galerie_sidebar" />');

		$(this).parent('.conteneur_galerie_sidebar').each(function(){
			$(this).append('<div class="nav_gallerie_sidebar"></div>');
		});

		$(this).siblings('.nav_gallerie_sidebar').append('<ul></ul>');
		var compteur_images = 1;
		$(this).children('.rsg_item').each(function(){
			var identifiant_image = "galerie_"+compteur_galeries+"_image_"+compteur_images;
			var identifiant_puce = "galerie_"+compteur_galeries+"_puce_"+compteur_images;
			$(this).attr('id',identifiant_image);
			$(this).parent('.rsgallery').siblings('.nav_gallerie_sidebar').find('ul').append('<li id="'+identifiant_puce+'"></li>');
			compteur_images++;
		});
		$('#galerie_'+compteur_galeries+'_puce_1').addClass('actif');
		compteur_galeries++;
		var largeur_gallerie = 200*(compteur_images-1);
		$(this).css('width',largeur_gallerie);

		$(this).siblings('.nav_gallerie_sidebar').find('ul li').click(function(){
			clearInterval(timer);
			var tableau_id=$(this).attr("id").split('_');
			var deplacement = -200*(tableau_id[3]-1);
			$('#galerie_'+tableau_id[1]).animate({left:deplacement},200);
			$(this).siblings('li').removeClass('actif');
			$(this).addClass('actif');
			multiplicateur = tableau_id[3]-1;
			var timer=setInterval(function(){slideImage(compteur_galeries-1,compteur_images-1);}, 10000);
		});

		var timer=setInterval(function(){slideImage(compteur_galeries-1,compteur_images-1);}, 10000);
	});
	
	/*** Fin slider image de la sidebar ***/

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

			// LOIC
			//$('#curseur_large').css('width',largeur);

			//position du curseur
			//$('#curseur_large').css('left', position_depart.left-6);
			$("#curseur_large").animate({	width:largeur,
											left:position_depart.left-6},300);


			//position frise dates
			//$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
			$("#frise ul.categorie").animate({	marginLeft:-multiplicateur*deplacement},300);

			// FIN LOIC
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
			
			// LOIC		
			//$('#curseur_large').css('width',largeur);

			for(var i=position-1; i<borne; i++){
				$('li.puce-tag').eq(i).addClass('actif');
			}

			//position du curseur
			//$('#curseur_large').css('left', position_depart.left-6);
			$("#curseur_large").animate({	width:largeur,
											left:position_depart.left-6},300);

			//position frise dates
			//$('#frise ul.categorie').css('marginLeft',(-multiplicateur*deplacement));
			$("#frise ul.categorie").animate({	marginLeft:-multiplicateur*deplacement},300);

			// FIN LOIC

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

		$('#liste_images figure').mousemove(function(e){
			$(this).find('.grand_format').css('left',e.pageX+10);
			$(this).find('.grand_format').css('top',e.pageY+10);
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
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
			var longueur_couleur_identifiants=parametres['couleur_identifiant'].length;
			var longueur_couleur_noms=parametres['couleur_nom'].length;
			//parametres['couleurs'][longueur]=$(this).html();
			parametres['couleur_identifiant'][longueur_couleur_identifiants]=$(this).data("la-couleur");
			parametres['couleur_nom'][longueur_couleur_noms]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
			var longueur_mots_identifiants=parametres['mots_identifiant'].length;
			var longueur_mots_noms=parametres['mots_nom'].length;
			//parametres['mots'][longueur]=$(this).html();
			parametres['mots_identifiant'][longueur_mots_identifiants]=$(this).data("le-mot");
			parametres['mots_nom'][longueur_mots_noms]=$(this).html();
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
			test = jQuery.inArray($(this).html(), parametres['couleur_nom']);
			if(test!=-1){
				parametres['couleur_nom'].splice(test,1);
				parametres['couleur_identifiant'].splice(test,1);
			}
			test = jQuery.inArray($(this).html(), parametres['mots_nom']);
			if(test!=-1){
				parametres['mots_nom'].splice(test,1);
				parametres['mots_identifiant'].splice(test,1);
			}
			$.post(
				ajaxurl, 
				{
					'action':'get_images_listing',
					'titre':$('#entete > h1').html(),
					'annees':parametres['annees'],
					'types':parametres['types'],
					'auteurs':parametres['auteurs'],
					'couleurs_identifiants':parametres['couleur_identifiant'],
					'couleurs_noms':parametres['couleur_nom'],
					'mots_identifiants':parametres['mots_identifiant'],
					'mots_noms':parametres['mots_nom'],
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
	parametres['couleur_identifiant'] = new Array();
	parametres['couleur_nom'] = new Array();
	parametres['mots_identifiant'] = new Array();
	parametres['mots_nom'] = new Array();

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
	      	parametres['couleur_identifiant'][i]=$.url().param('couleurs')[i];
	      	parametres['couleur_nom'][i]=$.url().param('couleurs_nom')[i];
	    }
	}

    if($.url().param('mots')!=undefined){
	    for(var i = 0, len = $.url().param('mots').length; i < len; ++i) {
	      	parametres['mots_identifiant'][i]=$.url().param('mots')[i];
	      	parametres['mots_nom'][i]=$.url().param('mots_nom')[i];
	    }
	}


	initialisation();

	
});