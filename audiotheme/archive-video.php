<?php
/**
 * The template to display list of videos.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" <?php audiotheme_archive_class( array( 'content-area', 'archive-video' ) ); ?>>
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php the_audiotheme_archive_title( '<h1 class="page-title">', '<h1>' ); ?></h1>
				<?php the_audiotheme_archive_description( '<div class="page-content">', '</div>' ); ?>
			</header>

			<div class="page-grid">
				<div class="page-grid-inside">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="post-thumbnail" href="<?php the_permalink(); ?>" itemprop="url">
									<?php the_post_thumbnail( 'record-thumbnail', array( 'itemprop' => 'image' ) ); ?>
								</a>
							<?php endif; ?>

							<header class="entry-header">
								<?php the_title( '<h2 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
							</header>
						</article>

					<?php endwhile; ?>

				</div>
			</div>

			<?php audiotheme_archive_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'audiotheme/parts/content-none', 'video' ); ?>

		<?php endif; ?>

	</main>
</div>

<?php
get_footer();
