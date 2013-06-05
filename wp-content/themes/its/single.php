<?php get_header(); ?>

<!-- GABARIT SINGLE.PHP -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php 
			$categorie = get_the_category();
			$liste_tags = "";
			//$categories="";
			$organisations = "";
			$tags = get_the_tags();
			if($tags){
				foreach ($tags as $tag){
					$liste_tags .= $tag->name.', ';
				}
				$liste_tags = substr($liste_tags, 0, -2);
			}
			//$categories = get_category_parents($categorie[0]->term_id,'true','');

			$organisations = get_the_term_list( $post->ID, 'organisation', '', ', ', '' );

			if($organisations==""){
				$organisations="Institut Tribune Socialiste";
			}
		?>
		<article class="pt1 pb2 post" id="post-<?php the_ID(); ?>">
			<h4 class="smaller mb0 tag"><span></span><?php echo $organisations; ?></h4>

			<h2 class="very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		<?php
			$date_article = get_field('date_article');
			$auteur_article = get_field('auteur_article');
			if($date_article || $auteur_article){
		?>
				<h3 class="little_small mb2 mt0 date">
		<?php 		
				if($date_article){
					echo $date_article;
					if($auteur_article){
						echo '&nbsp•&nbsp<span>'.$auteur_article.'</span>';
					}
				}
				else{
					if($auteur_article){
						echo '<span>'.$auteur_article.'</span>';
					}
				}
		?>
				</h3>
		<?php
			}
		?>
			<div class="post_content normal pb2 mb1 mt2">
				<?php get_template_part( 'content', 'get_post_format()' ); ?>
				<div class="clear"></div>
				<?php create_attachement_list(get_the_ID());?>
			</div>
			<?php
				if($liste_tags!=""){
			?>
					<p class="normal tags">Mots-clés : <span class="tags"><?php echo $liste_tags;?></span></p>
			<?php
				}
			?>
		</article>

		<section id="meme_theme" class="pt1 pb4">
            <!--<h3 class="small mb2">Archives sur le thème : <?php echo $categorie[0]->cat_name;?></h3>-->
            <h3 class="small mb1">Archives en relation</h3>
            <ul id="liste_liens" class="small">
				<?php
					$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>$categorie[0]->term_id, 'orderby' => 'rand', 'posts_per_page'=>5));
					while( $my_query->have_posts() ) : $my_query->the_post();
				?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile;
					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
				?>
            </ul>

            <a href="#" class="recherche small mt0">Faire une recherche</a>
        </section>
        <section class="comments-template pt1">
        	<?php comments_template(); ?>
		</section>
	
	<?php endwhile; ?>
	<?php else : ?>
			<p>Désolé, aucun article ne correspond à vos critères.</p>
<?php endif; ?>
	</div>

<?php get_footer(); ?>