<?php

/**
 * This file adds the Home Page to the Revive Child Theme.
 *
 */

add_action( 'genesis_meta', 'revive_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function revive_home_genesis_meta() {

if ( is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Add revive-home body class
		add_filter( 'body_class', 'revive_body_class' );

		// Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets
		add_action( 'genesis_after_header', 'revive_homepage_widgets' );

	}
}

function revive_body_class( $classes ) {
   	$classes[] = 'revive-home';
  	return $classes;
}

function revive_homepage_widgets() {

	
	if ( is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) ) {

		echo '<div class="home-top"><div class="wrap">';

		genesis_widget_area( 'home-top-left', array(
			'before' => '<div class="home-top-left widget-area one-fourth first">',
			'after'  => '</div>',
		) );

		genesis_widget_area( 'home-top-right', array(
			'before' => '<div class="home-top-right widget-area three-fourths">',
			'after'  => '</div>',
		) );

		echo '</div></div>';
	
	}
	
	if ( is_active_sidebar( 'home-middle' ) ) {

		genesis_widget_area( 'home-middle', array(
			'before' => '<div class="home-middle widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	
	}
	
	if ( is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {

		echo '<div class="home-bottom"><div class="wrap">';

		genesis_widget_area( 'home-bottom-left', array(
			'before' => '<div class="home-bottom-left widget-area one-fourth first">',
			'after'  => '</div>',
		) );

		genesis_widget_area( 'home-bottom-right', array(
			'before' => '<div class="home-bottom-right widget-area three-fourths">',
			'after'  => '</div>',
		) );

		echo '</div></div>';
	
	}
	
}

genesis();