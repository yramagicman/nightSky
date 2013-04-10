<?php
if ( !isset( $content_width ) ) {
    $content_width = 700;
    /* pixels */
} //!isset( $content_width )

define( 'additional_css', false );

// Where? What CSS do you need to include?
$styles = array(
     '/additional/Styles.css' 
);
// use web fonts?
define( 'web_fonts', false );
// if using web fonts, where are they?
// $fonts = array(
//      'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic' 
// );
// should we remove all the WordPress junk from the head?
define( 'clean_head', true );
// Wordpress adds a some css to the head to style the Recent Comments Widget, should we remove it?
define( 'no_recent_comments_style', false );
// use jquery? If not, menus will break
define( 'jquery', true );
// Where? true loads jquery in footer, false in header
define( 'header_or_footer', true );

// add CSS classes that allow the sidebar to be split for responsive design? if true use .sidebar-col-1 and .sidebar-col-2 to style the split
define( 'js_sidebar_split', false );

// Use WordPress Gallery CSS?
define( 'kill_gallery_styles', false );

// Use WordPress Gallery CSS?
define( 'post_formats', false );

// use php script to minify stylesheet on the server side?
// DOESN'T MINIFY ANYTING IF ADDITIONAL STYLES ARE USED. Only minifies style.css. See inc/minified.php.
//Redundant if using Less or SASS/Compass
define( 'minify_styles', false );

// Is the default excerpt too short? Change "false" to an integer to change the length of the excerpt. The WordPress default is 85 words. If a non-integer, non-boolean value is input, the default is used.
define( 'custom_excerpt_length', false );
// if using a custom excerpt, do you want to allow specific HTML tags. WordPress doesn't allow any HTML in the excerpt by default. Accepts a string that looks like '<br>, <p>, <h2>'
define( 'custom_excerpt_tags', '' );

require_once( 'inc/init.php' ); // if you remove this line your blog will die
// enqueue CSS and JS
require_once( 'inc/scripts-styles.php' ); // if you remove this line your blog will die
// to use Jetpack infinite scroll, uncomment the next line.
// require_once( 'inc/jetpack.php' );
// for WordPress.com compatibility uncomment the next line.
// require_once( 'inc/wpcom.php' );
// Do you have an additional CSS directory? (Not web fonts, those are defined below.)

function nightsky_user_scripts( ) {
    // enque your own stuff here. CSS should be added to the array above.
    // enqueue a script.
    // wp_enqueue_script( 'id', get_template_directory_uri() . 'path',array('dependencies'), filemtime(get_stylesheet_directory() . 'path'), header_or_footer );
}
// customize the end of the excerpt.
function nightsky_excerpt_more( $more ) {
    global $post;
    return ' <p class="readmore"><a href="' . get_permalink( $post->ID ) . '">Continue reading ' . $post->post_title . '</a></p>';
}

// Widgitize sidebars.
function nightsky_sidebars( ) {
    if ( function_exists( 'register_sidebar' ) ) {
        // duplicate this array and edit it if you have more than one widgitable area in your theme
        register_sidebar( array(
             'name' => 'Sidebar',
            'before_widget' => '<ul id="%1$s" class="widget %2$s">',
            'after_widget' => '</ul>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>' 
        ) );
    } //function_exists( 'register_sidebar' )
} //end sidebars

// tell WordPress about custom Nav Menus.
register_nav_menus( array(
     'header' => __( 'Header Navigation', 'nightsky' ),
    // 'footer' => __( 'Footer Navigation', 'nightsky' ) 
) );

function nightsky_header_menu( ) {
    $header = array(
         'theme_location' => 'header',
        'container' => 'div',
        'container_id' => 'nav',
        'container_class' => 'menu header-menu row span12-no-margin',
        'menu_class' => 'menu header-menu-list' 
    );
    wp_nav_menu( $header );
}

function nightsky_single_post_nav( ) {
    $prev_post = get_previous_post();
    if ( !empty( $prev_post ) ) {
?>
    <a href="<?php
        echo get_permalink( $prev_post->ID );
?>" class="alignleft"><?php
        echo $prev_post->post_title;
?></a>
  <?php
    } //!empty( $prev_post )
    $next_post = get_next_post();
    if ( !empty( $next_post ) ) {
?>
    <a href="<?php
        echo get_permalink( $next_post->ID );
?>" class="alignright"><?php
        echo $next_post->post_title;
?></a>
  <?php
    } //!empty( $next_post )
}



// make TinyMCE look good.
add_editor_style();
function nightsky_init( ) {
  if ( clean_head ) { // remove RSD link
    remove_action( 'wp_head', 'rsd_link' );
    // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // index link
    remove_action( 'wp_head', 'index_rel_link' );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // Remove meta generator
    remove_action( 'wp_head', 'wp_generator' );
  } //clean_head
  if ( no_recent_comments_style ) {
    // remove recent comments style
    add_action( 'widgets_init', 'nightsky_remove_recent_comments_style' );
  } //no_recent_comments_style
  // initilize sidebars
  add_action( 'widgets_init', 'nightsky_sidebars' );
  // initilize styles and scripts
  add_action( 'wp_enqueue_scripts', 'nightsky_styles_and_scripts' );
  // user added scripts and styles
  add_action( 'wp_enqueue_scripts', 'nightsky_user_scripts' );
  //  change the end of the excerpt.
  add_filter( 'excerpt_more', 'nightsky_excerpt_more' );
  // Add Home page to page_menu() fallback function
  add_filter( 'wp_page_menu_args', 'nightsky_page_menu_args' );
  // pretty title
  add_filter( 'wp_title', 'nightsky_title' );
  //kill default gallery styles
  if ( kill_gallery_styles ) {
    add_filter( 'use_default_gallery_style', '__return_false' );
  } //kill_gallery_styles
  //   split sidebar
  if ( js_sidebar_split ) {
    add_filter( 'wp_footer', 'nightsky_split_sidebar' );
  } //js_sidebar_split
  if ( custom_excerpt_length ) {
    remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
    add_filter( 'get_the_excerpt', 'nightsky_custom_wp_trim_excerpt' );
  } //custom_excerpt_length
  if ( web_fonts ) {
    add_filter( 'wp_head', 'nightsky_webfonts' );
  } //web_fonts
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'nightsky_init' );
?>
