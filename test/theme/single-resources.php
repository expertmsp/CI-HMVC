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
        $content = get_the_content();
        $file = get_field('upload_file');
        $url = get_permalink();
    endwhile;
else : 
  $title = 'no Title Found';
  $shortDesc = 'No Description Found';
  $url = "";
endif;
?>

  <div class="container">      
    <div class="content-page">
          <?php if (has_post_thumbnail(get_the_ID())) {  ?>
          <div class="banner-img">
          <?php echo $thumb;?>
         </div>
          <?php } ?>
         <?php if(get_field('heading_1')!='' || get_field('heading_2')!='' || get_field('heading_3')!=''){?>
        <div class="row">
            <div class="col-md-12 inner-right-side">
                <div class="right-sideTab">
                    <!-- Tab panes -->
                    <?php $heading_1 = get_field('heading_1');?>
                   
                    <ul role="tablist" class="nav nav-tabs">
                      <?php if($heading_1!=''){?>
                      <li ><a href="<?php echo get_site_url()?>/resources/?tag_title=<?php echo urlencode(get_field('heading_1')) ?>" ><?php the_field('heading_1');?></a></li>
                      <?php }if(get_field('heading_2')!=''){ ?>
                      <li><a href="<?php echo get_site_url()?>/resources/?tag_title=<?php echo urlencode(get_field('heading_2')) ?>" ><?php the_field('heading_2')?></a></li>
                      <?php }if(get_field('heading_3')!=''){ ?>
                      <li><a href="<?php echo get_site_url()?>/resources/?tag_title=<?php echo urlencode(get_field('heading_3')) ?>" ><?php the_field('heading_3')?></a></li>
                      <?php }if(get_field('heading_4')!=''){ ?>
                      <li><a href="<?php echo get_site_url()?>/resources/?tag_title=<?php echo urlencode(get_field('heading_4')) ?>" ><?php the_field('heading_4')?></a></li>
                      <?php }if(get_field('heading_5')!=''){ ?>
                      <li><a href="<?php echo get_site_url()?>/resources/?tag_title=<?php echo urlencode(get_field('heading_5')) ?>" ><?php the_field('heading_5')?></a></li>
                      <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
              <?php } ?>
                  <h1><?php echo $title; ?></h1>
                
                  <p style="text-align:justify"><?php the_content();?></p>
                    <?php if(isset($file['url']) && $file['url']!=''){ ?>
                    
                  <div class="BackBtn"> 
                   <ul>
                   <li>
                     <div class="BackBtn">
                         <a target="_blank" href="<?php echo $file['url'];?>" title="Download File">
                             <!-- <img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/img/pdf.png" alt="Download" title="Download File"> -->
                             <i class="fa fa-caret-right" aria-hidden="true"></i> Download now</a>
                    </div>
                    <?php } ?>
                   </li>
                    <li> <a href="<?php echo get_site_url().'/resources';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Back to resources and publications</a></li>
                   </ul>
                  </div>
                
            </div>
<?php get_footer(); ?>
