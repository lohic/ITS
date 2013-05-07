<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
    		$laCat = get_query_var('cat');
		?>
		<div id="entete">
			<section id="frise" class="normal mt4 mb3 pl1 row biographie">
				<ul class="row">
					<li <?php if($_GET['lettre']=="a" || !isset($_GET['lettre'])){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=a">A</a></li>
					<li <?php if($_GET['lettre']=="b"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=b">B</a></li>
					<li <?php if($_GET['lettre']=="c"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=c">C</a></li>
					<li <?php if($_GET['lettre']=="d"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=d">D</a></li>
					<li <?php if($_GET['lettre']=="e"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=e">E</a></li>
					<li <?php if($_GET['lettre']=="f"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=f">F</a></li>
					<li <?php if($_GET['lettre']=="g"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=g">G</a></li>
					<li <?php if($_GET['lettre']=="h"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=h">H</a></li>
					<li <?php if($_GET['lettre']=="i"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=i">I</a></li>
					<li <?php if($_GET['lettre']=="j"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=j">J</a></li>
					<li <?php if($_GET['lettre']=="k"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=k">K</a></li>
					<li <?php if($_GET['lettre']=="l"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=l">L</a></li>
					<li <?php if($_GET['lettre']=="m"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=m">M</a></li>
					<li <?php if($_GET['lettre']=="n"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=n">N</a></li>
					<li <?php if($_GET['lettre']=="o"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=o">O</a></li>
					<li <?php if($_GET['lettre']=="p"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=p">P</a></li>
					<li <?php if($_GET['lettre']=="q"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=q">Q</a></li>
					<li <?php if($_GET['lettre']=="r"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=r">R</a></li>
					<li <?php if($_GET['lettre']=="s"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=s">S</a></li>
					<li <?php if($_GET['lettre']=="t"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=t">T</a></li>
					<li <?php if($_GET['lettre']=="u"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=u">U</a></li>
					<li <?php if($_GET['lettre']=="v"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=v">V</a></li>
					<li <?php if($_GET['lettre']=="w"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=w">W</a></li>
					<li <?php if($_GET['lettre']=="x"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=x">X</a></li>
					<li <?php if($_GET['lettre']=="y"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=y">Y</a></li>
					<li <?php if($_GET['lettre']=="z"){ echo 'class="actif"';}?>><a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=z">Z</a></li>
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
						<a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=<?php echo $prev;?>" class="precedent">Prev</a>
				<?php
					}
				?>

				<?php 
					if($next!=""){
				?>
						<a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=<?php echo $next;?>" class="suivant">Next</a>
				<?php
					}
				?>
			</section>
		</div>
		
		<?php
			
			$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char)); 

			if ($postids) {
				$args=array('post__in' => $postids, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'category_name'=>'biographies', 'order' => 'ASC', 'caller_get_posts'=> 1);
				$my_query = null;
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<?php 
						$liste_tags = "";
						$tags = get_the_tags();
						foreach ($tags as $tag){
							$liste_tags .= '<a href="'.get_bloginfo('url').'?tag='.$tag->slug.'">'.$tag->name.'</a>, ';
						}
						$liste_tags = substr($liste_tags, 0, -2);
				?>
						<article class="pt2 pb2 post_archive biographie" id="post-<?php the_ID(); ?>">
							<h2 class="little_very_biggest mb0 titre"><?php the_field('prenom'); ?> <?php the_title(); ?></h2>
							<h4 class="smaller tag"><span></span><?php echo $liste_tags; ?></h4>
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
					<a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=<?php echo $prev;?>" class="precedent">Prev</a>
			<?php
				}
			?>

			<?php 
				if($next!=""){
			?>
					<a href="<?php bloginfo('url'); ?>?cat=<?php echo $laCat;?>&amp;lettre=<?php echo $next;?>" class="suivant">Next</a>
			<?php
				}
			?>
		</section>
	</div>

<?php get_footer(); ?>