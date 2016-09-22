<?php
/*
Plugin Name: History Tours
Plugin URI: http://csudigitalhumanities.org
Description: Adds Tour and Location post types, as well as custom taxonomies and metadata fields for each.
Version: 0.9
Author: CSU Center for Public History + Digital Humanities 
Author URI: http://csudigitalhumanities.org
License: GPL2
*/

/*  
	Copyright 2016  CSU Center for Public History + Digital Humanities  (email : digitalhumanities@csuohio.edu)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Plugin settings
define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyDKA8gwbVUoZvaPFXOdOjD4JFOAQFVTub4' );
define( 'MAP_DEFAULT_LAT', '39.961176' );
define( 'MAP_DEFAULT_LON', '-82.998794' );
define( 'AUTO_FILTER_TITLES', true); // maybe disable for custom theme design
define( 'AUTO_FILTER_CONTENT', true ); // maybe disable for custom theme design 
define( 'WYSIWYG_TWEAKS', true ); // if true removes some annoying formatting buttons


// Define custom post types and taxonomies
add_action( 'init', 'tour_type_tax_init' );
function tour_type_tax_init() {

	// Custom Post Type: Tour
	register_post_type('tours', 
		array(	
		'label' => 'Tours',
		'labels' => array (
			'name' => 'Tours',
			'singular_name' => 'Tour',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Tour',
			'edit_item' => 'Edit Tour',
			'new_item' => 'New Tour',
			'view_item' => 'View Tour',
			'search_items' => 'Search Tours',
			'not_found' => 'No Tours Found',
			'not_found_in_trash' => 'No Tours Found in Trash',
			'parent_item_colon' => 'Parent Tour',
			'all_items' => 'All Tours',
			'archives' => 'Tour Archives',
			'insert_into_item' => 'Insert into Tour',
			'uploaded_to_this_item' => 'Uploaded to this Tour',
			'featured_image' => 'Tour Image',
			'set_featured_image' => 'Set Tour Image',
			'remove_featured_image' => 'Remove Tour Image',
			'use_featured_image' => 'Use as Tour Image',
			'menu_name' => 'Tours',
			'name_admin_bar' => 'Tour',
			/*
			'filter_items_list' => 'String for the table views hidden heading',
			'items_list_navigation' => 'String for the table pagination hidden heading',
			'items_list' => 'String for the table hidden heading',
			*/
			),	
		'description' => 'Tours for historic sites.',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-location-alt',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => ''),
		'query_var' => true,'has_archive' => true,
		'supports' => array('title','editor','thumbnail','author','excerpt','comments','revisions'),
		'taxonomies' => array('tour_types'),
		'has_archive' => true,
		'show_in_rest' => true,
		'rest_base' => 'tours',
		) 
	);
	
	// Custom Post Type: Location
	register_post_type('tour_locations', 
		array(	
		'label' => 'Locations',
		'labels' => array (
			'name' => 'Locations',
			'singular_name' => 'Location',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Location',
			'edit_item' => 'Edit Location',
			'new_item' => 'New Location',
			'view_item' => 'View Location',
			'search_items' => 'Search Locations',
			'not_found' => 'No Locations Found',
			'not_found_in_trash' => 'No Locations Found in Trash',
			'parent_item_colon' => 'Parent Location',
			'all_items' => 'All Locations',
			'archives' => 'Location Archives',
			'insert_into_item' => 'Insert into Location',
			'uploaded_to_this_item' => 'Uploaded to this Location',
			'featured_image' => 'Location Image',
			'set_featured_image' => 'Set Location Image',
			'remove_featured_image' => 'Remove Location Image',
			'use_featured_image' => 'Use as Location Image',
			'menu_name' => 'Locations',
			'name_admin_bar' => 'Location',
			/*
			'filter_items_list' => 'String for the table views hidden heading',
			'items_list_navigation' => 'String for the table pagination hidden heading',
			'items_list' => 'String for the table hidden heading',
			*/
			),	
		'description' => 'Locations for use in historic site Tours.',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-location',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => ''),
		'query_var' => true,'has_archive' => true,
		'supports' => array('title','editor','thumbnail','author','excerpt','comments','revisions'),
		'taxonomies' => array('location_types'),
		'has_archive' => false,
		'show_in_rest' => true,
		'rest_base' => 'tour-locations',
		) 
	);	
	
	// Custom Taxonomy: Tour Types
	register_taxonomy('tour_types',
		'tours',
		array( 
			'hierarchical' => false, 
			'label' => 'Tour Types',
			'labels' => array(
				'menu_name' => 'Tour Types',
				'add_new_item' => 'Add New Type',
				'separate_items_with_commas' => 'Separate types with commas',
				'choose_from_most_used' => 'Choose from most used types',
				'add_or_remove_items' => 'Add or Remove Types',
				'not_found' => 'No Tour Types Found',
				'search_items' => 'Search Types',
				'all_items' => 'All Types',
				'update_item' => 'Update Type',
				),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'tour-type'),
			'singular_label' => 'Tour Type',
			) 
	);
	
	// Custom Taxonomy: Location Types
	register_taxonomy('location_types',
		'tour_locations',
		array( 
			'hierarchical' => false, 
			'label' => 'Location Types',
			'labels' => array(
				'menu_name' => 'Location Types',
				'add_new_item' => 'Add New Type',
				'separate_items_with_commas' => 'Separate types with commas',
				'choose_from_most_used' => 'Choose from most used types',
				'add_or_remove_items' => 'Add or Remove Types',
				'not_found' => 'No Location Types Found',
				'search_items' => 'Search Types',
				'all_items' => 'All Types',
				'update_item' => 'Update Type',
				),			
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'location-type'),
			'singular_label' => 'Location Type'
			) 
	);	
}
function tour_register_and_rewrite_flush() {
    tour_type_tax_init();
    flush_rewrite_rules();
}
// Register the post type and flush rewrite rules
register_activation_hook( __FILE__, 'tour_register_and_rewrite_flush' );


