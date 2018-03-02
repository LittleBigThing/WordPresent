<?php
/**
 * WordPresent functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPresent
 */

if ( ! function_exists( 'wordpresent_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wordpresent_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WordPresent, use a find and replace
		 * to change 'wordpresent' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wordpresent', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wordpresent' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wordpresent_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 96,
			'width'       => 96,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
		
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style();
		
	}
endif;
add_action( 'after_setup_theme', 'wordpresent_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordpresent_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wordpresent_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordpresent_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpresent_widgets_init() {	
	register_sidebar( array(
		'name'          => esc_html__( 'Presentation slides', 'wordpresent' ),
		'id'            => 'slides',
		'description'   => esc_html__( 'Add widgets here to appear as a slide. This widget area is only visible when the page template "Presentation" is used', 'wordpresent' ),
		'before_widget' => '<div id="%1$s" class="slide widget %2$s"><div class="vertically-centered">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wordpresent_widgets_init' );
// how to add this to widget for slide navigation? It results in a bug if it is simply added to before widget (to have the widget id for navigation in the href)
// <a href="#%1$s" class="slide-navigation" role="navigation">' . esc_html( 'Next slide', 'wordpresent' ) . '</a>

/**
 * Enqueue scripts and styles.
 */
function wordpresent_scripts() {
	wp_enqueue_style( 'wordpresent-style', get_stylesheet_uri(), array(), '20180225' );
	
	if ( is_page_template( 'page-templates/presentation-template.php' ) ) {
		wp_enqueue_script( 'wordpresent-functions', get_template_directory_uri() . '/js/presentation.js', array(), '20180225', true );
		
		if ( is_customize_preview() ) {
			wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );
		}
	}

	wp_enqueue_script( 'wordpresent-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wordpresent-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wordpresent_scripts' );

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
 * Add support for starter content including some of Csaba Varszegi's presentation slides at WordCamp Antwerp on March 3, 2018 and some instructional information.
 */
require get_template_directory() . '/inc/starter-content.php';