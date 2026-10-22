<?php
/**
 * CENTAM theme functions.
 *
 * Kept small on purpose: design tokens live in theme.json, looks live in
 * style.css, and content lives in the editor. This file only loads assets,
 * registers block styles and adds the EN | NL language switcher.
 *
 * @package centam
 */

defined( 'ABSPATH' ) || exit;

define( 'CENTAM_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );

/**
 * Theme supports.
 */
function centam_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	// Hide the generic core patterns so editors only see CENTAM ones.
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'centam_setup' );

/**
 * Front-end assets.
 */
function centam_enqueue_assets() {
	wp_enqueue_style( 'centam', get_theme_file_uri( 'style.css' ), array(), CENTAM_VERSION );

	// Section-specific styles for the home page patterns.
	if ( file_exists( get_theme_file_path( 'assets/css/patterns.css' ) ) ) {
		wp_enqueue_style( 'centam-patterns', get_theme_file_uri( 'assets/css/patterns.css' ), array( 'centam' ), CENTAM_VERSION );
	}

	wp_enqueue_script(
		'centam',
		get_theme_file_uri( 'assets/js/centam.js' ),
		array(),
		CENTAM_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'centam_enqueue_assets' );

/**
 * Pattern styles in the editor too, so sections look the same while editing.
 */
function centam_editor_pattern_styles() {
	if ( file_exists( get_theme_file_path( 'assets/css/patterns.css' ) ) ) {
		add_editor_style( 'assets/css/patterns.css' );
	}
}
add_action( 'after_setup_theme', 'centam_editor_pattern_styles', 11 );

/**
 * Block styles. Editors pick these from the block sidebar (Styles panel)
 * instead of typing CSS classes. The CSS for each lives in style.css under
 * `.is-style-<name>`.
 */
function centam_register_block_styles() {
	$styles = array(
		'core/cover'     => array(
			'centam-hero' => __( 'Hero (hex mesh)', 'centam' ),
		),
		'core/group'     => array(
			'centam-section-dark'   => __( 'Section: dark', 'centam' ),
			'centam-section-darker' => __( 'Section: dark green + mesh', 'centam' ),
			'centam-section-light'  => __( 'Section: light', 'centam' ),
			'centam-card'           => __( 'Card', 'centam' ),
		),
		'core/column'    => array(
			'centam-card' => __( 'Card', 'centam' ),
		),
		'core/paragraph' => array(
			'centam-eyebrow' => __( 'Eyebrow', 'centam' ),
			'centam-meta'    => __( 'Meta (small)', 'centam' ),
		),
		'core/separator' => array(
			'centam-accent-bar' => __( 'Maroon bar', 'centam' ),
		),
		'core/image'     => array(
			'centam-hexagon'      => __( 'Hexagon photo', 'centam' ),
			'centam-partner-logo' => __( 'Partner logo', 'centam' ),
		),
		'core/post-template' => array(
			'centam-card-grid' => __( 'Card grid (3 columns)', 'centam' ),
		),
	);

	foreach ( $styles as $block => $block_styles ) {
		foreach ( $block_styles as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'centam_register_block_styles' );

/**
 * Pattern category for CENTAM sections.
 */
function centam_register_pattern_category() {
	register_block_pattern_category( 'centam', array( 'label' => __( 'CENTAM', 'centam' ) ) );
}
add_action( 'init', 'centam_register_pattern_category' );

/**
 * Language links from Polylang, or an empty array when Polylang is off.
 *
 * Polylang falls back to the other language's home page when the current
 * item has no translation, which is the behaviour of the old switcher.
 *
 * @return array[] Each item has 'slug', 'url' and 'current_lang'.
 */
function centam_languages() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return array();
	}
	$languages = pll_the_languages(
		array(
			'raw'                    => 1,
			'hide_if_no_translation' => 0,
			'hide_if_empty'          => 0,
		)
	);
	return is_array( $languages ) ? array_values( $languages ) : array();
}

/**
 * Adds the language switcher to the header Navigation block:
 * "EN | NL" next to the menu on desktop, and the other language as the last
 * menu item inside the mobile menu. Mirrors .nav-lang / .nav-lang-mobile on
 * the static site. Only the Navigation block with the
 * "centam-primary-nav" class is touched.
 *
 * @param string $block_content Rendered block.
 * @param array  $block         Parsed block.
 * @return string
 */
function centam_add_language_switcher( $block_content, $block ) {
	$class = $block['attrs']['className'] ?? '';
	if ( false === strpos( $class, 'centam-primary-nav' ) ) {
		return $block_content;
	}

	$languages = centam_languages();
	if ( count( $languages ) < 2 ) {
		return $block_content;
	}

	$desktop = array();
	$mobile  = '';
	foreach ( $languages as $language ) {
		$label = esc_html( strtoupper( $language['slug'] ) );
		if ( ! empty( $language['current_lang'] ) ) {
			$desktop[] = '<span class="centam-lang__active" aria-current="true">' . $label . '</span>';
		} else {
			$link      = sprintf( '<a href="%1$s" hreflang="%2$s" lang="%2$s">%3$s</a>', esc_url( $language['url'] ), esc_attr( $language['slug'] ), $label );
			$desktop[] = $link;
			$mobile   .= '<li class="wp-block-navigation-item centam-lang-mobile">' . str_replace( '<a ', '<a class="wp-block-navigation-item__content" ', $link ) . '</li>';
		}
	}

	// Mobile: append to the menu list (the last </ul> closes the top level).
	$position = strrpos( $block_content, '</ul>' );
	if ( false !== $position && '' !== $mobile ) {
		$block_content = substr_replace( $block_content, $mobile . '</ul>', $position, 5 );
	}

	// Desktop: a sibling after the Navigation block.
	$block_content .= '<div class="centam-lang">' . implode( '<span class="centam-lang__divider" aria-hidden="true">|</span>', $desktop ) . '</div>';

	return $block_content;
}
add_filter( 'render_block_core/navigation', 'centam_add_language_switcher', 10, 2 );

/**
 * Shows the bundled CENTAM logo until a Site Logo is chosen in the editor,
 * so a fresh install already looks right. Links to the home page of the
 * current language.
 *
 * @param string $block_content Rendered block.
 * @return string
 */
function centam_default_site_logo( $block_content ) {
	if ( '' !== trim( $block_content ) ) {
		return $block_content;
	}
	$home = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
	return sprintf(
		'<div class="wp-block-site-logo centam-header__logo"><a href="%1$s" class="custom-logo-link" rel="home"><img class="custom-logo" src="%2$s" width="175" height="58" alt="%3$s"></a></div>',
		esc_url( $home ),
		esc_url( get_theme_file_uri( 'assets/images/logo.png' ) ),
		esc_attr__( 'CENTAM, Ceramic Engineering Through Additive Manufacturing', 'centam' )
	);
}
add_filter( 'render_block_core/site-logo', 'centam_default_site_logo' );
