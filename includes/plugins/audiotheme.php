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
 * @since 1.0.0
 */
function progeny_audiotheme_setup() {
	add_image_size( 'record-thumbnail', 748, 748, true );
	add_image_size( 'video-thumbnail', 748, 420, true );
}
add_action( 'after_setup_theme', 'progeny_audiotheme_setup', 11 );

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 1.0.0
 */
function progeny_audiotheme_enqueue_assets() {
	// Enqueue AudioTheme's Fitvids script
	if ( is_singular( 'audiotheme_video' ) ) {
		wp_enqueue_script( 'jquery-fitvids' );
	}
}
add_action( 'wp_enqueue_scripts', 'progeny_audiotheme_enqueue_assets', 20 );

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 1.0.0
 */
function progeny_audiotheme_document_head() {
	// Call AudioTheme's Fitvids script.
	if ( is_singular( 'audiotheme_video' ) && wp_script_is( 'jquery-fitvids' ) ) {
		echo '<script>jQuery(function($){ $(".hentry").fitVids(); });</script>' . "\n";
	}
}
add_action( 'wp_head', 'progeny_audiotheme_document_head', 20 );

/**
 * Add additional HTML classes to posts.
 *
 * @since 1.0.0
 *
 * @param array $classes List of HTML classes.
 * @return array
 */
function progeny_audiotheme_post_class( $classes ) {
	if ( is_singular( 'audiotheme_gig' ) && audiotheme_gig_has_venue() ) {
		$classes[] = 'has-venue';
	}

	if ( is_singular( 'audiotheme_track' ) && get_audiotheme_track_thumbnail_id() ) {
		$classes[] = 'has-post-thumbnail';
	}

	if ( is_singular( 'audiotheme_video' ) && get_audiotheme_video_url() ) {
		$classes[] = 'has-post-video';
	}

	return $classes;
}
add_filter( 'post_class', 'progeny_audiotheme_post_class', 10 );


/*
 * AudioTheme hooks.
 * -----------------------------------------------------------------------------
 */

/**
 * Activate default archive setting fields.
 *
 * @since 1.0.0
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


/*
 * Template tags.
 * -----------------------------------------------------------------------------
 */

function progeny_the_audiotheme_tickets_html( $before = '', $after = '' ) {
	$gig_tickets_price = get_audiotheme_gig_tickets_price();
	$gig_tickets_url = get_audiotheme_gig_tickets_url();

	if ( ! $gig_tickets_price || ! $gig_tickets_url ) {
		return;
	}

	$html = __( 'Tickets', 'progeny-mmxv' );

	if ( $gig_tickets_price ) {
		$html .= sprintf( ' <span class="gig-ticket-price" itemprop="price">%s</span>', $gig_tickets_price );
	}

	if ( $gig_tickets_url ) {
		$html = sprintf( '<a class="gig-tickets-link button js-maybe-external" href="%s" itemprop="url">%s</a>',
			$gig_tickets_price,
			$html
		);
	}

	echo $before . $html . $after;
}
