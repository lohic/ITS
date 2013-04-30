<?php get_header();?>

<div class="row mb3">
    <div id="centre" class="col">
        <section id="agenda" class="pl3">
        	<ul id="navigation_curseur">
        		<li id="curseur"></li>
				<li class="precedent"></li>
				<li></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li class="actif"></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li class="suivant"></li>
        	</ul>
            <h2 class="smaller"><span></span>Agenda</h2>
            <div class="conteneur">
				<?php
					$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>'51', 'orderby' => 'DESC', 'posts_per_page'=>-1));
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
            <h2 class="smaller"><span></span>Institut Tribune Socialiste</h2>
            <div class="row">
				<?php
					$remontee_its = get_field('remontee_its', 'option');
				?>
                <div class="col">
                	<?php echo get_the_post_thumbnail($remontee_its->ID,'remontee_its');?>
                </div>
                <a href="<?php echo get_permalink($remontee_its->ID);?>" class="pl3 col">
	                <article>
	                    <h3 class="very_biggest mb0 titre"><?php echo get_the_title($remontee_its->ID);?></h3>
	                    <h4 class="normal mt0 mb1"><?php the_field('date_article', $remontee_its->ID); ?><span><?php the_field('auteur_article', $remontee_its->ID); ?></span></h4>
	                    <div class="pb1 mb1">
	                        <p class="small mb1"><?php echo $remontee_its->post_content;?></p>
	                    </div>
	                    <p class="small suite"><span>lire la suite</span></p>
	                </article>
                </a>
            </div>
        </section>

        <section id="regards" class="pl3">
            <h2 class="smaller"><span></span>Regards d'aujourd'hui</h2>
            <div class="row">
            <?php 
                $my_query = new WP_Query( array( 'post_type' => 'post', 'tag'=>'regards-d-aujourd-hui', 'orderby' => 'rand', 'posts_per_page'=>1));
                while( $my_query->have_posts() ) : $my_query->the_post();?>
		            <article class="col">
                        <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>
                        <h4 class="normal mt0 mb1"><?php the_field('date_article');?><span><?php the_field('auteur_article');?></span></h4>
                        <div class="pb2 mb1 small">
	                        <?php the_content();?>
	                    </div>
	                    <a href="<?php the_permalink(); ?>" class="small suite"><span>lire la suite</span></a>
		            </article>
		            <section id="meme_theme" class="pl3 col">
		                <h3 class="small mb0">Archives sur le même thème</h3>
		                <?php 
		                	$categories = get_the_category();
		                	foreach ($categories as $categorie){
		                		$lesCategories.=$categorie->cat_name.', ';
		                	}
		                	$lesCategories = substr($lesCategories, 0, -2);
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
							// Prevent weirdness
							wp_reset_postdata();

							endif;
						?>

		                <a href="#" class="recherche small mt3">Faire une recherche</a>
		            </section>
                <?php endwhile;
            ?>
            </div>
        </section>

        
    </div>
<?php get_footer(); ?>