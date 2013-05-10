<?php get_header(); ?>

<!-- GABARIT SINGLE.PHP -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="little_very_biggest sans mb3">Archive d'images</h1>
			<section id="filtres" class="mb2">
				<div class="image">
					<p class="filtre mr2 normal"><a href="">Retour à la liste</a></p>
				</div>
				<div class="bordure image">
				</div>
			</section>
		</div>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<article class="pb2 post" id="post-<?php the_ID(); ?>">
			<div class="post_content image mb2 row">
				<div class="conteneur_image col">
					<img src="<?php bloginfo( 'template_url' ); ?>/img/grande_affiche.png" alt="<?php the_title(); ?>" class=""/>
				</div>
				<div class="col texte_image">
					<h2 class="bigger"><?php the_title(); ?></h2>
					<p class="small"><span class="court">Date :</span>1960</p>
					<p class="small"><span class="long">Type de document :</span>Affiche</p>
					<p class="small"><span class="court">Auteur :</span>Inconnu</p>
					<p class="small"><span class="court">Couleur :</span><span class="couleur">Noir</span><span class="couleur">Blanc</span><span class="couleur">Rouge</span></p>
					<p class="small"><span class="court">Mots clés :</span>Manifestation</p>
					<p class="small"><span class="moyen">Dimensions :</span>400 x 600 (pixels)</p>
					<p class="small mb1"><span class="moyen">Poids fichier :</span>3,5 Mo</p>
					<p class="small"><span class="full">Remarques :</span>Les conditions désastreuses de la rentrée à la Faculté des Sciences de Paris serviront de 
						prétexte à une sélection renforcée des étudiants à l’entrée de l’enseignement supérieur.</p>
				</div>
			</div>
			<div class="small texte_article_image">
				<?php the_content(); ?>
				<a href="#" class="suite mt1"><span>Contact ITS</span></a>
			</div>
		</article>

		<section id="meme_theme" class="pt1 pb4 image">
            <h3 class="small mb3">Archives sur les mêmes critères</h3>
            <div>
	            <figure class="mb1">
					<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche1.png" alt="<?php the_title(); ?>"/></div>
					<p>1960, noir, vert, indochine, picart</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche2.png" alt="<?php the_title(); ?>"/></div>
					<p>1960, bleu, derbe, auteur inconnu</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche3.png" alt="<?php the_title(); ?>"/></div>
					<p>1960, rouge, berlin, auteur inconnu</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche4.png" alt="<?php the_title(); ?>"/></div>
					<p>1960, affiche, noir, blanc, pays basque</p>
				</figure>
				<figure class="mb1 sans">
					<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche5.png" alt="<?php the_title(); ?>"/></div>
					<p>1960, affiche, noir, blanc, pays basque</p>
				</figure>
			</div>
        </section>
       
	<?php endwhile; ?>
	<?php else : ?>
			<p>Désolé, aucun article ne correspond à vos critères.</p>
<?php endif; ?>
	</div>

<?php get_footer(); ?>