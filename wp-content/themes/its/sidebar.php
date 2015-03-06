<aside class="pl2 pr3 col">
	<?php wp_nav_menu( array('menu'=>'Menu Sidebar', 'container' => 'false', 'menu_id' => 'menu_sidebar', 'menu_class' => 'small mb2'));?>

    <section id="nuage_sidebar" class="small mb3">
    	<?php 
            $idObj = get_category_by_slug('categories-meres'); 
    		$categories = get_categories( array('parent'=>$idObj->term_id) ); 
            $categories_meres = get_ancestors( get_query_var('cat'), 'category' );
            $catMere = get_category($categories_meres[0]);
            $catEnCours = get_category(get_query_var('cat'));
            if($categories){
                foreach ($categories as $categorie){
    	?>
				    <a href="<?php echo get_category_link($categorie->term_id);?>" <?php if($catMere->slug==$categorie->slug || $categorie->slug==$catEnCours->slug ){echo ' class="actif"';}?>><?php echo $categorie->name;?></a>&nbsp;
    	<?php
                }
            }
    	?>
    </section>


    <!--<section class="mb3 sidebar">
        <h3 class="small"><span>La lettre de l'ITS</span></h3>
        <a class="suite small"><span>Consultez les archives</span></a>
        <p class="small">Abonnez vous en entrant votre email ci-dessous : </p>
        <form id="searchform" action="http://localhost:8888/ITS/" method="get">
            <div>
                <input id="email" type="text" onfocus="javascript:this.value=''" name="email" value="Votre email">
                <input id="searchsubmit" type="submit" value="OK">
            </div>
        </form>
    </section>

    <section class="mb3 sidebar">
        <h3 class="small"><span>Le livre</span></h3>
        <img src="<?php bloginfo( 'template_url' ); ?>/img/livre.png" alt="livre" class=""/>
        <p class="small">Cet ouvrage n’est pas seulement une réaction à l’occultation fréquente par 
            les médias du rôle du PSU et des ESU du rôle dans les luttes politiques des années 60...</p>
        <a class="suite small"><span>Lire la suite</span></a>
    </section>

    <section class="mb3 sidebar">
        <h3 class="mb1 small"><span>Soutenez l'ITS!</span></h3>
        <p class="small">Pour soutenir notre action, vous pouvez faire un don à l’ITS :</p>
        <a class="suite small"><span>Telecharger le bon de soutien</span></a>
    </section>

    <section class="mb3 sidebar">
        <h3 class="small"><span>Contribuez au fonds</span></h3>
        <p class="small">Vous avez des documents originaux (tracts, discours, analyses…), vous souhaitez participer 
            à l’enrichissement de ce site et faire part au plus grand nombre de l’engagement des 
            étudiants  de 1960 à 1971.</p>
        <a class="suite small"><span>Faites-nous parvenir vos documents</span></a>
    </section>

    <section class="mb3 sidebar">
        <ul class="slider">
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li class="actif"><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
        </ul>
        <img src="<?php bloginfo( 'template_url' ); ?>/img/petit_visuel.png" alt="image"/>
        <p class="smaller">Légende pour l'image</p>
        <a class="suite small"><span>Consulez le fonds d'affiches</span></a>
    </section>-->

    
    <?php dynamic_sidebar( 'Sidebar' ); ?>
    <?php /*if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?> 
    <?php endif; */?>
    
    
</aside>