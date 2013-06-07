<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if($_GET['s']=="accueil_recherche"){
    	?>
    			<div id="breadcrumbs" class="smaller mb3" xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a id="breadh" property="v:title" rel="v:url" href="<?php bloginfo('url'); ?>" title="ITS">Accueil</a>
					</span>
					<span>» Recherche</span>
				</div>
		<?php
    		}
    		else{
    			if (function_exists('mybread')) mybread();
    		}
		?>
		<div id="entete">
			<?php
				global $query_string;
				$query_args = explode("&", $query_string);
				$search_query = array();
				foreach($query_args as $key => $string) {
					$query_split = explode("=", $string);
					if(!is_numeric($query_split[1])){
						$lachaine.=urldecode($query_split[1])." ";
					}
					$search_query[$query_split[0]] = urldecode($query_split[1]);
				}
				$search_query['posts_per_page'] = 20;
				$search = new WP_Query($search_query);
			?>
			<!--<h4 class="resultats smaller mb1">Résultat(s) de recherche pour :</h4> 
			<h1 class="very_biggest mb2"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php echo $lachaine;?></a></h1>
			-->
			<?php if ( have_posts() ) : 	
				global $wp_query;
				$total_results = $wp_query->found_posts;
			?>
			<p class="nombre_resultat smaller"><?php echo $total_results;?> résultat(s) pour <a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php echo $lachaine;?></a></p>
			<?php else : ?>
				<?php if($_GET['s']=="accueil_recherche"){
			?>
					<p class="nombre_resultat smaller">Rechercher</p>
			<?php
				}
				else{
			?>
					<p class="nombre_resultat smaller">Aucun article trouvé. Essayer une autre recherche ?</p>
			<?php
				}
				endif; ?>
			
			<section class="pagination smaller mb2">
				<?php previous_posts_link('« Previous') ?>
				<?php next_posts_link('Next »','') ?>
			</section>
		</div>
		
		<?php if(have_posts()) : ?>
		<?php while( $search->have_posts() ) : $search->the_post();?>
			<?php 
			$categorie = get_the_category();
			$resume = get_field("resume_article");
			$liste_tags = "";
			$categories="";
			$organisations = "";
			
			$tags = get_the_tags();
			if($tags){
				foreach ($tags as $tag){
					$liste_tags .= '<a href="'.get_bloginfo('url').'?tag='.$tag->slug.'">'.$tag->name.'</a>, ';
				}
				$liste_tags = substr($liste_tags, 0, -2);
			}
			
			if($categorie[0]->term_id){
				$categories = get_category_parents($categorie[0]->term_id,false,';');
				$tableau_categories = explode(';',$categories);
				$categories="";
				foreach($tableau_categories as $lacate){
					if($lacate!="Non classé" && $lacate!="Catégories mères" && $lacate!=""){
						$category_id = get_cat_ID($lacate);
    					$category_link = get_category_link( $category_id );
						$categories.='<a href="'.$category_link.'">'.$lacate.'</a>';
					}
				}
			}

			$organisations = get_the_term_list( $post->ID, 'organisation', '', ', ', '' );

			/*if($organisations==""){
				$organisations="Institut Tribune Socialiste";
			}*/
		?>
			<article class="pt2 pb2 post_archive search" id="post-<?php the_ID(); ?>">
			<?php
				if($organisations!=""){
			?>
					<h4 class="smaller mb1 tag"><span></span><?php echo $organisations; ?></h4>
			<?php
				}
			?>
				<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php
				if($categories!="" || $liste_tags!=""){
			?>
					<p class="mb0 smaller categories_et_tags">
					<?php 
						if($categories!=""){ 
							echo '<span class="categories">'.$categories.'</span>';
							if($liste_tags!=""){
								echo '&nbsp•&nbsp<span class="tags">'.$liste_tags.'</span>';
							}
						}
						else{
							if($liste_tags!=""){
								echo '<span class="tags">'.$liste_tags.'</span>';
							}
						}
					?>
					</p>
			<?php
				}
			?>

			<?php
				$date_article = get_field('date_article');
				$auteur_article = get_field('auteur_article');
				if($date_article || $auteur_article){
			?>
					<h3 class="little_small mb1 mt1 date">
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
				<div class="post_content small resume">
					<?php 
						//the_excerpt();
						echo '<a href="'.get_permalink().'" class="suite"><span>lire la suite</span></a>';
					?>
				</div>
			</article>
		<?php endwhile;
		wp_reset_postdata();
		?>
		<section class="pagination smaller mb2">
			<?php previous_posts_link('« Previous') ?>
			<?php next_posts_link('Next »','') ?>
		</section>
		<?php else : ?>
				
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>