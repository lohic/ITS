<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest mb4"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php single_cat_title();?></a></h1>
			<section class="pagination smaller mb2">
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