// Custom Metaboxes
class History_Tours_Meta_Box {
		

	public function __construct($post_type, $metabox_title, $fields, $appendFile) {
		
		$this->post_type = $post_type ? $post_type : null;
		$this->fields = $fields ? $fields : array();
		$this->metabox_title = $metabox_title ? $metabox_title : 'Custom Metabox';
		$this->appendFile = $appendFile ? $appendFile : false;

		add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
		add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );

	}
	

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {
		
		add_meta_box(
			$this->post_type.'_id',
			$this->metabox_title,
			array( $this, 'render_metabox' ),
			$this->post_type,
			'normal',
			'high'
		);

	}

	public function render_metabox( $post ) {


		// Add nonce for security and authentication.
		$nonce_action = $this->post_type.'_nonce_action';
		$nonce_name = $this->post_type.'_nonce';
		wp_nonce_field( $nonce_action, $nonce_name );
		
		
		$html = null;
		foreach($this->fields as $field){
			
			$value = get_post_meta( $post->ID, $field['name'], true );
			if( empty( $value ) ) $value = '';
			
			$html .= '<tr id="'.$field['name'].'_row" '.( $field['custom_ui'] ? 'class="custom_ui"' : null ).'>';
			switch ($field['type']) {
			    case 'text':
			        $html .= '<th>'.
			        '<label for="'.$field['name'].'" class="'.$field['name'].'_label">'.$field['label'].'</label>'.
			        '</th><td>'.
			        '<input type="text" id="'.$field['name'].'" name="'.$field['name'].'" class="'.$field['name'].'_field"'. 
			        	'placeholder="" value="' . $value. '"><br><span class="description">'.$field['helper'].'</span></td>';
			        continue 2;
			    case 'select':
			    	$options = $field['options'];
			    	if( count($options) > 0 ){
				    	$options_html=null;
				    	foreach($options as $option){
					    	$options_html .= '<option value="'.$option['name'].'" ' . selected( $value, $option['name'], false ) . '> '.$option['label'].'</option>';
				    	}
				        $html .= '<th>'.
				        '<label for="'.$field['name'].'" class="'.$field['name'].'_label">'.$field['label'].'</label>'.
				        '</th><td>'.
				        '<select id="'.$field['name'].'" name="'.$field['name'].'" class="'.$field['name'].'_field">'.$options_html.'</select><br><span class="description">'.$field['helper'].'</span></td>';			    	
			    	}
			        continue 2;
			    case 'checkbox':
			        $html .= '<th>'.
			        '<label for="'.$field['name'].'" class="'.$field['name'].'_label">'.$field['label'].'</label>'.
			        '</th><td>'.
			        '<input type="checkbox" id="'.$field['name'].'" name="'.$field['name'].'" class="'.$field['name'].'_field"'.
			        	'value="' . $value . '" ' . checked( $value, 'checked', false ) . '>'.
			        	'<span class="description">'.$field['helper'].'</span></td>';
			        continue 2;
			}
			$html .= '</tr>';

		}
		
		// Form fields.
		echo '<table class="form-table">'.$html.'</table>';
		
		// Include external file for any fields requiring a custom UI
		if($this->appendFile){
			include $this->appendFile;
		}

	}

	public function save_metabox( $post_id, $post ) {

		// Nonce for security and authentication
		$nonce_name   = isset($_POST[$this->post_type.'_nonce']) ? $_POST[$this->post_type.'_nonce'] : null;
		$nonce_action = $this->post_type.'_nonce_action';

		// Nonce is set
		if ( ! isset( $nonce_name ) )
			return;

		// Nonce is valid
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// User has permissions 
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Not an autosave
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Not a revision
		if ( wp_is_post_revision( $post_id ) )
			return;

		// Sanitize user input and update database		
		foreach($this->fields as $field){
			switch ($field['type']) {
			    case 'text':
			    $new = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
			    update_post_meta( $post_id, $field['name'], $new );
			    continue 2;

			    case 'select':
			    $new = isset( $_POST[ $field['name'] ] ) ? $_POST[ $field['name'] ] : '';
			    update_post_meta( $post_id, $field['name'], $new );
			    continue 2;

			    case 'checkbox':
			    $new = isset( $_POST[ $field['name'] ] ) ? 'checked' : '';
			    update_post_meta( $post_id, $field['name'], $new );
			    continue 2;			    			    
			}

		}
	}

}
// Tour Info Fields
$tourFields = array(
	array(
		'label'		=> 'Tour Subtitle',
		'name'		=> 'tour_subtitle',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> false,
		'helper'	=> 'Enter a subtitle for the tour.'
		),
	array(
		'label'		=> 'Map this Tour',
		'name'		=> 'map_this_tour',
		'type'		=> 'checkbox',
		'options'	=> null,
		'custom_ui'	=> false,
		'helper'	=> 'Check this box to create a map of locations for this tour. (All tour locations must have geocoordinate data)'
		),
	array(
		'label'		=> 'Custom Label for Locations',
		'name'		=> 'tour_location_label',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> false,
		'helper'	=> 'Enter a custom label for the tour locations. Default: "Locations for this Tour"'
		),		
	array(
		'label'		=> 'Tour Locations',
		'name'		=> 'tour_locations',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> true, // this hidden form field will save Location post IDs as an ordered array
		'helper'	=> 'Choose locations for this tour. You can <a href="/wp-admin/edit.php?post_type=tour_locations">add and edit Locations here</a>.'
		),		
);

