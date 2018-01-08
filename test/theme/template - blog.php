<?php 
/*
Template Name: Blog
*/

get_header();?>
<div id="" class="container" style="min-height:800px">
    <br />
  <div class="col-md-9">
    <?php query_posts('cat=24'); ?>
  <?php
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  get_template_part('content');
endwhile;

    else : 
      echo '<p>No content found</a>';

    endif;
  ?>
  <br /><br />
  </div>
  <ul class="col-md-3 list-unstyled">
   <?php dynamic_sidebar('Sidebar'); ?>
  </ul>
  <br />
  <br />
  <br />
</div>


<?php get_footer();?>