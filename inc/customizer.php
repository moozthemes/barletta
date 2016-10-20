<?php
/**
 * barletta theme Customizer
 *
 * @package barletta
 */

function barletta_theme_options( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register' , 'barletta_theme_options' );

/**
 * Options for WordPress Theme Customizer.
 */
function barletta_customizer( $wp_customize ) {

	global $barletta_site_layout;

	/**
	 * Section: Theme layout options
	 */

	$wp_customize->add_section('barletta_layout_section', 
		array(
			'priority' => 31,
			'title' => __('Layout options', 'barletta'),
			'description' => __('Choose website layout', 'barletta'),
			)
		);

		// Sidebar position
		$wp_customize->add_setting('barletta_sidebar_position', array(
			'default' => 'mz-sidebar-right',
			'sanitize_callback' => 'barletta_sanitize_layout'
		));

		$wp_customize->add_control('barletta_sidebar_position', array(
			'priority'  => 1,
			'label' => __('Website Layout Options', 'barletta'),
			'section' => 'barletta_layout_section',
			'type'    => 'select',
			'description' => __('Choose between different layout options to be used as default', 'barletta'),
			'choices'    => $barletta_site_layout
		));	

		// checkbox center menu
		$wp_customize->add_setting( 'barletta_menu_center', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'barletta_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'barletta_menu_center', array(
			'priority'  => 2,
			'label'     => __('Center Menu?','barletta'),
			'section'   => 'barletta_layout_section',
			'type'      => 'checkbox',
		) );

	/**
	 * Section: Slider settings
	 */

	$wp_customize->add_section( 
		'barletta_slider_options', 
		array(
			'priority'    => 32,
			'title'       => __( 'Slider Settings', 'barletta' ),
			'capability'  => 'edit_theme_options',
			'description' => __('Change slider settings here.', 'barletta'), 
		) 
	);

		// chose category for slider
		$wp_customize->add_setting( 'barletta_slider_cat', array(
			'default' => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'barletta_sanitize_slidercat'
		) );	

		$wp_customize->add_control( 'barletta_slider_cat', array(
			'priority'  => 1,
			'type' => 'select',
			'label' => __('Choose a category.', 'barletta'),
			'choices' => barletta_cats(),
			'section' => 'barletta_slider_options',
		) );

		// checkbox show/hide slider
		$wp_customize->add_setting( 'show_barletta_slider', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'barletta_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'show_barletta_slider', array(
			'priority'  => 2,
			'label'     => __('Show Slider?','barletta'),
			'section'   => 'barletta_slider_options',
			'type'      => 'checkbox',
		) );

		/**
		 * Section: Change footer text
		 */

		// Change footer copyright text
		$wp_customize->add_setting( 'barletta_footer_text', array(
			'default'        => '',
			'sanitize_callback' => 'barletta_sanitize_input',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( 'barletta_footer_text', array(
			'label'     => __('Footer Copyright Text','barletta'),
			'section'   => 'title_tagline',
			'priority'    => 31,
		));

		/**
		 * Section: Colors
		 */

		// Change accent color
		$wp_customize->add_setting( 'barletta_accent_color', array(
			'default'        => '#7DC07B',
			'sanitize_callback' => 'barletta_sanitize_hexcolor',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'barletta_accent_color', array(
			'label'     => __('Accent color','barletta'),
			'section'   => 'colors',
			'priority'  => 2,
		)));

		// Change link hover color
		$wp_customize->add_setting( 'barletta_link_hover_color', array(
			'default'        => '#7DC07B',
			'sanitize_callback' => 'barletta_sanitize_hexcolor',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'barletta_link_hover_color', array(
			'label'     => __('Links hover color','barletta'),
			'description' => __('Hover color for links in text, headings and menu', 'barletta'),
			'section'   => 'colors',
			'priority'  => 2,
		)));

		// Change titles background
		$wp_customize->add_setting( 'barletta_titles_color', array(
			'default'        => '#A9A9B1',
			'sanitize_callback' => 'barletta_sanitize_hexcolor',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'barletta_titles_color', array(
			'label'     => __('Titles background color','barletta'),
			'description' => __('Widget titles font color is white, please chose dark color for titles background', 'barletta'),
			'section'   => 'colors',
			'priority'  => 2,
		)));

		// Change Footer background
		$wp_customize->add_setting( 'barletta_footer_background', array(
			'default'        => '#2D2D2D',
			'sanitize_callback' => 'barletta_sanitize_hexcolor',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'barletta_footer_background', array(
			'label'     => __('Footer background color','barletta'),
			'description' => __('Change footer background color here', 'barletta'),
			'section'   => 'colors',
			'priority'  => 2,
		)));

		// Change Footer background
		$wp_customize->add_setting( 'barletta_footer_color', array(
			'default'        => '#9A9A9A',
			'sanitize_callback' => 'barletta_sanitize_hexcolor',
			'transport'  =>  'refresh',
		));

		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'barletta_footer_color', array(
			'label'     => __('Footer font color','barletta'),
			'description' => __('Change footer font color here', 'barletta'),
			'section'   => 'colors',
			'priority'  => 2,
		)));

}

add_action( 'customize_register', 'barletta_customizer' );

/**
 * Adds sanitization for text inputs
 */
function barletta_sanitize_input($input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Slider Category
 */
function barletta_sanitize_slidercat( $input ) {
	if ( array_key_exists( $input, barletta_cats()) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze checkbox for WordPress customizer
 */
function barletta_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitze number for WordPress customizer
 */
function barletta_sanitize_number($input) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Sanitze blog layout
 */
function barletta_sanitize_layout( $input ) {
	global $barletta_site_layout;
	if ( array_key_exists( $input, $barletta_site_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze colors
 */
function barletta_sanitize_hexcolor($color)
{
	if ($unhashed = sanitize_hex_color_no_hash($color)) {
		return '#'.$unhashed;
	}

	return $color;
}
