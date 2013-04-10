<?php
// Remove recent comments styles from head
function nightsky_remove_recent_comments_style( ) {
  global $wp_widget_factory;
  remove_action( 'wp_head', array(
     $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ],
    'recent_comments_style' 
  ) );
}
// Make the title look cool 
function nightsky_title( ) {
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
}

// add home page to page_menu function.
function nightsky_page_menu_args( $args ) {
  $args[ 'show_home' ] = true;
  return $args;
}

function nightsky_split_sidebar( ) {
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

function nightsky_custom_wp_trim_excerpt( $text ) {
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
?>