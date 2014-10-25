<?php
/**
 * This file adds the custom portfolio post type archive template to the Revive Theme.
 */

//* Add portfolio body class to the head
add_filter( 'body_class', 'revive_portfolio_body_class' );
function revive_portfolio_body_class( $classes ) {
   $classes[] = 'revive-portfolio';
   return $classes;
}
 
//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * Archive Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 *
 * @param array $classes
 * @return array
 */
function revive_archive_post_class( $classes ) {
	global $wp_query;
	if( ! $wp_query->is_main_query() )
		return $classes;
		
	$classes[] = 'one-third';
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 3 )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'post_class', 'revive_archive_post_class' );

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Add the featured image after post title
add_action( 'genesis_entry_header', 'revive_portfolio_image', 5 );
function revive_portfolio_image() {

    if ( $image = genesis_get_image( 'format=url&size=portfolio-archive' ) ) {
        printf( '<div class="portfolio-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );

    }

}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
