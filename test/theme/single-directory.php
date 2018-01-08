<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
if (!is_user_logged_in() ) { 
wp_redirect(get_site_url().'/login');
exit;
}
get_header(); ?>
  <div class="container">
    <div class="content-page">
      <div class="inner-page">
        <div class="row">
          <div class="col-md-3">
              
            <div class="catchy-headlines-left">
              <ul>
                <?php if(get_field('logo')!=''){?>
                <li><img src="<?php echo the_field('logo'); ?>" class="business-logo" /></li>
                <?php } ?>
                <li> Business Address<span><?php echo the_field('business_address'); ?></span></li>
                <li> Phone Number<span><?php echo the_field('phone_no'); ?></span></li>
                <li> Email Address<span><a href="mailto:<?php echo the_field('email_address');?>"><?php echo the_field('email_address');?></a></span></li>
                <li> Website Url<span><a href="http://<?php echo the_field('website_url');?>" target="_blank" ><?php echo the_field('website_url');?></a></span></li>
              </ul>
            </div>
          </div>
          <div class="col-md-9 inner-right-side">
              <?php if(has_post_thumbnail(get_the_ID())!='' || TRUE){?>
            <span style="float:right"><a href="javascript:void(0);" id="closeImage"><i class="fa fa-times" aria-hidden="true"></i></a></span> 
            <span id="hideImage"><?php echo the_post_thumbnail('full'); ?></span>
              <?php } ?>
            <div class="right-sideTab"> 
              <!-- Tab panes -->
              <?php $heading_1 = get_field('heading_1');?>
              <?php if(get_field('heading_1')!='' || get_field('heading_2')!='' || get_field('heading_3')!=''){?>
              <ul role="tablist" class="nav nav-tabs">
                <?php if($heading_1!=''){?>
                <li ><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_1')) ?>" ><?php the_field('heading_1');?></a></li>
                <?php }if(get_field('heading_2')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_2')) ?>" ><?php the_field('heading_2')?></a></li>
                <?php }if(get_field('heading_3')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_3')) ?>" ><?php the_field('heading_3')?></a></li>
                <?php }if(get_field('heading_4')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_4')) ?>" ><?php the_field('heading_4')?></a></li>
                <?php }if(get_field('heading_5')!=''){ ?>
                <li><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_5')) ?>" ><?php the_field('heading_5')?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                        <p class="blog-content"> <?php the_content(); ?></p>

                      <?php endwhile;

                      else : 
                        echo '<p>No content found</a>';

                      endif;
                    ?>
                 <?php /* <h1><?php echo get_the_title(); ?></h1>
                  <p><?php echo the_content();?></p>
                  * 
                  */?>
                  <div class="BackBtn"> 
                 <ul>
                  <li> <a href="<?php echo get_site_url().'/directory';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Back to the directory</a></li>
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
  <script>
    $(document).ready(function(){
       $('#closeImage').click(function(){
        $("span#hideImage").remove();
        $('#closeImage').hide();
      });
    });
  </script>
<?php get_footer(); ?>
