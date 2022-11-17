<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale()=='ar')dir="rtl"@else dir='ltr' @endif>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> {{ __('home.app_name') }} </title>

    <!-- stylesheets of Bootstrap  css -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/bootstrap.min.css') }}">

    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/animate.min.css') }}">

    <!-- Libarary of font Awesome -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/font-awesome.min.css') }}">

    <!-- Hover Css -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/hover-min.css') }}">

    <!-- Small Slider -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/flexslider.css') }}">

    <!-- For Vido -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/YouTubePopUp.css') }}">

    <!-- Fancybox For images -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/jquery.fancybox.min.css') }}">

    <!-- My Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/style.css') }}">

    <!-- My Media CSS -->
    <link rel="stylesheet" href="{{ asset('frontAssets/css/media.css') }}">


    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>


    <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->

    <!-- ----------------------------------------------------------- -->

</head>


<body data-spy="scroll" data-target=".navbar" data-offset="50">




    <!-- ------------------------------------------Start Home section-------------------------------------------- -->


    <section id="home" class="Slide_Show text-center">

        <!-- Start and End overlay -->
        <div class="gradient-overlay"></div>

        <!-- Start container -->
        <div class="container">

            <!-- Start row -->
            <div class="row">

                <!-- start txt -->
                <div class="col-md-offset-2 col-md-8 col-sm-12 txt">
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s">{{ __('home.app_name') }}</h1>
                    <p class="wow fadeInUp lead" data-wow-delay="1.0s">{{ __('home.description') }}.</p>

                    <a href="#feature" class="wow fadeInUp btn btn-default hvr-bounce-to-top"
                        data-wow-delay="1.3s">{{ __('home.discover_now') }}</a>
                </div>
                <!-- End txt -->

            </div>
            <!-- End row -->

        </div>
        <!-- End Container -->

    </section>

    <!-- ------------------------------------------End Home section-------------------------------------------- -->


    <!-- ------------------------------------------ Start Navbar ----------------------------------------------- -->

    <nav class="navbar navbar-default">

        <div class="container">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">{{ __('home.app_name') }}</a>

            </div>

            <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">

                    <li class="active">
                        <a href="#home"> {{ __('home.home') }} <span class="sr-only">(current)</span> </a>
                    </li>

                    <li><a href="#Features">{{ __('home.Features') }}</a></li>

                    <li><a href="#About">{{ __('home.About') }}</a></li>

                    <li><a href="#Menu">{{ __('home.Menu') }}</a></li>

                    <li><a href="#Team">{{ __('home.Team') }}</a></li>

                    <li> <a href="#my-Gallery">{{ __('home.Gallery') }}</a> </li>

                    <li> <a href="#Contact">{{ __('home.Contact') }}</a> </li>

                </ul>


            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <!-- ------------------------------------------ End navbar -------------------------------------------------- -->


    <!-- ------------------------------------------ Start Features ---------------------------------------------- -->

    <section class="feature text-center" id="Features">

        <div class="container">

            <div class="row">

                <h2 style="margin-bottom: 56px;">{{ __('home.why_we') }}</h2>


                <div class="col-md-4 col-sm-6 col-sm-offset-0 col-xs-offset-2 col-xs-8
                                 wow fadeInUp animated"
                    data-wow-delay=".3s">
                    <div class="content">
                        <div class="myspan"><span><i class="fa fa-cutlery"></i></span></div>
                        <h3>{{ __('home.SPECIAL_DISH') }}</h3>
                        <p>{{ __('home.food_text') }}.
                        </p>
                    </div>
                </div>


                <div class="col-md-4 col-sm-6 col-sm-offset-0 col-xs-offset-2 col-xs-8
                                 wow fadeInUp animated"
                    data-wow-delay=".6s">
                    <div class="content">
                        <div class="myspan"><span><i class="fa fa-coffee"></i></span></div>
                        <h3>{{ __('home.best_drinks') }}</h3>
                        <p>{{ __('home.drink_text') }}.
                        </p>
                    </div>
                </div>



                <div class="col-md-4 col-sm-6 col-sm-offset-0 col-xs-offset-2 col-xs-8
                                 wow fadeInUp animated"
                    data-wow-delay=".9s">
                    <div class="content three">
                        <div class="myspan"><span><i class="fa fa-truck"></i></span></div>
                        <h3>{{ __('home.fast_delivery') }}</h3>
                        <p>{{ __('home.delivery_text') }}.
                        </p>
                    </div>
                </div>


            </div>
            <!-- End Row -->

        </div>
        <!-- End container -->

    </section>

    <!-- End Features -->

    <!-- ------------------------------------------ End Features ---------------------------------------------- -->


    <!-- ---------------------------------------- Start Section About ----------------------------------------- -->

    <section class="about" id="About">

        <div class="container">

            <div class="row">

                <div class="col-md-3 col-sm-5 rtl wow bounceInLeft animated" data-wow-delay=".3s">
                    <img src="{{ asset('frontAssets/images/about-img.jpg') }}" class="img-responsive">

                    <p class="lead about-parag">
                        {{ __('home.text1') }}</p>
                </div>


                <div class="col-md-5 col-sm-7 lft wow bounceInDown animated" data-wow-delay=".5s">

                    <!-- Place somewhere in the <body> of your page -->
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="{{ asset('frontAssets/images/slide-img1.jpg') }}" />
                            </li>
                            <li>
                                <img src="{{ asset('frontAssets/images/slide-img2.jpg') }}" />
                            </li>
                            <li>
                                <img src="{{ asset('frontAssets/images/slide-img3.jpg') }}" />
                            </li>
                        </ul>
                    </div>

                    <p class="flexslider-parag">{{ __('home.text1') . __('home.text2') }}</p>

                </div>


                <div class="col-md-4 col-sm-12 last wow bounceInRight animated text-center" data-wow-delay=".9s">

                    <h2>{{ __('home.best_services') }}</h2>

                    <p>{{ __('home.service_text1') }}</p>


                    <p>{{ __('home.service_text2') }}</p>


                    <ul class="list">
                        <li>{{ __('home.ser1') }}</li>
                        <li>{{ __('home.ser2') }}</li>
                        <li>{{ __('home.ser3') }}</li>
                    </ul>

                </div>

            </div>
            <!-- End row -->

        </div>
        <!-- End Container -->

    </section>

    <!-- -----------------------------------------End Section About--------------------------------------------- -->


    <!-- -----------------------------------------Start Section vido--------------------------------------------- -->

    <section class="vido text-center">

        <div class="vido-overlay"></div>

        <div class="container">

            <div class="row">

                <div class="col-md-offset-2 col-md-8 col-sm-12">

                    <a class="demo" href="https://vimeo.com/155813398">
                        <i class="fa fa-play"></i>
                    </a>

                    <h2>{{ __('home.WATCH THE VIDEO')}}</h2>
                    <p>{{ __('home.text1')}}.</p>

                </div>

            </div>
            <!-- End Row -->


        </div>
        <!-- End Container -->

    </section>

    <!-- -----------------------------------------End Section vido--------------------------------------------- -->


    <!-- -----------------------------------------Start Section menu------------------------------------------- -->

    <section class="menu" id="Menu">

        <div class="container">

            <div class="row">


                <h2 class="text-center"> {{ __('home.FOOD_MENU') }} </h2>
                <p class="text-center menu-parag">{{ __('home.food_text') }}</p>

                <!-- --------------------------------------------------------------------------- -->

                <!-- start Second col-md-6 -->
                <div class="col-md-6">


                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media1 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img1.jpg') }}" alt="">
                            <p class="inner1">$24</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Breakfast')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>



                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media2 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img2.jpg') }}" alt="">
                            <p class="inner2">$36</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Seafood')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>



                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media3 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img3.jpg') }}" alt="">
                            <p class="inner3">$24</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Seafood')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>



                </div>
                <!-- End Second col-md-6 -->

                <!-- --------------------------------------------------------------------------- -->


                <!-- --------------------------------------------------------------------------- -->

                <!-- start Second col-md-6 -->
                <div class="col-md-6">

                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media4 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img4.jpg') }}" alt="">
                            <p class="inner4">$32</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Breakfast')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>


                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media5 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img5.jpg') }}" alt="">
                            <p class="inner5">$64</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Seafood')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>


                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object media6 img-responsive"
                                src="{{ asset('frontAssets/images/gallery-img6.jpg') }}" alt="">
                            <p class="inner6">$45</p>
                        </a>

                        <div class="media-body">
                            <h3 class="media-heading">{{ __('home.Seafood')}}</h3>
                            <p class="lead">{{ __('home.text1')}}.</p>
                        </div>
                    </div>


                </div>
                <!-- End Second col-md-6 -->

                <!-- --------------------------------------------------------------------------- -->


            </div>
            <!-- End Row -->

        </div>
        <!-- End Container -->

    </section>

    <!-- -----------------------------------------End Section menu--------------------------------------------- -->


    <!-- -----------------------------------------Start Section team--------------------------------------------- -->

    <section class="team text-center" id="Team">

        <div class="container">

            <h2 class="text-center team-header">{{__('home.MEET_OUR_CHEFS')}}</h2>
            <p class="text-center team-parag">{{__('home.WE_ARE_FOOD_SPECIALISTS')}}</p>

            <div class="row">

                <!-- Start First Col -->
                <div class="col-md-3 col-sm-6">
                    <!-- Start team-content -->
                    <div class="team-content div1">
                        <div class="team-overlay">
                            <h3>Sandar</h3>
                            <p>SENIOR CHEF</p>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-dribbble"></a></li>
                            </ul>
                        </div>
                        <img src="{{ asset('frontAssets/images/chef1.jpg') }}" class="img-responsive">
                        <div class="team-overlay-show">
                            <h3>Sandar</h3>
                            <p>SENIOR CHEF</p>
                        </div>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End First Col -->

                <!-- -------------------------------------------------------------- -->

                <!-- Start Second Col -->
                <div class="col-md-3 col-sm-6">
                    <!-- Start team-content -->
                    <div class="team-content div2">
                        <div class="team-overlay">
                            <h3>Candy</h3>
                            <p>CO-FOUNDER</p>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-dribbble"></a></li>
                            </ul>
                        </div>
                        <img src="{{ asset('frontAssets/images/chef2.jpg') }}" class="img-responsive">
                        <div class="team-overlay-show">
                            <h3>Candy</h3>
                            <p>CO-FOUNDER</p>
                        </div>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End Second Col -->


                <!-- -------------------------------------------------------------- -->

                <!-- Start Third Col -->
                <div class="col-md-3 col-sm-6">
                    <!-- Start team-content -->
                    <div class="team-content div3">
                        <div class="team-overlay">
                            <h3>Mama</h3>
                            <p>SENIOR CHEF</p>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-dribbble"></a></li>
                            </ul>
                        </div>
                        <img src="{{ asset('frontAssets/images/chef3.jpg') }}" class="img-responsive">
                        <div class="team-overlay-show">
                            <h3>Sandar</h3>
                            <p>SENIOR CHEF</p>
                        </div>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End Third Col -->

                <!-- -------------------------------------------------------------- -->

                <!-- Start Four Col -->
                <div class="col-md-3 col-sm-6">
                    <!-- Start team-content -->
                    <div class="different-team1 div4">
                        <i class="fa fa-plus"></i>
                        <p class="lead">
                            {{ __('home.text1')}}.
                        </p>
                        <a href="#" class="btn btn-default hvr-bounce-to-bottom">{{ __('home.JOIN_US') }}</a>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End Four Col -->

                <!-- -------------------------------------------------------------- -->


            </div>
            <!-- End First Row -->




            <div class="row">

                <!-- Start five Col -->
                <div class="col-md-6">
                    <!-- Start team-content -->
                    <div class="div5 text-center">
                        <h2>{{ __('home.OUR_SERVICE') }}</h2>
                        <p>{{ __('home.text1') .__('home.text2')}}.</p>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End five Col -->

                <!-- -------------------------------------------------------------- -->

                <!-- Start six Col -->
                <div class="col-md-6">
                    <!-- Start team-content -->
                    <div class="div6 text-center">
                        <h2>{{ __('home.OUR_SERVICE') }}</h2>
                        <p>{{ __('home.text1') .__('home.text2')}}.</p>
                    </div>
                    <!-- End Team-content -->
                </div>
                <!-- End six Col -->

                <!-- ---------------------------------------------------- -->

            </div>
            <!-- End Second Section Row -->

        </div>
        <!-- End Section Container -->

    </section>

    <!-- -----------------------------------------End Section team--------------------------------------------- -->


    <!-- ---------------------------------------Start Gallery section ------------------------------------------ -->

    <section id="my-Gallery">

        <div class="container">

            <div class="row">


                <div class="wow fadeInUp text-center" data-wow-delay="0.3s">
                    <h2>{{ __('home.Food_Gallery') }}</h2>
                    <h4 class="Gallery-heading">{{ __('home.testtext') }}</h4>
                </div>


                <!-- All here content -->
                <div class="gallery-content wow fadeInUp" data-wow-delay="0.6s">

                    <div id="tabs" class="col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10">
                        <ul class="tabs-button">
                            <li class="button" data-filter="all"> {{ __('home.All') }} </li>
                            <li class="button" data-filter="breakfast"> {{ __('home.Breakfast') }} </li>
                            <li class="button" data-filter="pizza"> {{ __('home.Breakfast') }} </li>
                            <li class="button" data-filter="lunch"> {{ __('home.Breakfast') }} </li>
                            <li class="button" data-filter="dinner"> {{ __('home.Breakfast') }} </li>
                        </ul>
                    </div>


                    <!-- all items section -->
                    <div id="my-item" class="wow fadeInUp" data-wow-delay="0.9s">

                        <div
                            class="myGallary-content filter dinner pizza lunch col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img1.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img1.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>


                        <div
                            class="myGallary-content filter breakfast lunch dinner col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img2.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img2.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>


                        <div
                            class="myGallary-content filter dinner col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img3.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img3.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>


                        <div
                            class="myGallary-content filter breakfast col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img4.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img4.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>


                        <div
                            class="myGallary-content filter lunch col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img5.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img5.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>


                        <div
                            class="myGallary-content filter pizza lunch col-md-4 col-sm-6
                                    col-sm-offset-0 col-xs-offset-1 col-xs-10">
                            <div class="Gallery-thumb">

                                <a href="{{ asset('frontAssets/images/gallery-img6.jpg') }}" data-fancybox="Gallery">
                                    <img src="{{ asset('frontAssets/images/gallery-img6.jpg') }}"
                                        class="img-responsive">
                                    <div class="Gallery-overlay">
                                        <div class="Gallery-item">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <h3>{{ __('home.testtext') }}</h3>
                        </div>

                    </div>
                    <!-- End all items section -->

                </div>
                <!-- End All here content -->

            </div>
            <!-- End row -->

        </div>
        <!-- End container -->

    </section>

    <!-- --------------------------------------End Section Gallery--------------------------------------------- -->


    <!-- --------------------------------------Start Section Contact--------------------------------------------- -->

    <section class="Contact" id="Contact">

        <!-- Start Section overlay -->
        <div class="Contact-overlay"></div>

        <div class="container">

            <div class="row">

                <h2 class="text-center">{{ __('home.SAY_HELLO') }}</h2>
                <p class="text-center">{{ __('home.testtext') }}!</p>


                <!-- start Contact Form -->
                <form role="form">

                    <!-- start Div Form -->
                    <div class="col-md-offset-2 col-md-8">

                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder="Your Name">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder="Your Email">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control input-lg" placeholder=" Your Message "></textarea>
                        </div>

                        <button type="button" class="btn btn-default btn-lg btn-block hvr-bounce-to-right">
                            {{ __('home.SEND_MESSAGE') }}
                        </button>

                    </div>
                    <!-- End Div Form -->

                </form>
                <!-- start Contact Form -->

            </div>
            <!-- End Row -->

        </div>
        <!-- End container -->

    </section>

    <!-- -------------------------------------End Section Contact------------------------------------------------- -->


    <!-- -------------------------------------Start Section Footer------------------------------------------------- -->

    <section class="footer text-center">

        <div class="container">
            <div class="row">
                <p>Copyright &copy; 2016 Steak House Company - Designed by
                    <a href="https://www.facebook.com/said.oraby.75" target="_blank"> El Sayed Oraby </a>
                </p>
            </div>
        </div>

    </section>

    <!-- -------------------------------------End Section Footer------------------------------------------------- -->

    <a href="#" class="scrollToTop"> <i class="fa fa-angle-up" aria-hidden="true"></i> </a>

    <!-- -------------------------------- Start Section Loading ------------------------------------------------- -->

    {{-- <section class="loading-overlay">

        <div class="loading-overlay-content">
            <h1 class="text-center heading">You Are Welcom In My Website</h1>
        </div>

        <div class="spinner"></div>

    </section> --}}

    <!-- -------------------------------- End Section Loading ------------------------------------------------- -->


    <!-- -------------------------------------------------------------------------------------------------- -->


    <script src="{{ asset('frontAssets/js/jquery-3.2.1.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ asset('frontAssets/js/bootstrap.min.js') }}"></script>

    <!-- Slide Show images #Home  -->
    <script src="{{ asset('frontAssets/js/jquery.backstretch.min.js') }}"></script>

    <!-- Small Slider -->
    <script src="{{ asset('frontAssets/js/jquery.flexslider-min.js') }}"></script>

    <!-- YouTubePopUp plugin -->
    <script src="{{ asset('frontAssets/js/YouTubePopUp.jquery.js') }}"></script>

    <!-- fancybox plugin -->
    <script src="{{ asset('frontAssets/js/jquery.fancybox.min.js') }}"></script>

    <!-- <script src="js/jquery.scrollTo.min.js"></script> -->

    <!-- nicescroll plugin -->
    <script src="{{ asset('frontAssets/js/jquery.nicescroll.min.js') }}"></script>

    <script src="{{ asset('frontAssets/js/wow.min.js') }}"></script>

    <script>
        new WOW().init();
    </script>

    <!-- Java Script Code -->
    <script src="{{ asset('frontAssets/js/myCode.js') }}"></script>

</body>

</html>
