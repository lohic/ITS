<!-- boucle.php -->
<?php 
	$categorie = get_the_category();
	$resume = get_field("resume_article");
	$liste_tags = "";
	$categories="";
	$organisations = "";
	$tags = get_the_tags();
	if($tags){
		foreach ($tags as $tag){
			//echo 'OK OK '.$tag->term_id;
			$liste_tags .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>, ';
			//$liste_tags .= '<a href="'.get_bloginfo('url').'?tag='.$tag->slug.'">'.$tag->name.'</a>, ';
		}
	}
	$liste_tags = substr($liste_tags, 0, -2);
	$categories = get_category_parents($categorie[0]->term_id,'true','');
	$organisations = get_the_term_list( $post->ID, 'organisation', '', ', ', '' );
	/*if($organisations==""){
		$organisations="Institut Tribune Socialiste";
	}*/
	$date_article = get_field('date_article');
	$auteur_article = get_field('auteur_article');
	if(!$resume){
?>
		<article class="pt2 pb2 post_archive" id="post-<?php the_ID(); ?>">
		<?php
			if($organisations!=""){
		?>
				<h4 class="smaller mb1 tag"><span></span><?php echo $organisations; ?></h4>
		<?php
			}
		?>
			<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php
			//if($categories!="" || $liste_tags!=""){
			if($liste_tags!=""){
		?>
				<p class="mb0 smaller categories_et_tags">
				<?php 
					/*if($categorie!=""){ 
						echo '<span class="categories">'.$categories.'</span>&nbsp';
					}
					if($liste_tags!=""){*/
					echo '<span class="titre_mot_cle">Mots-clés : </span><span class="tags">'.$liste_tags.'</span>';
					//}
				?>
				</p>
		<?php
			}
		?>

		<?php
			
			if($date_article || $auteur_article){
		?>
				<h3 class="little_small mt1 date">
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
			
			<div class="post_content small mt1">
				<?php the_content(); ?>
			</div>
			<div class="clear"></div>
			<?php create_attachement_list(get_the_ID());?>
		</article>
<?php
	}
	else{
?>
		<article class="pt2 pb2 post_archive resume" id="post-<?php the_ID(); ?>">
		<?php
			if($organisations!=""){
		?>
				<h4 class="smaller mb1 tag"><span></span><?php echo $organisations; ?></h4>
		<?php
			}
		?>
			<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php
			//if($categories!="" || $liste_tags!=""){
			if($liste_tags!=""){
		?>
				<p class="mb0 smaller categories_et_tags">
				<?php 
					/*if($categorie!=""){ 
						echo '<span class="categories">'.$categories.'</span>&nbsp';
					}
					if($liste_tags!=""){*/
						echo '<span class="tags">'.$liste_tags.'</span>';
					//}
				?>
				</p>
		<?php
			}
		?>

		<?php
			if($date_article || $auteur_article){
		?>
				<h3 class="little_small mt1 date">
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
			<div class="post_content small resume mt1">
				<?php 
					the_field('resume_article');
					echo ' ... <a href="'.get_permalink().'" class="suite"><span>lire la suite</span></a>';
				?>
			</div>
		</article>
<?php	
	}
?>
<!-- fin boucle.php -->
