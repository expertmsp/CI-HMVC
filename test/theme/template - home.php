<?php
/*
  Template Name: Home
 */

get_header();
$siteurl = get_site_url()."/wp-content/themes/p4p/img/";
$news = array(
    'post_type' => 'post',
    'cat' => 21,
    'numberposts' => '1'
);
$recent_news = wp_get_recent_posts( $news );

$news = array("title" => $recent_news[0]['post_title'],
        "comment" => strip_tags($recent_news[0]['post_content'],"<p>"),
        "image" => (has_post_thumbnail($recent_news[0]['ID']))? get_the_post_thumbnail($recent_news[0]['ID']):'<img src="'.$siteurl.'news_standard.jpeg">',
        "href" => "news-room"
    );

$resourcess = array(
    'post_type' => 'resources',
    'numberposts' => '1'
);
$recent_resources = wp_get_recent_posts( $resourcess );

$resorce = array("title" => $recent_resources[0]['post_title'],
        "comment" => strip_tags($recent_resources[0]['post_content'],"<p>"),
        "image" => (has_post_thumbnail($recent_resources[0]['ID']))? get_the_post_thumbnail($recent_resources[0]['ID']):'<img src="'.$siteurl.'resources_standard.jpeg">',
        "href" => "resourses"
    );

$eventss = array(
    'post_type' => 'events',
    'numberposts' => '1'
);
$recent_events = wp_get_recent_posts( $eventss );
$evnts = array("title" => $recent_events[0]['post_title'],
        "comment" => strip_tags($recent_events[0]['post_content'],"<p>"),
        "image" => (has_post_thumbnail($recent_events[0]['ID']))? get_the_post_thumbnail($recent_events[0]['ID']):'<img src="'.$siteurl.'event_standard.jpeg">',
        "href" => "events"
    );

