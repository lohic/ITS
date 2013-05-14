<?php get_header(); ?>

<!-- GABARIT image.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
    		$args_url = '';
    		if(isset($_GET['annees'])){
				foreach($_GET['annees'] as $annee){
					$args_url.='&amp;annees[]='.$annee;
				}
			}
			if(isset($_GET['types'])){
				foreach($_GET['types'] as $type){
					$args_url.='&amp;types[]='.$type;
				}
			}
			if(isset($_GET['auteurs'])){
				foreach($_GET['auteurs'] as $auteur){
					$args_url.='&amp;auteurs[]='.$auteur;
				}
			}
			if(isset($_GET['couleurs'])){
				foreach($_GET['couleurs'] as $couleur){
					$args_url.='&amp;couleurs[]='.$couleur;
				}
			}
			if(isset($_GET['mots_cles'])){
				foreach($_GET['mots_cles'] as $mot_cle){
					$args_url.='&amp;mots_cles[]='.$mot_cle;
				}
			}
		?>
		<div id="entete">
			<h1 class="little_very_biggest sans mb3">Archive d'images</h1>
			<section id="filtres" class="mb2">
				<div class="image">
					<p class="filtre mr2 normal"><a href="<?php bloginfo('url'); ?>?page_id=13<?php echo $args_url;?>">Retour à la liste</a></p>
				</div>
				<div class="bordure image">
				</div>
			</section>
		</div>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php
			$couleurs = get_the_terms( $post->ID, 'couleur' );	
			if ( $couleurs && ! is_wp_error( $couleurs ) ) : 
				foreach ( $couleurs as $couleur ) {
					$liste_couleurs.='<span class="couleur">'.$couleur->name.'</span>';
				}			
			endif;

			$mots_cles = get_the_terms( $post->ID, 'mot_cle_image' );
			if ( $mots_cles && ! is_wp_error( $mots_cles ) ) : 
				foreach ( $mots_cles as $mot_cle ) {
					$liste_mots_cles.='<span class="couleur">'.$mot_cle->name.'</span>';
				}
			endif;


		?>
		<article class="pb2 post" id="post-<?php the_ID(); ?>">
			<div class="post_content image mb2 row">
				<div class="conteneur_image col">
					<?php
						echo wp_get_attachment_image( $post->ID, 'iconographie' );
					?>
				</div>
				<div class="col texte_image">
					<h2 class="bigger"><?php the_title(); ?></h2>
					<p class="small"><span class="court">Date :</span><?php the_field('date_document');?></p>
					<p class="small"><span class="long">Type de document :</span><?php the_field('type_de_document');?></p>
					<p class="small"><span class="court">Auteur :</span><?php the_field('auteur');?></p>
					<p class="small"><span class="court">Couleur :</span><?php echo $liste_couleurs;?></p>
					<p class="small"><span class="court">Mots clés :</span><?php echo $liste_mots_cles;?></p>
					<p class="small"><span class="moyen">Dimensions :</span><?php the_field('dimensions');?></p>
					<p class="small mb1"><span class="moyen">Poids fichier :</span><?php the_field('poids');?></p>
					<p class="small"><span class="full">Remarques :</span><?php the_field('remarques');?></p>
				</div>
			</div>
			<div class="small texte_article_image">
				<p>Vous souhaitez utiliser un document, une image, un texte ? Prenez contact avec nous afin d’en obtenir une meilleure résolution et les droits de reproduction.</p>
				<a href="<?php bloginfo('url'); ?>?page_id=18" class="suite mt1"><span>Contact ITS</span></a>
			</div>
		</article>

		<section id="meme_theme" class="pt1 pb4 image">
            <h3 class="small mb3">Archives sur les mêmes critères</h3>
            <div>
	            <figure class="mb1">
					<div class="miniature"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche1.png" alt="<?php the_title(); ?>"/></a></div>
					<p>1960, noir, vert, indochine, picart</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche2.png" alt="<?php the_title(); ?>"/></a></div>
					<p>1960, bleu, derbe, auteur inconnu</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche3.png" alt="<?php the_title(); ?>"/></a></div>
					<p>1960, rouge, berlin, auteur inconnu</p>
				</figure>
				<figure class="mb1">
					<div class="miniature"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche4.png" alt="<?php the_title(); ?>"/></a></div>
					<p>1960, affiche, noir, blanc, pays basque</p>
				</figure>
				<figure class="mb1 sans">
					<div class="miniature"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche5.png" alt="<?php the_title(); ?>"/></a></div>
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