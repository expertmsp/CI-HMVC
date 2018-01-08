<?php 

/*
Template Name: General Page
*/

get_header();

?>
<div class="container">
  <div class="content-page">
  <?php
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
      if (has_post_thumbnail(get_the_ID())) { 
        echo the_post_thumbnail();
     }else{ ?> 
      <img src="<?php echo get_bloginfo('template_directory');?>/img/slider/hero3.jpg" class="hero"> 
    <?php }   ?>
      <h1><?php the_title(); ?></h1>

      <p class="blog-content"> <?php the_content(); ?></p>

    <?php endwhile;

    else : 
      echo '<p>No content found</a>';

    endif;
  ?>
   </div>
  </div>
  
  
<?php  get_footer(); ?>