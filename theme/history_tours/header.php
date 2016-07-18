<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package History_Tours
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'history_tours' ); ?></a>
		
	
	<?php if( get_header_image() ){ ?>
		<header id="masthead" class="site-header <?php if( is_front_page() && is_home() ) echo 'home';?>" role="banner" style="background-image: url(<?php header_image(); ?>)">
	<?php } else { ;?>
		<header id="masthead" class="site-header <?php if( is_front_page() && is_home() ) echo 'home';?>" role="banner">
	<?php } ?>
		
				<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class=""><?php esc_html_e( 'Menu', 'history_tours' ); ?></span></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth'=>1 ) ); ?>
		</nav><!-- #site-navigation -->
	
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img id="network-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/ohc-vector.png" alt=""></a>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->


	</header><!-- #masthead -->

	<div id="content" class="site-content">
