<br><hr> 
<p class="dashicons-before dashicons-location">&nbsp;<em>Submit a search term to place a pin on the map. Drag the pin to adjust the exact location.</em></p>

<?php history_tours_admin_map_form($post,'location_coordinates');?>

<br><hr> 
<p class="dashicons-before dashicons-admin-media">&nbsp;<em>Drag Media Items from left to right to add to location. Drag up and down to change order.</em></p>

<?php history_tours_admin_object_picker($post,'attachment','location_media','Media Items','Location');?>