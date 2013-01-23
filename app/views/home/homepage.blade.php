@extends('layouts.master')
            @section('slider')
                <section id="wrapper_slider" class="container">
                    <div class="row">
                        <!-- // Say Welcome !// -->
                        <div class="span12 text_shadow center">
                            <h1 class="center">Welcome !</h1>
                            <p class="m1" id="showing">Here you can write a message to introduce yourself.<br /> Lorem ipsum dolor sit amet,
                               consectetur adipiscing elit. Nullam condimentum arcu vel odio elementum rutrum.
                               Nam sed orci quam, eu dictum lectus. Nullam id dolor et metus pulvinar dictum.</p>
                        </div><!-- end .span12 -->
                        <div class="span12 text_shadow center">
                            <div class="row m2">
                                <!-- // To place icons with details in relation to the arrows, moves directly into the tags -> Style="..."// -->
                                <div class="span1 offset2 center">
                                       <img src="images/icons/favorite_white.png" alt="home_icon" class="showing_icons">
                                </div>
                                <div class="span1 offset1 center">
                                       <img src="images/icons/shopping_white.png" alt="home_icon" style="margin-right: -25px;"  class="showing_icons" >
                                </div>
                                <div class="span1 offset2 center">
                                       <img src="images/icons/bulb_white.png" alt="home_icon" style="margin-left: -25px;" class="showing_icons">
                                </div>
                                <div class="span1 offset1 center">
                                       <img src="images/icons/comments_white.png" alt="home_icon" style="margin-left: -25px;" class="showing_icons">
                                </div>
                            </div><!-- end .row -->
                        </div><!-- end .span12 -->
                        <div class="span3 center" id="extrem_left">
                            <div class="home_button_bg">
                               <a href="home3.html" class="btn btn-large"><i class="icon-picture icon_grey"></i> View Home with slider</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="left">
                            <div class="home_button_bg">
                               <a href="portfolio_4col.html" class="btn btn-large"><i class="icon-briefcase icon_grey"></i> Look at our work</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="right">
                            <div class="home_button_bg">
                               <a href="blog.html" class="btn btn-large"><i class="icon-comment icon_grey"></i> What we think</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="extrem_right">
                            <div class="home_button_bg">
                               <a href="contact.html" class="btn btn-large"><i class="icon-heart icon_grey"></i> Let's get closer</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                    </div><!-- end .row -->
                </section><!-- end #wrapper_slider -->
            @stop