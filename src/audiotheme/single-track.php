<?php
/**
 * The template for displaying a single track.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area single-record single-track">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/MusicRecording" role="article">

				<?php if ( $thumbnail_id = get_audiotheme_track_thumbnail_id() ) : ?>

					<p class="record-artwork">
						<a class="post-thumbnail" href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" itemprop="image">
							<?php echo wp_get_attachment_image( $thumbnail_id, 'record-thumbnail' ); ?>
						</a>
					</p>

				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>

					<?php if ( $artist = get_audiotheme_record_artist() ) : ?>
						<h2 class="record-artist entry-subtitle" itemprop="byArtist"><?php echo esc_html( $artist ); ?></h2>
					<?php endif; ?>

					<h3 class="record-title entry-subtitle"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" itemprop="inAlbum"><?php echo get_the_title( $post->post_parent ); ?></a></h3>
				</header>

				<?php
				$download_url = is_audiotheme_track_downloadable();
				$purchase_url = get_audiotheme_track_purchase_url();

				if ( $download_url || $purchase_url ) :
				?>
					<div class="record-links track-links">
						<h2><?php _e( 'Track Links', 'progeny-mmxv' ); ?></h2>
						<ul>
							<?php if ( $download_url ) : ?>
								<li>
									<a href="<?php echo esc_url( $download_url ); ?>" class="button" itemprop="url" target="_blank"><?php _e( 'Download', 'progeny-mmxv' ); ?></a>
								</li>
							<?php endif; ?>

							<?php if ( $purchase_url ) : ?>
								<li>
									<a href="<?php echo esc_url( $purchase_url ); ?>" class="button" itemprop="url" target="_blank"><?php _e( 'Purchase', 'progeny-mmxv' ); ?></a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="entry-content" itemprop="description">
					<?php the_content( '' ); ?>
				</div>

			</article>

		<?php endwhile; ?>

	</main>
</div>

<?php
get_footer();
