<?php
/**
 * The template to display list of gigs.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" <?php audiotheme_archive_class( array( 'content-area', 'archive-gig' ) ); ?>>
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php the_audiotheme_archive_title( '<h1 class="page-title">', '<h1>' ); ?></h1>
				<?php the_audiotheme_archive_description( '<div class="page-content">', '</div>' ); ?>
			</header>

			<article id="gigs" class="page-list gig-list vcalendar">

				<?php while ( have_posts() ) : the_post(); ?>

					<dl <?php post_class(); ?> itemscope itemtype="http://schema.org/MusicEvent">

						<?php if ( audiotheme_gig_has_venue() ) : ?>
							<dt class="gig-venue">
								<h2 class="gig-title">
									<a href="<?php the_permalink(); ?>" itemprop="url"><?php echo get_audiotheme_gig_location(); ?></a>
								</h2>
							</dt>
						<?php else : ?>
							<dt class="gig-venue">
								<span class="gig-title"><?php _e( 'Gig venue details are missing or incomplete.', 'progeny-mmxv' ); ?></span>
								<?php edit_post_link( __( 'Edit Gig', 'progeny-mmxv' ) ); ?>
							</dt>
						<?php endif; ?>

						<dd class="gig-date date">
							<meta content="<?php echo get_audiotheme_gig_time( 'c' ); ?>" itemprop="startDate">
							<a href="<?php the_permalink(); ?>">
								<time class="dtstart" datetime="<?php echo get_audiotheme_gig_time( 'c' ); ?>">
									<?php echo get_audiotheme_gig_time( 'M d, Y' ); ?>
								</time>
							</a>
						</dd>

						<?php if ( audiotheme_gig_has_venue() ) : ?>
							<dd class="gig-location location vcard entry-subtitle" itemprop="location" itemscope itemtype="http://schema.org/EventVenue">
								<?php
								the_audiotheme_venue_vcard( array(
									'container'      => '',
									'show_name_link' => false,
									'show_phone'     => false,
								) );
								?>
							</dd>
						<?php endif; ?>

						<?php the_audiotheme_gig_description( '<dd class="gig-note" itemprop="description">', '</dd>' ); ?>
					</dl>

				<?php endwhile; ?>

			</article>

			<?php
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'progeny-mmxv' ),
				'next_text'          => __( 'Next page', 'progeny-mmxv' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'progeny-mmxv' ) . ' </span>',
			) );
			?>

		<?php else : ?>

			<?php get_template_part( 'audiotheme/parts/content-none', 'gig' ); ?>

		<?php endif; ?>

	</main>
</div>

<?php
get_footer();
