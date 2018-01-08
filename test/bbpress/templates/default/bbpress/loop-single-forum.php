<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

$args = array(
            'post_type' => 'topic',
            'post_status' =>'publish',
            'post_parent' => get_the_ID(),
            'order' => DESC,
            'posts_per_page' => 3
            );
$newquery = new WP_Query($args);
//print_r($newquery);
if ($newquery->have_posts()):?>      
    <ul>
    <?php while ($newquery->have_posts()):
                $newquery->the_post();?>
        <li>
            <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/forums-icon.jpg" alt="" />
            <a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a>
            <span><?php echo the_time('j F, Y'); ?></span>
        </li>
    <?php endwhile;?>
        <li> <img src="<?php echo plugins_url('bbpress/templates/default/');?>images/forums-icon.jpg" alt=""><a href="<?php bbp_forum_permalink(); ?>"> See all active threads</a></li>
    </ul>
<?php endif;
wp_reset_query(); ?>

