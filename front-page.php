<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package allanahjohnson
 */

get_header();
?>

	<div class="container">

		<main id="primary" class="site-main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

			$services = new WP_Query(
				array(
					'post_type'		 => 'service',
					'posts_per_page' => '3',
				)
			);

			if ( $services->have_posts() ) :
				while ( $services->have_posts() ) :
					$services->the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title mt-0">', '</h2>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php the_excerpt( '<p class="entry-excerpt">', '</p>' ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
					<?php
				endwhile;
			endif;
			?>

			<a href="<?php echo get_post_type_archive_link( 'service' ); ?>" class="site-button">
				<?php echo esc_html__( 'Explore My Services', 'allanahjohnson' ); ?>
			</a>

		</main><!-- #main -->

		<aside>
			<div class="bio">
			<?php
			$image_url = get_theme_mod( 'bio_image' );
			$image_id  = attachment_url_to_postid( $image_url );
			?>

			<?php if ( $image_url ) : ?>
				<img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'medium' ) ); ?>" alt="<?php echo get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>" class="bio__image">
			<?php else : ?>
				<span class="bio__image-placeholder"></span>
			<?php endif; ?>
				<h2 class="bio__heading h3">
					<?php echo esc_html__( get_theme_mod( 'bio_heading' ), 'allanahjohnson' ); ?>
				</h2>
				<p class="bio__intro">
					<?php echo esc_html__( get_theme_mod( 'bio_intro' ), 'allanahjohnson' ); ?>
				</p>
				<a href="<?php the_permalink( get_page_by_path( 'about-me' ) ); ?>" class="site-button">
					<?php echo esc_html__( 'More About Me', 'allanahjohnson' ); ?>
				</a>
			</div><!-- .bio -->
		</aside>

	</div><!-- .container -->

<?php
get_footer();
