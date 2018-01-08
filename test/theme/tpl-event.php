<?php
//error_reporting(E_ALL);
/**
  Template Name:Event Page
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
<?php
                        if(isset($_REQUEST['tag_title']))
                        {
                           $_REQUEST['event_title'] = $_REQUEST['tag_title'];
                        }?>
<style type="">
    .event_title {
        color: #72221c;
        font-size: 28px;
        font-weight: 400;
    }/*  */
</style>
<div class="container">
    <?php echo $thumb;?>
    <div class="content-page">
        <div class="inner-page">
                    <h1><?php echo $title ?></h1>
                    <p class="blog-content"><?php echo get_the_content();?></p>
            <div class="Employment-main">
                <div class="LatestDiv">
                    <ul>
                        <li class="LatestText <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'date') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=date&order=DESC' ?>">Upcoming</a></li>
                        <li class="a-to-z <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'post_title') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=post_title&order=ASC' ?>">A - Z</a></li>
                        <li class="Search-keyword">
                            <form id="searchevents">

                                <input id="events_name" type="text" required value="<?php
                                       if (isset($_REQUEST['event_title'])) {
                                           echo urldecode($_REQUEST['event_title']);
                                       }
                                       ?>" placeholder="Search by keyword" name="event_title" id="Email"
                                       onblur="if (this.value == '') {
                                                   this.value = 'Search by keyword';
                                               }"
                                       onfocus="if (this.value == 'Search by keyword') {
                                                   this.value = '';
                                               }"  />
                                <button id="search-events" class="SubmitBtn">Submit</button>
                            </form>
                        </li>
                        <li class="ClearAll"><a id="ClearAll" href="javascript:void(0);">Clear All</a></li>
                    </ul>
                </div>
                <div class="UpcomingEvents">
                    <ul>
                        <?php 
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if ((isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) && (!isset($_REQUEST['tag_title']))) {
                            $args = array(
                                'post_type' => 'events',
                                's' => urldecode($_REQUEST['event_title']),
                                'order' => $_REQUEST['order'],
                                'orderby' => $_REQUEST['orderby'],
                                'order'     => 'ASC',
                                'meta_key' => 'date',
                                'orderby'   => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key' => 'date',
                                        'value' => date('Ymd'),
                                        'compare' => '>=',
                                    ),
                                ),
                                'posts_per_page' => 10,
                                'paged'=>$paged
                                
                            );
                        } else if(!isset($_REQUEST['tag_title'])){
                            $args = array(
                                'post_type' => 'events',
                                's' => urldecode($_REQUEST['event_title']),
                                'order'     => 'ASC',
                                'meta_key' => 'date',
                                'orderby'   => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key' => 'date',
                                        'value' => date('Ymd'),
                                        'compare' => '>=',
                                    ),
                                ),
                                'posts_per_page' => 10,
                                'paged'=>$paged
                            );
                        }
                        if (isset($_REQUEST['tag_title']) && !(isset($_REQUEST['orderby']) && isset($_REQUEST['order']))) {
                            $args = array(
                                'post_type' => 'events',
                                /*'s' => urldecode($_REQUEST['event_title']),*/
                                'order'     => 'ASC',
                                'meta_key' => 'date',
                                'orderby'   => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key' => 'date',
                                        'value' => date('Ymd'),
                                        'compare' => '>=',
                                    ),
                                ),
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
                                    <?php if(has_post_thumbnail(get_the_ID())){ ?>
                                    <div class="upcoming-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('full'); ?></a>
                                    </div>
                                    <?php  } ?>
                                    <div class="upcomingR">
                                        <h2><a class="event_title" id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="FreeEvent">
                                            <ul>
                                                <li><?php echo the_field('event_type'); ?></li>
                                                <li><?php echo date('j F, Y', strtotime(get_field('date'))); ?></li>
                                                <li><?php echo the_field('event_time'); ?></li>
                                                <li><?php echo the_field('event_location'); ?></li>
                                            </ul>
                                        </div>
                                        <div class="event-intro"><?php echo the_field('short_description'); ?></div>
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
                        if($newquery->post_count>=$args['posts_per_page']){
                        ?>
                        <li><?php wp_pagenavi( array( 'query' => $newquery ) ); ?></li>
                        <?php 
                        }
                        wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search-events').on('click', function() {
        $('#searchevents').submit();
    });
    $('#ClearAll').on('click', function() {
        $('#events_name').val('');
        window.location.assign("<?php echo get_site_url() . "/events" ?>")
    });
</script>
<?php get_footer(); ?>
