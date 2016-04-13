<?php get_header(); ?>

<!-- cathegory-biographies.php -->

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
    		$laCat = get_query_var('cat');
		?>
		<div id="entete">
			<section id="frise" class="normal mt4 mb3 pl1 row biographie">
				<ul class="row">
					<li <?php if($_GET['lettre']=="a" || !isset($_GET['lettre'])){ echo 'class="actif"';}?>><a href="?lettre=a">A</a></li>
				<?php
					foreach (range('b', 'z') as $letter) {
				?>
						<li <?php if($_GET['lettre']==$letter){ echo 'class="actif"';}?>><a href="?lettre=<?php echo $letter;?>"><?php echo $letter;?></a></li>				
				<?php	
					}
				?>
				</ul>
			</section>
			
			<?php
				if(isset($_GET['lettre']) && $_GET['lettre']!=""){
					$first_char = $_GET['lettre'];
					if($_GET['lettre']=="a"){
						$next=chr(ord($_GET['lettre'])+1);
						$prev='';
					}
					else{
						if($_GET['lettre']=="z"){
							$next='';
							$prev=chr(ord($_GET['lettre'])-1);
						}
						else{
							$next=chr(ord($_GET['lettre'])+1);
							$prev=chr(ord($_GET['lettre'])-1);
						}
					}
				}
				else{
					$first_char = 'a';
					$next='b';
					$previous='';
				}
			?>

			<section class="pagination smaller mb4">
				<?php 
					if($prev!=""){
				?>
						<a href="?lettre=<?php echo $prev;?>" class="precedent">Précédent</a>
				<?php
					}
				?>

				<?php 
					if($next!=""){
				?>
						<a href="?lettre=<?php echo $next;?>" class="suivant">Suivant</a>
				<?php
					}
				?>
			</section>
		</div>
		
		<?php
					
			$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title", $first_char)); 

			if ($postids) {
				$args=array('post__in' => $postids, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'category_name'=>'biographies', 'orderby'=>'title', 'order' => 'ASC', 'caller_get_posts'=> 1);
				$my_query = null;
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<?php 
						$organisations = "";
						$organisations = get_the_term_list( $post->ID, 'organisation', '', ', ', '' );
						/*if($organisations==""){
							$organisations="Institut Tribune Socialiste";
						}*/
				?>
						<article class="pt2 pb2 post_archive biographie" id="post-<?php the_ID(); ?>">
							<h2 class="little_very_biggest mb0 titre"><a href="<?php the_permalink(); ?>" title="<?php the_field('prenom'); ?> <?php the_title(); ?>"><?php the_field('prenom'); ?> <?php the_title(); ?></a></h2>
						<?php
							if($organisations!=""){
						?>
								<h4 class="smaller tag"><span></span><?php echo $organisations; ?></h4>
						<?php
							}
						?>
							<div class="post_content small biographie">
								<div>
									<?php the_content(); ?>
								</div>
								<?php 
								if ( has_post_thumbnail() ) { 
								?>
									<div><?php the_post_thumbnail('biographie');?></div>
	  							<?php
								}
								?>
							</div>
							<div class="clear"></div>
							<?php create_attachement_list(get_the_ID());?>
						</article>
				<?php endwhile;
				}
				wp_reset_query();  // Restore global post data stomped by the_post().
			}
		?>
		<section class="pagination smaller mt1">
			<?php 
				if($prev!=""){
			?>
					<a href="?lettre=<?php echo $prev;?>" class="precedent">Précédent</a>
			<?php
				}
			?>

			<?php 
				if($next!=""){
			?>
					<a href="?lettre=<?php echo $next;?>" class="suivant">Suivant</a>
			<?php
				}
			?>
		</section>
	</div>

<!-- fin cathegory-biographies.php -->

<?php get_footer(); ?>