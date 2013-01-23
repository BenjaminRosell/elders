@extends('layouts.master')
            @section('slider')
                <section id="wrapper_slider" class="container">
                    <div class="row">
                        <!-- // Say Welcome !// -->
                        <div class="span12 text_shadow center">
                            <h1 class="center">Welcome !</h1>
                            <p class="m1" id="showing"> "<strong>For the power is in them</strong>, wherein they are agents unto themselves. <br> And inasmuch as men do good they shall in nowise lose their reward "</p>
                            <p>Doctrine and Covenants 58:27</p>
                        </div><!-- end .span12 -->
                        <div class="span12 text_shadow center">
                            <div class="row m2">
                                <!-- // To place icons with details in relation to the arrows, moves directly into the tags -> Style="..."// -->
                                <div class="span1 offset2 center">
                                       <img src="images/icons/calendar_white.png" alt="home_icon" class="showing_icons">
                                </div>
                                <div class="span1 offset1 center">
                                       <img src="images/icons/comments_white.png" alt="home_icon" style="margin-right: -25px;"  class="showing_icons" >
                                </div>
                                <div class="span1 offset2 center">
                                       <img src="images/icons/bulb_white.png" alt="home_icon" style="margin-left: -25px;" class="showing_icons">
                                </div>
                                <div class="span1 offset1 center">
                                       <img src="images/icons/settings_white.png" alt="home_icon" style="margin-left: -25px;" class="showing_icons">
                                </div>
                            </div><!-- end .row -->
                        </div><!-- end .span12 -->
                        <div class="span3 center" id="extrem_left">
                            <div class="home_button_bg">
                               <a href="homes" class="btn btn-large"><i class="icon-calendar icon_grey"></i> Scheldule</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="left">
                            <div class="home_button_bg">
                               <a href="visits" class="btn btn-large"><i class="icon-signal icon_grey"></i> Reports</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="right">
                            <div class="home_button_bg">
                               <a href="homes" class="btn btn-large"><i class="icon-comment icon_grey"></i> Goals and actions plans</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                        <div class="span3 center" id="extrem_right">
                            <div class="home_button_bg">
                               <a href="users" class="btn btn-large"><i class="icon-wrench icon_grey"></i> Set up your account</a>
                            </div><!-- end .button_bg -->
                        </div><!-- end .span3 -->
                    </div><!-- end .row -->
                </section><!-- end #wrapper_slider -->
            @stop