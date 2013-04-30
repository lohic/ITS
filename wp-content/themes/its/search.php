<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<?php
				global $query_string;
				$query_args = explode("&", $query_string);
				$search_query = array();
				foreach($query_args as $key => $string) {
					$query_split = explode("=", $string);
					$lachaine.=$query_split[1]." ";
				}
			?>
			<h4 class="resultats smaller mb1">Résultat(s) de recherche pour :</h4> 
			<h1 class="very_biggest mb2"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php echo $lachaine;?></a></h1>
			<?php if ( have_posts() ) : 	
				global $wp_query;
				$total_results = $wp_query->found_posts;
			?>
			<?php endif; ?>
			<p class="nombre_resultat smaller"><?php echo $total_results;?> résultat(s)</p>
			<section class="pagination smaller mb2">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>get_query_var('cat'), 'paged' => $paged));

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
		
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php 
			$categorie = get_the_category();
			$resume = get_field("resume_article");
			$liste_tags = "";
			$categories="";
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
			if($tag_principal==""){
				$tag_principal="Institut Tribune Socialiste";
			}
		?>
			<article class="pt2 pb2 post_archive resume" id="post-<?php the_ID(); ?>">
				<h4 class="smaller mb1 tag"><span></span><?php echo $tag_principal; ?></h4>
				<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php
				if($categories!="" || $liste_tags!=""){
			?>
					<p class="mb0 smaller categories_et_tags">
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

			<?php
				if(get_field('date_article') || get_field('auteur_article')){
			?>
					<h3 class="little_small mb1 mt1 date">
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
				<div class="post_content small resume">
					<?php 
						the_excerpt();
						echo ' ... <a href="'.get_permalink().'" class="suite"><span>lire la suite</span></a>';
					?>
				</div>
			</article>
		<?php endwhile; ?>
		<?php else : ?>
				<h2 class="center">Aucun article trouvé. Essayer une autre recherche ?</h2>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<?php endif; ?>

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