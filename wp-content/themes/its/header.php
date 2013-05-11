<!doctype html>
<!--[if lte IE 6]> <html class="no-js ie6 ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=10">
	<title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="viewport" content="initial-scale=1.0">
	<!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/style.css" media="all">

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script type="text/javascript" src="http://use.typekit.com/lwg4aka.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
 	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/script-home.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/script-page-tag.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/purl.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/scripts/general.js"></script>
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
</head>
<body>
	<div id="page">
		<header>
			<h1><a href="<?php bloginfo('url'); ?>"><span class="invisible">ITS</span></a></h1>
			<ul id="sur_menu" class="very_smaller">
				<li><a href="#">Appel aux documents</a></li>
				<li><a href="#">Soutenir le fond</a></li>
			</ul>
			<div id="recherche">
		        <?php get_search_form(); ?>
		    </div>
		    <div id="logo" class="pr3">
		    	<h1 class="very_bigger">Institut<br/>Tribune<br/>Socialiste</h1>
		    	<h2 class="biggest mt0"><?php bloginfo('description') ?></h2>
		    	<img src="<?php bloginfo( 'template_url' ); ?>/img/petit_logo.png" alt="ITS, Institut Tribune Socialiste"/>
		    </div>
		    <nav id="menus" class="small pr3">
				<?php
				if ( has_nav_menu( 'main_menu' ) ) {
					wp_nav_menu( array('theme_location'=>'main_menu'));
				}
				?>
				<?php wp_nav_menu( array('menu'=>'Menu Principal', 'container' => 'false', 'menu_id' => 'menu', 'menu_class' => ''));?>
				<?php wp_nav_menu( array('menu'=>'Menu Secondaire', 'container' => 'false', 'menu_id' => 'menu_secondaire', 'menu_class' => ''));?>
			</nav>
		</header> 
<!-- FIN HEADER -->