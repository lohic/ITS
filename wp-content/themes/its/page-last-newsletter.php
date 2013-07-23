<?php

/*
Template Name: Page last newsletter
*/

$args = array(
	'post_type'      => 'newsletter',
	'posts_per_page' => 1,
);

$url = "";

$my_query = new WP_Query( $args );
while( $my_query->have_posts() ) : $my_query->the_post();
	$url = get_permalink();
endwhile;


header('location:'.$url);