<?php
/**
 * The template used for displaying articles in a Grid Page template.
 *
 * @package Progeny_MMXV
 * @since 1.1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'progeny-block-grid-16x9' ); ?>
	</a>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
	</header>

</article>
