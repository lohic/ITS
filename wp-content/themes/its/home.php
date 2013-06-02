<?php get_header();?>

<div class="row mb3">
    <div id="centre" class="col">
        <section id="agenda" class="pl3">
        	<ul id="navigation_curseur">
        		<li id="curseur"></li>
				<li class="precedent"></li>
				<?php
					$my_query = new WP_Query( array( 'post_type' => 'post', 'category_name'=>'agenda', 'orderby' => 'DESC', 'posts_per_page'=>-1));
					$index = 1;
					while( $my_query->have_posts() ) : $my_query->the_post();
				?>
						<li id="puce_<?php echo $index;?>" class="standard"></li>
				<?php
						$index++;
					endwhile;
				?>
				<li class="suivant"></li>
        	</ul>
            <h2 class="smaller"><span></span>Agenda</h2>
            <div class="conteneur">
				<?php
	                while( $my_query->have_posts() ) : $my_query->the_post();?>
	                    <a href="<?php the_permalink(); ?>">
			                <article class="pt1 pb1 pl2 pr2">
			                    <h3 class="big"><?php the_title();?></h3>
			                    <h4 class="small"><?php the_field('date_article');?></h4>
			                    <div class="small" id="resume">
			                    	<?php 
			                    		$resume = strip_tags(get_field('resume_article'),'<p><ul><li><ol><div><span><h1><h2><h3><h4><h5><h6>');
        								echo $resume;
        							?>
    							</div>
			                    <div class="small" id="complet">
									<?php 
			                    		$texte = strip_tags(get_the_content());
        								echo '<p>'.$texte.'</p>';
        							?>
			                    </div>
			                </article>
			            </a>
	                <?php endwhile;
	            ?>
	        </div>
        </section>

        <section id="actualites" class="pl3">
        <?php
			$posts = get_field('remontee_its', 'option');
			
			if( $posts ):
			
			foreach( $posts as $post): // variable must be called $post (IMPORTANT)
		?>

            <h2 class="smaller"><span></span>Institut Tribune Socialiste</h2>
            <div class="row">
				
				<a href="<?php echo the_permalink();?>" class="row">
	                <div class="col">
	                	<figure class="tint">
							<?php the_post_thumbnail('remontee_its');?> 
						</figure>
	                </div>
                
	                <article class="col pl3">
	                    <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>
	                    <h4 class="normal mt0 mb1">
						<?php 		
							if(get_field('date_article')){
								echo get_field('date_article').'&nbsp•&nbsp';
							}
							if(get_field('auteur_article')){
								echo '<span>'.get_field('auteur_article').'</span>';
							}
						?>
	                    </h4>
	                    <div class="pb1 mb1">
	                        <div class="small mb1">
		                    <?php
								$resume = get_field('resume_article');
								if(!$resume){
									the_content();
								}else{
									echo $resume;
								}
							?>
							</div>
	                    </div>
	                    <p class="small suite"><span>lire la suite</span></p>
	                </article>
                </a>
            </div>
        <?php 
		
		endforeach;
		wp_reset_postdata();
		endif; ?>
        </section>
        
        

        <section id="regards" class="pl3">
            <h2 class="smaller"><span></span>Regards d'aujourd'hui</h2>
            <div class="row">
            <?php 
                $my_query = new WP_Query( array( 'post_type' => 'post', 'tag'=>'regards-d-aujourd-hui', 'orderby' => 'rand', 'posts_per_page'=>1));
                while( $my_query->have_posts() ) : $my_query->the_post();?>
		            <article class="col">
                        <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>

                        <h4 class="normal mt0 mb1">
							<?php 		
								if(get_field('date_article')){
									echo get_field('date_article').'&nbsp•&nbsp';
								}
								if(get_field('auteur_article')){
									echo '<span>'.get_field('auteur_article').'</span>';
								}
							?>
                        </h4>
                        <div class="pb2 mb1 small">
	                        <?php the_content();?>
	                    </div>
	                    <a href="<?php the_permalink(); ?>" class="small suite"><span>lire la suite</span></a>
		            </article>
		            <section id="meme_theme" class="pl3 col">
		                <h3 class="small mb0">Archives en relation</h3>
		                <?php 
		                	$categories = get_the_category();
		                	if($categories){
		                		foreach ($categories as $categorie){
			                		$lesCategories.=$categorie->cat_name.', ';
			                	}
			                	$lesCategories = substr($lesCategories, 0, -2);
		                	}
		                ?>
		                <h4 class="very_smaller mb1"><?php echo $lesCategories;?></h4>

						<?php
							$connected = p2p_type( 'posts_to_posts' )->get_connected(get_the_ID());
							// Display connected pages
							if ( $connected->have_posts() ) :
						?>
								<ul id="liste_liens" class="small">
								<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
								</ul>
						<?php
							else:
						?>
								<p class="small">Aucune archive en relation</p>
						<?php
							// Prevent weirdness
							wp_reset_postdata();

							endif;
						?>

		                <a href="#recherche" class="recherche small mt3">Faire une recherche</a>
		            </section>
                <?php endwhile;
            ?>
            </div>
        </section>

        
    </div>
<?php get_footer(); ?>