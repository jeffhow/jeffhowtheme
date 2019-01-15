<?php get_header(); ?>
<?php 
    /**
     * Index is the basic template.
    */
?>

<?php 
    if( have_posts() ):
        while(have_posts()): the_post();
        	get_template_part( 'post-formats/content', get_post_format() );
        endwhile;
    endif;
?>

<?php get_footer(); ?>