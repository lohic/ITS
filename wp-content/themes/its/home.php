<?php get_header();?>

<div class="row mb3">
    <div id="centre" class="col">
        <section id="agenda" class="pl3">
        	<ul id="navigation_agenda">
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
				<li></li>
				<li class="suivant"></li>
        	</ul>
            <h2 class="smaller"><span></span>Agenda</h2>
			<?php
				$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>'51', 'orderby' => 'DESC', 'posts_per_page'=>-1));
                while( $my_query->have_posts() ) : $my_query->the_post();?>
                    <a href="<?php the_permalink(); ?>">
		                <article class="pt1 pb1 pl2 pr2">
		                    <h3 class="big"><?php the_title();?></h3>
		                    <h4 class="small"><?php the_field('date_article');?></h4>
		                    <div class="small" id="resume"><?php the_field('resume_article');?></div>
		                    <div class="small" id="complet"><?php the_content();?></div>
		                </article>
		            </a>
                <?php endwhile;
            ?>
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
                <article class="pl3 col">
                    <h3 class="very_biggest mb0 titre"><?php echo get_the_title($remontee_its->ID);?></h3>
                    <h4 class="normal mt0 mb1"><?php the_field('date_article', $remontee_its->ID); ?><span><?php the_field('auteur_article', $remontee_its->ID); ?></span></h4>
                    <div class="pb1 mb1">
                        <p class="small mb0"><?php echo $remontee_its->post_content;?></p>
                    </div>
                    <a href="<?php echo get_permalink($remontee_its->ID);?>" class="small suite"><span>lire la suite</span></a>
                </article>
            </div>
        </section>

        <section id="regards" class="pl3">
            <h2 class="smaller"><span></span>Regards d'aujourd'hui</h2>
            <div class="row">
                <article class="col">
					<?php 
                        $my_query = new WP_Query( array( 'post_type' => 'post', 'tag'=>'regards-d-aujourd-hui', 'orderby' => 'rand', 'posts_per_page'=>1));
                        while( $my_query->have_posts() ) : $my_query->the_post();?>
                            <h3 class="very_biggest mb0 titre"><?php the_title();?></h3>
                            <h4 class="normal mt0 mb1"><?php the_field('date_article');?><span><?php the_field('auteur_article');?></span></h4>
                            <div class="pb2 mb1 small">
		                        <?php the_content();?>
		                    </div>
		                    <a href="<?php the_permalink(); ?>" class="small suite"><span>lire la suite</span></a>
                        <?php endwhile;
                    ?>
                </article>
                <section id="meme_theme" class="pl3 col">
                    <h3 class="small mb0">Archives sur le même thème</h3>
                    <h4 class="very_smaller mb1">Laïcité, éducation</h4>
                    <ul id="liste_liens" class="small">
                        <li><a href="#">Lien vers une archive</a></li>
                        <li><a href="#">Lien vers une autre archive</a></li>
                        <li><a href="#">Lien vers une archive</a></li>
                        <li><a href="#">Lien vers une autre archive</a></li>
                        <li><a href="#">Lien vers une archive</a></li>
                    </ul>

                    <a href="#" class="recherche small mt3">Faire une recherche</a>
                </section>
            </div>
        </section>

        
    </div>
<?php get_footer(); ?>