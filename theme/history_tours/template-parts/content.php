<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package History_Tours
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php history_tours_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			if(get_the_excerpt() && is_singular('tours') && !is_singular('tour_locations') ) echo '<p class="excerpt">'.get_the_excerpt().'</p>';
			if ( has_post_thumbnail() && !is_singular('tour_locations')) the_post_thumbnail('full');
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'history_tours' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'history_tours' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	

	<footer class="entry-footer">
		<?php history_tours_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

