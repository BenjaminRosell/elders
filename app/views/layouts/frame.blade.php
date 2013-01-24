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
        <link rel="stylesheet" href="../../../../css/style.css">
        <link rel="stylesheet" href="../../../../css/responsive.css">
        <link rel="stylesheet" href="../../../../css/prettyPhoto.css">
        <link rel="stylesheet" href="../../../../css/datepicker.css">
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

        $userData = Sentry::getUser();

        if ($userData) {
            $isAdmin =  $userData->hasAccess('admin');
        } else {
            $isAdmin = false;
        }
    ?>
    
	<body>
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
                            <a href="#container_header" class="scroll_top_a" data-tip="top" data-original-title="Go to the top !"><img src="images/scroll_top_bg.png" alt="Go to the top"></a>
                        </div><!-- end #scroll_top -->
                    </div><!-- end .row -->
                </div><!-- end #main_container -->
            </section><!-- end #wrapper_main_container -->
               
                    
            <!-- ///////////////////////////////////////////////////////////////////
            Javascript files
            /////////////////////////////////////////////////////////////////////-->
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            <script type="text/javascript" src="../../../../js/superfish.js" ></script>
            <script type="text/javascript" src="../../../../js/jquery.royalslider.min.js" ></script>
            <script type="text/javascript" src="../../../../js/bootstrap.min.js" ></script>
            <script type="text/javascript" src="../../../../js/jquery.prettyPhoto.js" ></script>
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
                });
            </script>
        </div><!-- end #page -->
	</body>
</html>
