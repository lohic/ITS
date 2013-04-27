<?php 
	$categorie = get_the_category();
	$resume = get_field("resume_article");
	$liste_tags = "";
	$tag_principal = "";
	$tags = get_the_tags();
	foreach ($tags as $tag){
		if(get_field('tag_principal','post_tag_'.$tag->term_id)=="Oui"){
			$tag_principal = '<a href="'.get_bloginfo('url').'?tag='.$tag->slug.'">'.$tag->name.'</a>';
		}
		else{
			$liste_tags .= '<a href="'.get_bloginfo('url').'?tag='.$tag->slug.'">'.$tag->name.'</a>, ';
		}
	}
	$liste_tags = substr($liste_tags, 0, -2);
	$categories = get_category_parents($categorie[0]->term_id,'true','');
	if(!$resume){
?>
		<article class="pt2 pb2 post_archive" id="post-<?php the_ID(); ?>">
			<h4 class="smaller mb1 tag"><span></span><?php echo $tag_principal; ?></h4>
			<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<p class="mb0 smaller categories_et_tags"><span class="categories"><?php echo $categories;?></span> <span class="tags"><?php echo $liste_tags; /*the_tags( '', ', ','' );*/?></span></p>
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
			<p class="mb0 smaller categories_et_tags"><span class="categories"><?php echo $categories;?></span> <span class="tags"><?php echo $liste_tags; ?></span></p>
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
