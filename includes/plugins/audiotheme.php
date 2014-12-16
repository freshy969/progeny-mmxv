<?php
/**
 * AudioTheme Compatibility File
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 * @link https://audiotheme.com/
 */

/**
 * Set up theme defaults and register support for various AudioTheme features.
 *
 * @since 1.1.0
 */
function progeny_audiotheme_setup() {
	// Add support for AudioTheme widgets.
	add_theme_support( 'audiotheme-widgets', array(
		'record',
		'track',
		'upcoming-gigs',
		'video',
	) );

	add_image_size( 'record-thumbnail', 672, 672, true );
	add_image_size( 'video-thumbnail', 672, 378, true );
}
add_action( 'after_setup_theme', 'progeny_audiotheme_setup', 11 );

/*
 * AudioTheme hooks.
 * -----------------------------------------------------------------------------
 */

/**
 * HTML to display before main AudioTheme content.
 *
 * @since 1.1.0
 */
function progeny_audiotheme_before_main_content() {
	echo '<div id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';

}
add_action( 'audiotheme_before_main_content', 'progeny_audiotheme_before_main_content' );

/**
 * HTML to display after main AudioTheme content.
 *
 * @since 1.1.0
 */
function progeny_audiotheme_after_main_content() {
	echo '</div><!-- #primary -->';
	echo '</main><!-- #main -->';
}
add_action( 'audiotheme_after_main_content', 'progeny_audiotheme_after_main_content' );

/**
 * Adjust AudioTheme widget image sizes.
 *
 * @since 1.1.0
 *
 * @param array $size Image size (width and height).
 * @return array
 */
function progeny_audiotheme_widget_image_size( $size ) {
	return array( 612, 612 ); // sidebar width x 2
}
add_filter( 'audiotheme_widget_record_image_size', 'progeny_audiotheme_widget_image_size' );
add_filter( 'audiotheme_widget_track_image_size', 'progeny_audiotheme_widget_image_size' );
add_filter( 'audiotheme_widget_video_image_size', 'progeny_audiotheme_widget_image_size' );

/**
 * Activate default archive setting fields.
 *
 * @since 1.1.0
 *
 * @param array $fields List of default fields to activate.
 * @param string $post_type Post type archive.
 * @return array
 */
function progeny_audiotheme_archive_settings_fields( $fields, $post_type ) {
	if ( ! in_array( $post_type, array( 'audiotheme_record', 'audiotheme_video' ) ) ) {
		return $fields;
	}

	$fields['posts_per_archive_page'] = true;

	return $fields;
}
add_filter( 'audiotheme_archive_settings_fields', 'progeny_audiotheme_archive_settings_fields', 10, 2 );
