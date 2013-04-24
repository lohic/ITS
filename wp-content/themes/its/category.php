<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest"><a href="<?php echo get_category_link(get_cat_ID(single_cat_title('',false)));?>"><?php single_cat_title();?></a></h1>
			<section id="frise" class="normal mt2 mb1 pl3 row">
				<ul class="row">
					<li><a href="#">1963</a></li>
					<li><a href="#">1964</a></li>
					<li><a href="#">1965</a></li>
					<li><a href="#">1966</a></li>
					<li><a href="#">1967</a></li>
					<li><a href="#">1968</a></li>
					<li><a href="#">1969</a></li>
				</ul>
				<a href="#">Regards d'aujourd'hui</a>
			</section>
			<section id="sous_categories" class="small mb2 pt1 pb1">
				<ul>
				<?php
					$categories = get_categories( array('parent'=>get_query_var('cat'), 'hide_empty'=>'0')); 
					if(empty($categories)){
						$les_categories = get_ancestors( get_query_var('cat'), 'category' );
						$categories = get_categories( array('parent'=>$les_categories[0], 'hide_empty'=>'0'));
					}
					foreach ($categories as $categorie){
				?>
						<li class="pl3"><a href="<?php echo get_category_link($categorie->term_id);?>"><?php echo $categorie->name;?></a></li>
				<?php
					}
				?>
				</ul>
			</section>
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