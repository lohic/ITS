<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<?php 
			/*if(is_tag()){
				get_template_part( 'entete', 'tag' );
			}
			else{
				get_template_part( 'entete', 'categorie' );
			}*/
		?>
		
		<?php get_template_part( 'boucle', '' );?>


		<section class="pagination smaller mt1">
			<a href="#" class="precedent">Prev</a>
			<a href="#" class="actif">1</a>
			<a href="#" class="">2</a>
			<a href="#" class="">3</a>
			<a href="#" class="">...</a>
			<a href="#" class="">18</a>
			<a href="#" class="">19</a>
			<a href="#" class="">20</a>
			<a href="#" class="suivant">Next</a>
		</section>
	</div>

<?php get_footer(); ?>