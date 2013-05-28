<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div id="entete">
				<h1 class="very_biggest sans"><?php the_title(); ?></h1>
			<?php
				$my_wp_query = new WP_Query();
				$all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));
				$monId = get_the_ID();
				$page_children = get_page_children( $monId, $all_wp_pages );
				if(!empty($page_children)){
			?>
					<section id="sous_categories" class="small mb2 pt1 pb1 mt2">
						<ul>
			<?php
						foreach ($page_children as $page_child){
			?>
							<li class="pl3"><a href="<?php echo get_permalink($page_child->ID);?>"><?php echo get_the_title($page_child->ID);?></a></li>
			<?php
						}
			?>
						</ul>
					</section>
			<?php						
				}
			?>
			</div>
		
			<article class="pt2 pb2 mb2 post_archive" id="post-<?php the_ID(); ?>">
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