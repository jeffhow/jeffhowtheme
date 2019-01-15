<?php
/**
 * Image content format for posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <header class="entry-header">
       <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
      <small><?php the_time('F j, Y'); ?> | <?php the_category(', '); ?></small>
  </header>
  
  <?php 
    if( has_post_thumbnail() ): ?>
      <div class="pull-left thumbnail-img"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
  <?php endif; ?>
  
  <?php the_content(); ?>
  
</article>