<?php get_header();?>



<div id="" class="container" style="min-height:800px">
    <br />
    <div id="" class="row">
          <h3><span style="font-weight:300;margin-left:15px">Search results for:</span> <?php the_search_query(); ?></h3>
    </div>
  <div class="col-md-12">

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
  <!--<ul class="col-md-3 list-unstyled">
   <?php //dynamic_sidebar('Sidebar'); ?>
  </ul>-->
  <br />
  <br />
  <br />
</div>



<?php get_footer();?>
