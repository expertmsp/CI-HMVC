<?php
/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */
?>
<?php do_action('bbp_template_before_forums_loop'); ?>
<?php
$i = 1;
while (bbp_forums()) : bbp_the_forum();
    if ($i > 4)
        $i = 1;
    $image = get_field('forum_image');
    $symbol = array('&#38;','&amp;','&');
    $titlef = str_replace($symbol,"",  strtolower(bbp_get_forum_title()));
    $titlef = str_replace(" ","-",  $titlef);
    ?>
    <div class="col-md-6 col-sm-6" id="bbp-forum-<?php bbp_forum_id(); ?>">
        <div class="forums-Box">
            <div class="forums-img forums-img-bg<?php echo ($i > 1) ? $i : '' ?>">
                <?php do_action('bbp_theme_before_forum_title'); ?>
                <div class="Forums-top">
                    <h3><?php bbp_forum_title(); ?></h3>
                    <a href="/services/<?php echo $titlef?>">Find out more</a> 
                </div>
                <?php do_action('bbp_theme_after_forum_title'); ?>
                <?php if ($image['url'] != '') { ?>
                    <div class="forums-img-m"><img style="width: 460px; height: 250px;" src="<?php echo $image['url'] ?>" /></div>
                <?php } ?>
            </div>
            <p style="overflow: hidden; max-height: 56px;"><?php bbp_forum_content(); ?></p>
          <!-- <p><?php //wp_strip_all_tags(bbp_forum_content()) ?></p> -->
            <?php bbp_get_template_part('loop', 'single-forum'); ?>
        </div>
    </div>
    <?php $i++;
endwhile; ?>    
<?php do_action('bbp_template_after_forums_loop'); ?>