<?php
/**
 * Post format for viewing single posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <div class="row">
      <div class="col-xs-12">
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <small>
          Posted on: <?php the_time('F j, Y'); ?>
          <?php the_tags('| Tags: '); ?>
          <?php the_terms( $post->ID, 'courses', ' ! Course: ', ', ', ' ' ); ?>
        </small>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </header>
    

  <div class="row">
    <div class="col-xs-12">
        
        <?php the_content(); ?>
        <?php edit_post_link( 
                $text = 'Edit', 
                $before = '(', 
                $after = ')', 
                $id = 0, 
                $class = 'post-edit-link' ); ?>
    </div><!-- /.col -->
  </div><!-- /.row -->
</article>

