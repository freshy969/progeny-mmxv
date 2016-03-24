<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

/**
 * Theme credits text.
 *
 * @since 1.0.0
 *
 * @param string $text Text to display.
 * @return string
 */
function progeny_credits() {
	$text = apply_filters( 'progeny_credits', '' );
	$text = apply_filters( 'footer_credits', $text );
}
add_action( 'twentyfifteen_credits', 'progeny_credits' );
