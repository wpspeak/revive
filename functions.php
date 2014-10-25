<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Revive Theme' );
define( 'CHILD_THEME_URL', 'http://wpspeak.com/themes/revive/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'revive_enqueue_scripts' );
function revive_enqueue_scripts() {

	wp_enqueue_script( 'revive-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'revive-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans|Varela+Round', array(), CHILD_THEME_VERSION );

}

//* Add new featured image sizes
add_image_size( 'home-img', 300, 200, TRUE );
add_image_size( 'portfolio-archive', 375, 250, TRUE );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'site-inner',
	'footer-widgets',
	'footer'
) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Create color style options
add_theme_support( 'genesis-style-selector', array(
	'revive-red'   => __( 'Red', 'revive' ),
	'revive-green'  => __( 'Green', 'revive' ),
	'revive-yellow'  => __( 'Yellow', 'revive' ),
) );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'revive_remove_comment_form_allowed_tags' );
function revive_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}


//* Change the number of portfolio items to be displayed (props Bill Erickson)
add_action( 'pre_get_posts', 'revive_limit_portfolio_items' );
function revive_limit_portfolio_items( $query ) {

	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '12' );
	}

}

//* Customize Portfolio post info and post meta
add_filter( 'genesis_post_info', 'revive_portfolio_post_info_meta' );
add_filter( 'genesis_post_meta', 'revive_portfolio_post_info_meta' );
function revive_portfolio_post_info_meta( $output ) {

     if( 'portfolio' == get_post_type() )
        return '';

    return $output;

}

//* Change the footer text
add_filter('genesis_footer_creds_text', 'revive_footer_creds_filter');
function revive_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; ' . get_bloginfo('name') . ' &middot; Proudly powered by [footer_wordpress_link] and [footer_childtheme_link before=""]';
	return $creds;
}

//* Hook after post widget area after post content
add_action( 'genesis_after_header', 'revive_intro_widget' );
	function revive_intro_widget() {
	if ( is_home() )
		genesis_widget_area( 'intro-widget', array(
			'before' => '<div class="intro-widget widget-area"><div class="wrap">',
			'after' => '</div></div>',
	) );
}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'intro-widget',
	'name'        => __( 'Home - Intro', 'revive' ),
	'description' => __( 'This is the intro section of the homepage.', 'revive' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top-left',
	'name'        => __( 'Home - Top Left', 'revive' ),
	'description' => __( 'This is the top left section of the homepage.', 'revive' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top-right',
	'name'        => __( 'Home - Top Right', 'revive' ),
	'description' => __( 'This is the top right section of the homepage.', 'revive' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'revive' ),
	'description' => __( 'This is the middle section of the homepage.', 'revive' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-bottom-left',
	'name'        => __( 'Home - Bottom Left', 'revive' ),
	'description' => __( 'This is the bottom left section of the homepage.', 'revive' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom-right',
	'name'        => __( 'Home - Bottom Right', 'revive' ),
	'description' => __( 'This is the bottom right section of the homepage.', 'revive' ),
) );