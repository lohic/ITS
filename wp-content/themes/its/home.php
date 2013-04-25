<?php get_header();?>

<div class="row mb3">
    <div id="centre" class="col">
        <section id="agenda" class="pl3">
            <h2 class="smaller"><span></span>Agenda</h2>
            <a href="#">
                <article class="pa1">
                    <h3 class="bigger">Assemblée générale IED</h3>
                    <h4 class="normal">lundi 4 février à 18h, au 40 rue de Malte</h4>
                    <p class="smaller">Assemblée générale de l'Institut Edouard Depreux</p>
                </article>
            </a>
            <a href="#">
                <article class="pa1">
                    <h3 class="bigger">Assemblée générale IED</h3>
                    <h4 class="normal">lundi 4 février à 18h, au 40 rue de Malte</h4>
                    <p class="smaller">Assemblée générale de l'Institut Edouard Depreux</p>
                </article>
            </a>
            <a href="#">
                <article class="pa1">
                    <h3 class="bigger">Assemblée générale IED</h3>
                    <h4 class="normal">lundi 4 février à 18h, au 40 rue de Malte</h4>
                    <p class="smaller">Assemblée générale de l'Institut Edouard Depreux</p>
                </article>
            </a>
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
                    <h4 class="normal mt0 mb1"><?php the_field('date_article', $remontee_its->ID); ?> <?php the_field('auteur_article', $remontee_its->ID); ?></h4>
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
                    <h3 class="very_biggest mb0 titre">Défendons la laïcité</h3>
                    <h4 class="normal mt0 mb1">Juin 1960 - Auteur</h4>
                    <div class="pb2 mb1">
                        <p class="small mb0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
                        eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <a href="#" class="small suite"><span>lire la suite</span></a>
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