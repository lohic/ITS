<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div id="entete">
				<h1 class="super_biggest sans mb4"><?php the_title(); ?></h1>
			<?php
				$id_page = get_the_ID();
				$page_children = new WP_Query( array( 'post_type' => 'page', 'posts_per_page'=>-1, 'post_parent'=>get_the_ID(), 'orderby'=>'menu_order', 'order'=>'ASC'));

				if ( $page_children->have_posts() ) {
			?>
					<section id="sous_categories" class="small mb2 pt1 pb1">
						<ul>
			<?php
						while( $page_children->have_posts() ) : $page_children->the_post();
			?>
							<li class="pl3"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
			<?php
						endwhile;
						wp_reset_postdata();
			?>
						</ul>
					</section>
			<?php						
				}
				else{
					$parent = get_page($post->post_parent);
					if($parent->ID != get_the_ID()){
						$page_soeurs = new WP_Query( array( 'post_type' => 'page', 'posts_per_page'=>-1, 'post_parent'=>$post->post_parent));

						if ( $page_soeurs->have_posts() ) {
					?>
							<section id="sous_categories" class="small mb2 pt1 pb1 mt2">
								<ul>
					<?php
								while( $page_soeurs->have_posts() ) : $page_soeurs->the_post();
					?>
									<li class="pl3 <?php if($post->ID==$id_page){echo 'actif';}?>"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
					<?php
								endwhile;
								wp_reset_postdata();
					?>
								</ul>
							</section>
					<?php
						}
					}
				}
			?>
			</div>
		
			<article class="mt4 pb2 mb2 post_archive" id="post-<?php the_ID(); ?>">
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