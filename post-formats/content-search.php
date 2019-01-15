<?php
/**
 * Content format for searche listings
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <header class="entry-header">
    <div class="search-heading">
      <h2><?php the_title(); ?></h2>
      <a href="<?php the_permalink(); ?>">Read full post &hellip;</a>
    </div>
      <small><?php the_time('F j, Y'); ?>
        <?php
          if( has_category() ){
            echo '| ';
            the_category(', '); 
          }
        ?>
      </small>
  </header>
  
  <?php the_excerpt(); ?>
  <hr class="separator">
</article>