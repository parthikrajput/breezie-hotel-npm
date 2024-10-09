<?php
/**
 * Rocket Homepage functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rocket_Homepage
 */

if ( ! defined( 'THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'THEME_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rocket_homepage_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'rocket-homepage' ),
			'menu-2' => esc_html__( 'Policy Menu', 'rocket-homepage' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'width' => 300,
		'height' => 65,
		'flex-height' => true,
		'flex-width' => true
	) );
}
add_action( 'after_setup_theme', 'rocket_homepage_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rocket_homepage_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rocket-homepage' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rocket-homepage' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rocket_homepage_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rocket_homepage_scripts() {
	wp_enqueue_script( 'jquery' );
	if(is_front_page()) { 
		wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/script.js', ['jquery'], THEME_VERSION, true );
	}
	wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/assets/js/fancybox.umd.js', ['jquery'], THEME_VERSION, true );

	wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/fonts/font.css', [], THEME_VERSION);

	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/output.css', [], THEME_VERSION );
	wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/assets/css/fancybox.css', [], THEME_VERSION );
	

	wp_register_script('owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', ['jquery'], THEME_VERSION, true);
	wp_register_style('owlmin', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', [], THEME_VERSION);
	wp_register_style('default', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', [], THEME_VERSION);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rocket_homepage_scripts' );



/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

function add_menu_image($items, $args) {
    if ($args->theme_location == 'menu-1') {
        ob_start();
        the_custom_logo();
        $logo = ob_get_clean();
        $image = '<li class="lg:block hidden">' . $logo . '</li>';
        $position = 2; // Position to insert the image
        $items_array = explode('</li>', $items);
        array_splice($items_array, $position, 0, $image);
        $items = implode('</li>', $items_array) . '</li>'; 
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_menu_image', 10, 2);


function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAmTg9uQHW8UsRpxagGaERjE2dfk6A-aGU';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');