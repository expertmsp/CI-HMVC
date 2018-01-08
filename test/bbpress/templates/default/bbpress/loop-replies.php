<?php
/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */
$topic_id = bbp_get_topic_id();
?>
    <div class="page52-well-cnt">
        <h2>Forums: <?php echo bbp_topic_title($topic_id); ?></h2>
        <p><?php echo bbp_topic_content($topic_id); ?></p>
    </div>

    <ul class="pg52-commtent-show">
        <li><span><h4 class="txt-hd">Title</h4></span>
            <div class="descri-txt"><?php echo bbp_topic_title($topic_id); ?></div>
        </li>
        <li><span><h4 class="txt-hd">Description</h4></span>
            <div class="descri-txt"><?php echo bbp_topic_content($topic_id); ?></div>
        </li>
        <li><span><h4 class="txt-hd">Created by</h4></span>
            <div class="descri-txt"><?php echo bbp_topic_author($topic_id); ?></div>
        </li>
    </ul>

    <div class="pg52-profile-bx">


        <?php do_action('bbp_template_before_replies_loop'); ?>

        <!--<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">-->

            <!--<li class="bbp-body">-->

                <?php if (bbp_thread_replies()) : ?>

                    <?php bbp_list_replies(); ?>

                <?php else : ?>

                    <?php while (bbp_replies()) : bbp_the_reply(); ?>

                        <?php bbp_get_template_part('loop', 'single-reply'); ?>

                    <?php endwhile; ?>

                <?php endif; ?>

            <!--</li> .bbp-body -->

<!--</ul> #topic-<?php bbp_topic_id(); ?>-replies -->

        <?php do_action('bbp_template_after_replies_loop'); ?>
    
</div>
<style>
    .quicktags-toolbar {
        display:none;
    }
    .wp-editor-container{
        border:1px solid black;
    }
</style>