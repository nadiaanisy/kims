<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('title')</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/tooplate-style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <style>
            .btn-block {
                cursor: pointer;
                width: 50%;
            }
            .fa-facebook{
                color: #1985bc;
            }
            .fa-twitter{
                color: #1da1f2;
            }
            .fa-instagram{
                color: #bd081c;
            }
        </style>
    </head>
    <body>
        <div class="ct" id="t1">
            <div class="ct" id="t2">
                <div class="ct" id="t3">
                    <div class="ct" id="t4">
                        <div class="ct" id="t5">
                            <section>  
                                <ul>
                                    <a href="#t1"><li class="icon fa fa-home" id="uno"></li></a>
                                    <a href="#t2"><li class="icon fa fa-sticky-note" id="dos"></li></a>
                                    <a href="#t3"><li class="icon fa fa-image" id="tres"></li></a>
                                    <a href="#t4"><li class="icon fa fa-phone" id="cuatro"></li></a>
                                    <a href="login"><li class="icon fa fa-user" id="cinco"></li></a>
                                </ul>
                                <div class="page" id="p1">
                                    <li class="icon fa fa-home">
                                        <span class="title">Welcome To</span>
                                        <h4>@yield('content')</h4>
                                        <p>@yield('uniorigin')</p>
                                        <br>
                                        <div class="primary-button">
                                            <a href="#t2">Discover More</a>
                                        </div>
                                    </li>
                                </div>
                                <div class="page" id="p2">
                                    <li class="icon fa fa-sticky-note"><span class="title">About</span>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="left-text">
                                                        <h4>What is KIMS?</h4>
                                                        <p>@yield('about1')<br><br>@yield('about2')</p>
                                                        <div class="primary-button">
                                                            <a href="#t3">Discover More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="right-image">
                                                        <img src="img/right-about-image.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <div class="page" id="p3">
                                    <li class="icon fa fa-image"><span class="title">Gallery</span>
                                        <div class="container">
                                            <div class="row">
                                                @if(!empty($gallery))
                                                    @foreach($gallery as $data)
                                                        <div class="col-md-3">
                                                            <div class="project-item">
                                                                <a href="{{ url('images/'.$data->image) }}"" data-lightbox="image-1"><img src="{{ url('images/'.$data->image) }}" alt="user" /></a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="primary-button">
                                                <a href="#t4">Discover More</a>
                                            </div>
                                        </div>                                
                                    </li>
                                </div>
                                <div class="page" id="p4">
                                   <li class="icon fa fa-phone"><span class="title">Contact</span>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><i class="fa fa-map-marker fa-lg"></i>@yield('location')</p>
                                                    <p><i class="fa fa-phone fa-lg"></i> Tel: @yield('tel')  || Faks: @yield('faks')</p>
                                                    <p><i class="fa fa-desktop fa-g"></i> Website: @yield('website')</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="border border-white">
                                                        <center>
                                                            <ol class="social-icons">
                                                                <i><a href="https://web.facebook.com/uitmcmrasmi" target="_blank"><i class="fa fa-facebook"></i></a></i>
                                                                <i><a href="https://twitter.com/UiTMCMelaka" target="_blank"><i class="fa fa-twitter"></i></a></i>
                                                                <i><a href="http://instagram.com/uitmcmelaka" target="_blank"><i class="fa fa-instagram"></i></a></i>
                                                            </ol>
                                                        </center>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <div class="page" id="p5">
                                    <li class="icon fa fa-user">
                                        <span class="title">Log In</span>
                                    </li>
                                </div>  
                            </section>
                        </div>
                    </div>
                </div>
            </div>   
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="../../public/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../../public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../../public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script>
            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
            // ============================================================== 
            // Login and Recover Password 
            // ============================================================== 
            $('#to-recover').on("click", function() {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });
            $('#to-login').click(function(){
                
                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        </script>
    </body>
</html>