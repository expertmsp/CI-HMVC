  <div class="event">
      <div class=" event-desc">
      <h2><?php the_title(); ?></h2>
      <ul class="list-unstyled list-inline event-details">
        <li> <?php the_time('F j, Y'); ?></li>
        <li><?php the_author(); ?></li>
      </ul>
    <p><?php the_excerpt(); ?></p>
    <ul class="list-unstyled list-inline">
     <li class="link"><i class="fa fa-caret-right"></i><a href="<?php the_permalink(); ?>">Find out more</a></li>
    </ul>
  </div>
 </div>