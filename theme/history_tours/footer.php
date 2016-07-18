<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package History_Tours
 */

?>

	</div><!-- #content -->
	
	

	<footer id="colophon" class="site-footer" role="contentinfo">

		<nav id="site-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'footer-menu','depth'=>1 ) ); ?>
		</nav><!-- #site-navigation -->
		
		<?php echo get_search_form( false );?>
		
		<div class="divider"></div>
		
		<div class="site-copyright">Brought to you by <a href="https://www.ohiohistory.org/">Ohio History Connection</a>, with support from the <a href="http://www.neh.gov/">National Endowment for the Humanities</a></div>
		
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
