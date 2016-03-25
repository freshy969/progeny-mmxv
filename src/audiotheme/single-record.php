<?php
/**
 * The template for displaying a single record.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area single-record">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/MusicAlbum" role="article">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="record-artwork">
						<a class="post-thumbnail" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" itemprop="image">
							<?php the_post_thumbnail( 'record-thumbnail' ); ?>
						</a>
					</figure>
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>

					<?php if ( $artist = get_audiotheme_record_artist() ) : ?>
						<h2 class="entry-subtitle record-artist" itemprop="byArtist"><?php echo esc_html( $artist ); ?></h2>
					<?php endif; ?>

					<?php
					$year = get_audiotheme_record_release_year();
					$genre = get_audiotheme_record_genre();

					if ( $year || $genre ) :
					?>
						<ul class="entry-meta">
							<?php if ( $year ) : ?>
								<li class="record-release">
									<span class="screen-reader-text"><?php _e( 'Released', 'progeny-mmxv' ); ?></span>
									<span itemprop="dateCreated"><?php echo esc_html( $year ); ?></span>
								</li>
							<?php endif; ?>

							<?php if ( $genre ) : ?>
								<li class="record-genere">
									<span class="screen-reader-text"><?php _e( 'Genre', 'progeny-mmxv' ); ?></span>
									<span itemprop="genre"><?php echo esc_html( $genre ); ?></span>
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</header>

				<?php if ( $links = get_audiotheme_record_links() ) : ?>

					<div class="record-links">
						<h2><?php _e( 'Purchase', 'progeny-mmxv' ); ?></h2>
						<ul>
							<?php
							foreach( $links as $link ) {
								printf( '<li><a href="%s" class="button"%s itemprop="url">%s</a></li>',
									esc_url( $link['url'] ),
									( false === strpos( $link['url'], home_url() ) ) ? ' target="_blank"' : '',
									$link['name']
								);
							}
							?>
						</ul>
					</div>

				<?php endif; ?>

				<?php if ( $tracks = get_audiotheme_record_tracks() ) : ?>

					<div class="tracklist-section">
						<h2><?php _e( 'Track List', 'progeny-mmxv' ); ?></h2>
						<ol class="tracklist">
							<?php foreach ( $tracks as $track ) : ?>
								<li id="track-<?php echo absint( $track->ID ); ?>" class="track" itemprop="track" itemscope itemtype="http://schema.org/MusicRecording">
									<a href="<?php echo esc_url( get_permalink( $track->ID ) ); ?>" itemprop="url" class="track-title"><span itemprop="name"><?php echo get_the_title( $track->ID ); ?></span></a>

									<?php if ( $download_url = is_audiotheme_track_downloadable( $track->ID ) ) : ?>
										(<a href="<?php echo esc_url( $download_url ); ?>" class="track-download-link"><?php _e( 'Download', 'audiotheme' ); ?></a>)
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ol>
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
