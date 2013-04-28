<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<?php 
				$tag = get_tags(array('slug'=>get_query_var('tag')));
				$value = get_field('titre_tag','post_tag_'.$tag[0]->term_id);
				if($value){
			?>
					<h1 class="very_biggest mb4 sans"><?php echo $value;?></h1>
					<div class="normal pb2 mb2" id="texte_tag"><?php the_field('texte_tag','post_tag_'.$tag[0]->term_id);?></div>
					<?php 
                        $articles = get_field('articles_relatifs','post_tag_'.$tag[0]->term_id);
                        if($articles!=false){
                    ?>
                    		<div class="normal pb3" id="relatif_tag">
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
				else{
			?>
					<h1 class="very_biggest mb4"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php single_cat_title();?></a></h1>
			<?php	 
				}
			?>
			
			<ul id="navigation_curseur" class="large mb1">
        		<li id="curseur_large"></li>
				<li class="precedent"></li>
				<li class="super_actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li class="suivant"></li>
        	</ul>

        	<section id="frise" class="normal mt2 mb1 pl3 row large">
				<ul class="row">
					<li class="actif"><a href="#">1960</a></li>
					<li><a href="#">1961</a></li>
					<li><a href="#">1962</a></li>
					<li><a href="#">1963</a></li>
					<li><a href="#">1964</a></li>
					<li><a href="#">1965</a></li>
					<li><a href="#">1966</a></li>
					<li><a href="#">1967</a></li>
					<li><a href="#">1968</a></li>
					<li><a href="#">1969</a></li>
					<li><a href="#">1970</a></li>
					<li><a href="#">1971</a></li>
				</ul>
			</section>
			<section id="sous_categories" class="small mb2 pt1 pb1">
				<ul>
					<li class="pl3"><a href="#">L'Enseignement</a></li>
					<li class="pl3"><a href="#">L'Agriculture</a></li>
					<li class="pl3"><a href="#">Le Logement</a></li>
					<li class="pl3"><a href="#">L'Urbanisme</a></li>
					<li class="pl3"><a href="#">L'économie</a></li>
				</ul>
			</section>

			<section class="pagination smaller mb2">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$my_query = new WP_Query( array( 'post_type' => 'post', 'tag'=>get_query_var('tag'), 'category__not_in'=>'52', 'posts_per_page' => 1, 'paged' => $paged));

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