$jumboItems = array
    (
    $news,
    $resorce,
    $evnts
);
?>
<div class="container">
<div id="home">
    <div id="hero" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators" style="z-index: 100 !important;">
            <li data-target="#hero" data-slide-to="0" class="active"></li>
            <li data-target="#hero" data-slide-to="1"></li>
            <li data-target="#hero" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner carousel-inner-hero" role="listbox">
            <?php for ($row = 0; $row <= 2; $row++) {
                $imageurl =  ($jumboItems[$row]["image"]!='')?$jumboItems[$row]["image"]:'<img src="/wp-content/themes/p4p/img/hero20.jpg" />';
                echo'
      <div class="item">
          ' . $imageurl. '
          <div class="carousel-caption">
            <div class="hero">
              <div id="" class="hero-filler"></div>
           <div class="hero-container">
          <ul class="hero-info list-unstyled">
            <li>
              <i class="icon-p4p-pilbaraforpurpose"></i>
              <h4 class="title-banner">
                ' . $jumboItems[$row]["title"] . '
                 </h4>
                 
                 <div><i class="fa fa-caret-right"></i><a href="/' . $jumboItems[$row]["href"] . '">Find out more</a></div>
               </li>
             </ul>
           </div>
         </div>
        </div>
      </div>
    ';
            }
            ?>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-4 col-md-push-8 front-sidebar">
            <div class="side-img"><img class="" src="<?php echo get_bloginfo('template_directory'); ?>/img/logo_p4p_vert.svg" alt=""></div>
            <h3>Become a Pilbara for Purpose Member</h3>
            <p>
                Pilbara for Purpose offers a range of membership levels from individual right through to corporate. Members have access to reports, resources and publications along with an in depth service directory and forums that allow members to support each other as we develop stronger and more engaged communities.
            </p>
            <div class="vacant">
            <p class="link1"><i class="fa fa-caret-right"></i><a href="/about-pilbara-for-purpose/about-membership">Learn more</a></p>
            <?php if(!is_user_logged_in()){?>
            <p class="link2"><i class="fa fa-caret-right"></i><a href="/login">Already a member? Sign in</a></p>
            <?php } ?>
            </div>
            <div class="bg-layer">

            </div>
            <div class="form">
        <?php
                if (isset($_REQUEST['reason']) && !empty($_REQUEST['reason'])) {
        $admin_email = get_option('admin_email');
        $to = $admin_email;
        $subject = "New request has been recieved for the membership level";
        $message = '<div class="form">
                <a class="navbar-brand" href="'. get_site_url() .'"><img src="' . get_bloginfo('template_directory') . '/img/p4p_logo.png" alt=""></a><br>
                        <div class="form-input">
                            Name: ' . $_REQUEST['username'] . '
                        </div>
                        <div class="form-input">
                            Email: ' . $_REQUEST['email'] . '
                        </div>
                        <p>New request for level of membership interested for:</p>
                        <div class="checkbox">';
        ?>
        <?php foreach ($_REQUEST['reason'] as $reason): ?>
            <?php $message .= '<div class="box">
                                <label>
                                    ' . $reason . '</label>
                            </div>'; ?>
        <?php endforeach; ?>
        <?php
        $message .= '</div>
                <div class="clear"></div>
        </div>';
        ?>
        <?php
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <p4p.uxconsulting.com.au/>' . "\r\n";

                if(mail($to, $subject, $message, $headers)){
                    $msg = '<div class="alert alert-success">
  <strong>Thank you!</strong> we will contact you shortly.
</div>';
                }else{
                    $msg = '
<div class="alert alert-warning">
  <strong>Warning!</strong> something went wrong, please contact after some time.
</div>';
                }
                echo $msg;
    }
        ?>
        <form action="" method="POST">
        
          <div class="form-input">
              <input type="text" name="username" placeholder="Enter Your Name" required="required">
          </div>
          <div class="form-input">
            <input type="email" name="email" placeholder="Enter Your Email" required="required">
          </div>
            <p>What level of membership are you interested in?</p>
          <div class="checkbox">
            
	    <div class="box">
            <label>
              <input name="reason[]" value="For Purpose" type="checkbox"> For Purpose
            </label>
            </div>
	    <div class="box">
                <label>
                    <input name="reason[]" value="Individual" type="checkbox"> Individual
                </label>
            </div>
            <div class="box">
            <label>
              <input name="reason[]" value="Volunteer" type="checkbox"> Volunteer
            </label>
            </div>
	    <div class="box">
            <label>
              <input name="reason[]" value="For Profit" type="checkbox"> For Profit
            </label>
            </div>
            <div class="box">
            <label>
              <input name="reason[]" value="Government Purpose" type="checkbox">Government
            </label>
            </div>
            
          </div>
          <div class="clear"></div>
          <div class="button">
            <button type="submit" class="btn-submit">Submit</button>
          </div>
        </form>
    </div>
        </div>
        <div class="col-md-8 col-md-pull-4 recent_tabs">

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="tb-news active"><a  href="#news" aria-controls="home" role="tab" data-toggle="tab">  <i class="icon-p4p-news"></i> &nbsp;News Room</a></li>
                <li role="presentation" class="tb-publications"><a  href="#publications" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-p4p-resources"></i> &nbsp;Publications</a></li>
                <li role="presentation" class="tb-events"><a  href="#events" aria-controls="messages" role="tab" data-toggle="tab"><i class="icon-p4p-calendar"></i> &nbsp;Upcoming Events</a></li>
            </ul>
