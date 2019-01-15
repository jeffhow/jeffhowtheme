<?php 
  /**
   * Home.php is the Blog template. If the 
   * static home page option is not chosen,
   * this will be the template used for the home page
   * 
   * Column 1: Blog Loop
   *  - Nested rows / cols
   * Column 2: Adsense Sidebar Widget
  */
?>

<?php get_header(); ?>

  <div class="row">
    <div class="col-sm-7 site-content">
<?php 
  /**
   * Exclude the course taxonomy
   */
  // Get all course terms
  $terms = get_terms( array(
    'taxonomy' => 'courses',
    'fields' => 'id=>slug',
    'hide_empty' => false,
    ) 
  );
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'courses',
      'terms' => $terms,
      'field' => 'slug',
      'operator' => 'NOT IN',
    ),
  );
  query_posts($args);

  // Start the post loop
  if( have_posts() ):
    while(have_posts()): the_post(); ?>
      <div class="row">
        <div class="col-xs-12">
    	    <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
    	  </div><!-- /.col -->
    	</div><!-- /.row -->
    <?php endwhile; ?>
      
  
  
  <?php // pagination links ?>
  <div class="row">
    <div class="col-xs-12">
      <ul class="pager">
      <?php if( get_previous_posts_link() ): ?>
        <li class="previous"><?php previous_posts_link( 'Newer Posts' ); ?></li>
      <?php else: ?>
        <li class="previous disabled" ><a href="#">Newer Posts</a></li>
      <?php endif; ?>

      <?php if( get_next_posts_link() ): ?>
        <li class="next"><?php next_posts_link( 'Older Posts' ); ?></li>
      <?php else: ?>
        <li class="next disabled" ><a href="#">Older Posts</a></li>
      <?php endif; ?>
      </ul>
    </div><!-- /.col -->
  </div><!-- /.row -->
  
  <?php endif; ?>
  
  </div><!--/.col site-content -->
  
  <div class="col-sm-5 widget-column">
    <?php get_sidebar('adsense'); ?>
  </div><!-- /.col sidebar -->
  
</div><!-- /.row -->

<?php get_footer(); ?>