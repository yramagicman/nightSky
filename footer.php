<div id="footer">
      <!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
      <div id="presenting">
        <?php bloginfo('name'); ?>
        is proudly powered by <a href="http://wordpress.org/">WordPress</a>
      </div>
      <div id="footRss">
        <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>. 
      </div>
      <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. --> 
      </p>
    </div>
  </div>
</div>
<!-- Header image from http://www.flickr.com/photos/73003003@N07/7004197882/. Lisenced CC-0. It appears in http://www.flickr.com/groups/freeuse/. The Group Info states that no attribution is required. -->
<?php wp_footer(); ?>
</body>
</html>
