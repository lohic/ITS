<?php

add_action( 'after_setup_theme', 'its_setup' );

if ( ! function_exists( 'its_setup' ) ){

	function its_setup() {
		
		// Dimensions des images
		add_theme_support('post-thumbnails' );
		add_image_size('newsletter-right'	, 140, 9999);
		add_image_size('newsletter-1x'		, 122, 165, true);
		add_image_size('newsletter-2x'		, 261, 165, true);
		add_image_size('newsletter-3x'		, 400, 165, true);
		
		// on enregistre la barre latérale	
		if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Sidebar'));
		
		// on enregistre les menus de navigation
		if ( function_exists('register_nav_menus') )
		register_nav_menus(
			array(
				'main_menu'	=> __('Menu principal')
			)
		);
		
		// on enregistre les types de posts, taxonomies
		if ( function_exists('my_register_post_types') )
		add_action( 'init', 'my_register_post_types' );
		
		if ( function_exists('my_register_taxonomies') )
		add_action( 'init', 'my_register_taxonomies' );
		
		// on déclare les connexions entre différents types de posts
		if ( function_exists('my_connection_types') )
		add_action( 'p2p_init', 'my_connection_types' );
		
	}
}

function my_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'posts_to_posts',
		'from' => 'post',
		'to' => 'post',
		'reciprocal' => true,
		'title' => 'Lire aussi'
	) );
}


if( ! function_exists (my_register_post_types)) {
	function my_register_post_types() {
		register_post_type(
			'newsletter',
			array(
				'label' => __('Newsletters'),
				'singular_label' => __('Newsletter'),
				'public' => true,
				'show_ui' => true,
				//'show_in_menu' => false,
				//'menu_icon'=> get_bloginfo('template_directory') .'/images/favicon.png',
				'show_in_nav_menus'=> false,
				'capability_type' => 'post',
				'rewrite' => array("slug" => "newsletter"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','custom-fields'),
				//'taxonomies' => 
			)
		);		
	}
}


if( ! function_exists (my_register_taxonomies)) {
	function my_register_taxonomies() {
	
		/*$labels = array(
			'name' => _x( 'Projects categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Projects categorie', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			//'show_ui' => false,
			'menu_name' => __( 'Projects categories' ),
		); 
	
		register_taxonomy('project_category','project',array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array( 'slug' => 'project_category' ),
		));*/
	}
}


/**
* sert à filtrer le contenu d'une newsletter et à appliquer le formatage css pour les balises p, ul, ol
* @param $html contenu html à analyser
* @return une structure html enrichie avec du CSS 
*/
function newsletter_content_format($html = ''){
	if(!empty($html)){
		//header('Content-Type: text/html; charset=utf-8');
	
	
		$dom = new DOMDocument();
		$html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8"); 
		$dom->loadHTML(utf8_decode($html));
		//Evaluate Anchor tag in HTML
		$xpath = new DOMXPath($dom);
		
		// on evalue les paragraphes
		$hrefs = $xpath->evaluate("*/p");
		for ($i = 0; $i < $hrefs->length; $i++) {			
				$href = $hrefs->item($i);      
				$href->removeAttribute('style');
				$href->setAttribute("style", "font-family:Tahoma, Arial, sans-serif;color:#333333;font-size:12px;margin:7px 0;padding:0;");
		}
		
		// on evalue les listes ul
		$hrefs = $xpath->evaluate("*/ul");
		for ($i = 0; $i < $hrefs->length; $i++) {		
				$href = $hrefs->item($i);
				$href->removeAttribute('style');
				$href->setAttribute("style", "font-family:Tahoma, Arial, sans-serif;color:#333333;font-size:12px;list-style:disc;margin:0;");
		}
		
		// on evalue les listes ol
		$hrefs = $xpath->evaluate("*/ol");
		for ($i = 0; $i < $hrefs->length; $i++) {		
				$href = $hrefs->item($i);
				$href->removeAttribute('style');
				$href->setAttribute("style", "font-family:Tahoma, Arial, sans-serif;color:#333333;font-size:12px;margin:0;");
		}
		
		// on evalue les listes ol
		$hrefs = $xpath->evaluate("*/*/a");
		for ($i = 0; $i < $hrefs->length; $i++) {		
				$href = $hrefs->item($i);
				$href->removeAttribute('style');
				$href->setAttribute("style", "color:#F03;");
		}
		
		// on supprime le doctype
		$dom->removeChild($dom->firstChild);
		// on supprime le doctype, la balise html et la balise body
		$html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());
				
		return $html;
	}
}

/**
* ajoute une classe et un attribut alt aux images de la newsletter
* @param $ref ID de l'image que l'on souhaite afficher
* @size taille wordpress de l'image attendue
* @return la balise image
*/
function newsletter_image($ref, $size){
	
	$default_attr = array(
		'class'	=> "attachment-$size",
		'alt'   => trim(strip_tags( get_post_meta($ref, '_wp_attachment_image_alt', true) ))
	);
	
	$retour->image		= wp_get_attachment_image( $ref, $size , false,  $default_attr);
	$retour->legende	= '<p style="font-family:Tahoma, Arial, sans-serif;color:#666666;font-size:11px;margin:7px 0;padding:0;font-style:italic;">' . get_post_meta($ref, '_wp_attachment_image_alt', true) . '</p>';
	
	return $retour;
}