<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package allanahjohnson
 */

?>
	</div><!-- .content-wrapper -->

	<footer class="site-footer">
		<div class="container">
			<div class="site-footer__inner">
				<div class="site-footer__col">
					<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
				</div>
				<div class="site-footer__col">
					<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
				</div>
			</div>
			<span class="site-footer__copyright">
				<?php
				echo esc_html( '&copy; Copyright ' );
				echo esc_html( date( 'Y ' ) );
				echo esc_html( get_option( 'blogname' ) );
				echo esc_html( '. All Rights Reserved' );
				?>
			</span><!-- .site-copyright -->
		</div><!-- .container -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
