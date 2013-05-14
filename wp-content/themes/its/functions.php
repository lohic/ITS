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
		add_image_size('remontee_its'		, 300, 270, true);
		add_image_size('biographie'		, 200, 200, true);
		add_image_size('iconographie'		, 310, 310, false);
		add_image_size('miniature-iconographie'		, 124, 124, false);
		
		// on enregistre la barre latérale	
		if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Sidebar','before_widget' => '<section class="mb3 sidebar">',
	'after_widget'  => '</section>','before_title'  => '<h3 class="small mb1"><span>',
	'after_title'   => '</span></h3>'));
		
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
add_action( 'p2p_init', 'my_connection_types' );


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
	
		$labels = array(
			'name' => _x( 'Organisations', 'taxonomy general name' ),
			'singular_name' => _x( 'Organisation', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			//'show_ui' => false,
			'menu_name' => __( 'Organisations' ),
		); 
	
		register_taxonomy('organisation','post',array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' => 'organisation' ),
		));

		$labels = array(
			'name' => _x( 'Couleurs', 'taxonomy general name' ),
			'singular_name' => _x( 'Couleur', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			//'show_ui' => false,
			'menu_name' => __( 'Couleurs' ),
		); 
	
		register_taxonomy('couleur','attachment',array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array( 'slug' => 'couleur' ),
		));

		$labels = array(
			'name' => _x( 'Mots clés image', 'taxonomy general name' ),
			'singular_name' => _x( 'Mot clé image', 'taxonomy singular name' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			//'show_ui' => false,
			'menu_name' => __( 'Mots clés image' ),
		); 
	
		register_taxonomy('mot_cle_image','attachment',array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array( 'slug' => 'mot_cle_image' ),
		));
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


if( ! function_exists ( 'create_attachement_list') ) {
	function create_attachement_list($identifiant = '', $titre = ''){
		if($identifiant == ''){
			$identifiant = get_the_ID();
		}

		if ( $documents = get_children ( array (
			'post_parent'	=> $identifiant,
			'post_type'		=> 'attachment',
			'numberposts'	=> -1 ,
			'post_status'	=> null,
			'post_mime_type'=> 'application/zip, application/msword, application/vnd.ms-excel, application/pdf, application/rtf',
			'orderby'		=> 'menu_order',
			'order'			=> 'ASC',
		) ) ) {
			echo '<ul class="liste_attachements mt2">'."\n";
			
			$media_count = 0;
			
			foreach ( $documents as $document ){
				echo '<li class="telechargement">' . wp_get_attachment_link ( $document->ID , '', false , false ) . '</li>'."\n";
			}
		
			echo '</ul>'."\n";
		}
	}
}

// cf http://www.seomix.fr/fil-dariane-chemin-navigation/

