<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?> - <?php the_title(); ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico?v=2">
  <meta name="description" content="Pilbara for Purpose">
  <meta name="author" content="Shiny Ideas Co">

  
  <script src="https://use.typekit.net/yvv7avn.js"></script>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/owl.carousel.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/cis_dev.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/bower_components/animate-css/animate.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <style>
  
    html, body{margin-top:0px!important;padding-top:0px!important;}
  
  </style>
    
  </head>

<body <?php body_class(); ?> >
      <header>
        <div class="navTop">
          <div class="container">
          
          <div id="navbarSearch">
          <?php get_search_form(); ?>
            </div>
            <ul class="list-unstyled list-inline pull-right navTopLinks">
              <li><a id="navSearch" href=""><i class="icon-p4p-search"></i></a></li>
              <li><i class="icon-p4p-contact"></i><a href="/contact"> Contact Us</a></li>
              <?php if ( is_user_logged_in() ) {  
                $current_user = wp_get_current_user();
                
                echo '
              
               <li class="dropdown user">
                  <i class="icon-p4p-member"></i>&nbsp; <a href="" id="userLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ' . $current_user->user_nicename .'<i class="fa fa-caret-down"></i></a>
                   <ul class="dropdown-menu userLabel-menu" aria-labelledby="userLabel">
                     <li><a href="'. wp_logout_url() .'"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
                   </ul>
               </li>';
             } else {
                echo ' <li class="dropdown user">
                    <i class="icon-p4p-member"></i>&nbsp; <a href="" id="userLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign in <i class="fa fa-caret-down"></i></a>
                     <div class="dropdown-menu userLabel-login" aria-labelledby="userLabel">
                       <div class="col-xs-12 col-sm-6 col-md-6">
                         <p class="login-info-title">
                           Member Sign-in
                         </p>
                         <p class="login-info-d">
                           Enter your registered email address and password to access the member functions of the website.
                         </p>
                         <p class="login-info-a">
                           <a href="/about-pilbara-for-purpose/about-membership">Not a member? Find out more.</a>
                         </p>
                       </div>
                       <div class="col-xs-12 col-sm-6 col-md-6">
                         <form id="login" action="'.get_site_url().'/wp-login.php" method="post">
                           <div class="form-group">
                             <label for="name">EMAIL</label>
                             <input type="text" class="form-control" id="username" name="log" autocomplete="off">
                           </div>
                           <div class="form-group">
                             <label for="pass">PASSWORD</label><label class="iforgot pull-right"><a href="'. wp_lostpassword_url() .' ">I forgot</a></label>
                             <input type="password" class="form-control" id="password"  name="pwd"  id="pass"  autocomplete="off">
                           </div>' 
                           . wp_nonce_field( 'ajax-login-nonce', 'security' ) .
                             
                             '<button type="submit" class="btn btn-default  pull-right" id="#loginButton">Sign in</button>
                         </form>
                         
                       </div>

                     </div>
                 </li>
              '; } ?>
              
              <script type="text/javascript">
  //                   setTimeout(function(){
  //
  //                     // // Perform AJAX login on form submit
  //                     // $('form#login').on('submit', function(e){
  //                     //     $('form#login p.status').show().text(ajax_login_object.loadingmessage);
  //                     //     $.ajax({
  //                     //         type: 'POST',
  //                     //         dataType: 'json',
  //                     //         url: ajax_login_object.ajaxurl,
  //                     //         data: {
  //                     //             'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
  //                     //             'username': $('form#login #username').val(),
  //                     //             'password': $('form#login #password').val(),
  //                     //             'security': $('form#login #security').val() },
  //                     //         success: function(data){
  //                     //             $('form#login p.status').text(data.message);
  //                     //             if (data.loggedin == true){
  //                     //                 document.location.href = ajax_login_object.redirecturl;
  //                     //             }
  //                     //         }
  //                     //     });
  //                     //     e.preventDefault();
  //                     // });
  // console.log(ajax_login_object.ajaxurl)
  //                         $("#loginButton").click(function() {
  //                             var data = {
  //                                 'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
  //                                 'username': $('#loginUsername').val(),
  //                                 'password': $('loginPassword').val(),
  //                                 'security': $('form#login #security').val()
  //                             }
  //
  //                             $.ajax({
  //                                 url: ajax_login_object.ajaxurl,
  //                                 data: data,
  //                             type: 'POST',
  //                             dataType: 'json',
  //                                 success: function( result ) {
  //                                     if (result.success==1) {
  //                                         alert("Ok!");
  //                                     } else {
  //                                         alert("Not Ok!");
  //                                     }
  //                                 }
  //                             });
  //
  //                         });
  //                   }, 3000);
  //

                     </script>
              
            </ul>
              <div class="navbar-header">
              <button class="navbar-toggle" role="button">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars" style="font-size: 30px;"></i>
              </button>
          
              <a class="navbar-search-link" href="/search">
                <i class="icon-p4p-search"></i>
              </button>
              <a class="navbar-brand" href="/">
                  <img  src="<?php echo get_bloginfo('template_directory');?>/img/logo_p4p_horz.svg" alt="">
                  <img class="s-logo" src="<?php echo get_bloginfo('template_directory');?>/img/logo_p4p_vert.svg" alt="">
              </a>
          </div>
          </div>
        </div>
        
        <nav class="navbar navbar-default">
          <div class="container">
          <div class="pull-right">
            <ul class="nav navbar-nav visible-md visible-lg">
              <li class="dropdown dropdown-main two-tabs-menu">
                <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu clearfix"  role="menu">
                  <li>
                    <ul class="list-unstyled col-sm-6 col-md-6 drop-down-modal-col">
                      <li class="heading"><b>About Pilbara for Purpose</b></li>
                      <li><a href="/about-us">About Us</a></li>
                      <li><a href="/about-our-board">Our Board</a></li>
                    </ul>
                    <ul class="list-unstyled col-sm-6 col-md-6 drop-down-modal-col">
                      <li class="heading"><b>Our Members</b></li>
                      <li><a href="/about-membership">About Membership</a></li>
                      <li><a href="/about-pilbara-for-purpose/become-a-member">Become a Member</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown dropdown-main two-tabs-menu">
                <a href="/service" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service Areas <i class="fa fa-caret-down"></i></a>
                
                <ul class="dropdown-menu clearfix" role="menu">
                  <li>
                    <li class="heading"><a href="/service">Service Areas</a></li>
                    <ul class="list-unstyled col-sm-6 col-md-6 drop-down-modal-col">
                     <li><a href="/archives/services/advice-and-support">Advice and Support</a></li>
                     <li><a href="/archives/services/disability-and-aged-care">Disability and Aged Care</a></li>
                     <li><a href="/archives/services/early-years">Early Years</a></li>
                     <li><a href="/archives/services/employment">Employment</a></li>
                     <li><a href="/archives/services/first-nations">First Nations</a></li>
                     <li><a href="/archives/services/government">Government</a></li>
                    </ul>
                    <ul class="list-unstyled col-sm-6 col-md-6 drop-down-modal-col">
                     <li><a href="/archives/services/housing-and-shelter">Housing and Shelter</a></li>
                     <li><a href="/archives/services/learning">Learning</a></li>
                     <li><a href="/archives/services/social-enterprise">Social Enterprise</a></li>
                     <li><a href="/archives/services/supporter-and-volunteers">Supporter and Volunteers</a></li>
                     <li><a href="/archives/services/wellness">Wellness</a></li>
                     <li><a href="/archives/services/youth">Youth</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li >
                <a href="/news-room">News Room </a>
              </li>
              <li >
               <a href="/events">Events </i></a>
              </li>
              <li >
                <a href="/directory" >Directory </a>
              </li>
              <li class="dropdown dropdown-main">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Members <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu clearfix drop-down-modal-col" role="menu">
                    <li class="heading">Members</li>
                    <?php if (is_user_logged_in()) { ?>
                    <li><a href="/resources">Resources & Publications</a></li>
                    <li><a href="/forums">Forums</a></li>
                    <?php }else{ ?>
                      <li class="sub-nav"><a href="/login">Sign In <span class="icon"></span></a></li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
        <nav class="visible-xs visible-sm navbar-mobile">
          <div class="navbar-header">
            <button class="navbar-toggle" role="button">
              <span class="sr-only">Toggle navigation</span>
              <i class="fa fa-close" style="font-size: 30px;color:#f5f5f5;"></i>
            </button>
          </div>
          <ul class="list-unstyled main-menu">
            <li><a href="">About Us <i class="fa fa-caret-down"></i></a>
                <ul class="list-unstyled">
                    <li class="heading"><b>About Pilbara for Purpose</b></li>
                    <li><a href="/about-pilbara-for-purpose">About Us</a></li>
                    <li><a href="/about-our-board">Our Board</a></li>
                    <li class="heading"><b>Our Members</b></li>
                    <li><a href="/about-membership">About Membership</a></li>
                    <li><a href="/about-pilbara-for-purpose/become-a-member">Become a Member</a></li>
                </ul>
              </li>
            </li>
            <li><a href="">Service Areas <i class="fa fa-caret-down"></i></a>
              <ul class="list-unstyled">
                    <li><a href="/archives/services/advice-support">Advice & Support</a></li>
                    <li><a href="/archives/services/disability-aged-care">Disability & Aged Care</a></li>
                    <li><a href="/archives/services/early-years">Early Years</a></li>
                    <li><a href="/archives/services/employment">Employment</a></li>
                    <li><a href="/archives/services/first-nations">First Nations</a></li>
                    <li><a href="/archives/services/government">Government</a></li>
                    <li><a href="/archives/services/housing-shelter">Housing & Shelter</a></li>
                    <li><a href="/archives/services/learning">Learning</a></li>
                    <li><a href="/archives/services/social-enterprise">Social Enterprise</a></li>
                    <li><a href="/archives/services/supporter-volunteers">Supporter & Volunteers</a></li>
                    <li><a href="/archives/services/wellness">Wellness</a></li>
                    <li><a href="/archives/services/youth">Youth</a></li>
              </ul>
            </li>
            <li><a href="/news-room">News Room </a></li>
            <li><a href="/events">Events </a></li>
            <li><a href="/directory" >Directory </a></li>
            <li><a href="">Members <i class="fa fa-caret-down"></i></a>

              <ul class="list-unstyled">
                  <?php if (is_user_logged_in()) { ?>
                  <li class="sub-nav"><a href="/resources">Resources & Publications <span class="icon"></span></a></li>
                  <li class="sub-nav"><a href="/forums">Forums <span class="icon"></span></a></li>
                  <?php }else{ ?>
                      <li class="sub-nav"><a href="/login">Sign In <span class="icon"></span></a></li>
                  <?php } ?>
              </ul>
            </li>
            <!-- <li>
              <a href="/search">Search</a>
            </li>
            <li>
              <a href="/contact">Contact Us</a>
            </li> -->
          </ul>
        </nav>
    </header>
    <div class="overlay"></div>
    <style>
      .heading a {
        margin-left:-15px; 
      }
    </style>
  