// Location Info Fields
$locationFields = array(
	array(
		'label'		=> 'Location Subtitle',
		'name'		=> 'location_subtitle',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> false,
		'helper'	=> 'Enter a subtitle for the location.'
		),
	array(
		'label'		=> 'Location Display Template',
		'name'		=> 'location_template',
		'type'		=> 'select',
		'options'	=> array(
						array('label'=>'Grid-based gallery of images','name'=>'grid'),
						array('label'=>'List with text excerpts and thumbnail images','name'=>'list'),
						array('label'=>'Slideshow','name'=>'slides'),
						array('label'=>'None (show media items on separate Location page)','name'=>'none'),
						),
		'custom_ui'	=> false,				
		'helper'	=> 'Select how to display tour locations.'
		),		
	array(
		'label'		=> 'Physical Location',
		'name'		=> 'location_address',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> false,
		'helper'	=> 'Enter a street address, gallery name, or other brief text to help users with navigation.'
		),
	array(
		'label'		=> 'Map Coordinates',
		'name'		=> 'location_coordinates',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> true, // this hidden form field will save coordinates as an array
		'helper'	=> 'Use the map to add geo-coordinates for this location.'
		),	
	array(
		'label'		=> 'Media Items',
		'name'		=> 'location_media',
		'type'		=> 'text',
		'options'	=> null,
		'custom_ui'	=> true, // this hidden form field will save attachment IDs as an array
		'helper'	=> 'Choose media attachments for this tour. You can <a href="/wp-admin/upload.php">add and edit Media files here</a>.'
		),				
);

