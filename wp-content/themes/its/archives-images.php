<?php
/*
Template Name: Page archive d'images
*/
?>
<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="little_very_biggest sans mb4"><?php the_title(); ?></h1>
			<section id="filtres" class="">
				<div class="">
					<p class="filtre mr2 pl3 normal">Filtrer les images par critères</p>
					<ul id="filtres_actifs" class="small">
						<?php
							if(isset($_GET['annees'])){
								foreach($_GET['annees'] as $annee){
									$new_url = str_replace ( '&annees[]='.$annee , '' , $_SERVER['REQUEST_URI']);
									echo '<li class="mr1"><a href="http://'.$_SERVER['HTTP_HOST'].$new_url.'">'.$annee.'</a></li>';
								}
							}

							if(isset($_GET['types'])){
								foreach($_GET['types'] as $type){
									$new_url = str_replace ( '&types[]='.$type , '' , $_SERVER['REQUEST_URI']);
									echo '<li class="mr1"><a href="http://'.$_SERVER['HTTP_HOST'].$new_url.'">'.$type.'</a></li>';
								}
							}

							if(isset($_GET['auteurs'])){
								foreach($_GET['auteurs'] as $auteur){
									$new_url = str_replace ( '&auteurs[]='.$auteur , '' , $_SERVER['REQUEST_URI']);
									echo '<li class="mr1"><a href="http://'.$_SERVER['HTTP_HOST'].$new_url.'">'.$auteur.'</a></li>';
								}
							}

							if(isset($_GET['couleurs'])){
								foreach($_GET['couleurs'] as $couleur){
									$new_url = str_replace ( '&couleurs[]='.$couleur , '' , $_SERVER['REQUEST_URI']);
									echo '<li class="mr1"><a href="http://'.$_SERVER['HTTP_HOST'].$new_url.'">'.$couleur.'</a></li>';
								}
							}

							if(isset($_GET['mots_cles'])){
								foreach($_GET['mots_cles'] as $mot_cle){
									$new_url = str_replace ( '&mots_cles[]='.$mot_cle , '' , $_SERVER['REQUEST_URI']);
									echo '<li class="mr1"><a href="http://'.$_SERVER['HTTP_HOST'].$new_url.'">'.$mot_cle.'</a></li>';
								}
							}
						?>
					</ul>
				</div>
				<div class="conteneur">
					<section id="filtre_date" class="row small pt3">
						<div class="col first">
							<p class="pl3">Date :</p>
						</div>
						<div class="col">
							<ul>
								<?php
									for($i=1960;$i<=1990;$i++){
										if(in_array($i,$_GET['annees'])){
											echo '<li>'.$i.'</li>';
										}
										else{
											echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&amp;annees[]='.$i.'">'.$i.'</a></li>';
										}
									}
								?>
							</ul>
						</div>
					</section>
					<section id="filtre_type" class="row small">
						<div class="col">
							<p class="pl3">Type de document :</p>
						</div>
						<div class="col">
							<ul>
							<?php
								$types_documents = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'type_de_document' ORDER BY meta_value" );
								foreach($types_documents as $type_document){
									if(in_array($type_document,$_GET['types'])){
										echo '<li>'.$type_document.'</li>';
									}
									else{
										echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&amp;types[]='.$type_document.'">'.$type_document.'</a></li>';
									}
								}
							?>
							</ul>
						</div>
					</section>
					<section id="filtre_auteur" class="row small">
						<div class="col">
							<p class="pl3">Auteur :</p>
						</div>
						<div class="col">
							<ul>
							<?php
								$auteurs = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'auteur' ORDER BY meta_value" );
								foreach($auteurs as $auteur){
									if(in_array($auteur,$_GET['auteurs'])){
										echo '<li>'.$auteur.'</li>';
									}
									else{
										echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&amp;auteurs[]='.$auteur.'">'.$auteur.'</a></li>';
									}
								}
							?>
							</ul>
						</div>
					</section>
					<section id="filtre_couleur" class="row small">
						<div class="col">
							<p class="pl3">Couleur :</p>
						</div>
						<div class="col">
							<ul>
							<?php
								$couleurs = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'couleur' ORDER BY meta_value" );
								var_dump($couleurs);
								/*foreach($couleurs as $couleur){
									if(in_array($couleur,$_GET['couleurs'])){
										echo '<li>'.$couleur.'</li>';
									}
									else{
										echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&amp;couleurs[]='.$couleur.'">'.$couleur.'</a></li>';
									}
								}*/
							?>
							</ul>
						</div>
					</section>
					<section id="filtre_mots" class="row small">
						<div class="col">
							<p class="pl3">Mots clés :</p>
						</div>
						<div class="col">
							<ul>
								<li>Campagne présidentielle</li>
								<li>Guerre</li>
								<li>Manifestation</li>
								<li>Ouvriers</li>
								<li>Logement</li>
								<li>Etudiants</li>
								<li>Impôts</li>
								<li>Ecologie</li>
							</ul>
						</div>
					</section>
				</div>
				<div class="bordure pb1">
				</div>
			</section>

			<section class="pagination smaller mb2 mt4">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$my_query = new WP_Query( array( 'post_type' => 'attachment', 'meta_key'=>'is_archive', 'meta_value'=>true, 'post_status'=>'any', 'posts_per_page' => 25,'paged' => $paged));

					$big = 99999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $my_query->max_num_pages,
						'prev_text'    => '« Previous',
						'next_text'    => 'Next »',
					) );
				?>
			</section>
		</div>
		
		<section id="liste_images">
			<?php
	        	while( $my_query->have_posts() ) : $my_query->the_post();
	        ?>
					<figure class="mb1">
						<div class="miniature">
							<a href="<?php the_permalink();?>">
								<?php
									echo wp_get_attachment_image( $post->ID, 'miniature-iconographie' );
								?>
							</a>
						</div>
						<p>
							<?php the_field('date_document');?>, 
							<?php the_field('couleur');?>, 
							<?php 
								$tags = get_the_tags();
								foreach ($tags as $tag){
									echo $tag->name.', ';
								}
							?>
							<?php the_field('auteur');?></p>
						<div class="grand_format">
							<?php
								echo wp_get_attachment_image( $post->ID, 'iconographie' );
							?>
							<h4 class="little_small"><?php the_title();?></h4>
							<h5 class="little_small"><span><?php the_field('date_document');?></span><?php the_field('auteur');?></h5>
						</div>
					</figure>
				<?php endwhile;
	        ?>
		</section>

		<section class="pagination smaller">
			<?php
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $my_query->max_num_pages,
					'prev_text'    => '« Previous',
					'next_text'    => 'Next »',
				) );
			?>
		</section>
	</div>

<?php get_footer(); ?>