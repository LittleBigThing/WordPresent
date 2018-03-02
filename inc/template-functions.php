<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPresent
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wordpresent_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	/*
	 * Customization
	 */
	
	// Adds a class light-text if text color is set to light.
	if ( get_theme_mod( 'light_text_color' ) ) {
		$classes[] = 'light-text';
	}
	
	// Adds a class background-gradient if a background gradient is set.
	if ( get_theme_mod( 'background_gradient_color' ) && '#ffffff' != get_theme_mod( 'background_gradient_color' ) ) {
		$classes[] = 'background-gradient';
	}
	
	// Adds a class to position the custom logo.
	if ( get_theme_mod( 'logo_position' ) && 'center' !== get_theme_mod( 'logo_position' ) ) {
		$logo_position = get_theme_mod( 'logo_position' );
		
		if ( 'left' === $logo_position ) {
			$classes[] = 'logo-left';
		} else if ( 'right' === $logo_position ) {
			$classes[] = 'logo-right';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'wordpresent_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wordpresent_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wordpresent_pingback_header' );

/**
 * Display custom link color CSS.
 */
function wordpresent_link_color() {
	if ( get_theme_mod( 'link_color_hue' ) ) {
		$hue = absint( get_theme_mod( 'link_color_hue', 210 ) );
	} else {
		return;
	}
	
	$css = "
		.widget a {
			color: hsl({$hue}, 61%, 50%);
		}
	";
	
	wp_add_inline_style( 'wordpresent-style', $css );
}
add_action( 'wp_enqueue_scripts', 'wordpresent_link_color' );

/**
 * Display custom background gradient CSS.
 */
function wordpresent_background_gradient() {
	
	if ( ! get_theme_mod( 'background_gradient_color' ) || '#ffffff' == get_theme_mod( 'background_gradient_color' ) ) {
		return;
	}
	
	$background_color = '#' . get_theme_mod( 'background_color', 'ffffff' );
	$background_gradient_color = get_theme_mod( 'background_gradient_color' );
	
	$css = "
		body.background-gradient {
			background-image: linear-gradient(90deg, {$background_color}, {$background_gradient_color});
		}
	";
	
	wp_add_inline_style( 'wordpresent-style', $css );
}
add_action( 'wp_enqueue_scripts', 'wordpresent_background_gradient' );

/**
 * Helper function for displaying custom background gradient CSS.
 */
function wordpresent_is_background_gradient() {
	// to write
}

/**
 * Set overlay
 */
function wordpresent_overlay() {
	if ( ! get_theme_mod( 'overlay' ) || 0 == get_theme_mod( 'overlay' ) ) {
		return;
	}
	
	$overlay = absint( get_theme_mod( 'overlay', 0 ) ) / 10;
	$css = "
		.custom-background .background-overlay {
			background-color: rgba(0,0,0,{$overlay});
		}
	";
	wp_add_inline_style( 'wordpresent-style', $css );
}
add_action( 'wp_enqueue_scripts', 'wordpresent_overlay' );

/**
 * Change logo size.
 */
function wordpresent_logo_size() {
	if ( ! get_theme_mod( 'logo_size' ) || 10 == get_theme_mod( 'logo_size' ) ) {
		return;
	}
	
	$logo_size = 48 * absint( get_theme_mod( 'logo_size', 10 ) ) / 10;
	$css = "
		.wp-custom-logo .custom-logo {
			width: {$logo_size}px;
		}
	";
	wp_add_inline_style( 'wordpresent-style', $css );
}
add_action( 'wp_enqueue_scripts', 'wordpresent_logo_size' );