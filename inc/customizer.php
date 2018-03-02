<?php
/**
 * WordPresent Theme Customizer
 *
 * @package WordPresent
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wordpresent_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wordpresent_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wordpresent_customize_partial_blogdescription',
		) );
	}
	
	/**
	 * Custom colors
	 */
	
	// add setting for 
	$wp_customize->add_setting( 'light_text_color', array(
		'default'           => 0,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wordpresent_sanitize_text_color',
	) );
	//add checkbox control to edit text color setting
	$wp_customize->add_control( 'light_text_color', array(
		'type'    => 'checkbox',
		'label'    => __( 'Light-colored text', 'wordpresent' ),
		'section'  => 'colors',
		'priority' => 1,
	) );
	
	// settings for background gradient
	$wp_customize->add_setting( 'background_gradient_color', array(
		'default'           => '#ffffff',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	// add control for background gradient color
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_gradient_color', array(
		'label'    => __( 'Background Gradient Color', 'wordpresent' ),
		'description' => __( 'Choose a gradient color to display a background gradient in combination with the background color', 'wordpresent' ),
		'section'  => 'colors',
		'priority' => 10,
	) ) );
	
	// add setting for the link color as hue
	$wp_customize->add_setting( 'link_color_hue', array(
		'default'           => 210,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );
	// add hue control to adjust link color
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hue', array(
		'mode' => 'hue',
		'label'    => __( 'Link color', 'wordpresent' ),
		'section'  => 'colors',
		'priority' => 11,
	) ) );
	
	// add setting for overlay
	$wp_customize->add_setting( 'overlay', array(
		'default'           => 0,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );
	// add control to adjust overlay
	$wp_customize->add_control( 'overlay', array(
		'type'    => 'range',
		'label'    => __( 'Overlay', 'wordpresent' ),
		'input_attrs'  => array(
			'min'  => 0,
			'max'   => 9,
			'step' => 1,
		),
		'section'  => 'background_image',
		'priority' => 11,
	) );
	
	/*
	 * Options for the custom logo
	 */
	
	// add setting for logo size
	$wp_customize->add_setting( 'logo_size', array(
		'default'           => 10,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );
	// add control to adjust logo size
	$wp_customize->add_control( 'logo_size', array(
		'type'    => 'range',
		'label'    => __( 'Logo size', 'wordpresent' ),
		'input_attrs'  => array(
			'min'  => 5,
			'max'   => 20,
			'step' => 1,
		),
		'section'  => 'title_tagline',
		'priority' => 8,
	) );
	
	// add setting for logo position
	$wp_customize->add_setting( 'logo_position', array(
		'default'           => 'center',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wordpresent_sanitize_logo_position',
	) );
	// add control to adjust logo position
	$wp_customize->add_control( 'logo_position', array(
		'type'    => 'radio',
		'label'    => __( 'Logo position', 'wordpresent' ),
		'choices'  => array(
			'left'  => __( 'Left', 'wordpresent' ),
			'center'   => __( 'Center', 'wordpresent' ),
			'right' => __( 'Right', 'wordpresent' ),
		),
		'section'  => 'title_tagline',
		'priority' => 9,
	) );
}
add_action( 'customize_register', 'wordpresent_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wordpresent_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function wordpresent_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sanitize text color checkbox.
 */
function wordpresent_sanitize_text_color( $input ) {
	return ( 1 == $input ? true : false );
}

/**
 * Sanitize the logo position.
 */
function wordpresent_sanitize_logo_position( $input ) {
	$valid = array( 'left', 'center', 'right' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'center';
}

/**
 * Binds JS handlers to make Customizer preview reload changes asynchronously.
 */
function wordpresent_customize_preview_js() {
	wp_enqueue_script( 'wordpresent-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20180227', true );
}
add_action( 'customize_preview_init', 'wordpresent_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function wordpresent_customize_controls_js() {
	wp_enqueue_script( 'wordpresent-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20180215', true );
}
add_action( 'customize_controls_enqueue_scripts', 'wordpresent_customize_controls_js' );