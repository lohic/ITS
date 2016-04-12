<?php
/*
Template Name: Page archive d'images
*/
?>
<?php get_header(); ?>

<!-- archives-images.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="container">
			<div id="entete">
				<h1 class="super_biggest sans mb4"><?php the_title(); ?></h1>
				<section id="filtres" class="affiches">
					<div class="">
						<p class="filtre mr2 pl3 normal">Filtrer les images par critères</p>
						<ul id="filtres_actifs" class="small">
							<?php
								$params = array();
								$paramsQuery = array();

								if(isset($_GET['annees'])){
									$params_annees=array();
									foreach($_GET['annees'] as $annee){
										$anneeTxt = $annee == 0 ? 'SD' : $annee;
										echo '<li class="mr1"><a href="#" class="lien_filtre_actif">'.$anneeTxt.'</a></li>';
										$params_annees[]=$annee;
									}
									$params[]=array('key' => 'date_document', 'value'=>$params_annees,'compare'=>'IN');
								}

								if(isset($_GET['types'])){
									$params_types=array();
									foreach($_GET['types'] as $type){
										echo '<li class="mr1"><a href="#" class="lien_filtre_actif">'.$type.'</a></li>';
										$params_types[]=$type;
									}
									$params[]=array('key' => 'type_de_document', 'value'=>$params_types,'compare'=>'IN');
								}

								if(isset($_GET['auteurs'])){
									$params_auteurs=array();
									foreach($_GET['auteurs'] as $auteur){									
										echo '<li class="mr1"><a href="#" class="lien_filtre_actif">'.$auteur.'</a></li>';
										$params_auteurs[]=$auteur;
									}
									$params[]=array('key' => 'auteur', 'value'=>$params_auteurs,'compare'=>'IN');
								}

								if(isset($_GET['couleurs'])){
									$params_couleurs=array();
									foreach($_GET['couleurs'] as $couleur){	
										$ma_couleur = get_term_by( 'slug', $couleur, 'couleur');															
										echo '<li class="mr1"><a href="#" class="lien_filtre_actif">'.$ma_couleur->name.'</a></li>';
										$params_couleurs[]=$couleur;
									}
									$paramsQuery[]=array('taxonomy'=>'couleur', 'field' => 'slug', 'terms' => $params_couleurs,'operator' => 'IN');
								}

								if(isset($_GET['mots'])){
									$params_mots=array();
									foreach($_GET['mots'] as $mot_cle){	
										$mon_mot = get_term_by( 'slug', $mot_cle, 'mot_cle_image');																
										echo '<li class="mr1"><a href="#" class="lien_filtre_actif">'.$mon_mot->name.'</a></li>';
										$params_mots[]=$mot_cle;
									}
									$paramsQuery[]=array('taxonomy'=>'mot_cle_image', 'field' => 'slug', 'terms' => $params_mots,'operator' => 'IN');
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
									if(!preg_match('/\?/',$_SERVER['REQUEST_URI'])){
										$caractere = "?";
									}
									else{
										$caractere = "&amp;";
									}
									$annees = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'date_document' ORDER BY meta_value" );
									if($annees){
										foreach($annees as $annee){
											if($annee!=""){
												$anneeTxt = $annee == 0 ? 'SD' : $annee;
												if(isset($_GET['annees'])){
													if(in_array($annee,$_GET['annees'])){
														echo '<li class="actif">'.$anneeTxt.'</li>';
													}
													else{
														echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'annees[]='.$annee.'">'.$anneeTxt.'</a></li>';
													}
												}
												else{
													echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'annees[]='.$annee.'">'.$anneeTxt.'</a></li>';
												}
											}
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
									if($types_documents){
										foreach($types_documents as $type_document){
											if($type_document!=""){
												if(isset($_GET['types'])){
													if(in_array($type_document,$_GET['types'])){
														echo '<li class="actif">'.$type_document.'</li>';
													}
													else{
														echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'types[]='.$type_document.'">'.$type_document.'</a></li>';
													}
												}
												else{
													echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'types[]='.$type_document.'">'.$type_document.'</a></li>';
												}
											}
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
									if($auteurs){
										foreach($auteurs as $auteur){
											if($auteur!=""){
												if(isset($_GET['auteurs'])){
													if(in_array($auteur,$_GET['auteurs'])){
														echo '<li class="actif">'.$auteur.'</li>';
													}
													else{
														echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'auteurs[]='.$auteur.'">'.$auteur.'</a></li>';
													}
												}
												else{
													echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'auteurs[]='.$auteur.'">'.$auteur.'</a></li>';
												}
											}
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
								$args = array('orderby'=>'name', 'order'=>'ASC', 'hide_empty'=>false);
								$couleurs = get_terms('couleur',$args);
								if($couleurs){
									foreach($couleurs as $couleur){
										if($couleur!=""){
											if(isset($_GET['couleurs'])){
												if(in_array($couleur->slug,$_GET['couleurs'])){
													echo '<li class="actif">'.$couleur->name.'</li>';
												}
												else{
													echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'couleurs[]='.$couleur->slug.'" data-la-couleur="'.$couleur->slug.'">'.$couleur->name.'</a></li>';
												}
											}
											else{
												echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'couleurs[]='.$couleur->slug.'" data-la-couleur="'.$couleur->slug.'">'.$couleur->name.'</a></li>';
											}
										}
									}
								}
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
								<?php
								$args = array('orderby'=>'name', 'order'=>'ASC', 'hide_empty'=>false);
								$mots = get_terms('mot_cle_image',$args);
								if($mots){
									foreach($mots as $mot){
										if($mot!=""){
											if(isset($_GET['mots'])){
												if(in_array($mot->slug,$_GET['mots'])){
													echo '<li class="actif">'.$mot->name.'</li>';
												}
												else{
													echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'mots_cles[]='.$mot->slug.'" data-le-mot="'.$mot->slug.'">'.$mot->name.'</a></li>';
												}
											}
											else{
												echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$caractere.'mots_cles[]='.$mot->slug.'" data-le-mot="'.$mot->slug.'">'.$mot->name.'</a></li>';
											}
										}
									}
								}
								?>
								</ul>
							</div>
						</section>
					</div>
					<div class="bordure">
					</div>
				</section>
				<p><?php
					//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					} else if ( get_query_var('page') ) {
						$paged = get_query_var('page'); 
					} else {
						$paged = 1;
					}

					$my_query = new WP_Query(
						array( 	'post_type' => 'attachment',
								'meta_query'=> $params,	
								'tax_query' => $paramsQuery,
								'meta_key'=>'is_archive',
								'meta_value'=>true,
								'post_status'=>'any',
								'posts_per_page' => 25,
								'paged' => $paged
						)
					);
				?></p>
						<section class="pagination smaller mb2 mt4 affiches">
						<?php
							$big = 99999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								//'format' => '/page/%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $my_query->max_num_pages,
								'prev_text'    => '« Précédent',
								'next_text'    => 'Suivant »',
							) );
						?>
						</section>
				<?php		
				?>
				
			</div>
		
		
			<section id="liste_images">
				<?php
					$parametres = "";
					if(isset($_GET['annees'])){
						foreach($_GET['annees'] as $uneAnnee){
							$parametres.="&amp;annees[]=".$uneAnnee;
						}
					}
					if(isset($_GET['types'])){
						foreach($_GET['types'] as $unType){
							$parametres.="&amp;types[]=".$unType;
						}
					}
					if(isset($_GET['auteurs'])){
						foreach($_GET['auteurs'] as $unAuteur){
							$parametres.="&amp;auteurs[]=".$unAuteur;
						}
					}
					if(isset($_GET['couleurs'])){
						foreach($_GET['couleurs'] as $uneCouleur){
							$parametres.="&amp;couleurs[]=".$uneCouleur;
							$ma_couleur = get_term_by( 'slug', $uneCouleur, 'couleur');
							$parametres.="&amp;couleurs_nom[]=".$ma_couleur->name;
						}
					}
					if(isset($_GET['mots'])){
						foreach($_GET['mots'] as $unMot){
							$parametres.="&amp;mots[]=".$unMot;
							$mon_mot = get_term_by( 'slug', $unMot, 'mot_cle_image');
							$parametres.="&amp;mots_nom[]=".$mon_mot->name;
						}
					}
					$compteur_images = 1;
		        	while( $my_query->have_posts() ) : $my_query->the_post();
		        		$infos_image = wp_get_attachment_image_src( $post->ID, 'iconographie');
		        ?>
						<figure class="mb1 <?php if($compteur_images%5==0){echo "sans";}?>" data-its-url="<?php echo $infos_image[0];?>">
							<div class="miniature">
								<a href="?attachment_id=<?php echo $post->ID.$parametres;?>">
									<?php
										echo wp_get_attachment_image( $post->ID, 'miniature-iconographie' );
									?>
								</a>
							</div>
							<!--<p>
								<?php
									$couleurs = get_the_terms( $post->ID, 'couleur' );
									$mots_cles = get_the_terms( $post->ID, 'mot_cle_image' );
									$phrase = array();

									if( get_field( "date_document" ) ): 
										$phrase[] = get_field('date_document');
									endif;
									
							
									if ( $couleurs && ! is_wp_error( $couleurs ) ) : 

										$liste_couleurs = array();

										foreach ( $couleurs as $couleur ) {
											$liste_couleurs[] = $couleur->name;
										}
														
										$les_couleurs = join( ", ", $liste_couleurs );
										$phrase[] = $les_couleurs;
									endif;
							
									
							
									if ( $mots_cles && ! is_wp_error( $mots_cles ) ) : 

										$liste_mots_cles = array();

										foreach ( $mots_cles as $mot_cle ) {
											$liste_mots_cles[] = $mot_cle->name;
										}
														
										$les_mots_cles = join( ", ", $liste_mots_cles );
										$phrase[] = $les_mots_cles;
									endif;
								
									if( get_field( "auteur" ) ): 
										$phrase[] = get_field('auteur');
									endif;

									$laphrase = join(", ", $phrase);
									echo $laphrase;
								?>
								
							</p>-->
							<div class="grand_format">
								<img src="" alt="<?php the_title();?>"/>
								<h4 class="little_small"><?php the_title();?></h4>
								<?php
									$date_document = get_field('date_document');
									$auteur = get_field('auteur');
									if($date_document || $auteur){
								?>
										<h5 class="little_small">
								<?php 		
										if($date_document){
											echo '<span>'.$date_document.'</span>';
											if($auteur){
												echo '&nbsp•&nbsp'.$auteur;
											}
										}
										else{
											if($auteur){
												echo $auteur;
											}
										}
								?>
										</h5>
								<?php
									}
								?>
							</div>
						</figure>
					<?php 
					$compteur_images++;
					endwhile;
		        ?>
			</section>

			<?php
				if($my_query->max_num_pages>1){
			?>
					<section class="pagination basse smaller pt1">
						<?php
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								//'format' => '/page/%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $my_query->max_num_pages,
								'prev_text'    => '« Précédent',
								'next_text'    => 'Suivant »',
							) );
						?>
					</section>
			<?php
				}
			?>
		</div>
	</div>

<!-- fin archives-images.php -->

<?php get_footer(); ?>