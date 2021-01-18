<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hamnportalen_tema
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
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hamnportalen_tema' ); ?></a>
		<header id="masthead" class="site-header">
		<div class="header-top-wrapper">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page()  ) :
						?>
					<!-- <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p> -->
					<?php

        else :
          ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					
				
				endif;
		
			  	?>
					<!-- <p class="site-description"><?php // echo $hamnportalen_tema_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p> -->
				<!-- <?php // endif; ?> -->
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				
				<!-- <img class="menu-toggle" src="<?php echo get_theme_file_uri('/assets/images/hamburger-menu.png'); ?>" alt="menu">  -->
				<button class="menu-toggle hamburger-menu" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '', 'hamnportalen_tema' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>

      	</nav><!-- #site-navigation -->
	  	</div>
	  	<?php if ( !is_front_page () ) : ?>
			<div class="bottom-header-wrapper">
				<?php echo do_shortcode("[hp_search_sc]"); ?>
			</div>
		<?php endif; ?>

	</header><!-- #masthead -->


<script>

	let menuButton = document.querySelector("button.menu-toggle")
	let links = document.querySelector(".menu")

	menuButton.addEventListener("click", () => {
		menuButton.classList.toggle("cancel-cross")
		let dropdown = document.querySelector("header.site-header")
		dropdown.classList.toggle("dropdown")
		links.classList.toggle("show-links")
	});

	const loginButton = document.querySelector('.menu-item:last-child a');
	loginButton.classList.add("secondary_btn")

	<?php if ( is_front_page()  ) :	?>
	
		let container = document.querySelector("div.site-branding").style.display = "none"
		
		const list = document.querySelectorAll('.menu-item:not(:last-child)');
		for (let li of list) {
			li.style.display = "none";
		}
		

		document.querySelector("div.header-top-wrapper").style.backgroundImage = "none";
	
		menuButton.style.display = "none";
		links.classList.add("show-links")
		let btn = document.querySelector(".secondary_btn")
		document.querySelector(".secondary_btn").classList.add("landingPageMobileButton")
		
		let header = document.querySelector("header.site-header")
		header.classList.add("landingPageHeader")

	<?php
		endif;
	?>
</script>