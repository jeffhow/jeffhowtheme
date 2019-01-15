<?php
/**
 * Front-page.php is the custom homepage for this site
 * It will be used if the static home page option is chosen.
 * 
 * Static Home Page outline
 * 1. Header
 *    a. Brand
 *    b. Primary Nav
 * 2. How do I... Jumbotron (About me)
 * 3. four col Course-Syllabus links
 * 4. four col 'latest blog' posts (excluding asides)
 * 5. one col Profile section
 * 6. Footer
 *    a. Secondary menu
 *    b. copyright
 *    c. social links
 */
?>
<?php 
//===========================================
//               Header 
//===========================================
?>
<?php get_header(); ?>

<?php 
//===========================================
//               Jumbotron 
//===========================================
?>

<?php
$howblog = new WP_Query( array( 'post_type' => 'page', 'pagename' => 'how-do-i' ) );
if( $howblog->have_posts() ):
  while( $howblog->have_posts() ): $howblog->the_post(); ?>
      <div class="jumbotron" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>'); background-position-y: bottom;">
        <div class="row">
          <div class="col-md-6 how-teaser">
            <h1><?php the_title(); ?></h1>
            <?php the_excerpt(); ?>
            <div class="text-center"><a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>" role="button">Read more</a></div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.jumbotron -->
  <?php endwhile; ?>
<?php endif; 
wp_reset_postdata(); ?>


<?php 
//===========================================
//               Course Syllabus links 
//===========================================
?>


  
    
  <?php 
  $args = array(
  	'post_type' => 'post', // it's default, you can skip it
    'posts_per_page' => '4',
    'order_by' => 'date', // it's also default
    'order' => 'DESC', // it's also default
    'category_name' => 'syllabus'
  ); ?>
  
  <?php
    $query = new WP_Query( $args );
    if($query->have_posts()): ?>
    
    <div class="row">
      <div class="col-xs-12">
        <h2 class="section-heading"><span>Courses</span></h2>
      </div><!-- /.col -->
    </div><!-- /.row -->
    
    <div class="row">
      <?php while( $query->have_posts() ): $query->the_post(); ?>
        <div class="col-xs-12 col-sm-3 front-col">
          <div class="front-panel">
            <h4 class="panel-title"><?php the_title(); ?></h4>
            <small>Posted on: <?php the_time('F j, Y'); ?></small>
            <?php the_excerpt(); ?>
            <p><a class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>" role="button">View Course</a></p>
          <div class="clearfix"></div>
          </div><!-- /.course-panel -->
        </div><!-- /.col -->         
      <?php endwhile; ?>
      </div><!-- /.row -->
    <?php endif;
    wp_reset_postdata(); ?>
    
  
    

<?php 
//===========================================
//               Latest Blog Links 
//===========================================
?>

    
  <?php // Get all the courses
  $terms = get_terms( array(
    'taxonomy' => 'courses',
    'fields' => 'id=>slug',
    'hide_empty' => false,
  ) );
  
  $blogargs = array(
    'post_type' => 'post',
    'posts_per_page' => '4',
    'tax_query' => array(
      array(
        'taxonomy' => 'courses',
        'terms' => $terms, // All the courses
        'field' => 'slug',
        'operator' => 'NOT IN', // Exclude the courses
      ),
      array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array( 'post-format-aside' ),
        'operator' => 'NOT IN' // Exclude the Aside posts
      )
    )
  );
  
  ?>
  
  <?php
    $query = new WP_Query( $blogargs );
    if($query->have_posts()): ?>
    
      <div class="row">
        <div class="col-xs-12">
          <h2 class="section-heading"><span>Latest from my blog</span></h2>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
      <?php while( $query->have_posts() ): $query->the_post(); ?>
        <div class="col-xs-12 col-sm-3 front-col">
          <div class="front-panel">
            <h4 class="panel-title"><?php the_title(); ?></h4>
            <small>Posted on: <?php the_time('F j, Y'); ?></small>
            <?php the_excerpt(); ?>
            <p><a class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>" role="button">View Post</a></p>
          <div class="clearfix"></div>
          </div><!-- /.course-panel -->
        </div><!-- /.col -->         
      <?php endwhile; ?>
        
        </div><!-- /.row -->

    <?php endif;
    wp_reset_postdata(); ?>
  


<?php 
//===========================================
//           Profile Section 
//===========================================
?>
<?php
$profilePage = new WP_Query( array( 'post_type' => 'page', 'pagename' => 'my-profile' ) );
if( $profilePage->have_posts() ): ?>

  <div class="row">
    <div class="col-xs-12">
      <h2 class="section-heading"><span>My Profile</span></h2>
    </div><!-- /.col -->
  </div><!-- /.row -->
  
  <?php while( $profilePage->have_posts() ): $profilePage->the_post(); ?>
  
  <div class="row front-col">
    <div class="col-xs-12 profile-panel">
      <div class="col-sm-3 col-sm-offset-1 col-xs-6">
        <?php if( has_post_thumbnail() ):
          the_post_thumbnail( 'full', array('class'=>'img-responsive') );
        endif; ?>
      </div><!-- /.col-->
      <div class="col-sm-7 col-xs-6">
        <?php the_content() ?>
        <div>
          <a class="btn btn-primary" href="<?php the_permalink(); ?>" role="button">Read more</a>
        </div>
      </div><!-- /.col -->
    </div><!-- /.profile-panel -->
  </div><!-- /.row -->

  <?php endwhile; ?>
<?php endif; 
wp_reset_postdata(); ?>


<?php 
//===========================================
//               Footer 
//===========================================
?>
<?php get_footer(); ?>