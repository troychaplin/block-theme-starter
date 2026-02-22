<?php
/**
 * Enqueue theme assets and register pattern categories.
 *
 * @package BTS
 */

namespace BTS;

/**
 * Class Enqueues
 *
 * Handles enqueueing scripts, styles, and registering pattern categories.
 *
 * @package BTS
 */
class Enqueues {

	/**
	 * Initialize the module.
	 */
	public function init() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'init', array( $this, 'register_pattern_categories' ) );
	}

	/**
	 * Set up theme support for editor styles.
	 */
	public function setup() {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/styles.css' );
		add_editor_style( 'assets/css/editor.css' );
	}

	/**
	 * Enqueue the frontend stylesheet with cache-busting.
	 */
	public function enqueue_styles() {
		$styles_path    = get_template_directory() . '/assets/css/styles.css';
		$styles_version = file_exists( $styles_path ) ? filemtime( $styles_path ) : wp_get_theme()->get( 'Version' );

		wp_enqueue_style(
			'bts-block-theme-styles',
			get_template_directory_uri() . '/assets/css/styles.css',
			array(),
			$styles_version
		);
	}

	/**
	 * Enqueue the frontend script when it exists.
	 */
	public function enqueue_scripts() {
		$script_path    = get_template_directory() . '/assets/js/script.js';
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

	/**
	 * Register a custom block pattern category for the theme.
	 */
	public function register_pattern_categories() {
		register_block_pattern_category(
			'bts-patterns',
			array( 'label' => __( 'BTS Patterns', 'bts-block-theme' ) )
		);
	}
}
