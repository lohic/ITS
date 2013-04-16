<!-- FOOTER -->

<?php get_sidebar(); ?>
</div>
        <footer class="row pt2 pb2">
        	<?php wp_nav_menu( array('menu'=>'Première colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_1', 'menu_class' => 'pl3 little_small col'));?>
        	<?php wp_nav_menu( array('menu'=>'Deuxième colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_2', 'menu_class' => 'little_small col'));?>
        	<div>
	        	<a href="#" id="facebook" title="facebook"><img src="<?php bloginfo( 'template_url' ); ?>/img/icn_facebook.png" alt="facebook"/></a>
	        	<a href="#" id="twitter" title="twitter"><img src="<?php bloginfo( 'template_url' ); ?>/img/icn_twitter.png" alt="twitter"/></a>
	        	<?php wp_nav_menu( array('menu'=>'Troisième colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_3', 'menu_class' => 'little_small col'));?>
	        </div>    
	        <section id="nuage" class="pr3 smallest col">
                <a href="#">Afrique</a> <a href="#">Agriculture</a> <a href="#">Algérie</a> <a href="#">Amérique latine</a> <a href="#">Associations</a> <a href="#">Autogestion</a> 
                <a href="#">Chine</a> <a href="#">Classes sociales</a> <a href="#">Consommation</a> <a href="#">Constitution</a> <a href="#">Cuba</a> <a href="#">Culture</a> 
                <a href="#">Démocratie locale</a> <a href="#">Décentralisation</a> <a href="#">Ecologie</a> <a href="#">Economie</a> <a href="#">Enseignement</a> 
                <a href="#">Europe</a> <a href="#">Femmes</a> <a href="#">Finances</a> <a href="#">Immigration</a> <a href="#">International</a> <a href="#">Israël</a> 
                <a href="#">Jeunes</a> <a href="#">Loisirs</a> <a href="#">Mixité</a> <a href="#">Mouvements</a> <a href="#">Moyen-­Orient</a> <a href="#">Nucléaire</a> 
                <a href="#">Parti</a> <a href="#">Palestine</a> <a href="#">Recherche</a> <a href="#">Régions</a> <a href="#">Retraites</a> <a href="#">Santé</a> 
                <a href="#">Socialisme</a> <a href="#">Syndicats</a> <a href="#">Temps de travail</a> <a href="#">Ville-­Urbanisme</a> <a href="#">UNEF 60/71</a> <a href="#">URSS</a> 
                <a href="#">Université</a> <a href="#">Vietnam</a> <a href="#">Yougoslavie</a>
            </section>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>