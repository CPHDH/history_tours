<?php
/**
 * History Tours functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package History_Tours
 */

if ( ! function_exists( 'history_tours_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function history_tours_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on History Tours, use a find and replace
	 * to change 'history_tours' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'history_tours', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'history_tours' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
// 		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'history_tours_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function history_tours_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'history_tours_content_width', 640 );
}
add_action( 'after_setup_theme', 'history_tours_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function history_tours_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'history_tours' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'history_tours' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Homepage',
		'id'            => 'homepage',
		'description'	=> 'Use the Visitor Info widget to add some text',
	) );	
}
add_action( 'widgets_init', 'history_tours_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function history_tours_scripts() {
	wp_enqueue_style( 'history_tours-style', get_stylesheet_uri() );
	
	//wp_enqueue_style( 'history_tours_google_fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans:400,400italic,700,700italic|Merriweather+Sans:400,400italic,700,700italic' );
	
	wp_enqueue_style( 'history_tours_local_fonts', get_template_directory_uri() . '/fonts/fonts.css');

	wp_enqueue_script( 'history_tours-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
	wp_enqueue_style( 'history_tours-dashicon', get_stylesheet_uri(), array( 'dashicons' ), '1.0' );

	wp_enqueue_script( 'history_tours-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'history_tours_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Widget: homepage
 */
class HT_Visitor_Info extends WP_Widget {


	function __construct() {
		parent::__construct(
			'HT_Visitor_Info', // Base ID
			__('Visitor Info', 'text_domain'), // Name
			array( 'description' => __( 'Enter brief text describing hours, admission, and location information. For display on homepage.', 'text_domain' ), ) // Args
		);
	}


	public function widget( $args, $instance ) {
	
		$html='<h1 class="title" style="">'.$instance['title'].'</h1>';
		$html.='<div class="divider"></div>';
		$html.='<p>'.$instance['text'].'</p>';		
		echo $html;
	}


	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Visitor Info', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<?php
		if ( isset( $instance[ 'text' ] ) ) {
			$text = $instance[ 'text' ];
		}
		else {
			$text = __( 'EXAMPLE TEXT: The museum is open from 9am to 10am on weekdays and from 7pm until midnight on saturday and sunday. Admission is $10 for adults and $6 for children. We are located at 123 Main Street, Townville, Ohio 44444 USA.', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
			<textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?>
			</textarea>
		</p>

		
		<?php 
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';

		return $instance;
	}

} // class HT_Visitor_Info

add_action( 'widgets_init', function(){
	register_widget( 'HT_Visitor_Info' );
});

function set_default_theme_widgets ($old_theme, $WP_theme = null) {

    $new_active_widgets = array (
        'homepage' => array (
            'HT_Visitor_Info',
        )
    );
        
    update_option('sidebars_widgets', $new_active_widgets);
}
add_action('after_switch_theme', 'set_default_theme_widgets', 10, 2);
