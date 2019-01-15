<?php
/**
 * Aside post format
 */
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if( is_singular() ): ?>
    <header class="entry-header">
      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
      <small>
        Posted on: <?php the_time('F j, Y'); ?> | 
        Categories: <?php the_category(', '); ?>
        <?php the_tags('| Tags: '); ?>
      </small>
    </header>
  <?php endif; ?>
        
  <div class="aside-panel">
    <?php the_content(); ?>
  </div><!--/.aside-panel-->

</article>
