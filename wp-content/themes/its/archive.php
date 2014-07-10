<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$idObj = get_category_by_slug('agenda'); 
    		$idObj = '-'.$idObj->term_id;

			$my_query = new WP_Query( array( 'post_type' => 'post', 'cat'=>$idObj, 'posts_per_page' => 1, 'paged' => $paged));

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
					'prev_text'    => '« Précédent',
					'next_text'    => 'Suivant »',
				) );
			?>
		</section>
	</div>

<?php get_footer(); ?>