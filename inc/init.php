<?php
// Remove recent comments styles from head
function wpHTML5_remove_recent_comments_style( ) {
  global $wp_widget_factory;
  remove_action( 'wp_head', array(
     $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ],
    'recent_comments_style' 
  ) );
}
// Make the title look cool 
function wpHTML5_title( ) {
  if ( is_home() ) {
    bloginfo( 'name' );
    echo " - ";
    bloginfo( 'description' );
  } //is_home()
  elseif ( is_category() ) {
    single_cat_title();
    echo " - ";
    bloginfo( 'name' );
  } //is_category()
    elseif ( is_single() || is_page() ) {
    single_post_title();
    echo " - ";
    bloginfo( 'name' );
  } //is_single() || is_page()
    elseif ( is_search() ) {
    bloginfo( 'name' );
    echo " search results: ";
    echo esc_html( $s );
  } //is_search()
  else {
    wp_title( '', true );
  }
}

// add home page to page_menu function.
function wpHTML5_page_menu_args( $args ) {
  $args[ 'show_home' ] = true;
  return $args;
}

function wpHTML5_split_sidebar( ) {
?>
  
  <script type="text/javascript">
  // function to add classes to split sidebar for responsive design
  function splitSidebar()	{
    var splitPoint = 3;//adjust this number to change the split point
    var tag = document.getElementById('sidebar').getElementsByTagName('ul');
    var num = tag.length;
    for (var i = 0; i < num; i++) {
      if (i < splitPoint) { 
        tag[i].className += " sidebar-col-1";		
      }
      if (i > splitPoint) {
        tag[i].className += " sidebar-col-2";		
      }
    }
  }
  splitSidebar();
  </script>
  <?php
}

function wpHTML5_custom_wp_trim_excerpt( $text ) {
  $raw_excerpt = $text;
  $text        = get_the_content( '' );
  $text        = strip_shortcodes( $text );
  
  $text         = apply_filters( 'the_content', $text );
  $text         = str_replace( ']]>', ']]&gt;', $text );
  $allowed_tags = custom_excerpt_tags;
  $text         = strip_tags( $text, $allowed_tags );
  if ( gettype( custom_excerpt_length ) == 'integer' ) {
    $excerpt_word_count = custom_excerpt_length;
  } //gettype( custom_excerpt_length ) == 'integer'
  else {
    $excerpt_word_count = 85;
  }
  $excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count );
  
  $excerpt_end  = '...';
  $excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );
  
  $words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
  if ( count( $words ) > $excerpt_length ) {
    array_pop( $words );
    $text = implode( ' ', $words );
    $text = $text . $excerpt_more;
  } //count( $words ) > $excerpt_length
  else {
    $text = implode( ' ', $words );
  }
  return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

// if ( post_formats ) {
//   add_theme_support( 'post-formats', array(
//      'aside',
//     'image',
//     'video',
//     'quote',
//     'link' 
//   ) );
// } //post_formats


function wpHTML5_init( ) {
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
    add_action( 'widgets_init', 'wpHTML5_remove_recent_comments_style' );
  } //no_recent_comments_style
  // initilize sidebars
  add_action( 'widgets_init', 'wpHTML5_sidebars' );
  // initilize styles and scripts
  add_action( 'wp_enqueue_scripts', 'wpHTML5_styles_and_scripts' );
  // user added scripts and styles
  add_action( 'wp_enqueue_scripts', 'wpHTML5_user_scripts' );
  //  change the end of the excerpt.
  add_filter( 'excerpt_more', 'wpHTML5_excerpt_more' );
  // Add Home page to page_menu() fallback function
  add_filter( 'wp_page_menu_args', 'wpHTML5_page_menu_args' );
  // pretty title
  add_filter( 'wp_title', 'wpHTML5_title' );
  //kill default gallery styles
  if ( kill_gallery_styles ) {
    add_filter( 'use_default_gallery_style', '__return_false' );
  } //kill_gallery_styles
  //   split sidebar
  if ( js_sidebar_split ) {
    add_filter( 'wp_footer', 'wpHTML5_split_sidebar' );
  } //js_sidebar_split
  if ( custom_excerpt_length ) {
    remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
    add_filter( 'get_the_excerpt', 'wpHTML5_custom_wp_trim_excerpt' );
  } //custom_excerpt_length
  if ( web_fonts ) {
    add_filter( 'wp_head', 'wpHTML5_webfonts' );
  } //web_fonts
  
}
add_action( 'after_setup_theme', 'wpHTML5_init' );

?>