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
	$text = sprintf( __( '%1$s WordPress theme by %2$s.', 'progeny-mmxv' ),
		'<a href="http://audiotheme.com/view/progeny-mmxv/">Progeny MMXV</a>',
		'<a href="http://cedaro.com/">Cedaro</a>'
	);

	echo apply_filters( 'progeny_credits', $text );
}
add_action( 'twentyfifteen_credits', 'progeny_credits' );
