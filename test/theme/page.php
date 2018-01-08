<?php get_header();?>

<div id="blog" class="container">
  <?php
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    if (has_post_thumbnail(get_the_ID())) { ?>
        <div class="banner-img">
        <?php echo the_post_thumbnail(); ?>
        </div>
    <?php  }   ?>
      <h1 class="blog-title"><?php the_title(); ?></h1>

      <p class="blog-content"> <?php the_content(); ?></p>

    <?php endwhile;

    else : 
      echo '<p>No content found</a>';

    endif;
  ?>
  </div>

<?php get_footer();?>