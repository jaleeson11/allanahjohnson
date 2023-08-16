<?php
/**
 * allanahjohnson Theme Customizer
 *
 * @package allanahjohnson
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function allanahjohnson_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'allanahjohnson_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'allanahjohnson_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'allanahjohnson_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function allanahjohnson_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function allanahjohnson_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function allanahjohnson_customize_preview_js() {
	wp_enqueue_script( 'allanahjohnson-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), ALLANAHJOHNSON_VERSION, true );
}
add_action( 'customize_preview_init', 'allanahjohnson_customize_preview_js' );

/**
 * Adds custom customiser sections.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object. 
 */
function allanahjohnson_custom_sections( $wp_customize ) {
	$wp_customize->add_panel(
		'theme_options',
		array(
			'title'       => 'Theme Options',
			'description' => 'Theme modifications for custom content can be done here',
		)
	);

	$wp_customize->add_section(
		'bio',
		array(
			'title' 	  => 'Bio',
			'panel' 	  => 'theme_options',
			'description' => 'This section serves as a short personal introduction, enabling you to share relevant information about yourself, your background, and your expertise.'
		)
	);

	$wp_customize->add_setting( 'bio_image' );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bio_image',
			array(
				'section'  => 'bio',
				'label'    => 'Image',
			)
		)
	);

	$wp_customize->add_setting(
		'bio_heading',
		array(
			'default'           => allanahjohnson_theme_defaults( 'bio_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'bio_heading',
			array(
				'type'     => 'text',
				'section'  => 'bio',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'bio_intro',
		array(
			'default'           => allanahjohnson_theme_defaults( 'bio_intro' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'bio_intro',
			array(
				'type'     => 'textarea',
				'section'  => 'bio',
				'label'    => 'Intro',
			)
		)
	);
}
add_action( 'customize_register', 'allanahjohnson_custom_sections' );
