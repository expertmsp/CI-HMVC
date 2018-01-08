<?php get_header();?>
<div id="" class="container">
   <br />
   <div id="" class="row">
         <h3 style=" text-transform: capitalize;"><?php
       		if ( is_category() ) {
       			single_cat_title();
       		} elseif ( is_tag() ) {
            echo '<span style="font-weight:300;margin-left:15px">Tags: </span>';
            echo  single_tag_title();
       		} elseif ( is_author() ) {
       			the_post();
       			echo 'Author Archives: ' . get_the_author();
       			rewind_posts();
       		} elseif ( is_day() ) {
       			echo 'Daily Archives: ' . get_the_date();
       		} elseif ( is_month() ) {
       			echo 'Monthly Archives: ' . get_the_date('F Y');
       		} elseif ( is_year() ) {
       			echo 'Yearly Archives: ' . get_the_date('Y');
       		} else {
       			echo 'Archives:';
       		}
         ?></h3>
   </div>
  <div class="col-md-9">

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
   <br /> <br />
  </ul>
  <br />
  <br />
  <br />
</div>



<?php get_footer();?>