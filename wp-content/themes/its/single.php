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
			$categories="";
			$tag_principal = "";
			$tags = get_the_tags();

			foreach ($tags as $tag){
				if(get_field('tag_principal','post_tag_'.$tag->term_id)=="Oui"){
					$tag_principal = $tag->name;
				}
				else{
					$liste_tags .= $tag->name.', ';
				}
			}
			$liste_tags = substr($liste_tags, 0, -2);
			$categories = get_category_parents($categorie[0]->term_id,'true','');
			if($tag_principal==""){
				$tag_principal="Institut Tribune Socialiste";
			}
		?>
		<article class="pt1 pb2 post" id="post-<?php the_ID(); ?>">
			<h4 class="smaller mb0 tag"><span></span><?php echo $tag_principal; ?></h4>

			<?php
			if($categories!="" || $liste_tags!=""){
		?>
				<p class="mb1 smaller categories_et_tags">
				<?php 
					if($categorie!=""){ 
						echo '<span class="categories">'.$categories.'</span>&nbsp';
					}
					if($liste_tags!=""){
						echo '<span class="tags">'.$liste_tags.'</span>';
					}
				?>
				</p>
		<?php
			}
		?>
			<h2 class="very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		<?php
			if(get_field('date_article') || get_field('auteur_article')){
		?>
				<h3 class="little_small mb4 mt0 date">
		<?php 		
				if(get_field('date_article')){
					echo get_field('date_article').'&nbsp';
				}
				if(get_field('auteur_article')){
					echo '<span>'.get_field('auteur_article').'</span>';
				}
		?>
				</h3>
		<?php
			}
		?>
			<div class="post_content normal pb2 mb2">
				<?php get_template_part( 'content', 'get_post_format()' ); ?>
			</div>
			<?php create_attachement_list(get_the_ID());?>
		</article>

		<section id="meme_theme" class="pt1 pb4">
            <h3 class="small mb2">Archives sur le thème : <?php echo $categorie[0]->cat_name;?></h3>
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