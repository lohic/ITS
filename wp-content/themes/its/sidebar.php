<aside class="pl2 pr3 col">
	<?php wp_nav_menu( array('menu'=>'Menu Sidebar', 'container' => 'false', 'menu_id' => 'menu_sidebar', 'menu_class' => 'small mb2'));?>

    <section id="nuage_sidebar" class="small mb3">
    	<?php 
    		$categories = get_categories( array('parent'=>'50', 'hide_empty'=>'0') ); 
            $categories_meres = get_ancestors( get_query_var('cat'), 'category' );
            $catMere = get_category($categories_meres[0]);
    		foreach ($categories as $categorie){
    	?>
				<a href="<?php echo get_category_link($categorie->term_id);?>" <?php if($catMere->slug==$categorie->slug){echo ' class="actif"';}?>><?php echo $categorie->name;?></a>&nbsp;
    	<?php
    		}
    	?>
    </section>

    <ul>
        <?php dynamic_sidebar( 'Sidebar' ); ?>
        <?php /*if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?> 
        <?php endif; */?>
    </ul>

    <!--<section id="soutien" class="mb3">
        <h3 class="small mb1"><a href="#"><span>Soutenez l'ITS!</span></a></h3>
        <p class="smaller">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </section>

    <section id="slider" class="mb3">
        <h3 class="small"><a href="#"><span>Accédez</span><br/><span>au fond d'images</span></a></h3>
        <p class="very_smaller">Laïcité, éducation</p>
        <img src="<?php bloginfo( 'template_url' ); ?>/img/petit_visuel.png" alt="image"/>
    </section>-->
</aside>