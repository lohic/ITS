<!-- FOOTER -->

</div>
        <footer class="row pt2 pb2">
        	<?php wp_nav_menu( array('menu'=>'Première colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_1', 'menu_class' => 'pl3 little_small col'));?>
        	<?php wp_nav_menu( array('menu'=>'Deuxième colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_2', 'menu_class' => 'little_small col'));?>
        	<div>
	        	<a href="<?php the_field('url_facebook', 'option'); ?>" id="facebook" title="facebook" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/icn_facebook.png" alt="facebook"/></a>
	        	<a href="<?php the_field('url_twitter', 'option'); ?>" id="twitter" title="twitter" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/icn_twitter.png" alt="twitter"/></a>
	        	<?php wp_nav_menu( array('menu'=>'Troisième colonne footer', 'container' => 'false', 'menu_id' => 'menu_footer_3', 'menu_class' => 'little_small col'));?>
	        </div>    
	        <section id="nuage" class="pr3 smallest col">
                <?php 
                	/*$idObj = get_category_by_slug('categories-meres'); 
    				$categories = get_categories( array('parent'=>$idObj->term_id) ); 
    				if($categories){
			    		foreach ($categories as $categorie){
		    	?>
							<a href="<?php echo get_category_link($categorie->term_id);?>"><?php echo $categorie->name;?></a>&nbsp;
		    	<?php
		    			}
		    		}*/
		    	?>
            </section>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>