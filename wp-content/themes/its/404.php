<?php get_header(); ?>

<!-- 404.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3 p404">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest sans mb3">Erreur : la page n'existe pas</h1>
		</div>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<article class="pt2 pb2 post_archive" id="post-<?php the_ID(); ?>">
				<div class="post_content small">
					<?php the_content(); ?>
				</div>
			</article>

		<?php endwhile; ?>
		<?php else : ?>
		<p class="normal mb3">Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici. Vous pouvez faire une recherche ci-dessous pour trouver ce que vous cherchez.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php edit_post_link('Modifier cette page', '<p>', '</p>'); ?>
		<?php endif; ?>
	</div>

<!-- fin 404.php -->

<?php get_footer(); ?>