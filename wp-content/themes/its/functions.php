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
		add_image_size('remontee_its'		, 300, 500, true); // 300, 270
		add_image_size('biographie'			, 200, 200, true);
		add_image_size('iconographie'		, 310, 310, false);
		add_image_size('miniature-iconographie'		, 124, 124, false);
		
		// on enregistre la barre latérale	
		if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Sidebar','before_widget' => '<section class="mb2 sidebar">',
	'after_widget'  => '</section>','before_title'  => '<h3 class="small mb1"><span>',
	'after_title'   => '</span></h3>'));
		
		// on enregistre les menus de navigation
		if ( function_exists('register_nav_menus') )
		register_nav_menus(
			array(
				'main_menu'	=> __('Menu principal'),
				'second_menu'	=> __('Menu secondaire'),
				'top_menu'	=> __('Menu du haut'),
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

		// AJAX
		add_action('wp_head','custom_head');
		add_action('wp_ajax_get_images_listing', 'ajax_get_images_listing');
		add_action('wp_ajax_nopriv_get_images_listing', 'ajax_get_images_listing');

	}
}

function custom_head(){
    echo '<script type="text/javascript">var ajaxurl = \''.admin_url('admin-ajax.php').'\';</script>';
}

function ajax_get_images_listing(){
	global $wpdb; // this is how you get access to the database
	include(dirname(__File__) . '/inc/ajax-images_listing.php');
	die();	
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
				'menu_icon'=> 'dashicons-editor-textcolor',
				'show_in_nav_menus'=> false,
				'capability_type' => 'post',
				'rewrite' => array("slug" => "newsletter"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','custom-fields'),
				//'taxonomies' => 
			)
		);


		register_post_type(
			'mail',
			array(
				'label' => __('Mails'),
				'singular_label' => __('Mail'),
				'public' => true,
				'show_ui' => true,
				//'show_in_menu' => false,
				'menu_icon'=> 'dashicons-email-alt',
				'show_in_nav_menus'=> false,
				'capability_type' => 'post',
				'rewrite' => array("slug" => "mail"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','editor'),
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
			'hierarchical' => false,
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
			'hierarchical' => false,
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
		
		// on evalue les liens a
		$hrefs = $xpath->evaluate("/html/body//a");
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

/* POUR AJOUTER UN TARGET _BLANK A wp_get_attachment_link */
function modify_attachment_link($markup) {
    return preg_replace('/^<a([^>]+)>(.*)$/', '<a\\1 target="_blank">\\2', $markup);
}
add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 6 );



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
		//echo $name. ' ' . get_category_link( $parent->term_id ) . ' '. $parent->slug;
		// LOIC
		if($parent->slug == "esu-60-71") $chain .= '<span typeof="v:Breadcrumb"><a href="http://www.institut-tribune-socialiste.fr/organisation/esu/" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
		// LOIC
		else if($parent->slug == "psu-60-90") $chain .= '<span typeof="v:Breadcrumb"><a href="http://www.institut-tribune-socialiste.fr/organisation/psu/" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
		elseif ($link) $chain .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
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
		if ( $thisCat->parent != 0) $rendu .= " &raquo; ".myget_category_parents($parentCat, true, " &raquo; ", true);
		if ( $thisCat->parent == 0) {$rendu .= " &raquo; ";}
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

if( ! function_exists ( 'get_the_content_by_id' ) ) {
	function get_the_content_by_id($id) {
		
		$content_post = get_post($id);
		$content = $content_post->post_content;

		$dom = new DOMDocument;
		$dom->loadHTML(utf8_decode($content));
		$xpath = new DOMXPath($dom);

		$nodes = $xpath->query('//img|//a[img]');
		foreach($nodes as $node) {
			$node->parentNode->removeChild($node);
		}
		$content = ($dom->saveHTML());

		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		
		return $content;
		
	}
}

if( ! function_exists ( 'the_excerpt_max_charlength_by_param') ) {
	function the_excerpt_max_charlength_by_param($charlength, $pageID) {
		/*			
			// pour corriger un probleme avec shopplugin ?
			$content = get_the_content();
			$content = do_shortcode( $content );
			$content = wpautop($content);
			//$content = apply_filters('the_content', $content);
			//the_content();
			$content = str_replace(']]>', ']]&gt;', $content);

			echo $content;*/
		$contenu_resume = get_the_content_by_id($pageID);
		//$contenu_resume = do_shortcode($contenu_resume );
		//$contenu_resume = wpautop($contenu_resume);
		//$contenu_resume = apply_filters('the_content', $contenu_resume);
		//$contenu_resume = str_replace(']]>', ']]&gt;', $contenu_resume);
		$contenu_resume = wptexturize($contenu_resume);
		//$contenu_resume = cleanApostrophes($contenu_resume );
		$contenu_resume = strip_tags($contenu_resume);
		$charlength++;

		if ( mb_strlen( $contenu_resume ) > $charlength ) {
			$subex = mb_substr( $contenu_resume, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '[...]';
		} else {
			echo "$contenu_resume";
		}
	}
}

function cleanApostrophes($content){
	$content = str_replace(array("'","`","’", "&146;", "&#2019;", "&#8217;", "&apos;", "&amp;apos;","&#039;"), "'", $content);
	return $content;
}


if( ! function_exists ( 'the_excerpt_max_charlength') ) {
	function the_excerpt_max_charlength($charlength) {
		$contenu_resume = get_the_content();
		$charlength++;

		if ( mb_strlen( $contenu_resume ) > $charlength ) {
			$subex = mb_substr( $contenu_resume, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '...';
		} else {
			echo "$contenu_resume";
		}
	}
}


function timeline_date(){
	$ladate = get_the_date('Y,m,d ');

	$ladate = explode(',',$ladate);

	$ladate[1] = $ladate[1]-1;

	return implode(',',$ladate);
}



/* DISPLAY FUTURE POST */
add_filter('the_posts', 'show_future_posts');
function show_future_posts($posts)
{
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }
 
   return $posts;
}


// [fondvideo nbr="9"]
add_shortcode( 'fondsvideo', 'fondsvideo_shortcode' );
function fondsvideo_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'nbr' => 12,
		'channel' => null,
		'notitle' => null,
		'nodesc'  => null,
	), $atts ) );

	$url = 'https://vimeo.com/itsats/badgeo/?script=1&badge_layout=horizontal&badge_quantity='.$nbr.'&badge_size=160&badge_stream=uploaded&show_titles=yes';
	if(!empty( $channel )){

		
		// https://vimeo.com/api/v2/channel/psuguerredalgerie/info.json
		$channelInfo = json_decode(file_get_contents('https://vimeo.com/api/v2/channel/'.$channel.'/info.json'));

		$channelID = $channelInfo->id;

		$url = 'https://vimeo.com/itsats/badgeo/?script=1&badge_layout=horizontal&badge_quantity='.$nbr.'&badge_size=160&badge_stream=channel&show_titles=yes&badge_channel='.$channelID;
	}

	//https://vimeo.com/api/v2/channel/psuguerredalgerie/info.json

	$retour = '<style id="badge-styles">
        /* You can modify these CSS styles */
        .vimeoBadge { margin: 0; padding: 0; }
        .vimeoBadge img { border: 0; }
        .vimeoBadge a, .vimeoBadge a:link, .vimeoBadge a:visited, .vimeoBadge a:active { color: #000; text-decoration: none; cursor: pointer; }
        .vimeoBadge a:hover { color:#188e7c; }
        .vimeoBadge #vimeo_badge_logo { margin-top:10px; width: 57px; height: 16px; }
        .vimeoBadge .credit { font: normal 11px verdana,sans-serif; }
        .vimeoBadge .clip { padding:0; float:left; margin:0 10px 10px 0; line-height:0; }
        .vimeoBadge.vertical .clip { float: none; }
        .vimeoBadge .caption {line-height:1em; width: auto; font-size:0.8em; margin-top:5px; min-height:40px; }
        .vimeoBadge .clear { display: block; clear: both; visibility: hidden; }
        .vimeoBadge .s160 { width: 160px; } .vimeoBadge .s80 { width: 80px; } .vimeoBadge .s100 { width: 100px; } .vimeoBadge .s200 { width: 200px; }
        .vimeoBadge .s160 img{ width: 160px; height: 120px; }
		.vimeoClear{ clear:both; margin-bottom:40px;}
    </style>';

    if(!empty( $channel )){
    	if(!isset( $notitle )){
    		$retour .= '<h3><a target="_blank" href="'.$channelInfo->url.'">'.$channelInfo->name.'</h3></a>';
		}
		if(!isset( $nodesc )){
    		$retour .= '<p>'.$channelInfo->description.'</p>';
    	}
    	
    }

    $retour .= '<p>&nbsp;</p>';
    $retour .= '<p><div class="badge">
<div class="vimeoBadge horizontal">
<script src="'.$url.'"></script>
</div>
</div>
<div class="vimeoClear"></div></p>
';

	return $retour;
}


// pour désactiver le bug lié au plugin formidable
add_action( 'admin_init', 'wpuxss_admin_scripts' );
function wpuxss_admin_scripts() 
{	
	global $pagenow;
	
	if (( $pagenow == 'post.php' ) ||   ( ( $pagenow == 'admin.php' ) && ($_GET['page'] == 'acf-options') ) ) 
	{		
		wp_enqueue_script( 'wplink', home_url('/wp-includes/js/wplink.js') );
		wp_enqueue_script( 'popup', home_url('/wp-includes/js/tinymce/plugins/wpdialogs/js/popup.js') );	
	}
}

/*
<div class="vimeoBadge horizontal">
<script src="https://vimeo.com/itsats/badgeo/?script=1&badge_layout=horizontal&badge_quantity=9&badge_size=80&badge_stream=channel&show_titles=no&badge_channel=694968"></script>
</div>
</div>
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


