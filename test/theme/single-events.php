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
        if (has_post_thumbnail(get_the_ID())) { 
            $thumb = get_the_post_thumbnail();
        } 
        $title = get_the_title();
        $shortDesc = get_field('short_description');
        $url = get_permalink();
    endwhile;
else : 
  $title = 'no Title Found';
  $shortDesc = 'No Description Found';
  $url = "";
endif;
?>

  <div class="container">
    <span style="float:right"><a href="javascript:void(0);" id="closeImage"><i class="fa fa-times" aria-hidden="true"></i></a></span> 
    <?php if (has_post_thumbnail(get_the_ID())) {  ?>
          <div class="banner-img">
          <?php echo $thumb;?>
         </div>
          <?php } ?>
    <div class="content-page">
      <div class="inner-page">
        <div class="row">
          <div class="col-md-3">
            <div class="catchy-headlines-left">
              <ul> 
                <li>DATE<span><?php echo date("j F, Y",strtotime(get_field('date'))); ?></span></li>
                <li>TIME<span><?php echo the_field('event_time'); ?></li>
                <li>VENUE<span><?php echo the_field('event_location',the_post('ID')); ?></span></li>
                <li> EVENT TYPE<span><?php echo the_field('event_type'); ?></span></li>
                <?php if( get_field('event_price')!= 0 ): ?>
                <li> EVENT PRICE<span>$ <?php echo the_field('event_price'); ?></span></li>
                <?php endif; ?>
                <li> CONTACT INFO<span><?php echo the_field('contact_info',the_post('ID')); ?></span></li>
                <li> SHARE 
                    <span class="share-div"> 
                        <a href="<?php echo 'http://facebook.com/sharer.php?u='.$url.'&t='.urlencode($title).''?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                        <a href=<?php echo 'http://twitter.com/intent/tweet?url='.$url.'&text='.urlencode($title).'';?> target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                        <a href="<?php echo 'http://www.linkedin.com/shareArticle?url='.$url.'&mini=true&title='.urlencode($title).'&ro=false&summary='.urlencode($shortDesc).'&source='; ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> </span> </li>
              </ul>
            </div>
          </div>
          <div class="col-md-9 inner-right-side">
            <div class="right-sideTab"> 
              <!-- Tab panes -->
              <?php $heading_1 = get_field('heading_1');?>
              <?php if(get_field('heading_1')!='' || get_field('heading_2')!='' || get_field('heading_3')!=''){?>
              <ul role="tablist" class="nav nav-tabs">
                <?php if($heading_1!=''){?>
                  <li ><a href="<?php echo get_site_url()?>/events/?tag_title=<?php echo urlencode(get_field('heading_1')) ?>" ><?php the_field('heading_1');?></a></li>
                <?php }if(get_field('heading_2')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/events/?tag_title=<?php echo urlencode(get_field('heading_2')) ?>" ><?php the_field('heading_2')?></a></li>
                <?php }if(get_field('heading_3')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/events/?tag_title=<?php echo urlencode(get_field('heading_3')) ?>" ><?php the_field('heading_3')?></a></li>
                <?php }if(get_field('heading_4')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/events/?tag_title=<?php echo urlencode(get_field('heading_4')) ?>" ><?php the_field('heading_3')?></a></li>
                <?php }if(get_field('heading_5')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/events/?tag_title=<?php echo urlencode(get_field('heading_5')) ?>" ><?php the_field('heading_3')?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
              <div class="tab-content">
                  
                <div role="tabpanel" class="tab-pane active" id="home">
                  <h1><?php echo single_post_title(); ?></h1>
                  <p class="event-single-intro"><?php echo get_field('short_description');?></p>
                  <p><?php the_content();?></p>
                  <div class="BackBtn"> 
                 <ul>
                  <?php if( get_field('buy_ticket_url') ): ?>
                   <li><a target="_blank" href="https://www.google.co.in/"><i aria-hidden="true" class="fa fa-caret-right"></i> Buy Ticket Now <i aria-hidden="true" class="fa fa-shopping-cart fa-1x"></i></a></li>
                  <?php endif; ?>
                  <li> <a href="<?php echo get_site_url().'/events';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Back to all events</a></li>
                 </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
<?php get_footer(); ?>
<script>
  $(document).ready(function(){
    $('#closeImage').click(function(){
      $("img#hideImage").remove();
      $('#closeImage').hide();
    });
  });
</script>