// Init metaboxes
if(is_admin()){
	new History_Tours_Meta_Box('tours','Tour Details',$tourFields,'custom_ui_fields/tours.php');
	new History_Tours_Meta_Box('tour_locations','Location Info',$locationFields,'custom_ui_fields/tour_locations.php');	
}

// Add counts to Dashboard
add_action( 'dashboard_glance_items' , 'history_tours_at_a_glance' );
function history_tours_at_a_glance(){
    $args = array(
        'public' => true ,
        '_builtin' => false
    );
    $post_types = get_post_types( $args , 'object' , 'and' );
    foreach( $post_types as $post_type ) {
        $count = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $count->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $count->publish ) );
        if ( current_user_can( 'edit_posts' ) ) {
            $type_name = $post_type->name;
        }
        echo '<li class="'.$type_name.'-count"><tr><a href="edit.php?post_type='.$type_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . ' <td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
    }

}


// Admin stylesheet 
add_action( 'admin_enqueue_scripts', 'history_tours_admin_css' );
function history_tours_admin_css(){
        wp_register_style( 'history_tours_admin_css', plugin_dir_url( __FILE__ ) . 'styles/admin.css');
        wp_enqueue_style( 'history_tours_admin_css' );	
}

// Public stylesheet 
add_action( 'wp_enqueue_scripts', 'history_tours_public_css' );
function history_tours_public_css(){
        wp_register_style( 'history_tours_public_css', plugin_dir_url( __FILE__ ) . 'styles/public.css');
        wp_enqueue_style( 'history_tours_public_css' );	
}


// Adds filter to the_title() so that Tour and Location subtitles are displayed automatically in tour posts
if(constant("AUTO_FILTER_TITLES")){
	add_filter( 'the_title', 'append_to_tour_and_location_title', 20 );
}
function append_to_tour_and_location_title($title){
	if ( is_singular('tours') || is_singular('tour_locations') ){
		$post = $GLOBALS['post'];
		$meta = get_post_meta($post->ID,null,true);
		if($title== $post->post_title && in_the_loop() && !is_page() && isset($meta['tour_subtitle']) && strlen($meta['tour_subtitle'][0])){ 
			// Tour Subtitle
			return $title.'&nbsp;<br><span class="subtitle">'.$meta['tour_subtitle'][0].'</span>';
		}elseif($title== $post->post_title && in_the_loop() && !is_page() && isset($meta['location_subtitle']) && strlen($meta['location_subtitle'][0])){ 
			// Location Subtitle
			return $title.'&nbsp;<br><span class="subtitle">'.$meta['location_subtitle'][0].'</span>';
		}else{
			return $title;
		}
	}else{
		return $title;
	}
}

// Adds filter to the_content() so that custom content is displayed automatically in tour/location posts
if(constant("AUTO_FILTER_CONTENT")){
	add_filter( 'the_content', 'history_tours_append_custom_content', 1 );
}
function history_tours_append_custom_content($content){
	if ( is_singular('tours') || is_singular('tour_locations') ){
		$html = null;
		$post = $GLOBALS['post'];
		$meta = get_post_meta($post->ID,null,true);
		
		if(is_singular('tours')){
			// Tour meta
			$map_this = isset($meta['map_this_tour']) && $meta['map_this_tour'][0]=='checked';
			$template = isset($meta['tour_template']) ? $meta['tour_template'] : null;
			$location_string = isset($meta['tour_locations']) ? $meta['tour_locations'][0] : null;
			$location_array = $location_string ? explode(',',$location_string) : false;			
		}
		
		if(is_singular('tour_locations')){
			// Location meta
			$physical_location = (isset($meta['location_address']) && strlen($meta['location_address'][0])) ? '<div style="margin:1em 0;"><strong>Location</strong>: <span><em>'.$meta['location_address'][0].'</em></span></div>' : null;
			$script_data = isset($meta['location_coordinates']) ? $meta['location_coordinates'][0] : null;
			$coords_raw = isset($meta['location_coordinates']) ? $meta['location_coordinates'][0] : null;
			$title = $post->post_title;
			if($coords_raw){
				// Construct data array for map script	
				$script_data = [];
				$script_data[] = process_marker_coords($coords_raw,$title);	
			}
			$html .= $physical_location;	
			
			$media_string = isset($meta['location_media']) ? $meta['location_media'][0] : null;
			$media_array = $media_string ? explode(',',$media_string) : false;	
				
		}
		

		
		// Content
		$html .= $content;


		// Tour Map
		if(is_singular('tours') && $map_this && $location_array){
			$html .= '<div id="history-tours-map">'.history_tours_tour_map($location_array).'</div>';
		}		
		
		// Media Items for Location
		if(is_singular('tour_locations') && $media_array){
			$html .= '<section><div id="location-media">';
			$html .= history_tours_media_items($media_array);
			$html .= '<div></section>';
		}
		
		// Location Map and Meta
		if(is_singular('tour_locations') && $script_data){
			$html.=history_tours_map_setup();
			$html.='<div id="history-tours-map">'.history_tours_map_script($script_data).'</div>';
			$html.=history_tours_inline_terms($post->ID,'location_types',"<strong>Type</strong>: ");
		}
		
		// Tour Locations
		if(is_singular('tours') && $location_array){
			$heading = (isset($meta['tour_location_label']) && strlen($meta['tour_location_label'][0])) ? '<h3>'.$meta['tour_location_label'][0].'</h3>' : '<h3>Locations for this Tour</h3>';
			$html .= '<div id="history-tours-locations">'.history_tours_tour_locations($location_array,$heading).'</div>';	
		}
		
		return $html;
	}else{
		return $content;
	}
}

