<?php

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'revive_social_default_styles' );
function revive_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'aligncenter',
		'border_radius'          => 50,
		);
		
	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}