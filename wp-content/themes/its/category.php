<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<!--<h1 class="very_biggest"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php single_cat_title();?></a></h1>-->
			<section id="frise" class="normal mt2 mb1 pl3">
				<ul class="categorie">
					<?php
						$laCat = get_query_var('cat');
						$lesAnnees = array();
						$my_query_annees = new WP_Query( array( 'post_type' => 'post', 'cat'=>get_query_var('cat'), 'posts_per_page'=>-1));
						while( $my_query_annees->have_posts() ) : $my_query_annees->the_post();
							$ladate = the_date('Y', '', '',FALSE);
							if(!in_array($ladate,$lesAnnees)){
								$lesAnnees[]=$ladate;
							}
						endwhile;
						wp_reset_postdata();
						asort($lesAnnees);
						foreach($lesAnnees as $annee){
					?>
							<li><a href="?annee=<?php echo $annee;?>"><?php echo $annee;?></a></li>
					<?php	
						}
					?>
				</ul>
				<a href="#">Regards d'aujourd'hui</a>
			</section>
			
			<?php
				$les_categories = get_ancestors( get_query_var('cat'), 'category' );
				$thisCat = get_category($les_categories[0]);
				if($thisCat->slug=="categories-meres"){
					$categories = get_categories( array('parent'=>get_query_var('cat'), 'hide_empty'=>'0')); 
				}
				else{
					$categories = get_categories( array('parent'=>$les_categories[0], 'hide_empty'=>'0'));
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
			?>
			
			<section class="pagination smaller mb2">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if(isset($_GET['annee'])){
						$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$_GET['annee'], 'cat'=>get_query_var('cat'), 'paged' => $paged));
					}
					else{
						$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>get_query_var('cat'), 'paged' => $paged));
					}

					
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
		
		<?php
        	while( $my_query->have_posts() ) : $my_query->the_post();?>
				<?php get_template_part( 'boucle', '' );?>
			<?php endwhile;
			wp_reset_postdata();
        ?>

		<section class="pagination smaller mt1">
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