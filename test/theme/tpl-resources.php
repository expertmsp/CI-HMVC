<?php
/**
  Template Name:Resources
 */
get_header();
?>

<div class="container">
    <div class="content-page">
        <div class="inner-page">
            <?php
            if ( have_posts() ) : 
                while ( have_posts() ) : 
                    the_post();
                    if (has_post_thumbnail(get_the_ID())) { 
                        echo the_post_thumbnail();
                     }?> 
<!--                    <h1><?php //the_title(); ?></h1>-->
                    <p class="blog-content"> <?php the_content(); ?></p>
            <?php endwhile;
            endif;?>
            <?php if ( is_user_logged_in() ) {?>
            <div class="Employment-main">
                <div class="LatestDiv">
                    <ul>
                        <li class="LatestText <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'date') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=date&order=DESC' ?>">Latest</a></li>
                        <li class="a-to-z <?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby'] == 'post_title') echo 'active'?>"><a href="<?php echo the_permalink() . '?orderby=post_title&order=ASC' ?>">A - Z</a></li>
                        <li class="Search-keyword">
                        <?php
                        //if(isset($_REQUEST['resource'])){echo $_REQUEST['resource'];die;}
                        if(isset($_REQUEST['tag_title']))
                        {
                           $_REQUEST['resource'] = $_REQUEST['tag_title'];
                        }?>
                            <form id="searchresource">
                                <input type="text" placeholder="Search by keyword" name="resource" id="resource" value="<?php if (isset($_REQUEST['resource'])) { echo urldecode($_REQUEST['resource']); }?>"/>
                                <button id="search-resource" class="SubmitBtn">Submit</button>
                            </form>
                        </li>
                        <li class="ClearAll"><a id="ClearAll" href="javascript:void(0);">Clear All</a></li>
                    </ul>
                </div>
                <div class="Type-main">
                    <ul>
                        <li class="TypeHead">
                            <div class="forums-icon-2"><h4>TYPE</h4></div>
                            <div class="forums-icon-2"><h4>TITLE</h4></div>
                            <div class="forums-icon-2" style="float: right; margin-right: 40px;"><h4>DATE</h4></div>
                            <div class="clear"></div>
                        </li>

                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if ((isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) && (!isset($_REQUEST['tag_title']))) {
                            $args = array(
                                'post_type' => 'resources',
                                's' => urldecode($_REQUEST['resource']),
                                'order' => $_REQUEST['order'],
                                'orderby' => $_REQUEST['orderby'],
                                'posts_per_page' => 10,
                                'paged'=>$paged,
                            );
                        } else if(!isset($_REQUEST['tag_title'])){
                            $args = array(
                                'post_type' => 'resources',
                                's' => urldecode($_REQUEST['resource']),
                                'posts_per_page' => 10,
                                'paged'=>$paged,
                            );
                        }
                        if (isset($_REQUEST['tag_title']) && !(isset($_REQUEST['orderby']) && isset($_REQUEST['order']))) {
                        $args = array(
                            'post_type' => 'resources',
                            /*'s' => urldecode($_REQUEST['resource']),*/
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
                                $file = get_field('upload_file');
                                ?>
                                <li>
                                    <div class="forums-icon-2"><a target="_blank" href="<?php echo $file['url'];?>">
                                            <img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/img/pdf.jpeg" alt=""></a></div>
                                    <div class="LostTime">
                                        <a href="<?php the_permalink() ?>"><h4 style="margin-top: 22px;margin-left: 30px;"><?php the_title(); ?></h4></a>
                                    </div>
                                    <span><?php echo get_the_date('j F Y'); ?></span>
                                    <div class="clear"></div>
                                </li>
                            <?php endwhile; ?>
                            <?php else : echo '<p>No content found</a>';
                      endif;
                     // print_r($newquery->query['paged']);
                    if($newquery->post_count>=$args['posts_per_page'] || (isset($newquery->query['paged']) && $newquery->query['paged']>0)){?>
                        <li><?php echo wp_pagenavi( array( 'query' => $newquery ) ); ?></li>
                    <?php } ?>
                </ul>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search-resource').on('click', function() {
        $('#searchresource').submit();
    });

    $('#ClearAll').on('click', function() {
        $('#resource').val('');
        window.location.assign("<?php echo get_site_url()."/resources"?>");
    });

</script>
<?php get_footer(); ?>
