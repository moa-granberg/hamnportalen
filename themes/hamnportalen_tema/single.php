<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hamnportalen_tema
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php require_once(__DIR__ . '/template-parts/pages/port/port.php'); ?>
	</main>

<?php
get_sidebar();
get_footer();
