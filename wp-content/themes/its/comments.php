<?php // Ne pas supprimer ces lignes
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Ne pas t&eacute;l&eacute;charger cette page directement, merci !');
if (!empty($post->post_password)) { // s'il y a un mot de passe
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // et ça ne fonctionne pas avec le cookie
?>
<h2><?php _e('Prot&eacute;g&eacute; par mot de passe'); ?></h2>
<p><?php _e('Entrer le mot de passe pour voir les commentaires'); ?></p>
<?php return;
	}
}
/* Cette variable est là comme alternative au fond d'écran des commentaires */
$oddcomment = 'alt';
?>

<?php if ('open' == $post->comment_status) : ?>

	<h3 id="respond" class="normal">Ajouter un commentaire</h3>

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>Vous devez etre <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">connecté</a> pour laisser un commentaire.</p>

	<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="smaller mb3">
			<?php if ( $user_ID ) : ?>

				<p>Connecté en tant que <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="D&eacute;connect&eacute; de ce compte">Déconnexion &raquo;</a></p>

			<?php else : ?>

				<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
				<label for="author">Nom <?php if ($req) echo "(requis)"; ?></label></p>

				<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
				<label for="email">Email (ne sera pas publié) <?php if ($req) echo "(requis)"; ?></label></p>

				<p style="display:none;"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
				<label for="url">Site Web</label></p>

			<?php endif; ?>

			<p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>

			<p>
				<input name="submit" type="submit" id="submit" tabindex="5" value="Envoyer" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			</p>

			<?php do_action('comment_form', $post->ID); ?>

		</form>

	<?php endif; // Si l'enregistrement est requis et que l'utilisateur n'est pas connecté ?>

<?php endif; // Si vous supprimez cete ligne, le ciel vous tombera sur la tête ?>

<!-- Vous pouvez faires des modifs à partir de là -->
<div class="cadre_commentaires mt1">
<?php if ($comments) : ?>
	<h3 id="comments" class="mb2 normal"><span><?php comments_number('Pas de commentaire', 'Afficher le commentaire ', 'Afficher les commentaires ' );?> (<?php echo get_comments_number( $post->ID );?>)</span></h3>
	<h3 id="comments_bis" class="mb2 normal"><span><?php comments_number('Pas de commentaire', 'Le commentaire', 'Les commentaires' );?></span> pour <span class="titre"><?php the_title(); ?></span></h3>
	<ol class="commentlist">
	<?php foreach ($comments as $comment) : ?>

		<li class="<?php echo $oddcomment; ?> pb1 pl3 pr3" id="comment-<?php comment_ID() ?>">
			<div class="commentmetadata">
				<p class="normal mb1"><?php comment_author_link() ?> <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('j F Y') ?> <?php _e('&agrave;');?> <?php comment_time('H:i') ?></a></p><?php edit_comment_link('Editer le commentaire','',''); ?>
		 		<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Votre commentaire est en cours de mod&eacute;ration'); ?></em>
		 		<?php endif; ?>
			</div>
			<div class="little_small commenttext">
				<?php comment_text() ?>
			</div>
		</li>

		<?php /* Change tous les autres commentaires à une classe différente */
			if ('alt' == $oddcomment) $oddcomment = '';
			else $oddcomment = 'alt';
		?>

		<?php endforeach; /* fin de chaque commentaire */ ?>
	</ol>

<?php else : // affiché si aucun commentaire ?>
	<?php if ('open' == $post->comment_status) : ?>
		<h3 id="comments" class="mb2 normal"><span>Pas de commentaire (0)</span></h3>
	<!-- Si les commentaires sont ouverts, mais sans aucun commentaire -->
	<?php else : // Les commentaires sont fermés ?>
		<!-- Si les commentaires sont fermés -->
		<p class="nocomments normal">Les commentaires sont fermés.</p>
	<?php endif; ?>
<?php endif; ?>

</div>



