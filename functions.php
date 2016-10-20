<?php
/**
 *
 * @package barletta
 */

global $barletta_site_layout;
$barletta_site_layout = array(
					'mz-sidebar-left' =>  esc_html__('Left Sidebar','barletta'),
					'mz-sidebar-right' => esc_html__('Right Sidebar','barletta'),
					'no-sidebar' => esc_html__('No Sidebar','barletta'),
					'mz-full-width' => esc_html__('Full Width', 'barletta')
					);

if ( ! function_exists( 'barletta_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function barletta_setup() {

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'barletta', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'barletta-large-thumbnail', 1140, 550, true );
	add_image_size( 'barletta-thumbnail', 833, 540, true );
	add_image_size( 'barletta-middle-thumbnail', 627, 320, true );
	add_image_size( 'barletta-small-thumbnail', 455, 320, true );
	add_image_size( 'barletta-author-thumbnail', 262, 170, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'barletta' ),
	) );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
	} 

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'audio', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'barletta_custom_background_args', array(
		'default-color' => 'F5F5F5',
		'default-image' => '',
	) ) );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       => 400,
		'flex-height' => true,
	) );

}
endif; // barletta_setup
add_action( 'after_setup_theme', 'barletta_setup' );


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
if ( ! function_exists( 'barletta_the_custom_logo' ) ) :
function barletta_the_custom_logo() {
	// Try to retrieve the Custom Logo
	$output = '';
	if ((function_exists('get_custom_logo'))&&(has_custom_logo()))
		$output = get_custom_logo();

		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
	if (empty($output))
		$output = '<hgroup><h1><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_attr(get_bloginfo('name')) . '</a></h1><div class="description">'.esc_attr(get_bloginfo('description')).'</div></hgroup>';

	echo $output;
}
endif; // sanremo_custom_logo


/*
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if ( ! function_exists( 'barletta_content_bootstrap_classes' ) ) :
function barletta_content_bootstrap_classes() {
	if ( is_page_template( 'page-fullwidth.php' ) ) {
		return 'col-md-12';
	}
	return 'col-md-9';
}
endif; // barletta_content_bootstrap_classes


/*
 * Generate categories for slider customizer
 */
function barletta_cats() {
	$cats = array();
	$cats[0] = "All";
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}



/*
 * generate navigation from default bootstrap classes
 */
require_once('inc/wp_bootstrap_navwalker.php');

if ( ! function_exists( 'barletta_header_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function barletta_header_menu() {
	/* display the WordPress Custom Menu if available */

	$barletta_add_center_class = "";
	if ( true == get_theme_mod('barletta_menu_center') ) {
		$barletta_add_center_class = " navbar-center";
	}
	wp_nav_menu(array(
		'menu'              => 'main-menu',
		'theme_location'    => 'main-menu',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse'.$barletta_add_center_class,
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'barletta_bootstrap_navwalker::fallback',
		'walker'            => new barletta_bootstrap_navwalker()
	));
} /* end header menu */
endif;

/*
 * load css/js
 */
function barletta_scripts() {

	// Add Google Fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,600,400italic|Lora:700|Roboto:400|Playfair+Display:700&subset=latin,latin-ext');

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );

	// Add main theme stylesheet
	wp_enqueue_style( 'barletta-style', get_stylesheet_uri() );

	// Add JS Files
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery') );
	wp_enqueue_script( 'barletta-js', get_template_directory_uri() . '/js/barletta.scripts.js', array('jquery') );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'barletta_scripts' );

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template_tags.php';