//***Fil d'arianne
//Récupérer les catégories parentes
function myget_category_parents($id, $link = false,$separator = '/',$nicename = false,$visited = array()) {
	$chain = '';
	$parent = &get_category($id);
	if($parent->category_nicename!="categories-meres"){
		if (is_wp_error($parent))return $parent;
		if ($nicename)$name = $parent->name;
		else $name = $parent->cat_name;
		if ($parent->parent && ($parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
			$visited[] = $parent->parent;
			$chain .= myget_category_parents( $parent->parent, $link, $separator, $nicename, $visited );
		}
		if ($link) $chain .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
		else $chain .= $name.$separator;
		return $chain;
	}
}


//Le rendu
function mybread() {
	// variables gloables
	global $wp_query;$ped=get_query_var('paged');$rendu = '<div xmlns:v="http://rdf.data-vocabulary.org/#" class="smaller mb3" id="breadcrumbs">';  
	$debutlien = '<span typeof="v:Breadcrumb"><a title="'. get_bloginfo('name') .'" id="breadh" href="'.home_url().'" rel="v:url" property="v:title">Accueil</a></span>';
	$debut = '<span typeof="v:Breadcrumb">Accueil de '. get_bloginfo('name') .'</span>';

	// si l'utilisateur a défini une page comme page d'accueil
	if ( is_front_page() ) {$rendu .= $debut;}

	// dans le cas contraire
	else {

	// on teste si une page a été définie comme devant afficher une liste d'article 
	if( get_option('show_on_front') == 'page') {
		$url = urldecode(substr($_SERVER['REQUEST_URI'], 1));
		$uri = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		$posts_page_id = get_option( 'page_for_posts');
		$posts_page_url = get_page_uri($posts_page_id);  
		$pos = strpos($uri,$posts_page_url);
		if($pos !== false) {
			$rendu .= $debutlien.' &raquo; <span typeof="v:Breadcrumb">Les articles</span>';
		}
		else {
			$rendu .= $debutlien;
		}
	}

	//Si c'est l'accueil
	elseif ( is_home()) {$rendu .= $debut;}

	//pour tout le reste
	else {$rendu .= $debutlien;}

    // les catégories
	if ( is_category()) {
		$cat_obj = $wp_query->get_queried_object();$thisCat = $cat_obj->term_id;$thisCat = get_category($thisCat);$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) $rendu .= " &raquo; ".myget_category_parents($parentCat, true, " &raquo; ", true);
		if ($thisCat->parent == 0) {$rendu .= " &raquo; ";}
		if ( $ped <= 1 ) {$rendu .= single_cat_title("", false);}
		elseif ( $ped > 1 ) {
			$rendu .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $thisCat ) . '" title="Voir tous les articles de '.single_cat_title("", false).'" rel="v:url" property="v:title">'.single_cat_title("", false).'</a></span>';
		}
	}

    // les auteurs
	elseif ( is_author()){
		global $author;$user_info = get_userdata($author);$rendu .= " &raquo; Articles de l'auteur ".$user_info->display_name."</span>";}  

	// les mots clés
	elseif ( is_tag()){
		$tag=single_tag_title("",FALSE);$rendu .= " &raquo; Articles sur le th&egrave;me <span>".$tag."</span>";
	}
	elseif ( is_date() ) {
		if ( is_day() ) {
			global $wp_locale;
			$rendu .= '<span typeof="v:Breadcrumb"><a href="'.get_month_link( get_query_var('year'), get_query_var('monthnum') ).'" rel="v:url" property="v:title">'.$wp_locale->get_month( get_query_var('monthnum') ).' '.get_query_var('year').'</a></span> ';
			$rendu .= " &raquo; Archives pour ".get_the_date();}
		else if ( is_month() ) {
			$rendu .= " &raquo; Archives pour ".single_month_title(' ',false);}
		else if ( is_year() ) {
			$rendu .= " &raquo; Archives pour ".get_query_var('year');
		}
	}

	//les archives hors catégories
	elseif ( is_archive() && !is_category()){
		$posttype = get_post_type();
		$tata = get_post_type_object( $posttype );
		$var = '';
		$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
		$titrearchive = $tata->labels->menu_name;
		if (!empty($the_tax)){$var = $the_tax->labels->name.' ';}
		if (empty($the_tax)){$var = $titrearchive;}
		$rendu .= ' &raquo; Archives sur "'.$var.'"';}

	// La recherche
	elseif ( is_search()) {
		$rendu .= " &raquo; R&eacute;sultats de votre recherche <span>&raquo; ".get_search_query()."</span>";}

	// la page 404
	elseif ( is_404()){
		$rendu .= " &raquo; 404 Page non trouv&eacute;e";}

	//Un article
	elseif ( is_single()){
		$category = get_the_category();
		$category_id = get_cat_ID( $category[0]->cat_name );
		if ($category_id != 0) {
			$rendu .= " &raquo; ".myget_category_parents($category_id,TRUE,' &raquo; ')."<span>".the_title('','',FALSE)."</span>";}
		elseif ($category_id == 0) {
			$post_type = get_post_type();
			$tata = get_post_type_object( $post_type );
			$titrearchive = $tata->labels->menu_name;
			$urlarchive = get_post_type_archive_link( $post_type );
			$rendu .= ' &raquo; <span typeof="v:Breadcrumb"><a class="breadl" href="'.$urlarchive.'" title="'.$titrearchive.'" rel="v:url" property="v:title">'.$titrearchive.'</a></span> &raquo; <span>'.the_title('','',FALSE).'</span>';
		}
	}

	//Une page
	elseif ( is_page()) {
		$post = $wp_query->get_queried_object();
		if ( $post->post_parent == 0 ){
			$rendu .= " &raquo; ".the_title('','',FALSE)."";
		}
		elseif ( $post->post_parent != 0 )
		{
			$title = the_title('','',FALSE);$ancestors = array_reverse(get_post_ancestors($post->ID));array_push($ancestors, $post->ID);
			foreach ( $ancestors as $ancestor ){
				if( $ancestor != end($ancestors) ){
					$rendu .= '&raquo; <span typeof="v:Breadcrumb"><a href="'. get_permalink($ancestor) .'" rel="v:url" property="v:title">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></span>';
				}
				else {
					$rendu .= ' &raquo; '.strip_tags(apply_filters('single_post_title',get_the_title($ancestor))).'';
				}
			}
		}
	}
	if ( $ped >= 1 ) {
		$rendu .= ' (Page '.$ped.')';
	}
	}
	$rendu .= '</div>';
	echo $rendu;
}