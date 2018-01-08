<?php

/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
?>
<style>
    .blog-title{ display: none;}
</style>
<?php 
    $image = get_field('forum_image');?>
    <div class="forums-img-m"><img style="" src="<?php echo $image['url'] ?>" /></div>
    <div class="content-page">
      <div class="inner-page">
      <?php bbp_breadcrumb(); ?>
      <?php bbp_forum_subscription_link(); ?>
        <h1>Forums: <?php bbp_forum_title(); ?></h1>
        <p><?php bbp_forum_content(); ?></p>
        <div class="Employment-main">
        <?php do_action( 'bbp_template_before_single_forum' ); ?>
            <?php if ( post_password_required() ) : ?>
              <?php bbp_get_template_part( 'form', 'protected' ); ?>
            <?php else : ?>
              <?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>
                <?php bbp_get_template_part( 'form',       'topic'     ); ?>
                <?php elseif ( !bbp_is_forum_category() ) : ?>
                <?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>
                <?php bbp_get_template_part( 'form',       'topic'     ); ?>
          <?php endif; ?>
          <?php endif; ?>
          <?php do_action( 'bbp_template_after_single_forum' ); ?>
          <div class="LatestDiv">
            <ul>
              <li class="LatestText <?php if(isset($_REQUEST['order_by']) && $_REQUEST['order_by'] == 'date') echo 'active'?>"><a href="<?php echo the_permalink() .'?order=DESC&order_by=date'?>">Latest</a></li>
              <li class="a-to-z <?php if(isset($_REQUEST['order_by']) && $_REQUEST['order_by'] == 'title') echo 'active'?>"><a href="<?php echo the_permalink() .'?order=ASC&order_by=title'?>">A - Z</a></li>
              <li class="Search-keyword">
                <?php bbp_get_template_part('form', 'search'); ?>
              </li>
              <li class="ClearAll"><a id="ClearAll" href="javascript:void(0);">Clear All</a></li>
            </ul>
          </div>
          <div class="Type-main">
            <?php do_action( 'bbp_template_before_single_forum' ); ?>
      			<?php if ( post_password_required() ) : ?>
              <?php bbp_get_template_part( 'form', 'protected' ); ?>
      			<?php else : ?>
      				<?php bbp_single_forum_description(); ?>
      				<?php if ( bbp_has_forums() ) : ?>
                <?php bbp_get_template_part( 'loop', 'forums' ); ?>
      				<?php endif; ?>
      				<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>
                <?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
                <hr>
      		      <?php bbp_get_template_part( 'loop',       'topics'    ); ?>
                <?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
      		<?php endif; ?>
      		<?php endif; ?>
      		<?php do_action( 'bbp_template_after_single_forum' ); ?>
          </div>
        </div>
      </div>
    </div>
 
 <style>
      #bbp_topic_content{
          border:1px solid black;
      }
      #qt_bbp_topic_content_toolbar{
          display: none;
      }
      #bbp_topic_title{
       border:1px solid black;   
      }
      
      #bbp_topic_tags{
           border:1px solid black;   
      }
      h2.blog-title,div.bbp-breadcrumb,span#subscription-toggle,p.bbp-forum-description{
        display: none;
      }
  </style>
  <script type="text/javascript">
    $('#ClearAll').on('click', function(){
        $('#bbp_search').val("");
        window.location.assign("<?php echo the_permalink()?>");
    });
  </script>
  
  
 	
