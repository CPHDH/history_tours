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

// This should maybe be a user-set plugin option?
define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyDKA8gwbVUoZvaPFXOdOjD4JFOAQFVTub4' );
define( 'MAP_DEFAULT_LAT', '39.961176' );
define( 'MAP_DEFAULT_LON', '-82.998794' );

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


// WYSIWYG tweaks
add_filter("mce_buttons", "edit_wysiwyg_buttons_line1", 0);
add_filter("mce_buttons_2", "edit_wysiwyg_buttons_line2", 0);
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
			
			$html .= '<tr id="'.$field['name'].'_row">';
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
		'label'		=> 'Tour Template',
		'name'		=> 'tour_template',
		'type'		=> 'select',
		'options'	=> array(
						array('label'=>'Inline','name'=>'all'),
						array('label'=>'Grid of images – open locations in lightbox','name'=>'grid'),
						array('label'=>'Grid of images – link to individual location pages','name'=>'grid_linked'),
						array('label'=>'List of links','name'=>'links'),
						array('label'=>'List of links – with text excerpts','name'=>'links_text'),
						array('label'=>'List of links – with text excerpts and thumbnail images','name'=>'links_text_thumbnails'),
						array('label'=>'Slideshow – open locations in lightbox','name'=>'slides'),
						array('label'=>'Slideshow – link to individual location pages','name'=>'slides_linked'),
						),
		'custom_ui'	=> false,				
		'helper'	=> 'Select how to display tour locations.'
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
);

// Init metaboxes
if(is_admin()){
	new History_Tours_Meta_Box('tours','Tour Details',$tourFields,'custom_ui_fields/location_picker.php');
	new History_Tours_Meta_Box('tour_locations','Location Info',$locationFields,'custom_ui_fields/location_map.php');	
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
// Adds filter to the_title() so that Tour and Location subtitles are displayed automatically in tour posts
add_filter( 'the_title', 'append_to_tour_and_location_title', 20 );
function append_to_tour_and_location_title($title){
	if ( is_singular('tours') || is_singular('tour_locations') ){
		$post = $GLOBALS['post'];
		$meta = get_post_meta($post->ID,null,true);
		if(is_singular('tours') && isset($meta['tour_subtitle']) && strlen($meta['tour_subtitle'][0])){ 
			// Tour Subtitle
			return $title.'&nbsp;<br><span style="font-size: .8em;">'.$meta['tour_subtitle'][0].'</span>';
		}elseif(is_singular('tour_locations') && isset($meta['location_subtitle']) && strlen($meta['location_subtitle'][0])){ 
			// Location Subtitle
			return $title.'&nbsp;<br><span style="font-size: .8em;">'.$meta['location_subtitle'][0].'</span>';
		}else{
			return $title;
		}
	}else{
		return $title;
	}
}
}