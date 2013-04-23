<?php get_header(); ?>

<!-- GABARIT SINGLE.PHP -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php 
			$categorie = get_the_category();
			$liste_tags = "";
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
		?>
		<article class="pt2 pb2 post" id="post-<?php the_ID(); ?>">
			<h4 class="smaller mb0 tag"><span></span><?php echo $tag_principal; ?></h4>
			<p class="mb1 smaller categories_et_tags"><span class="categories"><?php echo get_category_parents($categorie[0]->term_id,'true','');?></span> <span class="tags"><?php echo $liste_tags; ?></span></p>
			<h2 class="very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<h3 class="little_small mb4 mt0 date"><?php the_field('date_article');?> <span><?php the_field('auteur_article');?></span></h3>
			<div class="post_content normal pb2 mb2">
				<?php get_template_part( 'content', 'get_post_format()' ); ?>
			</div>
			<?php create_attachement_list(get_the_ID());?>
		</article>

		<section id="meme_theme" class="pt1 pb4">
            <h3 class="small mb2">Archives sur le thème : etudiants</h3>
            <ul id="liste_liens" class="small">
                <li><a href="#">Lien vers une archive</a></li>
                <li><a href="#">Lien vers une autre archive</a></li>
                <li><a href="#">Lien vers une archive</a></li>
                <li><a href="#">Lien vers une autre archive</a></li>
                <li><a href="#">Lien vers une archive</a></li>
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