// Tour map
function history_tours_tour_map($location_array){
	$html=history_tours_map_setup();
	$script_data=[];
	foreach($location_array as $loc){
		$post = get_post($loc);
		$meta = get_post_meta($loc,null,true);
		$coords_raw = isset($meta['location_coordinates']) ? $meta['location_coordinates'][0] : null;
		$title = $post->post_title;
		if($coords_raw){
			// Construct data array for map script	
			$script_data[] = process_marker_coords($coords_raw,$title);
		}

	}
	return $html.history_tours_map_script($script_data);
}

function history_tours_map_script($script_data){
	?>
	<script>
		var data = <?php echo json_encode($script_data);?>;

		function initMap(){
			var markers = [];
			var bounds = new google.maps.LatLngBounds();			
			var default_lat = <?php echo constant("MAP_DEFAULT_LAT");?>;
			var default_lon = <?php echo constant("MAP_DEFAULT_LON");?>;
			var default_zoom = 4;
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: default_lat, lng: default_lon},
				scrollwheel: false,
				zoom: default_zoom
			});
			data.forEach(function(location,i){
				var contentString = '<div id="content"><a href="#'+location.anchor+'">'+location.title+'</a></div>';
		        var infowindow = new google.maps.InfoWindow({
		          content: contentString
		        });				
				markers[i] = new google.maps.Marker({
					title: location.title,
					map: map,
					position: {lat: parseFloat(location.lat), lng: parseFloat(location.lon)},
					animation: google.maps.Animation.DROP,
				});	
				bounds.extend(markers[i].getPosition());	
		        markers[i].addListener('click', function() {
		          infowindow.open(map, markers[i]);
		        });							
			});
			if(data.length > 1){
				 map.fitBounds(bounds);
			}else{
				map.setCenter(markers[0].getPosition());
			}
	
			
		}
	</script>
	<?php
}

