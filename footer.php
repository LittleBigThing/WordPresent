<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPresent
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<span class="site-design">
			<?php
				printf( esc_html__( 'Designed by %1$s from %2$s', 'wordpresent' ), '<a href="https://twitter.com/CsabaVarszegi">@CsabaVarszegi</a>', '<a href="https://littlebigthings.be">LittleBigThings</a>' );
			?>
			</span>
			<a href="<?php echo esc_url( __( 'https://codex.wordpress.org/Appearance_Customize_Screen', 'wordpresent' ) ); ?>"><?php
				printf( esc_html__( 'Proudly powered by %s', 'wordpresent' ), 'the WordPress Customizer' );
			?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
