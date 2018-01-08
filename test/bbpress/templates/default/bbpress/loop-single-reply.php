<?php
/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */
$reply_id = bbp_get_reply_id();
?>
<div class="profile-bx">
    <div class="well">
        <?php bbp_reply_admin_links(); ?>
        <div class="two-separate">
            <div class="image"> <a href="<?php echo bbp_reply_author_url($reply_id); ?>"><?php echo bbp_reply_author_avatar($reply_id, 125); ?></a>
            </div>

            <div class="pro-info-txt">
                <p><?php echo bbp_reply_author_display_name($reply_id); ?></p>
                <p><?php bbp_reply_post_date(); ?></p>
            </div>
        </div>

    </div>
    <div class="view-info-bx">
        <?php bbp_reply_content(); ?>
    </div>
</div>
<style>
    legend {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: -moz-use-text-color -moz-use-text-color #e5e5e5;
    border-image: none;
    border-style: none none solid;
    border-width: 0 0 1px;
    color: #333;
    display: block;
    font-size: 21px;
    line-height: inherit;
    margin-bottom: 30px;
    margin-top: 50px;
    padding: 0;
    width: 100%;
    font-family: "proximanovasemiboldwebfont";
    font-size: 18px;
}
div.bbp-template-notice{
    display:none;
}
</style>