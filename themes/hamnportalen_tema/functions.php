<?php
/**
 * hamnportalen_tema functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hamnportalen_tema
 */

// if ( ! defined( '_S_VERSION' ) ) {
// 	// Replace the version number of the theme on each release.
// 	define( '_S_VERSION', '1.0.0' );
// }

if ( ! function_exists( 'hamnportalen_tema_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hamnportalen_tema_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hamnportalen_tema, use a find and replace
		 * to change 'hamnportalen_tema' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hamnportalen_tema', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'hamnportalen_tema' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'hamnportalen_tema_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'hamnportalen_tema_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamnportalen_tema_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hamnportalen_tema_content_width', 640 );
}
add_action( 'after_setup_theme', 'hamnportalen_tema_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hamnportalen_tema_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hamnportalen_tema' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hamnportalen_tema' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hamnportalen_tema_widgets_init' );

function wpb_add_google_fonts() {
wp_enqueue_style("wpb-google-fonts", "https://fonts.googleapis.com/css2?family=Dosis:wght@600&display=swap", false); 
wp_enqueue_style("wpb-google-fonts", "https://fonts.googleapis.com/css2?family=Montserrat&display=swap", false); 
}
add_action("wp_enqueue_scripts", "wpb_add_google_fonts");

function add_hamnportalen_theme_styles() {
  $version = wp_get_theme()->get("Version");
  wp_enqueue_style("hamnportalen-style", get_template_directory_uri() . "/style.css", array(), $version, "all");
}
add_action("wp_enqueue_scripts", "add_hamnportalen_theme_styles");

// function add_hamnportalen_map_search_api_script() {
// 	wp_enqueue_script('mapScript', get_template_directory_uri() . "/template-parts/pages/search-results/scripts/mapScript.js#wpcasync");
// }
// add_action("wp_enqueue_scripts", "add_hamnportalen_map_search_api_script");

// This function is to load the google api script file asynchronius

// function add_async_forscript($url) {
// 	if (strpos($url, '#wpcasync')===false)
// 			return $url;
// 	else if (is_admin())
// 			return str_replace('#wpcasync', '', $url);
// 	else
// 			return str_replace('#wpcasync', '', $url)."' async='async"; 
// }
// add_filter('clean_url', 'add_async_forscript', 11, 1);

// function add_google_api_script() {
// 	wp_enqueue_script('google-maps-api', "https://maps.googleapis.com/maps/api/js?key=AIzaSyAhZ_WbKFU-E6YCJuoB3dD0BWVTYuO8Km8&callback=initMap#wpcasync");
// }
// add_action('wp_enqueue_scripts', "add_google_api_script");

// ENDPOINTS

function get_ports($search_term) {
	$search_query = $search_term['search_term'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "posts";

	$posts = $wpdb->get_results(
		"SELECT * FROM $table_name 
		WHERE post_title LIKE '$search_query%'
		AND post_status = 'publish'");
	
	$ports_info_arr = array();
	
	foreach($posts as $post) {
		$portObj = new stdClass;
		$portObj->img_url = get_field('hero_img_1', $post->ID);
		$portObj->name = get_field('name', $post->ID);
		$portObj->long = (float)get_field('long', $post->ID);
		$portObj->lat = (float)get_field('lat', $post->ID);
		$portObj->price = get_field('price', $post->ID);
		
		array_push($ports_info_arr, $portObj );
	}
	return $ports_info_arr;
}

add_action( 'rest_api_init', function() {
  register_rest_route( 'mapsearch', '/search/(?P<search_term>\S+)', array(
    'methods' => 'GET',
    'callback' => 'get_ports'
  ) );
} );

/**
 * Enqueue scripts and styles.
 */
// TROLIGEN ÖVERFLÖDIG KOD (ERROR)
// function hamnportalen_tema_scripts() {
// 	wp_enqueue_style( 'hamnportalen_tema-style', get_stylesheet_uri(), array(), _S_VERSION );
// 	wp_style_add_data( 'hamnportalen_tema-style', 'rtl', 'replace' );

// 	wp_enqueue_script( 'hamnportalen_tema-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'hamnportalen_tema_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