<!--            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a style="color: #c13b27 !important; border-bottom: 3px solid #c13b27;" href="#news" aria-controls="home" role="tab" data-toggle="tab">  <i class="icon-p4p-news"></i> &nbsp;News Room</a></li>
                <li role="presentation"><a style="color: #130A5A !important; border-bottom: 3px solid #130A5A;" href="#publications" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-p4p-resources"></i> &nbsp;Publications</a></li>
                <li role="presentation"><a style="color: #EC9D21 !important; border-bottom: 3px solid #EC9D21;" href="#events" aria-controls="messages" role="tab" data-toggle="tab"><i class="icon-p4p-calendar"></i> &nbsp;Upcoming Events</a></li>
            </ul>-->
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="news">
                    <ul class="list-unstyled">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'cat' => 21,
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'posts_per_page' => 9,
                        );
                        $newquery = new WP_Query($args);
                        if ($newquery->have_posts()):
                            while ($newquery->have_posts()):$newquery->the_post();
                                ?>
                                <li>
                                    <a href="<?php echo the_permalink(); ?>">
                                        <p><?php

                                            $str = get_the_title(); 
                                            $out = strlen($str) > 60 ? substr($str,0,60)."..." : $str ;

                                        echo $out; ?></p>
                                        <p><?php the_time('j F, Y'); ?></p>
                                    </a>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="publications">
                    <ul class="list-unstyled">
                        <?php
                        $args = array(
                            'post_type' => 'resources',
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'posts_per_page' => 9,
                        );
                        $newquery = new WP_Query($args);
                        if ($newquery->have_posts()):
                            while ($newquery->have_posts()):$newquery->the_post();
                                ?>
                                <li>
                                    <a href="<?php echo the_permalink(); ?>">
                                        <p><?php

                                            $str = get_the_title(); 
                                            $out = strlen($str) > 60 ? substr($str,0,60)."..." : $str ;

                                        echo $out; ?></p>
                                        <p><?php echo get_the_date(); ?></p>
                                    </a>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="events">
                    <ul class="list-unstyled">
                        <?php
                        $today= date('Ymd');
                        $args = array(
                            'post_type' => 'events',
                            'meta_key' => 'date',
                            'meta_query' => array(
                                array(
                                    'key' => 'date'
                                ),
                                array(
                                    'key' => 'date',
                                    'value' => $today,
                                    'compare' => '>'
                                )
                            ),
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'posts_per_page' => 9,
                        );

                        $newquery = new WP_Query($args);
                        if ($newquery->have_posts()):
                            while ($newquery->have_posts()):$newquery->the_post();
                                ?>
                                <li>
                                    <a href="<?php echo the_permalink(); ?>">
                                        <p><?php

                                            $str = get_the_title(); 
                                            $out = strlen($str) > 60 ? substr($str,0,60)."..." : $str ;

                                        echo $out; ?></p>
                                        <p><?php echo date('j F, Y', strtotime(get_field('date'))); ?></p>
                                    </a>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?php 
            $page_id = 683; 
            $content = get_post($page_id); 
            $description = $content->post_content; 
        ?>
        <div class="heading-2">
            <h2><?php echo get_the_title($page_id); ?></h2>
        </div>
        <div class="heading-3">
            <p style="text-align:justify"><?php echo $description; ?></p>
        </div>
        <div class="ForumsMain">
          <?php
            $args = array(
                'post_type' => 'services',
		'orderby' =>'title',
                'order'=>'ASC',
                'posts_per_page'=>-1,
            );

            $newquery = new WP_Query($args);
            if ($newquery->have_posts()):
                $i = 1;
                while ($newquery->have_posts()):$newquery->the_post();
                    if ($i > 4)
                        $i = 1;
            ?>
            <div class="col-md-4 col-sm-4">
              <div class="forums-Box">
                <div class="forums-img forums-img-bg<?php echo ($i > 1) ? $i : '' ?>">
                  <div class="Forums-top">
			<a href="<?php echo the_permalink();?>">
                    <h3><?php the_title(); ?></h3>
                    Find out more </div>
                    <?php $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "size"); ?>
                  <div class="forums-img-m"> <img src="<?php echo $thumbnail_src[0] ?>" alt=""> </div>
			</a>
                </div>
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
<?php get_footer(); ?>
