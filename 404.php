<?php 
    /**
     * Single.php is the template for single posts
    */
?>
<?php get_header(); ?>

  <div class="row">
    <div class="col-sm-7 site-content">
      <section class="error-404 not-found">
        <header class="page-header">
					<h1 class="page-title"><?php _e( '404: <i class="fa fa-puzzle-piece fa-x3" aria-hidden="true"></i>', 'jeffhow' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
				  <h4>That page cannot be found.</h4>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'jeffhow' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
      </section>
  </div><!--/.col site-content -->
  
  <div class="col-sm-5 widget-column">
    <?php get_sidebar('adsense'); ?>
  </div><!-- /.col sidebar -->
  
</div><!-- /.row -->

<?php get_footer(); ?>