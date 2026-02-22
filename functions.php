<?php
/**
 * Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Set up theme support for editor styles and enqueue the editor stylesheet.
 */
function bts_setup() {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/styles.css' );
    add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'bts_setup' );

/**
 * Enqueue the frontend stylesheet with cache-busting.
 */
function bts_enqueue_frontend_styles() {
    $styles_path = get_template_directory() . '/assets/css/styles.css';
    $styles_version = file_exists( $styles_path ) ? filemtime( $styles_path ) : wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'bts-block-theme-styles',
        get_template_directory_uri() . '/assets/css/styles.css',
        array(),
        $styles_version
    );
}
add_action( 'wp_enqueue_scripts', 'bts_enqueue_frontend_styles', 20 );


/**
 * Enqueue the frontend script when it exists.
 */
function bts_enqueue_scripts() {
    $script_path = get_template_directory() . '/assets/js/script.js';
    $script_version = file_exists( $script_path ) ? filemtime( $script_path ) : wp_get_theme()->get( 'Version' );

    if ( file_exists( $script_path ) ) {
        wp_enqueue_script(
            'bts-block-theme-script',
            get_template_directory_uri() . '/assets/js/script.js',
            array(),
            $script_version,
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'bts_enqueue_scripts' );

/**
 * Register a custom block pattern category for the theme.
 */
function bts_register_pattern_categories() {
    register_block_pattern_category(
        'bts-patterns',
        array( 'label' => __( 'BTS Patterns', 'bts-block-theme' ) )
    );
}
add_action( 'init', 'bts_register_pattern_categories' );