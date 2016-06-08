<?php wp_enqueue_script('jquery-ui-selectable');?>
<br><hr> 
<p class="dashicons-before dashicons-location">&nbsp;<em>Drag locations from left to right to add to tour. Drag up and down to change order.</em></p>
<div class="location-picker"> 
   <div class="col addable">
	   <input class="col-input" id="location-filter" type="text" onkeyup="filterLocations(this)" placeholder="Filter locations by title...">
	   <ul id="left" class="connected_sortable">
			<?php
				$already_added = explode(',',get_post_meta( $post->ID, 'tour_locations', true )); 
				$type = 'tour_locations';
				$args = array(
					'post_type'=>$type,
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'post__not_in' => $already_added, /* omit posts that are already added to #right */
				);	
				$my_query = null;
				$my_query = new WP_Query($args);	
				if( $my_query->have_posts() ) {
				  while ($my_query->have_posts()) : $my_query->the_post(); ?>
				    <li class="location-item" id="<?php echo the_id();?>">
					    <div class="col thumb" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : null;?>)">
						</div>
					    <div class="col text"><h4><?php the_title(); ?></h4><?php the_excerpt();?></div>
				    </li>
				    <?php
				  endwhile;
				}else{ ?>
					<p class="no-locations">No published Locations found. <a href="/wp-admin/edit.php?post_type=tour_locations">Create one now</a>.</p>
				<?php }
				wp_reset_query();
			?>
	   </ul>
   </div>
   <div class="col added">
	   <ul id="right" class="connected_sortable">
		<?php
			$already_added = explode(',',get_post_meta( $post->ID, 'tour_locations', true )); 
			$type = 'tour_locations';
			$args = array(
				'post_type'=>$type,
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'post__in' => $already_added, /* include only posts that are already added to #right */
			);	
			$my_query = null;
			$my_query = new WP_Query($args);	
			if( $my_query->have_posts() ) {
			  while ($my_query->have_posts()) : $my_query->the_post(); ?>
			    <li class="location-item" id="<?php echo the_id();?>">
				    <div class="col thumb" style="background-image: url(<?php echo has_post_thumbnail() ? the_post_thumbnail_url() : null;?>)">
					</div>
				    <div class="col text"><h4><?php the_title(); ?></h4><?php the_excerpt();?></div>
			    </li>
			    <?php
			  endwhile;
			}else{ ?>
				<p class="no-locations">Drag Locations from left column to add to Tour.</p>
			<?php }
			wp_reset_query();
		?>
	   </ul>
   </div>
</div>
  
  
<script>
	// Hide text input field
	jQuery('#tour_locations_row').hide();
	
	// Create sortable columns
	jQuery(function() {
		jQuery( "#left, #right" ).sortable({
		  connectWith: ".connected_sortable",
		}).disableSelection();
	});
	// Update form field with location IDs when user updates right column
	jQuery( "#right" ).on( "sortreceive sortremove sortupdate", function( event, ui ) {
		var locations=Array();
		jQuery('#right li').each(function(index){
			locations.push(jQuery(this).attr('id'))
		});
		console.log(locations);
		jQuery('input#tour_locations').val(locations);
		
	});
	// Hide fallback message when a column recieves an item
	jQuery( "#right" ).on('sortreceive',function(event,ui){
		jQuery('#right .no-locations').remove(); 
	});
	jQuery( "#left" ).on('sortreceive',function(event,ui){
		jQuery('#left .no-locations').remove(); 
	});	
	// Filter form for left column
    function filterLocations(element) {
        var value = jQuery(element).val();
	    value = value.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	        return letter.toUpperCase();
	    });
        jQuery("#left > li").each(function() {
            if (jQuery(this).text().search(value) > -1) {
                jQuery(this).show();
            }
            else {
                jQuery(this).hide();
            }
        });
    }	
</script>