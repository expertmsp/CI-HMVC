<?php
/**
  Template Name:Services Page
 */
get_header();
$topic_id = bbp_get_topic_id();
?>
<div class="container">
    <div class="content-page">
      <div class="inner-page">
        <div class="row">
          <h1><?php echo bbp_topic_title($topic_id); ?></h1>
          <p><?php echo bbp_topic_content($topic_id); ?></p>
          <div class="ForumsMain">
          <?php
            $args = array(
                'post_type' => 'services',
                'orderby'=>'title',
                'order'=>'asc',
                'posts_per_page'=>-1,
            );

            $newquery = new WP_Query($args);
            if ($newquery->have_posts()):
                $i = 1;
                while ($newquery->have_posts()):$newquery->the_post();
                    $title = get_the_title();
                    $symbol = array('&#38;','&amp;','&');
                    $titlef = str_replace($symbol," and ",$title);
                    if ($i > 4)
                        $i = 1;
            ?>
            <div class="col-md-6 col-sm-6">
              <div class="forums-Box">
                <div class="forums-img forums-img-bg<?php echo ($i > 1) ? $i : '' ?>">
                  <div class="Forums-top">
                    <h3><?php the_title(); ?></h3>
                    <a href="<?php echo the_permalink();?>">Find out more</a> </div>
                    <?php $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "size"); ?>
                  <div class="forums-img-m"> <img src="<?php echo $thumbnail_src[0] ?>" alt=""> </div>
                </div>
                <p>Use the quick links below to view relevant resources for the <?php the_title(); ?> service area</p>
                <ul>
                  <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon2.jpeg" alt=""> <a href="/directory?business_title=<?php echo urlencode($title)?>">Directory</a></li>
                  <?php if ( is_user_logged_in() ) {?>
                  <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/iconb1.jpg" alt=""> <a href="/resources?resource=<?php echo urlencode($title)?>">Resources & Publications</a></li>
                  <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/iconb4.jpg" alt=""> 
                      <a href="/forums/forum/<?php echo str_replace(" ","-",  strtolower($titlef));?>">Forums</a>
                  </li>
                  <?php } else{?>
                  <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon1.jpeg" alt=""> <a href="/login" style="color:#D3D3D3 !important">Resources & Publications<span><img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon6.jpeg" alt=""></span></a></li>
                  <li> 
                      <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon4.jpeg" alt=""> 
                      <a href="/login" style="color:#D3D3D3 !important">Forums<span><img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon6.jpeg" alt=""></span></a>
                  </li>
                  <?php } ?>
                  <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon3.jpeg" alt=""> <a href="/news-room?news_search=<?php echo urlencode($title)?>">News</a></li>
                </ul>
              </div>
            </div>
            <?php
                $i++;
                endwhile;
            else :
                echo '<p>No content found</a>';
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
</div>
<?php get_footer(); ?>
