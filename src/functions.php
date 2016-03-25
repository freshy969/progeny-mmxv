<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

/**
 * Load helper functions and libraries.
 */
require( get_stylesheet_directory() . '/includes/hooks.php' );
require( get_stylesheet_directory() . '/includes/template-tags.php' );
require( get_stylesheet_directory() . '/includes/vendor/cedaro-theme/autoload.php' );
progeny_theme()->load();

/**
 * Load AudioTheme support or display a notice that it's needed.
 */
if ( function_exists( 'audiotheme_load' ) ) {
	require( get_stylesheet_directory() . '/includes/plugins/audiotheme.php' );
} else {
	require( get_stylesheet_directory() . '/includes/vendor/class-audiotheme-themenotice.php' );
	new Audiotheme_ThemeNotice();
}

/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * @since 1.0.0
 */
function progeny_setup() {
	// Add support for translating strings in this theme.
	// @link http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	load_child_theme_textdomain( 'progeny-mmxv', get_stylesheet_directory() . '/languages' );

	// Add post thumbnail size.
	add_image_size( 'progeny-block-grid-16x9', 748, 420, array( 'center', 'top' ) );

	// Add page excerpt support
	add_post_type_support( 'page', 'excerpt' );

	// Get the theme object.
	$page_types = progeny_theme()->page_types->add_support();

	// Register the grid page templates.
	$page_types->register(
		'grid',
		array(
			'archive_template' => 'templates/archive-block-grid.php',
			'single_template'  => 'templates/single-block-grid.php',
		)
	);

	// Register the list page templates.
	$page_types->register(
		'list',
		array(
			'archive_template' => 'templates/archive-page-list.php',
			'single_template'  => 'templates/single-page-list.php',
		)
	);
}
add_action( 'after_setup_theme', 'progeny_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function progeny_enqueue_assets() {
	// Load parent stylesheet.
	wp_enqueue_style( 'progeny-parent-theme', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'progeny_enqueue_assets' );

/**
 * Wrapper for accessing the Cedaro_Theme instance.
 *
 * @since 1.1.0
 *
 * @return Cedaro_Theme
 */
function progeny_theme() {
	static $instance;

	if ( null === $instance ) {
		Cedaro_Theme_Autoloader::register();
		$instance = new Cedaro_Theme( array( 'prefix' => 'progeny-mmxv' ) );
	}

	return $instance;
}
