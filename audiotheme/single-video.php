<?php
/**
 * The template for displaying a single video.
 *
 * @package Progeny_MMXV
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area single-video">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
				<?php if ( $thumbnail = get_post_thumbnail_id() ) : ?>
					<meta itemprop="thumbnailUrl" content="<?php echo esc_url( wp_get_attachment_url( $thumbnail, 'full' ) ); ?>">
				<?php endif; ?>

				<?php if ( $video_url = get_audiotheme_video_url() ) : ?>
					<meta itemprop="embedUrl" content="<?php echo esc_url( $video_url ); ?>">
					<figure class="entry-video">
						<?php the_audiotheme_video(); ?>
					</figure>
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
				</header>

				<div class="entry-content" itemprop="description">
					<?php the_content( '' ); ?>
				</div>
			</article>

		<?php endwhile; ?>

	</main>
</div>

<?php
get_footer();
