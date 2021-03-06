<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package History_Tours
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
						
			get_template_part( 'template-parts/content', get_post_format() );

			if (get_post_format() === 'post') the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( !get_post_format() === 'tour'  && (comments_open() || get_comments_number()) ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
