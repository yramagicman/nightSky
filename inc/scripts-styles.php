<?php
define('minify_styles', false);
function nightsky_styles_and_scripts( ) {

    if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
        wp_enqueue_script( 'comment-reply' );
    } //is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 )

    // since this is HTML5 we always use modernizr
    // wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/scripts/modernizr.min.js', __FILE__, filemtime( get_template_directory() . '/scripts/modernizr.min.js' ) );

    // are we using jquery?
    if ( jquery ) {
        // what copy?
        wp_enqueue_script( 'jquery', __FILE__, __FILE__, filemtime( __FILE__ ), header_or_footer );
        // wp_enqueue_script( 'plugins', get_template_directory_uri() . '/scripts/plugins.js', array(
//              'jquery'
//         ), filemtime( get_template_directory() . '/scripts/plugins.js' ), header_or_footer );
    } //jquery
    if ( web_fonts ) {
        wp_enqueue_script( 'no-fout', get_template_directory_uri() . '/scripts/foutbgone/foutbgone.min.js', __FILE__, filemtime( get_template_directory() . '/scripts/foutbgone/foutbgone.min.js' ) );
        global $fonts; // access fonts array
        foreach ( $fonts as $value ) {
            static $i = 1;
            wp_enqueue_style( "fonts$i", $value, __FILE__, filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
            // enque fonts
            $i++;
        } //$fonts as $value
    } //web_fonts
    // Redundant if using Less or SASS/Compass

    // if minification is on, minify styles via php script, othwise output non-minified CSS
    if ( minify_styles ) {
        if ( additional_css ) {
            nightsky_enqueue_css();
        } //additional_css
        else {
            wp_enqueue_style( 'wordpressHTML5-style', get_template_directory_uri() . '/inc/minified.php', __FILE__, filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
        }
    } //minify_styles
    else {
        if ( additional_css ) {
            nightsky_enqueue_css();
        } //additional_css
        else {
            wp_enqueue_style( 'wordpressHTML5-style', get_stylesheet_uri(), __FILE__, filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
        }
    }
}

function nightsky_enqueue_css( ) {
    $my_theme = wp_get_theme();
    wp_enqueue_style( 'wordpressHTML5-style', get_stylesheet_uri(), __FILE__, filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
    global $styles; // access stylesheet array
    foreach ( $styles as $value ) {
        static $i = 1;
        wp_enqueue_style( "styles$i", $value, __FILE__, filemtime( $value ), 'all' );
        // enque css
        $i++;
    } //$styles as $value
}

function nightsky_webfonts( ) {
?>
  <script type="text/javascript">
    fbg.hideFOUT('asap');
    </script>
  <?php
}
?>