<?php
/**
 * Template Name: Grid Page
 *
 * @package Progeny_MMXV
 * @since 1.1.0
 */

get_header();
?>

<div id="primary" class="content-area archive-grid">
	<main id="main" class="site-main" role="main">

		<?php do_action( 'progeny_main_top' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="page-header">
				<?php the_title( '<h1 class="page-title" itemprop="headline">', '</h1>' ); ?>

				<?php if ( progeny_has_content() ) : ?>
					<div class="page-content" itemprop="text"><?php the_content(); ?></div>
				<?php endif; ?>
			</header>

		<?php endwhile; ?>

		<?php
		$loop = progeny_page_type_query();
		if ( $loop->have_posts() ) :
		?>

			<div id="posts-container" <?php progeny_posts_class( 'page-grid' ); ?>>

				<div class="page-grid-inside">

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<a class="post-thumbnail" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'progeny-block-grid-16x9' ); ?>
							</a>

							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
							</header>

						</article>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>
				</div>

			</div>

		<?php else : ?>

			<p><?php progeny_page_type_notice(); ?></p>

		<?php endif; ?>

		<?php do_action( 'progeny_main_bottom' ); ?>

	</main>
</div>

<?php
get_footer();
