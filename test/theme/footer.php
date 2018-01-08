<?php 
$args = array('post_type' => 'partners_logos','post_status'=>'publish','posts_per_page' => -1,);
$newquery = new WP_Query($args);
if ($newquery->have_posts()): ?>
    <div class="row">
            <div class="container">
                <div class="heading-2">
                    <h2 class="heading-slider">Our Members &amp; Partners</h2>
                </div>
                <br>
                <div class="owl-main">
                    <div class="owl-carousel">
                        <?php  
                        while ($newquery->have_posts()):
                            $newquery->the_post(); ?>
                            <div class="item">
                                <div class="ProvokeText"><a href="<?php echo (get_field('website_url_p')!='')? the_field('website_url_p'):'#';?>" target="_blank">
                                    <?php echo the_post_thumbnail(); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
    </div>
<?php
endif; wp_reset_query();?>
<script src="<?php echo get_bloginfo('template_directory'); ?>/js/owl.carousel.min.js"></script> 
<script>
$('.owl-carousel').owlCarousel({
    loop: true,
    autoplay:true,
    margin: 10,
    nav: true,
    goToFirstSpeed:1,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
$('.dropdown-toggle').on('click', function(){
    if($('.overlay').attr('class') == 'overlay'){
        $('.overlay').addClass('overlay-show');
    }
});
$('.overlay').on('click', function(){
        $('.overlay').removeClass('overlay-show');
});
$('.navTop').on('click', function(){
        $('.overlay').removeClass('overlay-show');
});

$('.nav>li.dropdown').hover(function(e) {
    $('.overlay').toggleClass('overlay-show');
});
</script>
<footer>
    <div class="container">
        <div class="footer-top row">
            <h2 class="left">For Purpose. For Pilbara. For People.</h2>
        </div>
        <div class="footer-main row">
            <ul class="col-xs-12 col-sm-6 col-md-3 list-unstyled">
                <li class="title">About P4P</li>
                <li><a href="/about-us">About Us</a></li>
                <li><a href="/about-our-board">About Our Board</a></li>
                <li><a href="/about-membership">About Membership</a></li>

            </ul>

            <ul class="col-xs-12 col-sm-6 col-md-3 list-unstyled">
                <li class="title">Community</li>
                <li><a href="/news-room">News</a></li>
                <li><a href="/events">Events</a></li>
                <li><a href="/directory">Directory</a></li>
            </ul>
            <?php if(is_user_logged_in()){?>
            <ul class="col-xs-12 col-sm-6 col-md-3 list-unstyled">
                <li class="title">Member Resources</li>
                <li><a href="/forums">Forums</a></li>
                <li><a href="/resources">Resources & Publications</a></li>
            </ul>
            <?php } else{ ?>
            <ul class="col-xs-12 col-sm-6 col-md-3 list-unstyled">
                <li class="title">Member Resources</li>
                <li><a href="/login">Sign In</a></li>
                <li><a href="javascript:void(0);">Forums</a></li>
                <li><a href="javascript:void(0);">Resources & Publications</a></li>
            </ul>
            <?php } ?>
            <div class="col-xs-12 col-sm-6 col-md-3 logo">
                <i class="icon-p4p-pilbaraforpurpose"></i>
                <h2>Pilbara for Purpose</h2>
            </div>
        </div>
        <div class="footer-bottom row">
            <div class="copyright">
                © Copyright Pilbara for Purpose 2016. All rights reserved.
            </div>
            <ul class="links list-unstyled list-inline">
                <li><a href="/terms-of-use">Terms of Use</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/disclaimer">Disclaimer</a></li>
            </ul>
            <div class="byShiny">
                Site By Shiny Ideas &nbsp;&nbsp;<a href="http://www.shinyideas.com.au" target="_blank"><img src="/wp-content/themes/p4p/img/footer_img.svg" alt="Image" /></a>
            </div>
        </div>
    </div>
</footer>



<script data-main="<?php echo get_bloginfo('template_directory'); ?>/js/main.min" src="<?php echo get_bloginfo('template_directory'); ?>/bower_components/requirejs/require.js"></script>


</body>
</html>