// Media 
function history_tours_media_items($media_array){
	$html=null;
	foreach($media_array as $media_id){
		$media_meta = wp_prepare_attachment_for_js($media_id);
		$media_title = isset($media_meta['title']) ? $media_meta['title'] : null;
		$media_caption = isset($media_meta['caption']) ? $media_meta['caption'] : null;
		$media_description = isset($media_meta['description']) ? $media_meta['description'] : null;
		$media_alt = isset($media_meta['alt']) ? $media_meta['alt'] : ' ';
		$media_link = $media_meta['link'];
		$media_url = $media_meta['url'];
		
		$html.= '<h4 id="'.urlencode($media_title).'"><a href="'.$media_link.'">'.$media_title.'</a></h4>';
		$html.= '<img src="'.$media_url.'" alt="'.$media_alt.'" style="max-width:100%;">';
		$html.= $media_caption ? '<div class="entry-caption"><p>'.$media_caption.'</p></div>' : null;
		$html.= $media_description ? '<p>'.$media_description.'</p>' : null;
	}
	return $html;	
}
// @layout = grid,slides,list
function history_tours_media_items_layout($media_array,$layout,$locationID){
	
	wp_register_script('swipe',plugin_dir_url( __FILE__ ) .'/scripts/swipe/swipe.js');
	wp_register_script('fancybox',plugin_dir_url( __FILE__ ) .'/scripts/fancybox/source/jquery.fancybox.pack.js');
	wp_register_script('fancybox_thumbs',plugin_dir_url( __FILE__ ) .'/scripts/fancybox/source/helpers/jquery.fancybox-thumbs.js');
	wp_register_script('tour',plugin_dir_url( __FILE__ ) .'/scripts/tour.js',array('jquery','swipe','fancybox','fancybox_thumbs'));
	
	$html='<div id="tour-location-media" class="'.$layout.'  location-'.$locationID.'">';
	
	if($layout==='slides'){
		
		$html.='<div id="slider" class="swipe"><div class="swipe-wrap">';
	}
	
	
	foreach($media_array as $media_id){
		
		$media_meta = wp_prepare_attachment_for_js($media_id);
		$media_title = isset($media_meta['title']) ? $media_meta['title'] : null;
		$media_caption = isset($media_meta['caption']) ? $media_meta['caption'] : null;
		$media_description = isset($media_meta['description']) ? '<span class="description">'.$media_meta['description'].'</span>' : null;
		$media_alt = isset($media_meta['alt']) ? $media_meta['alt'] : ' ';
		$media_link = $media_meta['link'];
		$media_url = $media_meta['url'];
		$fancybox_caption='<strong>'.$media_title.'</strong>: '.$media_description.'<a target="_blank" href="'.$media_link.'" class="view-more">View Details</a>';
		
		if($layout === 'grid'){
			// Grid item
			$html.= '<a href="'.$media_url.'" title="'.$media_title.'" class="item fancybox" style="background-image: url('.$media_url.');" data-caption="'.htmlspecialchars($fancybox_caption).'" rel="location-'.$locationID.'"></a>';
		}elseif($layout === 'list'){
			// List item
			$html.='<div>';
				$html.='<div class="col"><a class="fancybox" href="'.$media_url.'" title="'.$media_title.'" style="background-image: url('.$media_url.');" data-caption="'.htmlspecialchars($fancybox_caption).'" rel="location-'.$locationID.'"></a></div>';
				$html .='<div class="col">';
					$html .= '<a href="'.$media_meta['link'].'"><strong>'.$media_title.'</strong></a>';
					$html .= '<p>'.$media_description.'</p>';
				$html .='</div>';
			$html .='</div>';
			
		}elseif($layout === 'slides'){
			// Slide item
			$html.= '<div><a class="slide-item fancybox" style="background-image: url('.$media_url.');" href="'.$media_url.'" data-caption="'.htmlspecialchars($fancybox_caption).'" rel="location-'.$locationID.'" title="'.$media_title.'">';
			$html.='<div class="slide-detail"><span class="title">'.$media_title.'</span></div>';
			$html.='</a></div>';
		}
	}
	
	
	if($layout === 'grid'){
		// add an empty item to prevent CSS flex stretching/spacing issues
		$html.='<span class="hidden item"></span>'; 
		}
		
	if($layout==='slides'){
		$html.='</div></div>';
		$html.= '<div><button class="swipe-left" onclick="mySwipe.prev()">Previous</button><button class="swipe-right" onclick="mySwipe.next()">Next</button></div>';
	}	
		
	$html.='</div>';
	wp_enqueue_script('tour');
	return $html;	
}

// Tour Locations
function history_tours_tour_locations($location_array,$heading){
	$html = $heading;
	foreach($location_array as $loc){
		$post = get_post($loc);
		$meta = get_post_meta($loc,null,true);
		$layout = isset($meta['location_template']) ? $meta['location_template'][0] : 'grid';
		$title = $post->post_title;
		$subtitle = (isset($meta['location_subtitle']) && strlen($meta['location_subtitle'][0])) ? '&nbsp;<br><span class="subtitle">'.$meta['location_subtitle'][0].'</span>' : null;
		$physical_location = (isset($meta['location_address']) && strlen($meta['location_address'][0])) ? '<div style="margin:1em 0;"><strong>Location</strong>: <span><em>'.$meta['location_address'][0].'</em></span></div>' : null;	
		$imgURL = isset($meta['_thumbnail_id'][0]) ? wp_get_attachment_image_src($meta['_thumbnail_id'][0],'post-thumbnail',true) : false;	
		$img = $imgURL ? '<div><img src="'.$imgURL[0].'"></div>' : null;
		
		$html .= '<h4 id="'.urlencode($title).'">'.'<a href="'.$post->guid.'">'.$title.'</a>'.$subtitle.'</h4>';
		$html .= $img.$physical_location;
		$html .= wpautop($post->post_content);
		//$html .= ' <a href="'.$post->guid.'" class="read-more-button">Permalink</a>';
			
		$media_string = isset($meta['location_media']) ? $meta['location_media'][0] : null;
		$media_array = $media_string ? explode(',',$media_string) : false;
		$html .= $media_array ? history_tours_media_items_layout($media_array,$layout,$post->ID) : null;
	}
	return '<section>'.$html.'</section>';
}

