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
    <?php echo $thumb;?>
    <div class="content-page">
      <div class="inner-page">
        <div class="row">
          <div class="col-md-3">
            <div class="catchy-headlines-left">
              <ul>
                <li> LOCATION<span><?php echo the_field('event_location',the_post('ID')); ?></span></li>
                <li> CONTACT INFO<span><?php echo the_field('contact_info',the_post('ID')); ?></span></li>
                <li> EVENT TYPE<span><?php echo the_field('event_type'); ?></span></li>
                <li> EVENT DATE<span><?php echo the_field('date'); ?></span></li>
                <li> EVENT TIME<span><?php echo the_field('event_time'); ?></li>
                <li> SHARE 
                    <span class="share-div"> 
                        <a href="<?php echo 'http://facebook.com/sharer.php?u='.$url.'&t='.urlencode($title).''?>"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                        <a href=<?php echo 'http://twitter.com/intent/tweet?url='.$url.'&text='.urlencode($title).'';?>><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                        <a href="<?php echo 'http://www.linkedin.com/shareArticle?url='.$url.'&mini=true&title='.urlencode($title).'&ro=false&summary='.urlencode($shortDesc).'&source='; ?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> </span> </li>
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
                <li ><?php the_field('heading_1');?></a></li>
                <?php }if(get_field('heading_2')!=''){ ?>
                <li><?php the_field('heading_2')?></li>
                <?php }if(get_field('heading_3')!=''){ ?>
                <li><?php the_field('heading_3')?></li>
                <?php } ?>
              </ul>
              <?php } ?>
              <div class="tab-content">
                  
                <div role="tabpanel" class="tab-pane active" id="home">
                  <h1><?php echo single_post_title(); ?></h1>
                  <p><?php echo get_field('short_description');?></p>
                  <p><?php echo get_the_content();?></p>
                  <div class="BackBtn"> 
                 <ul>
                  <li> <a href="<?php echo get_site_url().'/events';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Back to the events</a></li>
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
