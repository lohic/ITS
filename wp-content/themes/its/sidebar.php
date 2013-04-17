<aside class="pl2 pr3 col">
	<?php wp_nav_menu( array('menu'=>'Menu Sidebar', 'container' => 'false', 'menu_id' => 'menu_sidebar', 'menu_class' => 'small mb2'));?>

    <section id="nuage_sidebar" class="small mb3">
        <a href="#">Agriculture</a> <a href="#">Associations</a> <a href="#">Autogestion</a> <a href="#">Classes sociales</a> <a href="#">Consommation</a> 
        <a href="#">Constitution</a> <a href="#">Culture</a> <a href="#">Démocratie locale</a> <a href="#">Décentralisation</a> <a href="#">Ecologie</a> 
        <a href="#">Economie</a> <a href="#">Enseignement</a> <a href="#">Europe</a> <a href="#">Femmes</a> <a href="#">Finances</a> 
        <a href="#">Immigration</a> <a href="#">International</a> <a href="#">Jeunes</a> <a href="#">Loisirs</a> <a href="#">Mixité</a> 
        <a href="#">Mouvements</a> <a href="#">Nucléaire</a> <a href="#">Parti</a> <a href="#">Recherche</a> <a href="#">Régions</a> 
        <a href="#">Retraites</a> <a href="#">Santé</a> <a href="#">Socialisme</a> <a href="#">Syndicats</a> <a href="#">Temps de travail</a> 
        <a href="#">Ville-­Urbanisme</a> <a href="#">Université</a>
    </section>

    <section id="soutien" class="mb3">
        <h3 class="small mb1"><a href="#"><span>Soutenez l'ITS!</span></a></h3>
        <p class="smaller">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </section>

    <section id="slider" class="mb3">
        <h3 class="small"><a href="#"><span>Accédez</span><br/><span>au fond d'images</span></a></h3>
        <p class="very_smaller">Laïcité, éducation</p>
        <img src="<?php bloginfo( 'template_url' ); ?>/img/petit_visuel.png" alt="image"/>
    </section>
</aside>

<!--<div class="sidebar">
<ul>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?> 
	<?php endif; ?>
</ul>
</div>-->