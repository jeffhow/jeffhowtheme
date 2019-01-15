<?php 
    /**
     * Single.php is the template for single posts
    */
?>
<?php get_header(); ?>

  <div class="row">
    <div class="col-sm-7 site-content">
      
<?php 
  if( have_posts() ):
    while(have_posts()): the_post();
        
      if( get_post_format() ){
  	    get_template_part( 'post-formats/content',  get_post_format() );
      }else{
        get_template_part( 'post-formats/content',  'single' );
      } ?>
            
      <div class="row">
        <div class="col-xs-12">
          <?php if ( comments_open() || get_comments_number() ): 
	          comments_template();
          endif; ?>
        </div><!--/.col-->
      </div><!--/.row-->

    <?php endwhile;
    
  endif; ?>
  
  </div><!--/.col site-content -->
  
  <div class="col-sm-5 widget-column">
    <?php get_sidebar('adsense'); ?>
  </div><!-- /.col sidebar -->
  
</div><!-- /.row -->

<?php get_footer(); ?>