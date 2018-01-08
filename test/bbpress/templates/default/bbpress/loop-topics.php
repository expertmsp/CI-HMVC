<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php do_action( 'bbp_template_before_topics_loop' ); ?>
<ul id="bbp-forum-<?php bbp_forum_id(); ?>">
<li class="TypeHead">
    <div class="forums-icon-2"><h4>TYPE</h4></div>
    <div class="forums-icon-2"><h4>TITLE</h4></div>
    <div class="forums-icon-2" style="float: right; margin-right: 40px;"><h4>DATE</h4></div>
    <div class="clear"></div>
</li>

<?php while ( bbp_topics() ) : bbp_the_topic(); ?>
	<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>
<?php endwhile; ?>
</ul>
<?php do_action( 'bbp_template_after_topics_loop' ); ?>
