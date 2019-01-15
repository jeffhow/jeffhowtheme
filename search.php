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
  // Start the post loop
  if( have_posts() ):
    while(have_posts()): the_post(); ?>
      <div class="row">
        <div class="col-xs-12">
        <?php if( get_post_format() == 'aside' ){
  	       get_template_part( 'post-formats/content',  get_post_format() );
        }else{
    	    get_template_part( 'post-formats/content', 'search' ); 
        } ?>
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
  
  <?php else: ?>
  
    <h4>Sorry, your search did not match any results.
      <i class="fa fa-puzzle-piece fa-x3" aria-hidden="true"></i>
    </h4>
    <p>Maybe try another search?</p>
    <?php get_search_form(); ?>

  <?php endif; ?>
  
  </div><!--/.col site-content -->
  
  <div class="col-sm-5 widget-column">
    <?php get_sidebar('adsense'); ?>
  </div><!-- /.col sidebar -->
  
</div><!-- /.row -->

<?php get_footer(); ?>