// Custom Taxonomies for inline use
function history_tours_inline_terms($id,$term_name,$heading) {
	$html = $heading;
	$tags_list = get_the_term_list($id,$term_name,'',', ');
	return strlen($tags_list) ? '<div class="location-meta" style="margin-top:.25em;">'.$html.$tags_list.'</div>' : null;
}

// Map Marker array helpers
function process_marker_coords($coords_raw,$title){
		$coords=explode(',',str_replace(array('(',')'),"",$coords_raw));
		$script_data = array(
				'title'=>$title,
				'anchor'=>urlencode($title),
				'lat'=>$coords[0],
				'lon'=>$coords[1],
			);	
		return $script_data;
}
// Builds HTML container for map and queues up the Google Maps API
function history_tours_map_setup(){
	$html = '<figure><div id="map" style="width:100%;height:20em;background:#eaeaea;margin-bottom:1em;"></div></figure>';
	$api = wp_enqueue_script('googlemaps',
	'https://maps.googleapis.com/maps/api/js?key='.constant("GOOGLE_MAPS_API_KEY").'&callback=initMap');			
	return $api.$html;
}

// Admin Object Picker
function history_tours_admin_object_picker($post,$type,$field,$label_from,$label_to){ 
	wp_enqueue_script('jquery-ui-selectable')
	?>
	<div class="history-tours-object-picker"> 
	   <div class="col addable">
		   <input class="col-input" id="location-filter" type="text" onkeyup="filterLocations(this)" placeholder="Filter <?php echo $label_from;?> by title...">
		   <ul id="left" class="connected_sortable">
				<?php
					$already_added = explode(',',get_post_meta( $post->ID, $field, true )); 
					if($type == 'attachment'){
						$args = array(
							'post_type'=>$type,
							'post_status' => 'any',
							'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png',
							'posts_per_page' => -1,
							'post__not_in' => $already_added, /* omit posts that are already added to #right */
						);													
					}else{
						$args = array(
							'post_type'=>$type,
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'post__not_in' => $already_added, /* omit posts that are already added to #right */
						);							
					}
					$my_query = null;
					$my_query = new WP_Query($args);	
					if( $my_query->have_posts() ) {
					  while ($my_query->have_posts()) : $my_query->the_post(); ?>
					    <li class="object-item" id="<?php echo the_id();?>">
					    	<?php 
						    	if($type == 'attachment'){
							    	$img_url = wp_get_attachment_url();
						    	}else{
							    	$img_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : null;
						    	}
						    ?>
						    <div class="col thumb" style="background-image: url(<?php echo $img_url;?>)">
							</div>
						    <div class="col text"><h4><?php the_title(); ?></h4><?php the_excerpt();?></div>
					    </li>
					    <?php
					  endwhile;
					}else{ ?>
						<p class="no-objects">No <?php echo ($type !== 'attachment' ? 'published ' : null).$label_from;?> found. <a href="/wp-admin/edit.php?post_type=<?php echo $type;?>">Add some now</a>.</p>
					<?php }
					wp_reset_query();
				?>
		   </ul>
	   </div>
	   <div class="col added">
		   <ul id="right" class="connected_sortable">
			<?php
				$already_added = explode(',',get_post_meta( $post->ID, $field, true )); 
				if($type == 'attachment'){
					$args = array(
						'post_type'=>$type,
						'post_status' => 'any',
						'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png',
						'orderby' => 'post__in',
						'post__in' => $already_added, /* include only posts that are already added to #right */
					);													
				}else{
					$args = array(
						'post_type'=>$type,
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'post__in',
						'post__in' => $already_added, /* include only posts that are already added to #right */
					);					
				}
				$my_query = null;
				$my_query = new WP_Query($args);	
				if( $my_query->have_posts() ) {
				  while ($my_query->have_posts()) : $my_query->the_post(); ?>
				    <li class="object-item" id="<?php echo the_id();?>">
				    	<?php 
					    	if($type == 'attachment'){
						    	$img_url = wp_get_attachment_url();
					    	}else{
						    	$img_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : null;
					    	}
					    ?>				    
					    <div class="col thumb" style="background-image: url(<?php echo $img_url;?>)">
						</div>
					    <div class="col text"><h4><?php the_title(); ?></h4><?php the_excerpt();?></div>
				    </li>
				    <?php
				  endwhile;
				}else{ ?>
					<p class="no-objects">Drag <?php echo $label_from;?> from left column to add to <?php echo $label_to;?>.</p>
				<?php }
				wp_reset_query();
			?>
		   </ul>
	   </div>
	</div>	
	<script>
		// Hide text input field
		jQuery('#<?php echo $field;?>_row').hide();
		
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
			jQuery('input#<?php echo $field;?>').val(locations);
			
		});
		// Hide fallback message when a column recieves an item
		jQuery( "#right" ).on('sortreceive',function(event,ui){
			jQuery('#right .no-objects').remove(); 
		});
		jQuery( "#left" ).on('sortreceive',function(event,ui){
			jQuery('#left .no-objects').remove(); 
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
<?php }


// Admin Map Form	
function history_tours_admin_map_form($post,$field){ 
	wp_enqueue_script('googlemaps',
	'https://maps.googleapis.com/maps/api/js?key='.constant("GOOGLE_MAPS_API_KEY").'&callback=initMap')
	?>
	<div id="admin-map-form">
		<input id="location-search" name="location-search" placeholder="Enter a search term">
		<input id="location-search-submit" class="wp-core-ui button" type="button" value="Get Coordinates">
		<div id="map"></div>
		<a href="#" id="clear_<?php echo $field;?>" class="hidden wp-core-ui button">Clear Map Coordinates</a>
	</div>
	<script>
		// Hide text input field
		jQuery('#<?php echo $field;?>_row').hide();
		
		var marker=null;
		function initMap() {
			
			var user_coords = '<?php echo str_replace(array('(',')'),"",get_post_meta( $post->ID, $field, true ));?>';
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
					jQuery('#<?php echo $field;?>').val(new_location);
				}); 
				jQuery('#clear_<?php echo $field;?>').removeClass('hidden');				
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
					jQuery('#<?php echo $field;?>').val(results[0].geometry.location);
					google.maps.event.addListener(marker, 'dragend', function(evt){
						var new_location = '(' + evt.latLng.lat() + ',' + evt.latLng.lng() +')';
						jQuery('#<?php echo $field;?>').val(new_location);
					});   
					jQuery('#clear_<?php echo $field;?>').removeClass('hidden');     
				} else {
				alert('Geocode was not successful for the following reason: ' + status);
				}
			});
		}
		
		// Button: Clear Map Coordinates 
		jQuery('#clear_<?php echo $field;?>').on('click',function(){
			marker.setMap(null);
			jQuery('#<?php echo $field;?>').val(null);	
			return false;			
		})		
	</script>	
<?php }	
	
// Admin WYSIWYG tweaks
if(constant("WYSIWYG_TWEAKS")){
	add_filter("mce_buttons", "edit_wysiwyg_buttons_line1", 0);
	add_filter("mce_buttons_2", "edit_wysiwyg_buttons_line2", 0);	
}
function edit_wysiwyg_buttons_line1($buttons) {

	//Remove these from first line
	$removable = array('alignleft','alignright','aligncenter');
	
	foreach($removable as $remove){
	  if ( ( $key = array_search($remove,$buttons) ) !== false )
	  unset($buttons[$key]);      
	}
	return $buttons;		

}
function edit_wysiwyg_buttons_line2($buttons) {
     
      //Remove these from second line
      $removable = array('forecolor','alignjustify');
      
      foreach($removable as $remove){
	      if ( ( $key = array_search($remove,$buttons) ) !== false )
		  unset($buttons[$key]);      
      }
      return $buttons;
}	