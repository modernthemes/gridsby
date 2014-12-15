<?php
/**
 * gridsby functions and definitions
 *
 * @package gridsby
 */
 
/**
 * Theme Updater
 */
  
require_once('inc/wp-updates-theme.php'); 
new WPUpdatesThemeUpdater_982( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) ); 

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'gridsby_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gridsby_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gridsby, use a find and replace
	 * to change 'gridsby' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gridsby', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'gallery-thumb', 450 );
	add_image_size( 'gallery-full', 600 );  

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gridsby' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gridsby_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // gridsby_setup
add_action( 'after_setup_theme', 'gridsby_setup' );

/*-----------------------------------------------------------------------------------*/
/* Remove Page + Comements */
/*-----------------------------------------------------------------------------------*/

function remove_admin_menu_items() {
	$remove_menu_items = array(__('Comments'),__('Widgets'));       
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}

add_action('admin_menu', 'remove_admin_menu_items');    

// change posts to photos

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Photos';
    $submenu['edit.php'][5][0] = 'Photos';
    $submenu['edit.php'][10][0] = 'Add Photos';
    $submenu['edit.php'][16][0] = 'Photos Tags';   
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Photos';
    $labels->singular_name = 'Photos';
    $labels->add_new = 'Add Photos';
    $labels->add_new_item = 'Add Photos';
    $labels->edit_item = 'Edit Photos';
    $labels->new_item = 'Photos';
    $labels->view_item = 'View Photos';
    $labels->search_items = 'Search Photos';
    $labels->not_found = 'No Photos found';
    $labels->not_found_in_trash = 'No Photos found in Trash';
    $labels->all_items = 'All Photos';
    $labels->menu_name = 'Photos';
    $labels->name_admin_bar = 'Photos';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

/**
 * Load Google Fonts.
 */
function load_fonts() {
            wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700');
            wp_enqueue_style( 'googleFonts');  
        }
    
    add_action('wp_print_styles', 'load_fonts'); 
	
/**
* Register and load font awesome CSS files using a CDN.
*
* @link http://www.bootstrapcdn.com/#fontawesome
* @author FAT Media 
*/
	
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );

function prefix_enqueue_awesome() {
wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' ); 
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gridsby_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'gridsby' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) ); 
	
}
add_action( 'widgets_init', 'gridsby_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gridsby_scripts() {
	wp_enqueue_style( 'gridsby-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts')); 
	
	if( $headings_font ) {
		wp_enqueue_style( 'gridsby-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'gridsby-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700');  
	}	
	if( $body_font ) {
		wp_enqueue_style( 'gridsby-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );	
	} else {
		wp_enqueue_style( 'gridsby-open-body', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700');
	} 
	
	wp_enqueue_style( 'gridsby-grid-css', get_template_directory_uri() . '/css/grid.css' );
	
	if ( file_exists( get_stylesheet_directory_uri() . '/inc/my_style.css' ) ) {
	wp_enqueue_style( 'gridsby-mystyle', get_stylesheet_directory_uri() . '/inc/my_style.css', array(), false, false );
	} 
	
	if ( is_admin() ) {
    wp_enqueue_style( 'gridsby-codemirror', get_stylesheet_directory_uri() . '/css/codemirror.css', array(), '1.0' ); 
	}

	wp_enqueue_script( 'gridsby-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), false, false );
	wp_enqueue_script( 'gridsby-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'gridsby-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'gridsby-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), false, false );
	wp_enqueue_script( 'gridsby-classie', get_template_directory_uri() . '/js/classie.js', array(), false, true );
	wp_enqueue_script( 'gridsby-helper', get_template_directory_uri() . '/js/helper.js', array(), false, true );
	wp_enqueue_script( 'gridsby-grid3d', get_template_directory_uri() . '/js/grid3d.js', array(), false, true );
	wp_enqueue_script( 'gridsby-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), false, true );     
	wp_enqueue_script( 'gridsby-share', get_template_directory_uri() . '/js/share.min.js', array(), false, true );  
	wp_enqueue_script( 'gridsby-codemirrorJS', get_template_directory_uri() . '/js/codemirror.js', array(), false, true);
	wp_enqueue_script( 'gridsby-cssJS', get_template_directory_uri() . '/js/css.js', array(), false, true); 
	wp_enqueue_script( 'gridsby-scripts', get_template_directory_uri() . '/js/gridsby.scripts.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gridsby_scripts' );

/**
 * Load html5shiv
 */
function gridsby_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'gridsby_html5shiv' );  

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Include additional custom features.
 */
require get_template_directory() . '/inc/my-custom-css.php';
require get_template_directory() . '/inc/socialicons.php'; 

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

remove_filter( 'the_content', 'wpautop' );
