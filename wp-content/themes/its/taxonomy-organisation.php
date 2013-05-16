<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest mb4"><?php single_cat_title();?></h1>
		<?php 
			$idObj = get_term_by('slug',get_query_var('organisation'),'organisation'); 
  			$value = get_field('texte_organisation','organisation_'.$idObj->term_id);
			if($value){
		?>
				<div class="normal pb2 mb2" id="texte_tag"><?php the_field('texte_organisation','organisation_'.$idObj->term_id);?></div>
				<?php 
                    $articles = get_field('articles_relatifs','organisation_'.$idObj->term_id);
                    if($articles!=false){
                ?>
                		<div class="normal pb3" id="relatif_tag">
                			<ul class="liste_attachements">
               	<?php
                        		foreach($articles as $article){
                ?>
                                    <li class="telechargement"><a href="<?php echo get_permalink($article->ID); ?>"><?php echo get_the_title($article->ID);?></a></li>
                <?php
                        		} 
                ?>
                			</ul>
						</div>
                <?php
                    }
                ?>
		<?php 
			}
		?>
		<?php
			if(get_query_var('organisation')=="psu-60-90" || get_query_var('organisation')=="esu-60-71" || get_query_var('organisation')=="unef-60-71"){
				if(get_query_var('organisation')=="psu-60-90"){
		?>
					<ul id="navigation_curseur" class="large mb1">
		        		<li id="curseur_large"></li>
						<li class="precedent_tag"></li>
		<?php
						for($i=1960;$i<=1990;$i++){
		?>
							<li id="puce-tag_<?php echo $i;?>" class="puce-tag"></li>
		<?php					
						}
		?>
						<li class="suivant_tag"></li>
		        	</ul>
		<?php			
				}
		?>
				<section id="frise" class="normal mt2 mb1 large">
					<ul class="row pl3">
						<li class="col" id="annee_1960"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1960'; ?>">1960</a></li>
						<li class="col" id="annee_1961"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1961'; ?>">1961</a></li>
						<li class="col" id="annee_1962"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1962'; ?>">1962</a></li>
						<li class="col" id="annee_1963"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1963'; ?>">1963</a></li>
						<li class="col" id="annee_1964"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1964'; ?>">1964</a></li>
						<li class="col" id="annee_1965"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1965'; ?>">1965</a></li>
						<li class="col" id="annee_1966"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1966'; ?>">1966</a></li>
						<li class="col" id="annee_1967"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1967'; ?>">1967</a></li>
						<li class="col" id="annee_1968"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1968'; ?>">1968</a></li>
						<li class="col" id="annee_1969"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1969'; ?>">1969</a></li>
						<li class="col" id="annee_1970"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1970'; ?>">1970</a></li>
						<li class="col" id="annee_1971"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1971'; ?>">1971</a></li>
		<?php
						if(get_query_var('organisation')=="psu-60-90"){
		?>
							<li class="col" id="annee_1972"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1972'; ?>">1972</a></li>
							<li class="col" id="annee_1973"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1973'; ?>">1973</a></li>
							<li class="col" id="annee_1974"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1974'; ?>">1974</a></li>
							<li class="col" id="annee_1975"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1975'; ?>">1975</a></li>
							<li class="col" id="annee_1976"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1976'; ?>">1976</a></li>
							<li class="col" id="annee_1977"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1977'; ?>">1977</a></li>
							<li class="col" id="annee_1978"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1978'; ?>">1978</a></li>
							<li class="col" id="annee_1979"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1979'; ?>">1979</a></li>
							<li class="col" id="annee_1980"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1980'; ?>">1980</a></li>
							<li class="col" id="annee_1981"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1981'; ?>">1981</a></li>
							<li class="col" id="annee_1982"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1982'; ?>">1982</a></li>
							<li class="col" id="annee_1983"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1983'; ?>">1983</a></li>
							<li class="col" id="annee_1984"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1984'; ?>">1984</a></li>
							<li class="col" id="annee_1985"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1985'; ?>">1985</a></li>
							<li class="col" id="annee_1986"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1986'; ?>">1986</a></li>
							<li class="col" id="annee_1987"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1987'; ?>">1987</a></li>
							<li class="col" id="annee_1988"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1988'; ?>">1988</a></li>
							<li class="col" id="annee_1989"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1989'; ?>">1989</a></li>
							<li class="col" id="annee_1990"><a href="<?php bloginfo('url'); echo '/?organisation='.get_query_var('organisation').'&amp;annee=1990'; ?>">1990</a></li>
		<?php
						}
		?>
					</ul>
				</section>
		<?php
			}
		?>
			<section id="sous_categories" class="small mb2 pt1 pb1">
				<ul>
		<?php
				$categories = get_field('categories_liees','organisation_'.$idObj->term_id);
				if($categories){
					foreach ($categories as $categorie){
		?>
					<li class="pl3"><a href="<?php echo get_category_link($categorie->term_id);?>" <?php if($categorie->term_id==get_query_var('cat')){echo ' class="actif"';}?>><?php echo $categorie->name;?></a></li>
		<?php
					}
				}
		?>
				</ul>
			</section>
			<section class="pagination smaller mb2">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$idObj = get_category_by_slug('agenda'); 
					
					if(isset($_GET['annee'])){
						$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>$_GET['annee'], 'organisation'=>get_query_var('organisation'), 'category__not_in'=>$idObj->term_id, 'paged' => $paged));
					}
					else{
						$my_query = new WP_Query( array( 'post_type' => 'post', 'year'=>'1960', 'organisation'=>get_query_var('organisation'), 'category__not_in'=>$idObj->term_id, 'paged' => $paged));
					}

					$big = 99999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $my_query->max_num_pages,
						'prev_text'    => '« Previous',
						'next_text'    => 'Next »',
					) );
				?>
			</section>
		</div>
		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$big = 99999999; // need an unlikely integer
		?>
		
		<?php
        	while( $my_query->have_posts() ) : $my_query->the_post();?>
				<?php get_template_part( 'boucle', '' );?>
			<?php endwhile;
        ?>


		<section class="pagination smaller mb2 mt1">
			<?php
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $my_query->max_num_pages,
					'prev_text'    => '« Previous',
					'next_text'    => 'Next »',
				) );
			?>
		</section>
	</div>

<?php get_footer(); ?>