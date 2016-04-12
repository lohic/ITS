<?php get_header(); ?>

<!-- index.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="very_biggest"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</div>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<article class="pt2 pb2 post_archive" id="post-<?php the_ID(); ?>">
				<div class="post_content small">
					<?php the_content(); ?>
				</div>
			</article>

		<?php endwhile; ?>
		<?php else : ?>
		<h2>Aucun résultat</h2>
		<p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php edit_post_link('Modifier cette page', '<p>', '</p>'); ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>

<!-- fin index.php -->
