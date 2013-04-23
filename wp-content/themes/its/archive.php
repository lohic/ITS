<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>

    	<div id="entete">
			<h1 class="very_biggest"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php single_cat_title();?></a></h1>
			<section id="frise" class="normal mt2 mb1 pl3 row">
				<ul class="row">
					<li><a href="#">1963</a></li>
					<li><a href="#">1964</a></li>
					<li><a href="#">1965</a></li>
					<li><a href="#">1966</a></li>
					<li><a href="#">1967</a></li>
					<li><a href="#">1968</a></li>
					<li><a href="#">1969</a></li>
				</ul>
				<a href="#">Regards d'aujourd'hui</a>
			</section>
			<section id="sous_categories" class="small mb2 pt1 pb1">
				<ul>
				<?php 	
					$categories = get_categories( array('parent'=>get_cat_ID(single_cat_title('',false)), 'hide_empty'=>'0') ); 
					foreach ($categories as $categorie){
				?>
						<li class="pl3"><a href="<?php echo get_category_link($categorie->term_id);?>"><?php echo $categorie->name;?></a></li>
				<?php
					}
				?>
				</ul>
			</section>
			<section class="pagination smaller mb2">
				<a href="#" class="precedent">Prev</a>
				<a href="#" class="actif">1</a>
				<a href="#" class="">2</a>
				<a href="#" class="">3</a>
				<a href="#" class="">...</a>
				<a href="#" class="">18</a>
				<a href="#" class="">19</a>
				<a href="#" class="">20</a>
				<a href="#" class="suivant">Next</a>
			</section>
    	</div>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php 
			$categorie = get_the_category();
			$resume = get_field("resume_article");
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
			if(!$resume){
		?>
				<article class="pt2 pb2 post_archive" id="post-<?php the_ID(); ?>">
					<h4 class="smaller mb1 tag"><span></span><?php echo $tag_principal; ?></h4>
					<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="mb0 smaller categories_et_tags"><span class="categories"><?php echo get_category_parents($categorie[0]->term_id,'true','');?></span> <span class="tags"><?php echo $liste_tags; ?></span></p>
					<h3 class="little_small mb1 mt1 date"><?php the_field('date_article');?> <span><?php the_field('auteur_article');?></span></h3>
					<div class="post_content small">
						<?php the_content(); ?>
					</div>
					<?php create_attachement_list(get_the_ID());?>
				</article>
		<?php
			}
			else{
		?>
				<article class="pt2 pb2 post_archive resume" id="post-<?php the_ID(); ?>">
					<h4 class="smaller mb1 tag"><span></span><?php echo $tag_principal; ?></h4>
					<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="mb0 smaller categories_et_tags"><span class="categories"><?php echo get_category_parents($categorie[0]->term_id,'true','');?></span> <span class="tags"><?php echo $liste_tags; ?></span></p>
					<h3 class="little_small mb1 mt1 date"><?php the_field('date_article');?> <span><?php the_field('auteur_article');?></span></h3>
					<div class="post_content small resume">
						<?php 
							the_field('resume_article');
							echo ' ... <a href="'.get_permalink().'" class="suite"><span>lire la suite</span></a>';
						?>
					</div>
				</article>
		<?php	
			}
		?>
<?php endwhile; ?>
<?php endif; ?>
		<section class="pagination smaller mt1">
			<a href="#" class="precedent">Prev</a>
			<a href="#" class="actif">1</a>
			<a href="#" class="">2</a>
			<a href="#" class="">3</a>
			<a href="#" class="">...</a>
			<a href="#" class="">18</a>
			<a href="#" class="">19</a>
			<a href="#" class="">20</a>
			<a href="#" class="suivant">Next</a>
		</section>
	</div>

<?php get_footer(); ?>