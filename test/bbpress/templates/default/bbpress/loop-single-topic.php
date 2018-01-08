<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<li>
    <div class="forums-icon-2"><img src="<?php echo plugins_url('bbpress/templates/default/');?>images/forums-icon.jpg" alt=""></div>
    <div class="LostTime">
    <?php do_action( 'bbp_theme_before_topic_title' ); ?>
    <h4><a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></h4>
    <?php do_action( 'bbp_theme_after_topic_title' ); ?>
	<?php bbp_topic_pagination(); ?>
	<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>
   <?php  
        $content = get_the_content();
        $content = strip_tags($content);
    ?>
    <p><?php echo substr($content, 0,250);?></p>
    </div>
    <?php do_action( 'bbp_theme_after_topic_meta' ); ?>
    <?php bbp_topic_row_actions(); ?>
    <span><?php echo the_time('d-m-Y'); ?></span>
    <div class="clear"></div>
</li>
		
		

	
