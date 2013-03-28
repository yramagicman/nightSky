<div id="sidebar">
  <ul>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>
      <li>
        <h2>Search</h2>
      </li>
      <?php get_search_form(); ?>
          <!--end search-->
    <li><h2>Recent Posts</h2></li>
    <?php wp_get_archives('type=postbypost&limit=10'); ?>
    <!--<h2>Browse by tags</h2>
  <ul>
      <?php // wp_tag_cloud('smallest=8&largest=17&number=30'); ?>
    </ul>-->
    <li><h2>Topics</h2></li>
    <?php wp_list_categories('title_li='); ?>
    <li><h2>Archives</h2></li>
    <?php wp_get_archives('type=monthly&limit=12'); ?>
<li>    <h2>Meta</h2></li>
    <li>
      <?php wp_register(); ?>
    </li>
    <li>
      <?php wp_loginout(); ?>
    </li>
    <li><?php wp_meta(); ?>
    </li>
    <li><h2>Links</h2></li>
    <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
    <?php  endif; ?>
  </ul>
</div>
<!-- Closes Sidebars -->