if ( ! function_exists( 'barletta_woo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function barletta_woo_setup() {
	/*
	 * Enable support for WooCemmerce.
	*/
	add_theme_support( 'woocommerce' );
}
endif; // barletta_woo_setup
add_action( 'after_setup_theme', 'barletta_woo_setup' );

/*
 * Add custom colors css to header
 */
if (!function_exists('barletta_custom_css_output'))  {
	function barletta_custom_css_output() {

		echo '<style type="text/css" id="barletta-custom-theme-css">';

		if ( get_theme_mod('barletta_link_hover_color')) {
			echo 'a:hover, a:focus, a:active, a.active { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.list-post-body h2 a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.widget_categories a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.widget a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.widget-post h2 a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.page-numbers li a:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; border-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.blog-post .entry-tags a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.blog-post .entry-content a:hover, a:focus, a:active, a.active { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'#back-top a:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.navbar .navbar-nav > li > a:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.widget_tag_cloud a:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; border-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.blog-post .entry-meta a:hover { color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; border-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; border-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }';		}
		if ( get_theme_mod('barletta_accent_color')) {
			echo '.post-navigation .nav-links .meta-nav span { color: ' . get_theme_mod( 'barletta_accent_color' ) . '; }' .
			'.comment-reply-link, .comment-reply-login { color: ' . get_theme_mod( 'barletta_accent_color' ) . '; }' .
			'.comments-title { color: ' . get_theme_mod( 'barletta_accent_color' ) . '; }' .
			'blockquote:before { color: ' . get_theme_mod( 'barletta_accent_color' ) . '; }' .
			'.blog-post .entry-content a { -webkit-box-shadow: inset 0px -3px 0px 0px ' . get_theme_mod( 'barletta_accent_color' ) . '; -moz-box-shadow: inset 0px -3px 0px 0px ' . get_theme_mod( 'barletta_accent_color' ) . '; box-shadow: inset 0px -3px 0px 0px ' . get_theme_mod( 'barletta_accent_color' ) . '; }' .
			'.navbar-nav > .active a { background-color: ' . get_theme_mod( 'barletta_link_hover_color' ) . '; }' .
			'.page-numbers .current { background-color: ' . get_theme_mod( 'barletta_accent_color' ) . '; border-color: ' . get_theme_mod( 'barletta_accent_color' ) . '; }';
		}
		if ( get_theme_mod('barletta_titles_color')) {
			echo '.widget-title span { background-color: ' . get_theme_mod( 'barletta_titles_color' ) . '; }' .
			'.widget-title:after { background-color: ' . get_theme_mod( 'barletta_titles_color' ) . '; }';
		}
		if ( get_theme_mod('barletta_footer_background')) {
			echo '.footer-bottom { background-color: ' . get_theme_mod( 'barletta_footer_background' ) . '; }';
		}
		if ( get_theme_mod('barletta_footer_color')) {
			echo '.footer-bottom { color: ' . get_theme_mod( 'barletta_footer_color' ) . '; }'.
			'.footer-bottom a { color: ' . get_theme_mod( 'barletta_footer_color' ) . '; }';
		}
		echo "</style>";
	}
}
add_action( 'wp_head', 'barletta_custom_css_output');

/*
 * Register widget areas.
 */
// if no title then add widget content wrapper to before widget
function barletta_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0][ 'after_widget' ] == '</div></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) )
		$params[0][ 'before_widget' ] .= '<div class="content">';

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'barletta_check_sidebar_params' );

function barletta_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'barletta' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'barletta' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'barletta' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Appears in the footer section of the site.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'barletta' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Appears in the footer section of the site.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'barletta' ),
		'id'            => 'footer-widget-3',
		'description'   => __( 'Appears in the footer section of the site.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Full-Width Widget', 'barletta' ),
		'id'            => 'footer-fullwidth-widget',
		'description'   => __( 'For full width widgets. Appears in the footer section of the site.', 'barletta' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	// WooCommerce Sidebar
	if( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'			=> __( 'WooCommerce Sidebar', 'barletta' ),
			'id'			=> 'woocommerce-sidebar',
			'description'	=> __( 'The widgets added in this sidebar will appear in WooCommerce pages.', 'barletta' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title"><span>',
			'after_title'	=> '</span></div>',
		) );
	}

	register_widget( 'barletta_recent_posts' );
	register_widget( 'barletta_social_widget' );
	register_widget( 'barletta_about_author' );

}
add_action( 'widgets_init', 'barletta_widgets_init' );

/*
 * Theme Widgets
 */
require_once(get_template_directory() . '/inc/widgets/widget-barletta-posts.php');
require_once(get_template_directory() . '/inc/widgets/widget-barletta-social.php');
require_once(get_template_directory() . '/inc/widgets/widget-barletta-about.php');

/*
 * Misc. functions
 */

/**
 * Footer credits
 */
function barletta_footer_credits() {
	?>
	<div class="site-info">
	<?php if (get_theme_mod('barletta_footer_text') == '') { ?>
	&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?><?php esc_html_e('. All rights reserved.', 'barletta'); ?>
	<?php } else { echo esc_html( get_theme_mod( 'barletta_footer_text', 'barletta' ) ); } ?>
	</div><!-- .site-info -->

	<?php
	$nofollow="";
	if (!is_home()) { $nofollow="rel=\"nofollow\""; }
	printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'barletta' ) , '<a href="http://moozthemes.com/" target="_blank" '.$nofollow.'>MOOZ Themes</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}
add_action( 'barletta_footer', 'barletta_footer_credits' );

/* Wrap Post count in a span */
add_filter('wp_list_categories', 'barletta_cat_count_span');
function barletta_cat_count_span($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

// Remove search text from search widget
add_filter('get_search_form', 'barletta_my_search_form');
function barletta_my_search_form($text) {
	$text = str_replace('value="Search"', 'value=""', $text);
	return $text;
}

// Add wrapper to video embed
add_filter( 'embed_oembed_html', 'barletta_video_embed_html', 10 );
function barletta_video_embed_html( $html ) { 
	return '<div class="embed-vimeo">' . $html . '</div>'; 
} 
