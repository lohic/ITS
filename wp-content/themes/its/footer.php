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
                <?php 
		    		$categories = get_categories( array('parent'=>'0', 'hide_empty'=>'0') ); 
		    		foreach ($categories as $categorie){
		    	?>
						<a href="<?php echo get_category_link($categorie->term_id);?>"><?php echo $categorie->name;?></a>&nbsp;
		    	<?php
		    		}
		    	?>
            </section>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>