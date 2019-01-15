<?php
/**
 * Generic content format for posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <header class="entry-header">
      <h2><?php the_title(); ?></h2>
      <small><?php the_time('F j, Y'); ?>
        <?php
          if( has_category() ){
            echo '| ';
            the_category(', '); 
          }
        ?>
      </small>
  </header>
  
  <?php 
    if( has_post_thumbnail() ): ?>
      <div class="pull-left thumbnail-img"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
  <?php endif; ?>
  
  <?php the_content(' (Continue reading: ' . get_the_title() . ')'); ?>
  
</article>