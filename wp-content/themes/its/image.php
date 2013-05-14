<?php get_header(); ?>

<!-- GABARIT image.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
    		$args_url = '';
    		$params = array();
			$paramsQuery = array();
			
    		if(isset($_GET['annees'])){
    			$params_annees=array();
				foreach($_GET['annees'] as $annee){
					$args_url.='&amp;annees[]='.$annee;
					$params_annees[]=$annee;
				}
				$params[]=array('key' => 'date_document', 'value'=>$params_annees,'compare'=>'IN');
			}
			if(isset($_GET['types'])){
				$params_types=array();
				foreach($_GET['types'] as $type){
					$args_url.='&amp;types[]='.$type;
					$params_types[]=$type;
				}
				$params[]=array('key' => 'type_de_document', 'value'=>$params_types,'compare'=>'IN');
			}
			if(isset($_GET['auteurs'])){
				$params_auteurs=array();
				foreach($_GET['auteurs'] as $auteur){
					$args_url.='&amp;auteurs[]='.$auteur;
					$params_auteurs[]=$auteur;
				}
				$params[]=array('key' => 'auteur', 'value'=>$params_auteurs,'compare'=>'IN');
			}
			if(isset($_GET['couleurs'])){
				$params_couleurs=array();
				foreach($_GET['couleurs'] as $couleur){
					$args_url.='&amp;couleurs[]='.$couleur;
					$params_couleurs[]=$couleur;
				}
				$paramsQuery[]=array('taxonomy'=>'couleur', 'field' => 'slug', 'terms' => $params_couleurs,'operator' => 'IN');
			}
			if(isset($_GET['mots_cles'])){
				$params_mots=array();
				foreach($_GET['mots_cles'] as $mot_cle){
					$args_url.='&amp;mots_cles[]='.$mot_cle;
					$params_mots[]=$mot_cle;
				}
				$paramsQuery[]=array('taxonomy'=>'mot_cle_image', 'field' => 'slug', 'terms' => $params_mots,'operator' => 'IN');
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
        	<?php
        		$new_url = str_replace ( 'attachment_id='.$post->ID , '' , $_SERVER['REQUEST_URI']);
				$new_url = 'http://'.$_SERVER['HTTP_HOST'].$new_url;
				$my_query = new WP_Query( array( 'post_type' => 'attachment', 'post__not_in' => array( $post->ID ), 'meta_query'=> $params, 'tax_query' => $paramsQuery, 'meta_key'=>'is_archive', 'meta_value'=>true, 'post_status'=>'any', 'orderby' => 'rand', 'posts_per_page' => 5,'paged' => $paged));
				while( $my_query->have_posts() ) : $my_query->the_post();
			?>
		            <figure class="mb1">
						<div class="miniature">
							<a href="<?php echo $new_url.'&amp;attachment_id='.$post->ID;?>">
								<?php
									echo wp_get_attachment_image( $post->ID, 'miniature-iconographie' );
								?>
							</a>
						</div>
						<p>
							<?php the_field('date_document');?>, 
							<?php
								$couleurs = get_the_terms( $post->ID, 'couleur' );
						
								if ( $couleurs && ! is_wp_error( $couleurs ) ) : 

									$liste_couleurs = array();

									foreach ( $couleurs as $couleur ) {
										$liste_couleurs[] = $couleur->name;
									}
													
									$les_couleurs = join( ", ", $liste_couleurs );
									echo $les_couleurs.', ';
								endif;
							?>
							<?php 
								$mots_cles = get_the_terms( $post->ID, 'mot_cle_image' );
						
								if ( $mots_cles && ! is_wp_error( $mots_cles ) ) : 

									$liste_mots_cles = array();

									foreach ( $mots_cles as $mot_cle ) {
										$liste_mots_cles[] = $mot_cle->name;
									}
													
									$les_mots_cles = join( ", ", $liste_mots_cles );
									echo $les_mots_cles.', ';
								endif;
							?>
							<?php the_field('auteur');?>
						</p>
					</figure>
				
				<?php endwhile;
	        ?>
			</div>
        </section>
       
	<?php endwhile; ?>
	<?php else : ?>
			<p>Désolé, aucun article ne correspond à vos critères.</p>
<?php endif; ?>
	</div>

<?php get_footer(); ?>