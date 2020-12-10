<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hamnportalen_tema
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
      <div class="welcome">
      <h2><?php echo strtoupper(get_bloginfo('name')); ?></h2>
      <p><?php echo get_bloginfo('description'); ?></p>
      </div>
      <div class="follow">
      <h2>FÖLJ <?php echo strtoupper(get_bloginfo('name')); ?></h2>
      <div class="social-media">
	  <img src="./wp-content/themes/hamnportalen_tema/assets/images/instagram.png" alt="instagram"/>
	  <img src="./wp-content/themes/hamnportalen_tema/assets/images/facebook.png" alt="facebook"/>
	  <img src="./wp-content/themes/hamnportalen_tema/assets/images/youtube.png" alt="youtube"/>
    </div>
    </div>
    <div class="contact">
    <h2>KONTAKT</h2>
    <p>Båtmansgränd 24</p>
    <p>Box 23456</p>
    <p>23 987 Halland</p>
    </div>
			<!-- <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hamnportalen_tema' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'hamnportalen_tema' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'hamnportalen_tema' ), 'hamnportalen_tema', '<a href="http://underscores.me/">Den flygande holländaren</a>' );
				?> -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
