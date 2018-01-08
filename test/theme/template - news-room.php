<?php
/*
  Template Name: News Room
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
<div id="" class="container">
    <?php echo $thumb;?>
    <div class="content-page">
        <div class="inner-page">
            <h1 id="upcoming-events"><?php echo $title; ?></h1>
            <div class="Employment-main">
                <div class="LatestDiv">
                    <ul>
                        <li class="LatestText <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'date') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=date&order=DESC' ?>">Latest</a></li>
                        <li class="a-to-z <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'post_title') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=post_title&order=ASC' ?>">A - Z</a></li>
                        <li class="Search-keyword <?php if(isset($_REQUEST['news_search']) && !empty($_REQUEST['news_search'])) echo 'active'?>">
                        <?php
                        //if(isset($_REQUEST['resource'])){echo $_REQUEST['resource'];die;}
                        if(isset($_REQUEST['tag_title']))
                        {
                           $_REQUEST['news_search'] = $_REQUEST['tag_title'];
                        }?>
                            <form id="searchresource">
                                <input type="text" placeholder="Search by keyword" name="news_search" id="resource" value="<?php if(isset($_REQUEST['news_search'])){ echo $_REQUEST['news_search']; }  ?>"/>
                                <button id="search-resource" class="SubmitBtn">Submit</button>
                            </form>
                        </li>
                        <li class="ClearAll <?php if(isset($_REQUEST['clear']) && $_REQUEST['clear'] == '1') echo 'active'?>"><a id="ClearAll" href="<?php echo get_site_url().'/news-room?clear=1'; ?>">Clear All</a></li>
                    </ul>
                </div>
                <div class="UpcomingEvents">
                    <ul>
                        <?php
                       $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if ((isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) && (!isset($_REQUEST['tag_title']))) {
                            $args = array(
                                'post_type' => 'post',
                                's' => urldecode($_REQUEST['news_search']),
                                'order' => $_REQUEST['order'],
                                'orderby' => $_REQUEST['orderby'],
                                'cat' => 21,
                                'posts_per_page' => 10,
                                'paged'=>$paged
                            );
                        } else if(!isset($_REQUEST['tag_title'])){
                            $args = array(
                                'post_type' => 'post',
                                's' => urldecode($_REQUEST['news_search']),
                                'cat' => 21,
                                'posts_per_page' => 10,
                                'paged'=>$paged
                            );
                        }
                        if (isset($_REQUEST['tag_title']) && !(isset($_REQUEST['orderby']) && isset($_REQUEST['order']))) {
                            $args = array(
                            'post_type' => 'post',
                            /*'s' => urldecode($_REQUEST['news_search']),*/
                            'cat' => 21,
                            'posts_per_page' => 10,
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
                        }
                        $newquery = new WP_Query($args);
                        if ($newquery->have_posts()):
                            while ($newquery->have_posts()):$newquery->the_post();
                                ?>
                                <li>
                                    <!-- <div class="upcoming-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('full'); ?></a>
                                    </div> -->
                                    <div class="upcomingR">
                                        <h2><a class="event_title" id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="FreeEvent">
                                            <ul>
                                                <li><?php echo date('j F, Y', strtotime(get_the_date())); ?></li>
<!--                                                <li><?php // echo substr(get_the_content(), 0,100); ?></li>-->
                                            </ul>
                                        </div>
                                        <div class="BackBtn">
                                            <ul>
                                                <li><a href="<?php the_permalink(); ?>" class="See-newsLink"><i class="fa fa-caret-right" aria-hidden="true"></i> Find out more</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </li> 
                                <?php
                            endwhile;
                            else : 
                                echo '<p>No content found</a>';
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
</div>


<?php get_footer(); ?>
