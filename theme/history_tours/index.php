<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package History_Tours
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<div class="home-content">

			<?php if ( is_active_sidebar( 'homepage' ) ) : ?>
				<article>
					<?php dynamic_sidebar( 'homepage' ); ?>
				</article>
			<?php endif; ?>

		</div>	

		<?php 
			$args = array(
				'post_type' => 'tours', 
				);
			$loop = new WP_Query($args);			
			if($loop->have_posts()){
				 while($loop->have_posts()){
					 $loop->the_post(); 
					 $meta = get_post_meta(get_the_id(),null,true);
					 
					 if ( has_post_thumbnail() ) {
						 $url=wp_get_attachment_image_src(get_post_thumbnail_id(),'full',true);
						 $thumbURL=$url[0];
					 }else{
						 $thumbURL=null;
					 }
					 
					 $subtitle = isset($meta['tour_subtitle']) ? '<h2 class="subtitle">'.$meta['tour_subtitle'][0].'</h2>' : null;
					 $cta = isset($meta['tour_location_label']) ? $meta['tour_location_label'][0] : 'Take the Tour';
					 
					 ?>



				<div class="featured-tour" style="background: url(<?php echo $thumbURL;?>) center center no-repeat #000;background-size: cover;background-attachment: scroll;">
					<article>
						<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title();?></a></h1>
						<?php echo $subtitle;?>
						<a class="cta" href="<?php the_permalink() ?>"><?php echo $cta;?></a>
					</article>
				</div>	


				<?php }
			}else{ ?>
				<div class="featured-tour"><p>No tours found...</p></div>
			<?php }
			?>	

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
