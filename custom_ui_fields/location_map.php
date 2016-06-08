<?php wp_enqueue_script('googlemaps','https://maps.googleapis.com/maps/api/js?key='.constant("GOOGLE_MAPS_API_KEY").'&callback=initMap');?>
<br><hr> 
<p class="dashicons-before dashicons-location">&nbsp;<em>Enter a search term to change the map view. Click on the map to drop a pin on your exact location.</em></p>
<input id="location-search" name="location-search" placeholder="Enter a search term">
<input id="location-search-submit" class="wp-core-ui button" type="button" value="Get Coordinates">
<div id="map"></div>
  
<script>
	// Hide text input field
	jQuery('#location_coordinates_row').hide();
	
	var marker=null;
	function initMap() {
		
		var user_coords = '<?php echo str_replace(array('(',')'),"",get_post_meta( $post->ID, 'location_coordinates', true ));?>';
		user_coords = user_coords ? user_coords.split(',') : false;
		var default_lat = user_coords ? parseFloat(user_coords[0]) : <?php echo constant("MAP_DEFAULT_LAT");?>;
		var default_lon = user_coords ? parseFloat(user_coords[1]) :<?php echo constant("MAP_DEFAULT_LON");?>;
		var default_zoom = user_coords ? 16 : 6;
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: default_lat, lng: default_lon},
			scrollwheel: false,
			zoom: default_zoom
		});
		var geocoder = new google.maps.Geocoder();
		if(user_coords){
			marker = new google.maps.Marker({
				map: map,
				position: {lat: parseFloat(user_coords[0]), lng: parseFloat(user_coords[1])},
				draggable:true,
				animation: google.maps.Animation.DROP,
			});		
			google.maps.event.addListener(marker, 'dragend', function(evt){
				var new_location = '(' + evt.latLng.lat() + ',' + evt.latLng.lng() +')';
				console.log(new_location);
				jQuery('#location_coordinates').val(new_location);
			}); 				
		}		
		document.getElementById('location-search-submit').addEventListener('click', function() {
			geocodeAddress(geocoder, map);
		});  
	}
	function geocodeAddress(geocoder, map) {
		var address = document.getElementById('location-search').value;
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				map.setZoom(16);
				if(marker !== null){
					marker.setMap(null);
					marker = null;
				}
				marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					draggable:true,
					animation: google.maps.Animation.DROP,
				});
				jQuery('#location_coordinates').val(results[0].geometry.location);
				google.maps.event.addListener(marker, 'dragend', function(evt){
					var new_location = '(' + evt.latLng.lat() + ',' + evt.latLng.lng() +')';
					console.log(new_location);
					jQuery('#location_coordinates').val(new_location);
				});        
			} else {
			alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
</script>