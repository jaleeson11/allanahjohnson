<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package allanahjohnson
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'allanahjohnson' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="custom-header">
			<?php
			$header_image = get_header_image();
			$default_image = get_template_directory_uri() . '/assets/images/custom-header-default.jpg';

			if ( ! empty( $header_image ) ) : ?>
			<div class="custom-header-image" style="background-image: url(<?php echo esc_url( $header_image ); ?>);"></div>
			<?php else : ?><!-- .custom-header-image -->
			<div class="custom-header-image" style="background-image: url(<?php echo esc_url( $default_image ); ?>);"></div>
			<?php endif; ?><!-- .custom-header-image -->
			
			<div class="site-branding">
				<div class="container">
					<?php
					the_custom_logo();
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$allanahjohnson_description = get_bloginfo( 'description', 'display' );
					if ( $allanahjohnson_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $allanahjohnson_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding -->
		</div><!-- .custom-header -->

		<nav id="site-navigation" class="main-navigation">
			<div class="container">
				<div class="main-navigation__inner">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'allanahjohnson' ); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
					<span class="dashicons dashicons-arrow-down-alt main-navigation__arrow"></span>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div class="content-wrapper">
