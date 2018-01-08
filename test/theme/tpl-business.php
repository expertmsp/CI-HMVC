<?php
/**
  Template Name:Business Directories Page
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
$userId = get_current_user_id();
?>
<div class="container">
    <?php echo $thumb;?>
    <div class="content-page">
        <div class="inner-page">
                    <h1><?php echo $title; ?></h1>
                    <p class="blog-content"><?php the_content();?></p>
            <?php 
            if(isset($_REQUEST['tag_title']))
            {
               $_REQUEST['business_title'] = $_REQUEST['tag_title'];
            }
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
             if ((isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) && (!isset($_REQUEST['tag_title']))) {
                 $args = array(
                     'post_type' => 'directory',
                     'post_status' => 'publish',
                     'order' => $_REQUEST['order'],
                     's' => (isset($_REQUEST['business_title']) && $_REQUEST['business_title']!='')? urldecode($_REQUEST['business_title']):'',
                     'orderby' => $_REQUEST['orderby'],
                     'posts_per_page' => 5,
                     'paged'=>$paged
                 );
             } else if(!isset($_REQUEST['tag_title'])){
                 $args = array(
                     'post_type' => 'directory',
                     'post_status' => 'publish',
                     's' => (isset($_REQUEST['business_title']) && $_REQUEST['business_title']!='')? urldecode($_REQUEST['business_title']):'',
                     'posts_per_page' => 5,
                     'order' => 'ASC',
                     'orderby' => 'post_title',
                     'paged'=>$paged
                 );
                 $_REQUEST['orderby'] = 'post_title';
                 $_REQUEST['order'] = 'ASC';
             }
             if (isset($_REQUEST['tag_title']) && !(isset($_REQUEST['orderby']) && isset($_REQUEST['order']))) {
                 $args = array(
                     'post_type' => 'directory',
                     'post_status' => 'publish',
                     /*'s' => urldecode($_REQUEST['business_title']),*/
                     'order' => 'ASC',
                     'orderby' => 'post_title',
                     'posts_per_page' => 5,
                     'paged'=>$paged,
                     'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'heading_1',
                                    'value' => urldecode($_REQUEST['tag_title']),
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'heading_2',
                                    'value' => urldecode($_REQUEST['tag_title']),
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'heading_3',
                                    'value' => urldecode($_REQUEST['tag_title']),
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'heading_4',
                                    'value' => urldecode($_REQUEST['tag_title']),
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'heading_5',
                                    'value' => urldecode($_REQUEST['tag_title']),
                                    'compare' => '='
                                )
                            ),
                 );
                 $_REQUEST['orderby'] = 'post_title';
                 $_REQUEST['order'] = 'ASC';
             }
            
             //print_r($args);
            ?>
            <div class="Employment-main">
                <div class="LatestDiv">
                    <ul>
                        <li class="a-to-z <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'post_title') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=post_title&order=ASC' ?>">A - Z</a></li>
                        <li class="LatestText <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'post_date') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=post_date&order=DESC' ?>">Latest</a></li>                        
                        <li class="Search-keyword <?php if(isset($_REQUEST['news_search']) && !empty($_REQUEST['news_search'])) echo 'active'?>">
                            <form id="business-dir-search">
                                <input value="<?php if (isset($_REQUEST['business_title'])) { echo urldecode($_REQUEST['business_title']); }?>" type="text" placeholder="Search by keyword" name="business_title" id="business_title" required
                                       onblur="if (this.value == '') {
                                               this.value = 'Search by keyword';
                                           }"
                                       onfocus="if (this.value == 'Search by keyword') {
                                               this.value = '';
                                           }" />
                                        <input type="hidden" value="<?php echo (isset($_REQUEST['orderby'])?$_REQUEST['orderby']:'post_title')?>" name="orderby" />
                                        <input type="hidden" value="<?php echo ((isset($_REQUEST['orderby']) && $_REQUEST['orderby']=='post_title')?'ASC':'DESC')?>" name="order" />
                                 <button id="search-business" class="SubmitBtn">Submit</button>
                            </form>
                        </li>
                        <li class="ClearAll"><a id="ClearAll" href="javascript:void(0);">Clear All</a></li>
                    </ul>
                </div>
            </div>
            <div class="UpcomingEvents">
                <ul>
                    <?php

                    $newquery = new WP_Query($args);
                    //print_r($args);die;
                    //echo $wpdb->last_query;
                    if ($newquery->have_posts()):
                        while ($newquery->have_posts()):$newquery->the_post();
                            ?>
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "size" );?>
                            <li>
                                <?php if (get_field('logo')) { ?>
                                <div class="upcoming-img">
                                        <img src="<?php echo the_field('logo'); ?>" class="business-logo" />
                                    
                                </div> 
                                <?php } ?>
                                <div class="upcomingR">
                                    <h2><?php the_title(); ?></h2>
                                    <div class="rrr"><?php the_field('short_description'); ?></div>
                                   
                                    <div class="Directory-c-l">
                                        <ul>
                                            <?php if(get_field('phone_no')!=''){?>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo the_field('phone_no'); ?></li>
                                            <?php }
                                            if(get_field('email_address')!=''){?>
                                            <li>
                                                <a href="mailto:<?php echo the_field('email_address'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo the_field('email_address'); ?></a>
                                            </li>
                                            <?php }
                                            if(get_field('website_url')!=''){?>
                                            <li> 
                                                <i class="fa fa-desktop" aria-hidden="true"></i> 
                                                <a href="http://<?php echo the_field('website_url'); ?>" target="_blank" ><?php echo the_field('website_url'); ?></a>
                                            </li>
                                            <?php }
                                            if(get_field('business_address')!=''){ ?>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo the_field('business_address'); ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="Directory-c-R">
        <?php if ((get_field('heading_1') != '')): ?>
                                        <span> <a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_1')) ?>">
                                            <?php echo the_field('heading_1'); ?> 
                                            </a>
                                        </span>
                                        <?php endif; ?>
                                        <?php if ((get_field('heading_2') != '')): ?>
                                            <span> <a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_2')) ?>">
                                                <?php echo the_field('heading_2'); ?> </a></span> 
                                        <?php endif; ?>
                                        <?php if ((get_field('heading_3') != '')): ?>
                                            <span><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_3')) ?>">
                                             <?php echo the_field('heading_3'); ?> </a></span> 
                                        <?php endif; ?>
                                        <?php if ((get_field('heading_4') != '')): ?>
                                            <span><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_4')) ?>">
                                             <?php echo the_field('heading_4'); ?> </a></span> 
                                        <?php endif; ?>
                                        <?php if ((get_field('heading_5') != '')): ?>
                                            <span><a href="<?php echo get_site_url()?>/directory/?tag_title=<?php echo urlencode(get_field('heading_5')) ?>">
                                             <?php echo the_field('heading_5'); ?> </a></span> 
                                        <?php endif; ?>
                                    </div>
                                    <div class="clear"></div>
                                    <?php if ( is_user_logged_in() ) { ?>
                                    <div class="BackBtn">
                                        <ul>
                                            <li><a href="<?php echo ($userId>0)?the_permalink():get_site_url(); ?>" class="See-newsLink"><i class="fa fa-caret-right" aria-hidden="true"></i> View more about this organisation</a> </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="clear"></div>
                            </li> 
                <?php endwhile;?>
                <?php else : echo '<p>No content found</a>';
                      endif;
                      wp_reset_query();
                    if($newquery->post_count>=$args['posts_per_page'] || (isset($newquery->query['paged']) && $newquery->query['paged']>0)){?>
                        <li><?php echo wp_pagenavi( array( 'query' => $newquery ) ); ?></li>
                    <?php } ?>
                </ul>
                
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#search-business').on('click', function() {
        $('#business-dir-search').submit();
    });

    $('#ClearAll').on('click', function(){
        $('#business_title').val('');
        window.location.assign("<?php echo get_site_url()."/directory"?>");
    });
</script>
<?php get_footer(); ?>
