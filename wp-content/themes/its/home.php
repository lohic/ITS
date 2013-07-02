<?php get_header();?>

<div class="row mb3">
    <div id="centre" class="col">
        <section id="agenda" class="pl3">
        	<ul id="navigation_curseur">
        		<li id="curseur"></li>
				<li class="precedent"></li>
				<?php
					//LOIC
					//$my_query = new WP_Query( array(	'p'=>$posts[0]->ID,
					//									'post_status'=>array('publish','future') ) );
					$my_query = new WP_Query( array('post_type' => 'post',
													'category_name'=>'agenda',
													'orderby' => 'DESC','posts_per_page'=>-1,
													'post_status'=>array('publish','future') ) );
					//$my_query = new WP_Query( array( 'post_type' => 'post', 'category_name'=>'agenda', 'orderby' => 'DESC', 'posts_per_page'=>-1));
					$index = 1;
					while( $my_query->have_posts() ) : $my_query->the_post();
				?>
						<li id="puce_<?php echo $index;?>" class="standard"></li>
				<?php
						$index++;
					endwhile;
					wp_reset_postdata();
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
	                wp_reset_postdata();
	            ?>
	        </div>
        </section>

        <section id="actualites" class="pl3">
        <?php
			$posts = get_field('remontee_its', 'option');
			if( $posts ):

				$post_id = rand(0, (count($posts) - 1) );

				$my_query = new WP_Query( 'p='.$posts[$post_id ]->ID );
				if($my_query->have_posts()){
					while( $my_query->have_posts() ) : $my_query->the_post(); // variable must be called $post (IMPORTANT)
			?>
			            <h2 class="smaller"><span></span>Focus</h2>
			            <div class="row">
			<?php
							if ( has_post_thumbnail() ) {
			?>
								<div class="col pr3">
				                	<figure class="tint">
										<?php the_post_thumbnail('remontee_its');?> 
									</figure>
				                </div>
			<?php
							}
							else{
			?>
								<div class="col pr3 sans">

				                </div>
			<?php					
							}
			?>
			                <article class="col">
			                    <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>
			                    <h4 class="normal mt0 mb1">
								<?php 		
									$date_article = get_field('date_article');
									$auteur_article = get_field('auteur_article');
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
			                    </h4>
			<?php
								if ( has_post_thumbnail() ) {
			?>
				                    <div class="pb1 mb1">
				                        <div class="small mb1">
											<?php the_excerpt_max_charlength(300);?>
										</div>
				                    </div>
			<?php
								}
								else{
			?>
									<div class="pb1 mb1">
				                        <div class="small mb1">
					                    <?php
											$resume = get_field('resume_article');
											if($resume==""){
												echo get_the_content_by_id(get_the_ID());
											}else{
												echo $resume.'...';
											}
										?>
										</div>
				                    </div>
			<?php						
								}
			?>
			                    <p class="small suite"><a href="<?php the_permalink();?>"><span>lire la suite</span></a></p>
			                </article>
			            </div>
	        <?php 
					endwhile;
				}
		        wp_reset_postdata();
			endif; 
		?>
        </section>
        
        <section id="regards" class="pl3">
            <h2 class="smaller"><span></span>Regards sur…</h2>
            <div class="row">
            <?php 
                //$my_query = new WP_Query( array( 'post_type' => 'post', 'tag'=>'regards-d-aujourd-hui', 'orderby' => 'rand', 'posts_per_page'=>1));
                //while( $my_query->have_posts() ) : $my_query->the_post();
            	$posts = get_field('categorie_insititut_tribune_socialiste', 'option');

				if( $posts ):

					$post_id = rand(0, (count($posts) - 1) );

					$my_query = new WP_Query( 'p='.$posts[$post_id]->ID );
					if($my_query->have_posts()){
						while( $my_query->have_posts() ) : $my_query->the_post(); // variable must be called $post (IMPORTANT)

            ?>
		            <article class="col">
                        <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>

                        <h4 class="normal mt0 mb1">
							<?php 		
								$date_article = get_field('date_article');
								$auteur_article = get_field('auteur_article');
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
                        </h4>
                        <div class="pb2 mb1 small">
	                        <?php the_content();?>
	                    </div>
	                    <a href="<?php the_permalink(); ?>" class="small suite"><span>lire la suite</span></a>
		            </article>
		            <section id="meme_theme" class="pl3 col">
		                <h3 class="small mb1">Archives en relation</h3>

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
								<p class="small">Aucune archive en relation.</p>
						<?php
							// Prevent weirdness
							wp_reset_postdata();

							endif;
						?>

		                <a href="?s=accueil_recherche" class="recherche small mt3">Faire une recherche</a>
		            </section>
                <?php //endwhile;

					endwhile;
				}
		        wp_reset_postdata();
			endif; 

            ?>
            </div>
        </section>
    </div>
<?php get_footer(); ?>