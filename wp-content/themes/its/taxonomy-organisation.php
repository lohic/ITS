<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="super_biggest mb4 sans"><?php single_cat_title();?></h1>
		<?php 
			$idObj = get_term_by('slug',get_query_var('organisation'),'organisation'); 
  			$value = get_field('texte_organisation','organisation_'.$idObj->term_id);
			if($value){
		?>
				<div class="normal mb2" id="texte_tag"><?php the_field('texte_organisation','organisation_'.$idObj->term_id);?></div>
				<?php 
                    $articles = get_field('articles_relatifs','organisation_'.$idObj->term_id);
                    if($articles!=false){
                ?>
                		<div class="normal pb3 pt2" id="relatif_tag">
                			<ul class="liste_attachements">
               	<?php
                        		foreach($articles as $article){
                ?>
                                    <li class="telechargement"><a href="<?php echo get_permalink($article->ID); ?>"><?php echo get_the_title($article->ID);?></a></li>
                <?php
                        		} 
                ?>
                			</ul>
						</div>
                <?php
                    }
                ?>
		<?php 
			}
		?>
			<div class="conteneur pt1">
				<ul id="navigation_curseur" class="large mb1 sans organisation">
	        		<li id="curseur_large"></li>
					<li class="precedent_tag"></li>
				<?php
					$idObj = get_category_by_slug('agenda'); 
					$idObj2 = get_category_by_slug('biographies');
					$laCat = get_query_var('cat');
					$lesAnnees = array();
					$i=1;
					$my_query_annees = new WP_Query( array( 'post_type' => 'post', 'organisation'=>get_query_var('organisation'), 'category__not_in'=>array($idObj->term_id, $idObj2->term_id), 'posts_per_page'=>-1, 'order'=>'ASC'));
					while( $my_query_annees->have_posts() ) : $my_query_annees->the_post();
						$ladate = the_date('Y', '', '',FALSE);
						if(!in_array($ladate,$lesAnnees) && $ladate!="" && $ladate<=1990){

							$lesAnnees[]=$ladate;
				?>
							<li class="puce-tag" id="puce-tag_<?php echo $i;?>"><span class="invisible span-tag" id="span-tag_<?php echo $i;?>"><?php echo $ladate;?></span></li>
				<?php
							$i++;
						}
					endwhile;
					wp_reset_postdata();					
				?>
					<li class="suivant_tag"></li>
	        	</ul>

				<section id="frise" class="normal mt2 mb1 pl3">
					<div class="conteneur_annees">
						<ul class="categorie">
							<?php
								//asort($lesAnnees);
								foreach($lesAnnees as $annee){
							?>
									<li id="annee_<?php echo $annee;?>"><a href="?annee=<?php echo $annee;?>"><?php echo $annee;?></a></li>
							<?php	
								}
							?>
						</ul>
					</div>
					<a href="?annee=regards" id="regards">Regards d'aujourd'hui</a>
				</section>
			<?php
				$categories = get_field('menu_lie','organisation_'.$idObj->term_id);
				if($categories){
			?>
					<section id="sous_categories" class="small mb2 pt1 pb1">
						<?php wp_nav_menu( array('menu'=>$categories->name, 'container' => 'false'));?>
					</section>
			<?php
				}
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				

				if(isset($_GET['annee'])){
					if($_GET['annee']!="regards"){
						$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$_GET['annee'], 'organisation'=>get_query_var('organisation'), 'category__not_in'=>array($idObj->term_id, $idObj2->term_id), 'paged' => $paged));
					}
					else{
						function filter_where( $where = '' ) {
							// posts for March 1 to March 15, 2010
							$where .= " AND post_date >= '1991-01-01'";
							return $where;
						}

						add_filter( 'posts_where', 'filter_where' );
						$my_query = new WP_Query( array( 'post_type' => 'post', 'organisation'=>get_query_var('organisation'), 'category__not_in'=>array($idObj->term_id, $idObj2->term_id), 'paged' => $paged));
						remove_filter( 'posts_where', 'filter_where' );
					}
				}
				else{
					$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$lesAnnees[0], 'organisation'=>get_query_var('organisation'), 'category__not_in'=>array($idObj->term_id, $idObj2->term_id), 'paged' => $paged));
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
								'prev_text'    => '« Previous',
								'next_text'    => 'Next »',
							) );
						?>
					</section>
			<?php		
				}
			?>
			</div>
		</div>
		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$big = 99999999; // need an unlikely integer
		?>
		
		<div>
		<?php
        	while( $my_query->have_posts() ) : $my_query->the_post();?>
				<?php get_template_part( 'boucle', '' );?>
			<?php endwhile;
        ?>
		</div>
		<?php
			if($my_query->max_num_pages>1){
		?>
				<section class="pagination basse smaller mb2 pt1">
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
		<?php
			}
		?>
	</div>

<?php get_footer(); ?>