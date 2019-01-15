<?php

/**
 * Register and enqueue CSS
 */
function jeffhow_styles(){
  // Register all styles
  wp_register_style(
    'jeffhow',  // $handle
    get_stylesheet_uri(),  // $src
    array(),  // $deps
    '1.0.0',  // $vers
    'all'  // $media
  );
  
  wp_register_style(
    'jeffhow-stylesheet',  // $handle
    get_template_directory_uri() . '/css/jeffhow.css',  // $src
    array(),  // $deps
    '1.0.0',  // $vers
    'all'  // $media
  );
  
  wp_register_style(
    'bootstrap-stylesheet',  // $handle
    get_template_directory_uri() . '/css/bootstrap.min.css',  // $src
    array(),  // $deps
    '3.3.7',  // $vers
    'all'  // $media
  );
  
  wp_enqueue_style('bootstrap-stylesheet');
  wp_enqueue_style('jeffhow');
  wp_enqueue_style('jeffhow-stylesheet');
  
  // enqueue Google Web Fonts
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Luckiest+Guy|Open+Sans:400,400i,700,700i');
}

add_action('wp_enqueue_scripts', 'jeffhow_styles');

/**
 * Register and enqueue JS
 */
function jeffhow_scripts(){    
  // Register JS
  wp_register_script(
    'jeffhow-script',  // $handle
    get_template_directory_uri() . '/js/jeffhow.js',  // $src
    array('jquery', 'bootstrap-script', 'scroll-reveal-script', 'match-hight-script'),  // $deps
    '1.0.0',  // $vers
    true  // $in_footer
  );

  wp_register_script(
    'bootstrap-script',  // $handle
    get_template_directory_uri() . '/js/bootstrap.min.js',  // $src
    array('jquery'),  // $deps
    '3.3.7',  // $vers
    true  // $in_footer
  );
  
  wp_register_script(
    'jQuery-ui-script',  // $handle
    get_template_directory_uri() . '/js/jquery-ui.min.js',  // $src
    array('jquery'),  // $deps
    '1.12.1',  // $vers
    true  // $in_footer
  );
  
  // Match Height
  // https://github.com/liabru/jquery-match-height
  wp_enqueue_script(
    'match-hight-script', // $handle
    get_template_directory_uri() . '/js/jquery.matchHeight.js', // $source
    array('jquery'),
    '0.7.0', // $vers
    true // $in_footer
  );
  
  // Scroll Reveal
  // https://github.com/jlmakes/scrollreveal/blob/master/README.md
  wp_enqueue_script(
    'scroll-reveal-script', // $handle
    'https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js', // $source
    array('jquery', 'bootstrap-script', 'jQuery-ui-script'), // $deps must load after all other libraries
    '3.3.2', // $vers
    true // $in_footer
  );
  
  wp_enqueue_script('jeffhow-script');
  wp_enqueue_script('bootstrap-script');
  wp_enqueue_script('jQuery-ui-script');
  
  wp_enqueue_script('awesome-font', 'https://use.fontawesome.com/cd6d7a86ba.js', array('bootstrap-script'), '4.7.0', true);

}

add_action( 'wp_enqueue_scripts', 'jeffhow_scripts' );


/**
 * Add theme support
 */
function jeffhow_theme_support(){
  // Navigation
  register_nav_menu( 'primary','Primary Navigation Menu' );

  // Add title-tag support
  add_theme_support( 'title-tag' );

  /**
   * Add post-format support
   * Note: Array defines post-templates found in 'post-template' dir
   */
  add_theme_support( 'post-formats' , array( 'aside', 'image', 'video', 'gallery' ) );
  
  // Other theme support
  add_theme_support( 'custom-background' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}

add_action( 'after_setup_theme', 'jeffhow_theme_support' );

// Register Custom Navigation Walker
require_once( get_template_directory().'/inc/wp_bootstrap_navwalker.php' );

/**
 * Adds search box to end of navbar
 */
add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
  $items .= '<li>' . get_search_form( false ) . '</li>';
  return $items;
}


/**
 * Add infinity symbol with permalink to end of all asides.
 */
add_filter( 'the_content', 'my_aside_to_infinity_and_beyond', 9 ); // run before wpautop

// Adds infinity symbol and permalink to end of aside content.
function my_aside_to_infinity_and_beyond( $content ) {

	if ( has_post_format( 'aside' ) && !is_singular() )
		$content .= ' <a href="' . get_permalink() . '">&#8734;</a>';

	return $content;
}


/**
 * Custom taxonomy for courses 
 */
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts
function create_topics_hierarchical_taxonomy() {
  
// Add new taxonomy, make it hierarchical like categories

// first do the translations part for GUI
  $labels = array(
    'name' => _x( 'Courses', 'taxonomy general name' ),
    'singular_name' => _x( 'Course', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Courses' ),
    'all_items' => __( 'All Courses' ),
    'parent_item' => __( 'Parent Course' ),
    'parent_item_colon' => __( 'Parent Course:' ),
    'edit_item' => __( 'Edit Course' ),
    'update_item' => __( 'Update Course' ),
    'add_new_item' => __( 'Add New Course' ),
    'new_item_name' => __( 'New Course Name' ),
    'menu_name' => __( 'Courses' ),
  );   
 
// Now register the taxonomy
  register_taxonomy('courses',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'courses' ),
  ));
}

/**
 * Register sidebar and other widgets
 */
function jeffhow_widgets(){
  register_sidebar(
    array(
        'name' => 'Adsense Sidebar',
        'id' => 'adsense-sidebar',
        'class' => 'sidebar',
        'description' => 'Adsense Sidebar. Drag a text widget into this sidebar and paste ad code',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget'  => '</aside>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>' 
    )
  );
}

add_action( 'widgets_init' , 'jeffhow_widgets' );

/**
 * Enqueue the comment-reply script needed for threaded comment replies
 */
function jeffhow_comment_reply() {
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
    wp_enqueue_script( 'comment-reply' ); 
  }
}
add_action( 'wp_enqueue_scripts', 'jeffhow_comment_reply' );
/**
 * remove url field from comment form
 */
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');

/**
 * Comment callback - custom comment format
 */
 function jeffhow_comments_callback( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
      <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      
      <?php // Comment Author Name ?>
      <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
      
      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
      </div><!-- / Comment Date -->
    </div><!-- / Comment vCard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    
      <div class="comment-content">
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-level-down" aria-hidden="true"></i> Reply', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- /.reply -->
      </div><!-- /.comment-content -->
    <?php if ( 'div' != $args['style'] ) : ?>
    </div><!-- /.comment-body -->
    <?php endif; ?>
    <?php
}

/**
 * Jeffhow login logo
 */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/jeffhow-login.png);
            padding-bottom: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return get_template_directory_uri() . '/images/jeffhow-login.png';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'www.jeff.how';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
 
?>