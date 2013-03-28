<?php get_header(); ?>

<div id="content">
<div id="body">
 <div class="padding">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php if (function_exists('wp_list_comments')): ?>
  <div <?php post_class(); ?>>
    <?php else : ?>
    <div class="posts">
      <?php endif; ?>
      <h2 class="postTitle"><a href="<?php the_permalink() ?>" class="postTitle">
        <?php the_title(); ?>
        </a></h2>
      <p class="topMeta">
        by
        <?php the_author_posts_link(); ?>
        on
        <?php the_time('M.d, Y') ?>
        , under
        <?php the_category(', '); ?>
      </p>
      <div class="postContent">
        <?php 
     
        	the_content('(continue reading...)');
        
        	
        ?>
      </div>
      <span class="linkpages">
        <?php wp_link_pages(); ?>
      </span>
       <div class="cleared">
        </div>
      <span class="postComments">
      <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
      </span><span class="postTags">
      <br /><?php the_tags('Tags: ', ', ', ''); ?>
      </span> <span class="moreLink"><a href="<?php the_permalink() ?>">more...</a></span>
    </div>
    <?php endwhile; ?>
    <div class="navigation">
      <div class="alignleft">
        <?php next_posts_link('Older Entries') ?>
      </div>
      <div class="alignright">
        <?php previous_posts_link('Newer Entries') ?>
      </div>
    </div>
    <?php else : ?>
    <div class="posts">
      <h2 class="postTitle"><a href="<?php the_permalink() ?>">Not Found</a></h2>
      <div class="postContent">
        <p>
          Sorry, but you are looking for something that isn't here. You can search again by using <a href="#searchform">this form</a>...
        </p>
      </div>
    </div>
    <!-- Closes topPost -->
    <?php endif; ?>
  </div>
  <div class="bottomRound">
  </div>
</div>
<!--sidebar-->
<?php get_sidebar(); ?>
<!--footer closes all divs and gets other info-->
<?php get_footer(); ?>
