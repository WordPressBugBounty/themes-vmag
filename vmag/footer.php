<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VMag
 */
?>

	</div><!-- #content -->
	<?php do_action( 'vmag_before_footer' ); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="vmag-container">
			<?php get_sidebar( 'footer' ); ?>
			<div class="site-info">
				<?php 
					$vmag_copyright_text = get_theme_mod( 'vmag_copyright_text');
					if( !empty( $vmag_copyright_text ) ) {
				?>
						<span class="copyright-text"><?php echo esc_html( $vmag_copyright_text ); ?></span>
					<?php }else{
						echo ('&copy; ' . date_i18n( 'Y' ) );
						} ?>
						<span class="sep"> | </span>
				<?php 
					$accesspress_url = 'https://accesspressthemes.com/wordpress-themes/vmag/';
					/* translators: %1$s : accesspress_url */
					printf( esc_html__( 'WordPress Theme %1$s','vmag' ), '<a href="' . esc_url( $accesspress_url ) . '" rel="designer">Vmag</a>' ); ?>
				<div class="clear"></div>
			</div><!-- .site-info -->

			<div class="footer-menu-wrapper">
				<nav id="footer-site-navigation" class="footer-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false  ) ); ?>
				</nav><!-- #site-navigation -->
			</div><!-- .footer-menu-wrapper -->
		</div>
	</footer><!-- #colophon -->
	<a href="#masthead" id="scroll-up"><i class="fa fa-sort-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
