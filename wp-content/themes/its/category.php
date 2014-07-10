<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete" class="pt0">
	<?php 	if(category_description()!=""){
	?>
				<h1 class="super_biggest sans mb3 pb0"><?php single_cat_title();?></h1>
				<div id="texte_tag" class="mb3 normal">
					<?php echo category_description(); ?> 
				</div>
	<?php
			}
	?>
			<div class="conteneur pt2">
				<ul id="navigation_curseur" class="large mb1 sans">
	        		<li id="curseur_large"></li>
					<li class="precedent_tag"></li>
				<?php
					$laCat = get_query_var('cat');
					$lesAnnees = array();
					$i=1;
					$my_query_annees = new WP_Query( array( 'post_type' => 'post', 'cat'=>get_query_var('cat'), 'posts_per_page'=>-1, 'order'=>'ASC'));
					while( $my_query_annees->have_posts() ) : $my_query_annees->the_post();
						$ladate = the_date('Y', '', '',FALSE);
						if(!in_array($ladate,$lesAnnees) && $ladate!="" && $ladate<=1990){

							$lesAnnees[]=$ladate;
				?>
							<li class="puce-tag" id="puce-tag_<?php echo $i;?>"><a href="?annee=<?php echo $ladate;?>"><span class="invisible span-tag" id="span-tag_<?php echo $i;?>"><?php echo $ladate;?></span></a></li>
				<?php
							$i++;
						}
					endwhile;
					wp_reset_postdata();					
				?>
					<li class="suivant_tag"></li>
	        	</ul>
				
				<?php
					//on gère l'affichage de la frise grâce à un champ ACF.
					$test_frise = get_field('masquer_frise','category_'.get_query_var('cat'));
					$parent="";
					$les_categories = get_ancestors( get_query_var('cat'), 'category' );
					if($les_categories){
						$parent = $les_categories[0];
					}
					$thisCat = get_category($parent);
					//if($thisCat->slug=="categories-meres" || $parent==""){
					$categories = get_categories( array('parent'=>get_query_var('cat'))); 
					//}
					if(empty($categories)){
						$categories = get_categories( array('parent'=>$parent));
					}
				?>
					
				<?php
					if(!$test_frise && count($lesAnnees)>0){
				?>
						<section id="frise" class="normal mb1 pl3">
						<?php
							if(count($lesAnnees)!=0){
						?>
								<div class="conteneur_annees">
									<ul class="categorie">
						<?php				
										foreach($lesAnnees as $annee){
						?>
											<li id="annee_<?php echo $annee;?>"><a href="?annee=<?php echo $annee;?>"><?php echo $annee;?></a></li>
						<?php
										}	
						?>
									</ul>
								</div>
						<?php
							}
						?>
							<a href="?annee=regards" id="regards">Regards d'aujourd'hui</a>
						</section>
				<?php
					}
					if(!empty($categories)){
				?>
						<section id="sous_categories" class="small mb2 pt1 pb1">
							<ul>
				<?php
							foreach ($categories as $categorie){
				?>
								<li class="pl3"><a href="<?php echo get_category_link($categorie->term_id);?>" <?php if($categorie->term_id==get_query_var('cat')){echo ' class="actif"';}?>><?php echo $categorie->name;?></a></li>
				<?php
							}
				?>
							</ul>
						</section>
				<?php						
					}
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if(isset($_GET['annee'])){
						if($_GET['annee']!="regards"){
							$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$_GET['annee'], 'cat'=>get_query_var('cat'), 'paged' => $paged));
						}
						else{
							function filter_where( $where = '' ) {
								// posts for March 1 to March 15, 2010
								$where .= " AND post_date >= '1991-01-01'";
								return $where;
							}

							add_filter( 'posts_where', 'filter_where' );
							$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>get_query_var('cat'), 'paged' => $paged));
							remove_filter( 'posts_where', 'filter_where' );
						}
					}
					else{
						$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$lesAnnees[0], 'cat'=>get_query_var('cat'), 'paged' => $paged));
					}
					if($my_query->max_num_pages>1){
				?>
						<section class="pagination smaller mb2">
							<?php
								$big = 99999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
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
		<div>
		<?php
        	while( $my_query->have_posts() ) : $my_query->the_post();?>
				<?php get_template_part( 'boucle', '' );?>
			<?php endwhile;
			wp_reset_postdata();
        ?>
		</div>
		<?php
			if($my_query->max_num_pages>1){
		?>
				<section class="pagination basse smaller pt1">
					<?php
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
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

<?php get_footer(); ?>