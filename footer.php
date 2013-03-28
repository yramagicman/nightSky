<div id="footer">
      <!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
      <div id="presenting">
        <?php bloginfo('name'); ?>
        is proudly powered by <a href="http://wordpress.org/">WordPress</a>
      </div>
      <div id="footRss">
        <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>. 
        <!-- Don't delete this. It credits the dude who took the header photo. -->
        Image credit to <a href="http://www.flickr.com/photos/nattu/3392855180/"> this guy</a> on flikr
      </div>
      <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. --> <?php wp_footer(); ?>
      </p>
    </div>
  </div>
</div>
</body>
</html>
