<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Elder's Quorum power</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <!-- ///////////////////////////////////////////////////////////////////
        Stylesheet 
        /////////////////////////////////////////////////////////////////////-->
        <link rel="stylesheet" href="../../../../css/bootstrap.min.css" media="screen"  />
        <link rel="stylesheet" href="../../../../css/bootstrap-responsive.min.css" media="screen"  />
        <link rel="stylesheet" href="../../../../css/font-awesome.min.css" media="screen"  />
        <link rel="stylesheet" href="../../../../css/style.css">
        <link rel="stylesheet" href="../../../../css/responsive.css">
        <link rel="stylesheet" href="../../../../css/prettyPhoto.css">
        <link rel="stylesheet" href="../../../../css/datepicker.css">
        <link rel="stylesheet" href="../../../../css/jquery.fancybox.css">
        <!-- SLIDERS -->
		<link rel="stylesheet" href="../../../../css/royalslider.css">
        <link rel="stylesheet" href="../../../../css/rs-default-inverted.css">
		<!-- FONTS -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic,700italic' rel='stylesheet' type='text/css'>
        <!--[if IE 9]><link rel="stylesheet" href="css/ie9.css" type="text/css" media="screen" /><![endif]-->
        <!--[if IE 8]><link rel="stylesheet" href="css/ie8.css" type="text/css" media="screen" /><![endif]-->
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <?php 

        $userData = Sentry::check();

        if ($userData) {
            $isAdmin =  $userData->hasAccess('admin');
        } else {
            $isAdmin = false;
        }
    ?>
    
	<body>
		<div id="page">
            <!-- ///////////////////////////////////////////////////////////////////
            Wrapper top -> Header + Blue area (slider, page name)
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper_top">
                
                <div id="shadow_header_container">
                    <!-- // Header (logo + menu) // -->
                    <header>
                        <div class="container">
                            <div id="logo" class="pull-left">
                                <a href="../../../../"><img src="../../../../images/logo.png" alt="your logo goes here ! "></a>
                            </div><!-- end #logo -->
                            
                            <nav class="pull-right navmenu">
                                <ul class="unstyled sf-menu">
                                    @if ($userData)
                                    <li>
                                        <a href="../../../../users/<?php echo $userData->username ?>" class="btn-menu"><i class="icon-white icon-user"></i> Welcome {{$userData->first_name}} !</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="../../../../login" class="btn-menu"><i class="icon-white icon-off"></i> Log In</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="../../../../homes" class="btn-menu"><i class="icon-white icon-home"></i> Families</a>
                                    </li>
                                    <li>
                                        <a href="../../../../visits" class="btn-menu"><i class="icon-white icon-signal"></i> Reports</a>
                                    </li>
                                    <li>
                                        <a href="../../../../teams" class="btn-menu"><i class="icon-white icon-briefcase"></i> @if ($isAdmin)Teams @else My Team @endif</a>
                                            @if ($isAdmin)
                                            <ul class="unstyled">
                                                <li><a href="../../../../teams/create">New Team</a></li>
                                            </ul>
                                            @endif
                                    </li>
                                    @if ($isAdmin)
                                    <li>
                                        <a href="../../../../users" class="btn-menu"><i class="icon-white icon-group"></i> Users</a>
                                            <ul class="unstyled">
                                                <li><a href="../../../../users/create">New User</a></li>
                                                <li><a href="../../../../groups">Groups</a></li>
                                            </ul>
                                    </li>
                                    @endif
                                    @if ($userData)
                                    <li>
                                        <a href="../../../../logout" class="btn-menu"><i class="icon-white icon-off"></i> Log Out</a>
                                    </li>
                                    @endif
                                    <!-- <li><a href="contact.html" class="btn-menu">Contact</a></li> -->
                                </ul>
                            </nav><!-- end nav -->
                            
                        </div><!-- end .container -->
                    </header><!-- end header -->
                </div><!-- end #shadow_header_container -->
                @yield('pagebar')

                @yield('slider')
                
            </section><!-- end #wrapper_top -->


			<!-- ///////////////////////////////////////////////////////////////////
            Main container
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper_main_container">
                
                <div id="main_container" class="container">
                    <div class="row">
                        <div class="span12">
                           @yield('content')
                        </div>
                        
                        <div id="scroll_top" class="span12 ">
                            <a href="#container_header" class="scroll_top_a" data-tip="top" data-original-title="Go to the top !"><img src="../../../images/scroll_top_bg.png" alt="Go to the top"></a>
                        </div><!-- end #scroll_top -->
                    </div><!-- end .row -->
                </div><!-- end #main_container -->
                
                <!-- ///////////////////////////////////////////////////////////////////
                Bottom area (widgets)
                /////////////////////////////////////////////////////////////////////-->
                <div id="wrapper_bottom_area">
                    <!-- // Separation with the teeth // -->
                    <div class="separation_shark_top"></div>
                    <div id="bottom_area" class="container">
                        <div class="row">
                            <!-- // Last tweet widget // -->
                            <div class="widget_area span4 m1 " role="complementary">
                                <h2><small>Last Tweet</small></h2>
                                <ul class="widget_twitter unstyled"></ul>
                            </div><!-- end #widget_area -->
                            
                            <!-- // Last news widget // -->
                            <div id="second" class="widget_area span4 m1" role="complementary">
                                <h2><small>Quick News</small></h2>
                                <div id="slider_news" class="widget_news">
                                    <div class="news_slides_container">
                                        <div>
                                            <span>12/04/12</span><br />
                                            <i> Suspendisse mollis placerat felis, eu semper sapien ornare eu.<br /> 
                                                Quisque malesuada tincidunt quam, sed gravida velit <br />
                                                pretium ac. Lorem ipsum dolor sit amet, consectetur.<br />
                                                <a href="#">More...</a></i>
                                        </div>
                                        <div>
                                            <span>05/04/12</span><br />
                                            <i>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />
                                                Nam tristique magna vitae augue mattis ultricies. <br />
                                                Morbi sit amet dolor id magna consectetur sagittis. <br />
                                                <a href="#">More...</a></i>
                                        </div>
                                        <div>
                                            <span>02/01/12</span><br />
                                            <i>Fusce neque quam, scelerisque id eleifend eget, sollicitudin<br />
                                                in tortor. Morbi sit amet dolor id magna consectetur sagittis. <br />
                                                <a href="#">More...</a></i>
                                        </div>
                                    </div><!-- end .news_slides_container -->
                                    <div class="btn-group slider_news_controls">
                                        <a href="#" class="btn slider_news_prev"><i class="icon-chevron-left icon_grey"></i></a>
                                        <a href="#" class="btn slider_news_next"><i class="icon-chevron-right icon_grey"></i></a>
                                    </div>
                                </div><!-- end #slider_news -->
                            </div><!-- end #second -->
                            
                            <!-- // Contact widget // -->
                            <div id="third" class="widget_area span4 m1" role="complementary">
                                <h2><small>Contact</small></h2>
                                <p> Mauris gravida placerat lacus nec accumsan.
                                    Nunc ultricies erat eget enim.</p>
                                <ul class="widget_contact unstyled">
                                    <li class="widget_contact_li">
                                        <i class=" icon-map-marker icon-white icon_grey"></i> The White House 1600 Pennsylvania Ave. DC 20500.
                                    </li>
                                    <li class="widget_contact_li">
                                        <i class="icon-bullhorn icon-white icon_grey"></i> +202-456-1414
                                    </li>
                                    <li class="widget_contact_li ">
                                        <i class="icon-envelope icon-white icon_grey"></i> admin@website.com
                                    </li>
                                </ul>
                                <a class="btn pull-right btn_contact_widget" href="contact.html"><i class="icon-envelope icon_grey"></i>   Contact us</a>
                            </div><!-- end #third -->
                        </div><!-- end .row -->
                    </div><!-- end #bottom_area -->
                    <!-- // Separation with the teeth // -->
                    <div class="separation_shark_bottom"></div>
                </div><!-- end #wrapper_bottom_area -->
                
            </section><!-- end #wrapper_main_container -->

			<!-- ///////////////////////////////////////////////////////////////////
            Bottom navigation + Social icons
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper_bottom_navigation">
                
                <div id="bottom_navigation" class="container">
                    <nav>
                        <ul class="unstyled">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="portfolio_4col.html">Portfolio</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="sitemap.html">Sitemap</a></li>
                        </ul>
                    </nav>
                    
                    <div class="social_icons_footer">
                        <div class="pull-right">
                            <a href="#" data-tip="top" data-original-title="Join us on facebook"><img src="images/icons_social/facebook.png" alt="facebook icon"  height="22" width="22" class="a_social_icon  facebook"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on twitter"><img src="images/icons_social/twitter.png" alt="twitter icon" height="22" width="22" class="a_social_icon twitter"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on google +"><img src="images/icons_social/gplus.png" alt="gplus icon"  height="22" width="22" class="a_social_icon gplus"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on youtube"><img src="images/icons_social/youtube.png" alt="youtube icon"  height="22" width="22" class="a_social_icon youtube"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on vimeo"><img src="images/icons_social/vimeo.png" alt="vimeo icon"  height="22" width="22" class="a_social_icon vimeo"></a>
                            <a href="#" data-tip="top" data-original-title="Subscribe our rss feed"><img src="images/icons_social/rss.png" alt="rss icon"  height="22" width="22" class="a_social_icon rss"></a>
                            <!-- disabled // choose yours !
                            <a href="#" data-original-title=""><img src="images/icons_social/addthis.png" alt="addthis icon"  height="22" width="22" class="a_social_icon addthis"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on behance"><img src="images/icons_social/behance.png" alt="behance icon"  height="22" width="22" class="a_social_icon behance"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on blogger"><img src="images/icons_social/blogger.png" alt="blogger icon"  height="22" width="22" class="a_social_icon blogger"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on digg"><img src="images/icons_social/digg.png" alt="digg icon"  height="22" width="22" class="a_social_icon digg"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on dribbble"><img src="images/icons_social/dribbble.png" alt="dribbble icon"  height="22" width="22" class="a_social_icon dribbble"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on flickr"><img src="images/icons_social/flickr.png" alt="flickr icon"  height="22" width="22" class="a_social_icon flickr"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on instagram"><img src="images/icons_social/instagram.png" alt="instagram icon"  height="22" width="22" class="a_social_icon instagram"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on lastfm"><img src="images/icons_social/lastfm.png" alt="lastfm icon"  height="22" width="22" class="a_social_icon lastfm"></a>
                            <a href="#" data-original-title=""><img src="images/icons_social/like.png" alt="like icon"  height="22" width="22" class="a_social_icon like"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on linkedin"><img src="images/icons_social/linkedin.png" alt="linkedin icon"  height="22" width="22" class="a_social_icon linkedin"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on livejournal"><img src="images/icons_social/livejournal.png" alt="livejournal icon"  height="22" width="22" class="a_social_icon livejournal"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on myspace"><img src="images/icons_social/myspace.png" alt="myspace icon"  height="22" width="22" class="a_social_icon myspace"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on paypal"><img src="images/icons_social/paypal.png" alt="paypal icon"  height="22" width="22" class="a_social_icon paypal"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on picasa"><img src="images/icons_social/picasa.png" alt="picasa icon"  height="22" width="22" class="a_social_icon picasa"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on reddit"><img src="images/icons_social/reddit.png" alt="reddit icon"  height="22" width="22" class="a_social_icon reddit"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on sharethis"><img src="images/icons_social/sharethis.png" alt="sharethis icon"  height="22" width="22" class="a_social_icon sharethis"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on skype"><img src="images/icons_social/skype.png" alt="skype icon"  height="22" width="22" class="a_social_icon skype"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on spotify"><img src="images/icons_social/spotify.png" alt="spotify icon"  height="22" width="22" class="a_social_icon spotify"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on stumbleupon"><img src="images/icons_social/stumbleupon.png" alt="stumbleupon icon"  height="22" width="22" class="a_social_icon stumbleupon"></a>
                            <a href="#" data-tip="top" data-original-title="Join us on tumblr"><img src="images/icons_social/tumblr.png" alt="tumblr icon"  height="22" width="22" class="a_social_icon tumblr"></a>
                            <a href="#" data-tip="top" data-original-title="Follow us on wordpress"><img src="images/icons_social/wordpress.png" alt="wordpress icon"  height="22" width="22" class="a_social_icon wordpress"></a>
                            -->
                        </div>
                    </div><!-- end .social_icons -->
                </div><!-- end #bottom_navigation -->
                
            </section><!-- end #wrapper_bottom_navigation -->


			<!-- ///////////////////////////////////////////////////////////////////
            Footer
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper_footer">
                
                <footer class="container text_shadow">
                    <p><strong>Sun Rising</strong> &#169; 2012 All rights reserved | Designed by <a href="http://bit.ly/SARKnL">F&#178; </a></p>
                    
                    <!-- ///////////////////////////////////////////////////////////////////
                    Javascript files
                    /////////////////////////////////////////////////////////////////////-->
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                    <script type="text/javascript" src="../../../../js/superfish.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.royalslider.min.js" ></script>
                    <script type="text/javascript" src="../../../../js/bootstrap.min.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.prettyPhoto.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.fancybox.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.isotope.min.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.tweet.js" ></script>
                    <script type="text/javascript" src="../../../../js/jquery.masqued.min.js" ></script>
					<script type="text/javascript" src="../../../../js/bootstrap-datepicker.js" ></script>
                    <script type="text/javascript" src="../../../../js/main.js" ></script>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $('.datepicker').datepicker({
                                format : 'yyyy-mm-dd'
                            });

                            $(function($){
                               $(".phone").mask("(999) 999-9999");
                            });
                            
                            $(".fancybox").fancybox();
                        });
                    </script>
                </footer><!-- end #footer -->
                
            </section><!-- end #wrapper_footer -->
        </div><!-- end #page -->
	</body>
</html>
