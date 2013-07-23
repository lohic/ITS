<?php
/*
Template Name: Page newsletter
*/
?>
<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest sans"><?php the_title(); ?></h1>
		</div>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<article class="pt2 pb2 mt2 post_archive" id="post-<?php the_ID(); ?>">
				<div class="post_content small newsletter">
					<?php the_content(); ?>
				</div>
				<div class="clear"></div>
			</article>
			<ul class="liste_attachements mt2 small" id="newsletter">
			<?php
				$args = array(
					'post_type'      => 'newsletter',
					'posts_per_page' => -1,
				);

				$my_query = new WP_Query( $args );
	        	while( $my_query->have_posts() ) : $my_query->the_post();?>
					<li class="telechargement"><a href="<?php the_permalink(); ?>">Voir la lettre de l'ITS - <?php the_title(); ?></a></li>
				<?php endwhile;
			?>
			</ul>
		<?php endwhile; ?>
		<?php else : ?>
		<h2>Aucun résultat</h2>
		<p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php edit_post_link('Modifier cette page', '<p>', '</p>'); ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>