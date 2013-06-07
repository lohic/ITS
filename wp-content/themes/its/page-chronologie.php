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
				$page_children = new WP_Query( array( 'post_type' => 'page', 'posts_per_page'=>-1, 'post_parent'=>get_the_ID()));

				if ( $page_children->have_posts() ) {
			?>
					<section id="sous_categories" class="small mb2 pt1 pb1 mt2">
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
									<li class="pl3"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
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
		
			
			<!-- IMPORT CSS DE LA TIMELINE -->
			<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/timeline/timeline.css">
			<style type="text/css">
				
		        div.timeline-event-content{
		            text-align:left;
		            font-size: 9px;
		        }

		        div.timeline-event-content p{
		            display:none;
		        }
		    </style>

			<article class="mt4 pb2 mb2 post_archive" id="post-<?php the_ID(); ?>">
				

				<div class="post_content small">

					<?php the_content(); ?>

				<div id="mytimeline"></div>

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


	<!-- SCRIPT DE LA TIMELINE -->
	<script type="text/javascript" language="javascript" src="<?php bloginfo( 'template_url' ); ?>/timeline/timeline-min.js" ></script>
	<script type="text/javascript" language="javascript" src="<?php bloginfo( 'template_url' ); ?>/timeline/timeline-values.js"  ></script>

<?php get_footer(); ?>