<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); 
if ( have_posts() ) : 
    while ( have_posts() ) : 
        the_post(); 
        $symbol = array('&#38;','&amp;','&');
        $title = get_the_title();
        $titlef = str_replace($symbol," and ",$title);
        $content = get_the_content();
        $url = get_permalink();
        if (has_post_thumbnail(get_the_ID())) { 
        $thumb = get_the_post_thumbnail();
        } 
    endwhile;
else : 
  $title = 'no Title Found';
  $shortDesc = 'No Description Found';
  $url = "";
endif;

?>
<div class="container">      
    <div class="content-page">
      <div class="inner-page">
      <?php if (has_post_thumbnail(get_the_ID())) {  ?>
          <div class="banner-img1">
          <?php echo $thumb;?>
         </div>
          <?php } ?>
        <div class="row">
            <div class="col-md-12 inner-right-side">
                <h1><?php echo $title; ?></h1>
                <p><?php echo $content;?></p>
                <div class="BackBtn"> 
                    <ul>
                        <li><a href="/directory?business_title=<?php echo urlencode($title)?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Directory</a></li>
                        <?php if ( is_user_logged_in() ) {?>
                        <li><a href="/resources?resource=<?php echo urlencode($title)?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Resources & Publications</a></li>
                        <li><a href="/forums/forum/<?php echo str_replace(" ","-",  strtolower($titlef));?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Forums</a></li>
                        <?php } else{?>
                        <li><a href="/login" style="color:#D3D3D3 !important"><i class="fa fa-caret-right" aria-hidden="true"></i> Resources & Publications <span><img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon6.jpeg" alt=""></span></a></li>
                        <li><a href="/login" style="color:#D3D3D3 !important"><i class="fa fa-caret-right" aria-hidden="true"></i> Forums <span><img src="<?php echo plugins_url('bbpress/templates/default/');?>images/icon6.jpeg" alt=""></span></a></li>
                        <?php } ?>
                        <li><a href="/news-room?news_search=<?php echo urlencode($title)?>"><i class="fa fa-caret-right" aria-hidden="true"></i> News Room</a></li>
                        <li><a href="<?php echo get_site_url().'/services';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Return to Service Areas</a></li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<?php get_footer(); ?>
