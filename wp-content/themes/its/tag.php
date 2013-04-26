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
		
		<?php get_template_part( 'boucle', '' );?>

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
