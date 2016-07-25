<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Home</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <!--
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    {{ HTML::style('https://fonts.googleapis.com/css?family=Lato:300') }}
    -->
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/lightslider.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <script src="js/jquery-1.11.0.min.js"></script>
    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <!--
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        -->
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">
    <style type="text/css">
        .lato-text { font-family: 'Lato', sans-serif}
        /*section{padding:0px 0px;}*/
        .signUpDiv
        {
            background-color: rgba(255,255,255,1);
            border:1px solid #ccc;
            border-radius: 4px; 
            padding-top: 25px; 
            padding-bottom:25px;
        }
    </style>
    <script src='https://www.google.com/recaptcha/api.js?hl=en?fallback=true'></script>
    <script>
        $(document).ready(function(){
            $('#minimalRegForm_Company').submit(function(e){
                $('#SUBMITBUTTON').prop('disabled', true).hide();
                $('#FAUXSUBMITBUTTON').show();

                if(grecaptcha.getResponse().length == 0){
                    alert("Please check the ReCaptcha First!");
                    e.preventDefault();
                    $('#FAUXSUBMITBUTTON').hide();
                    $('#SUBMITBUTTON').prop('disabled', false).show();
                }else{
                    e.preventDefault();
                    $.ajax({
                        type    :   'POST',
                        url     :   '/CHKRGWRKR',
                        data    :   $(this).serialize(),
                        success :   function(data){
                            if(data.length == 0){
                                $('#minimalRegForm_Company').unbind().submit();
                            }else{
                                alert(data.join("\n"));
                                $('#FAUXSUBMITBUTTON').hide();
                                $('#SUBMITBUTTON').prop('disabled', false).show();
                            }
                        }
                    });
                }
            });
        });
    </script>
</head>

<body id="page-top">
    <div class="toTop">
        <a class="page-scroll text-primary" href="#page-top" style="text-decoration:none; outline:none;">
            <i class="fa fa-chevron-circle-up"></i>   Back to top
        </a>
    </div>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand page-scroll logoImg" href="/" style="padding:0; margin:0;"></a>
               
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {{ HTML::link('/', 'Worker')}}
                    </li>

                    <li class="active">
                        {{ HTML::link('/employer', 'Employer')}}
                    </li>

                    <li>
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>

                    <li>
                     <!--   <a class="" href="WhyProveek.html">Why Choose Proveek</a> -->
                         {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}

                    </li>
                    <!-- <li>
                         <a class="" href="Pricing.html">Pricing</a>
                        {{ HTML::link('/pricing', 'Pricing')}}
                    </li> -->
                    <li>
                        <!--<a class="" href="#">Login / Sign Up</span></a> -->
                        {{ HTML::link('/login', 'Sign In')}}
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!--<div class="collapse navbar-collapse" style="background-color:rgba(255,255,255,.30); height: 25px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#about" style="padding-top: 0;padding-bottom: 0">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services" style="padding-top: 0;padding-bottom: 0">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact" style="padding-top: 0;padding-bottom: 0">Contact</span></a>
                    </li>
                </ul>
            </div>-->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- HEADER SEARCH SECTION -->
    <header style="max-height: auto !important;">
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5);">
        <div class="header-content">
            <div class="header-content-inner lato-text">
                <div class="row">
                    <div class="col-lg-8 text-left">
                        <h2>Sign Up</h2>
                        <h3 class="lato-text">Post jobs and find suitable workers!</h3>
                        <br>
                        {{ Form::open(array('url' => '/regEmployer', 'id' => 'minimalRegForm_Company')) }}
                            <div class="col-lg-8 signUpDiv" style="">
                                <div class="col-lg-12" style="">
                                    {{ Form::label('lbl_companyName', 'Company name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('compName', null, ['class' => 'form-control', 'placeholder' => "Night's Watch", 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('firstName', 'First name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('fName', null, ['class' => 'form-control', 'placeholder' => 'Jon', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lastName', 'Last name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('lName', null, ['class' => 'form-control', 'placeholder' => 'Snow', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>

                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('lbl_username', 'Username', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('uName', null, ['class' => 'form-control', 'placeholder' => 'markopotato', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_email', 'Email', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('txtEmail', null, ['class' => 'form-control', 'placeholder' => 'youremail@example.com', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>

                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('lbl_password', 'Passowrd', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::password('primary_pass' , array('style' => 'border:none;', 'class' => 'form-control', 'placeholder' => '•••••••', 'required' => 'True')) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_cPassword', 'Confirm Password', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::password('cPass' , array('style' => 'border:none;', 'class' => 'form-control', 'placeholder' => '•••••••', 'required' => 'True')) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_mobileNum', 'Mobile Number', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    <input type="text" class="form-control" placeholder="09xxxxxxxxx" name="mobileNum" style="border: none;" required="required" />
                                </div>
                                <div class="col-lg-12 lato-text g-recaptcha" style="padding-top:10px;" data-sitekey="6LfpJyITAAAAAPxa-KWsJlqMNHL6qVK6nngZktlY"></div>
                                <div class="col-lg-12 lato-text">
                                    <p style="padding:0;margin:0;font-size:10pt; color:#0f0f0f">By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Privacy Policy</a>.</p>
                                </div>
                                <div class="col-lg-12 text-center" style="padding-top:5px;">
                                    {{ Form::submit('Sign up for free', array('class' => 'btn btn-primary', 'style' =>'border-radius:4px; width:100%;', 'id' => 'SUBMITBUTTON')) }}
                                    <button id="FAUXSUBMITBUTTON" class="btn btn-primary btn-block" style="display: none; border-radius: 0.3em;" disabled><i class="fa fa-circle-o-notch fa-spin"></i> LOADING DATA</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- <div class="col-lg-5">
                        <h2 class="lato-text">Latest Jobs</h2>
                        <hr/>
                        <div class="text-left">
                          
                        </div>
                    </div> -->
                </div>
                <!-- <h1>Find Jobs that Matched Your Skills</h1>
                <hr>
                <p style="color:#ECF0F1">Proveek is an online platform that allows an individual or company to outsource jobs or hire skilled or manual laborers near their area.</p>
 -->
                <!-- SEARCH BOX -->
                <!-- <div class="col-xs-2"> --><!--used to center the textbox --><!-- </div> -->
                <!-- <div class="col-xs-8">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon1"><span class=" glyphicon glyphicon-search"></span></span>
                      <input type="text" class="form-control" placeholder="Tell us what you need..." aria-describedby="basic-addon1" style="text-align:center;">
                    </div>
                </div> -->
                <!-- <div class="col-xs-2">used to center the textbox</div> -->       
                <!-- END OF SEARCH BOX -->

                <!-- SEARCH BUTTONS -->
		
                <!-- <div class="btn" style="padding-top: 20px;">
                    <a href="#GlobalModal" data-toggle="modal"  style="text-decoration:none;">
                        <button type="button" class="btn btn-primary btn-md" style="width: 180px; border-top-right-radius: 1em; border-bottom-right-radius: 1em;">Job Provider</button>
                        <button type="button" class="btn btn-primary btn-md" style="width: 180px;border-top-left-radius: 1em; border-bottom-left-radius: 1em;">Job Seeker</button>
                    </a>
                </div> -->
		
                <!-- END OF SEARCH BUTTONS -->
                <!-- <div class="text-center div_header">
                  <a href="#services" class="page-scroll">
                       <i class="fa fa-4x fa-angle-down"></i>
                  </a>
                </div> -->
                <!--<a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>-->
            </div>
        </div>
        </div>
    </header>
    <!-- END OF -->


<!-- SKILLS AND SERVICES -->
    <section id="services" style="padding-top:40px; padding-bottom:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                	<i class="fa fa-5x fa-users wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Skills and Services Offered</h2>
                    <hr class="primary">
                    <p>Please select from the catergories</p>
                </div>
            </div>
        </div>
    </section>
    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                    	<i class="fa fa-5x fa-building-o wow bounceIn text-primary" style="padding-top:50px;"></i>
                    	<h3>Construction / Factory Workers</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Construction / Factory Workers
                                </div>
                                <div class="project-name">
                                    <!-- 123,456 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <!-- <img src="#" class="img-responsive" alt=""> -->
                        <i class="fa fa-5x fa-cogs wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".1s"></i>
                        <h3>Automotive / Electronics</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Automotive / Electronics
                                </div>
                                <div class="project-name">
                                    <!-- 3,987,543 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-dollar wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".2s"></i>
                        <h3>Sales Agents / Salesclerk</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Sales Agents / Salesclerk
                                </div>
                                <div class="project-name">
                                   <!-- 9,123,456 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-user-md wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".3s"></i>
                        <h3>House Helpers / Caregivers</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    House Helpers / Caregivers
                                </div>
                                <div class="project-name">
                                    <!-- 546,152 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-wrench wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".4s"></i>
                        <h3>Repair &amp Maintenance Services</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Repair &amp Maintenance Services
                                </div>
                                <div class="project-name">
                                    <!-- 9,436 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-stethoscope wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".5s"></i>
                        <h3>Personal Care &amp Wellness</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Personal Care &amp Wellness
                                </div>
                                <div class="project-name">
                                    <!-- 5,859 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-cutlery wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".6s"></i>
                        <h3>Hotel &amp Restaurant Crew</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Hotel &amp Restaurant Crew
                                </div>
                                <div class="project-name">
                                    <!-- 1,285,956 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-ellipsis-h wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".7s"></i>
                        <h3>More</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    More
                                </div>
                                <div class="project-name">
                                    <span class="glyphicon glyphicon-option-horizontal text-default"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
<!-- END OF SKILLS AND SERVICES -->

<!-- POST A JOB -->
 <!-- 	<section class="bg-primary" style="background-image: url(frontend/img/header.jpg); background-position: center; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top: 40px; padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                	<i class="fa fa-5x fa-search wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Can't find what you're looking for?</h2><br>
                    <a href="#GlobalModal" data-toggle="modal" class="btn btn-default btn-lg" style="border-radius: 4em; width: 250px; outline:none;">Post a Job</a>
                    <!--<a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section> -->
<!-- END OF POST A JOB -->

<!-- TESTIMONIAL SLIDER -->
   <!--  <section style="background-color: white; background-position: top; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top: 40px; padding-bottom: 40px">
		<div class="item">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-lg-1"></div>
			        <div class="col-lg-10">
				        <div style="width:100%; color:#222" class="text-center">
					        <i class="fa fa-5x fa-comments-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
					        <h2>Testimonials</h2>
				        </div>
			        	<hr class="default" style="">
				        <ul id="lightSlider" class="content-slider" style="color: #222;">
				            <li>
				            	<div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Best Blue-collar job listing site in the Philippines. Period."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-AQUEOUS Inc.</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Proveek means Providers and Seekers, Great Idea!"</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-PewDiePie</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"15 million ducks out of 10."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Entrio Productions</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Made with love."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-BootPly.com</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Perfect place for blue-collar job seekers!"</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Awwwards.com</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Made with Bootstrap 3, images from Unsplash.com, and powered by PHP."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Proveek</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				        </ul>
			        </div>
			        <div class="col-lg-1"></div>
			    </div>
		    </div>
	    </div>
    </section> -->
<!-- END OF TESTIMONIAL SLIDER -->

<!-- PARTNERSHIP SLIDER -->
    <section class="bg-primary" style="background-image: url(frontend/img/blur_03.jpg); background-position: top; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top:40px; padding-bottom: 40px">
		<div class="item">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-lg-1"></div>
			        <div class="col-lg-10">
				        <div style="width:100%; color:#222" class="text-center">
					        <i class="fa fa-5x fa-chain wow bounceIn text-primary" data-wow-delay=".2s"></i>
					        <h2 style="">Featured On</h2>
				        </div>
			        	<hr class="default" style="">
				        <ul id="lightSlider0" class="content-slider" style="color: #222;">
				            <li>
				            	<div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_tia.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_mst.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_philStar.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_bloomBusi.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_dealStreet.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				        </ul>
			        </div>
			        <div class="col-lg-1"></div>
			    </div>
		    </div>
	    </div>
    </section>
<!-- END OF PARTNERSHIP SLIDER -->

<!-- FOOTER -->
    <section id="footer" class="divFooterDark" style="padding-top:40px; padding-bottom:60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-8 text-center">
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-left div_footer">
                                <h2>Proveek</h2>
                                <ul style="padding-left:0">
                                    <li><a href="/" class="page-scroll">Home</a></li>
                                    <li>{{ HTML::link('/howitworks', 'How It Works')}}</li>
                                    <li>  {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}</li>
                                    <li>  {{ HTML::link('/pricing', 'Pricing')}}</li>
                                   <li><a href="#">FAQ</a></li>
                                    <li>    {{ HTML::link('/login', 'Login / Sign Up')}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 text-left feedback_footer">
                            <h2>Contact Us</h2>
                            <p>We love to hear from you. Please drop us a message.</p>
                            <div class="col-lg-12" style="padding:0;">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                <input type="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                <input type="text" placeholder="Message">
                            </div>
                            <div class="col-lg-12 text-right" style="padding:15px 0 0 0 ;">
                                <button type="button" class="btn btn-primary btn-md" style="width: 120px;border-radius: 4px;">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                         <div class="col-lg-12 text-center div_footer">
                            <h2>Find Us On</h2>
                            <hr class="primary">
                            <p>
                                Stay connected to keep up with the latest news, promos and updates.
                            </p>
                            <div class="div_footer">
                                <a href="https://www.facebook.com/proveek"><i class="fa fa-facebook-square fa-3x wow bounceIn" data-wow-delay=".2s"></i></a>
                                <a href="https://twitter.com/Proveek"><i class="fa fa-twitter-square fa-3x wow bounceIn" data-wow-delay=".3s"></i></a>
                                <a href="#"><i class="fa fa-instagram fa-3x wow bounceIn" data-wow-delay=".4s"></i></a>
                                <a href="https://plus.google.com/108796854139900682022/posts"><i class="fa fa-google-plus-square fa-3x wow bounceIn" data-wow-delay=".5s"></i></a>
                                <a href="#"><i class="fa fa-envelope-square fa-3x wow bounceIn" data-wow-delay=".6s"></i></a>
                            </div>
                            <p>2015  <i class="fa fa-copyright"></i>  Proveek Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END OF FOOTER -->



<!-- MODALS -->
    <div class="modal modal-vcenter fade lato-text" id="GlobalModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: url(frontend/img/modalBg.jpg)">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <i class="fa fa-user-plus fa-5x text-primary"></i>
                    <h2 style="text-transform:uppercase;">Find Skilled Workers for your Job</h2>
                </div>
                <div class="modal-body text-center" style="padding-bottom:0">
                    <p style="font-size:16px;">Sign up as Employer now, post jobs and find workers suitable for that job. A 3-month subscription is active upon signing up.</p>
                </div>
                <div class="modal-footer text-center" style="text-align:center; padding-bottom:20px;">
                    <a href="/employer" class="btn btn-primary btn-md" style="border:1px solid #2980b9; font-size:16pt; padding:15px 30px 15px 30px;border-radius: 4px;">SIGN UP</a>
                </div>
            </div>
        </div>
    </div>
<!-- END OF MODAL -->



<!-- All scripts and plugin should be placed here so the page can load -->
<!-- jQuery -->
    <script src="frontend/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
    <script src="frontend/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
    <script src="frontend/js/jquery.easing.min.js"></script>
    <script src="frontend/js/jquery.fittext.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/vegas.js"></script>
    <script src="frontend/js/lightslider.js"></script>
<!-- Custom Theme JavaScript -->
    <script src="frontend/js/creative.js"></script>

    <script src="frontend/js/jquery.nicescroll.js"></script>
    <script src="frontend/js/custom.js"></script>
<!-- HTML SMOOTH MOUSEWHEEL SCROLLING -->
    <script>
    $(document).ready(

      function() { 

        $("html").niceScroll();

      }
    );
    </script>
<!-- END OF SMOOTH MOUSEWHEEL SCROLLING -->

<!-- FOR HEADER SLIDER -->
    <script>
        $('header').vegas({
          overlay: true,
          preload: true,
          preloadImage: true,
          transition: 'fade', 
          overlay: true,
          transitionDuration: 4000,
          delay: 10000,
          animation: 'fade',
          shuffle: true,
          timer:false,
          animationDuration: 20000,
          slides: [
            { src: 'frontend/img/slideshow/01.jpg' },
            { src: 'frontend/img/slideshow/03.jpg' },
            { src: 'frontend/img/slideshow/05.jpg' },
            { src: 'frontend/img/slideshow/07.jpg' },
            { src: 'frontend/img/slideshow/02.jpg' },
            { src: 'frontend/img/slideshow/04.jpg' },
            { src: 'frontend/img/slideshow/06.jpg' },
          ]
        });
    </script>
<!-- END OF HEADER SLIDER -->

<!-- SLIDER PUBLIC SETTING -->
<!-- NOTE: For one slider only -->
	<script>
// SLIDER PROPERTIES FOR COMMENTS/FEEDBACK SLIDERS
	$(document).ready(function() {
	    $("#lightSlider").lightSlider({
	        item: 3,
	        autoWidth: false,
	        slideMove: 1, // slidemove will be 1 if loop is true
	        slideMargin: 100,
	 
	        addClass: '',
	        mode: "slide",
	        useCSS: true,
	        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
	        easing: 'linear', //'for jquery animation',////
	 
	        speed: 600, //ms'
	        auto: true,
	        loop: true,
	        slideEndAnimation: true,
	        pause: 6000,
	 
	        keyPress: false,
	        controls: false,
	        prevHtml: '',
	        nextHtml: '',
	 
	        rtl:false,
	        adaptiveHeight:false,
	 
	        vertical:false,
	        verticalHeight:500,
	        vThumbWidth:100,
	 
	        thumbItem:10,
	        pager: true,
	        gallery: false,
	        galleryMargin: 5,
	        thumbMargin: 5,
	        currentPagerPosition: 'middle',
	 
	        enableTouch:true,
	        enableDrag:true,
	        freeMove:true,
	        swipeThreshold: 40,
	 
	        responsive : [],
	 
	        onBeforeStart: function (el) {},
	        onSliderLoad: function (el) {},
	        onBeforeSlide: function (el) {},
	        onAfterSlide: function (el) {},
	        onBeforeNextSlide: function (el) {},
	        onBeforePrevSlide: function (el) {}
	    });
	});

// SLIDER PROPERTIES FOR PARTNERSHIP SLIDER
	$(document).ready(function() {
	    $("#lightSlider0").lightSlider({
	        item: 3,
	        autoWidth: false,
	        slideMove: 1, // slidemove will be 1 if loop is true
	        slideMargin: 100,
	 
	        addClass: '',
	        mode: "slide",
	        useCSS: true,
	        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
	        easing: 'linear', //'for jquery animation',////
	 
	        speed: 600, //ms'
	        auto: true,
	        loop: true,
	        slideEndAnimation: true,
	        pause: 6000,
	 
	        keyPress: false,
	        controls: false,
	        prevHtml: '',
	        nextHtml: '',
	 
	        rtl:false,
	        adaptiveHeight:false,
	 
	        vertical:false,
	        verticalHeight:500,
	        vThumbWidth:100,
	 
	        thumbItem:10,
	        pager: true,
	        gallery: false,
	        galleryMargin: 5,
	        thumbMargin: 5,
	        currentPagerPosition: 'middle',
	 
	        enableTouch:true,
	        enableDrag:true,
	        freeMove:true,
	        swipeThreshold: 40,
	 
	        responsive : [],
	 
	        onBeforeStart: function (el) {},
	        onSliderLoad: function (el) {},
	        onBeforeSlide: function (el) {},
	        onAfterSlide: function (el) {},
	        onBeforeNextSlide: function (el) {},
	        onBeforePrevSlide: function (el) {}
	    });
	});
	</script>
<!-- END OF SLIDER PUBLIC SETTING -->

<!-- SCRIPT TO VERTICALLY CENTER MODAL -->
    <script>
        /* center modal */
        function centerModals($element) {
          var $modals;
          if ($element.length) {
            $modals = $element;
          } else {
            $modals = $('.modal-vcenter:visible');
          }
          $modals.each( function(i) {
            var $clone = $(this).clone().css('display', 'block').appendTo('body');
            var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
            top = top > 0 ? top : 0;
            $clone.remove();
            $(this).find('.modal-content').css("margin-top", top);
          });
        }
        $('.modal-vcenter').on('show.bs.modal', function(e) {
          centerModals($(this));
        });
        $(window).on('resize', centerModals);
    </script>
<!-- END OF -->


    {{--MODA LFOR TERMS - TAGALOG -- START--}}
    <div class="modal modal-vcenter fade lato-text" id="TERMSMODAL_TAGALOG" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                    <h3>Terms of Service - Proveek BETA</h3>
                    <a href="#" data-target="#TERMSMODAL_TAGALOG" data-toggle="modal">Click here for TOS Tagalog Version</a>
                </div>
                <div class="modal-body" style="padding: 4em">
                    <p class=MsoNormal align=center style='text-align:center'><b><span
                    style='font-size:16.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>TERMS
                    OF SERVICE</span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:16.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang mga
                    impormasyong nakasaad sa kasunduang ito ay mahalaga. Marapat lamang na basahin
                    ito ng buo at maigi upang malaman ang mga dapat tandaan sa paggamit ng Proveek.
                    Magmula (DATE), ang mga kondisyong ito ay magiging basehan sa kung paano mo
                    gagamitin ang website na ito. Kung ikaw ay hindi sasang-ayon sa mga panuntunang
                    ito, hindi mo maaaring gamitin ang Proveek website o alinmang serbisyo nito.
                    Kung ikaw ay may katanungan, maaari ninyo kaming maabot sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Kasunduan
                    (Binding Agreement)</span></b><b><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang mga
                    patakarang nakasaad dito ang bumubuo sa isang kasunduan sa pagitan mo na User
                    at ng kumpanya na Proveek Inc., at nangangahulugang tinanggap mo ang mga ito
                    tuwing gagamitin mo ang Website at ang aming mga serbisyo. Sumasang-ayon ka rin
                    na gamitin ang Website sa iyong sariling kagustuhan at pananagutan. Ang mga
                    patakarang ito ang gagamiting basehan sa ano mang isyu na lumutang sa pagitan
                    mo at ng Proveek.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>May mga
                    pagbabagong maaaring gawin sa mga patakarang ito kaya mabuting lagi mong
                    tingnan kung may mga updates. Kung patuloy mong gagamitin ang Proveek.com
                    pagkatapos maidagdag ang mga pagbabago sa patakaran, ibig sabihin ay
                    sumasang-ayon ka sa mga pagbabagong ito.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Tala-Salitaan
                    (Definitions)<o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Patakaran (Terms)</span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> – Terms
                    of service. Mga patakaran o batas sa paggamit ng Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>User</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – Ikaw.Lahat ng gumagamit ng Proveek.com.Kasama
                    dito ang employer at manggagawa.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Content</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – lahat ng, ngunit hindi limitado sa disenyo (designs),
                    text, graphics, imahe (images), bidyo (video), impormasyon, logos, button
                    icons, software, audio files at iba pang laman ng Proveek.com website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Website</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – Proveek.com<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:normal'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Proveek</span></i></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> –
                    Proveek Inc. na pangalan ng kumpanya.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Copyright
                    at Pag-gamit ng Nilalaman (Copyright and Use of Proveek Content)<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.5in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.1 <u>Copyright</u></span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. Narito
                    ang mga probisyon:</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(a)</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Proveek Inc, kasama ng mga lisensyor nito, ang
                    nagmamay-ari at kumokontrol sa lahat ng copyright at intellectual property
                    rights ng Website pati lahat ng nilalaman ng Website; at</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(b)</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Lahat ng <span
                    style='mso-spacerun:yes'> </span>copyrightat ibang intellectual property rights
                    sa Website lahat ng material dito ay pagmamay-ari at nakareserba para sa <i
                    style='mso-bidi-font-style:normal'>Proveek</i>lamang.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Pinapayagan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i> ang mga User na tingnan ang content, i-download at ilimbag
                    (i-print) ang isang kopya ng content para sa pansarili at hindi pang-komersyong
                    gamit lamang. Ang content ng Website at protektado ng copyright, trademark at
                    iba pang batas.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi maaaring baguhin, kopyahin, padamihin,
                    i-upload o ipamigay sa ano mang paraan ang content ng Websitekabilang na ang
                    code at ang software. Dapat ding panatilihin ng User ang lahat naproprietary
                    notices na laman ng orihinal na laman ng anumang kopya ng anumang content mula
                    sa Website. Hindi maaaring ibenta o baguhin ang content, paramihin, i-display,
                    ipamigay o gamitin ang content para sa pampubliko o komersyal na gamit. Ang
                    bagay na ito ay mahigpit na ipinagbabawal ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>. Kung ang User ay lalabag sa mga patakarang ito, maaaring
                    maalis ang karapatan mong gamitin ang content ng Website at kakailanganin mong
                    sirain ang lahat ng kopya mo ng <i style='mso-bidi-font-style:normal'>Proveek</i>
                    content.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.2 <u>Pangkalahatang Paggamit sa Website (General
                    Use of Website)</u></span></b><u><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>.</span></u><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang Website ay inilaan para sa mga tao, lalo na
                    sa mga manggagawa (skilled workers) na naghahanap ng trabaho at sa mga Employer
                    na naghahanap ng pinakamainam na trabahador. Maaari ninyong gamitin ang Website
                    ayon sa batas at nakapaloob sa konteksto ng itinakdang gamit at
                    katanggap-tanggap na gamit sa Website.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    paggamit sa Website sa anumang paraan na magbubunga o maaaring magbunga ng
                    pinsala sa Proveek, o magkaroon ng diperensya ang Website ay mahigpit na
                    ipinagbabawal. Gayundin, ang paggamit ng Website sa anumang paraan na hindi
                    naaayon sa batas (unlawful), iligal (illegal), panloloko (fraudulent) o
                    naglalagay sa kapahamakan (harmful) ay hindi maaaring palagpasin. Maaaring
                    gumawa ng legal na aksyon ang Proveek sa ganitong sitwasyon. Hindi rin maaaring
                    gamitin ang Website upang kumopya, mag-imbak (store), mag-host, mag-transmit,
                    magpadala (send), gumamit, mag-limbag (publish), o mamigay (distribute) ng
                    anumang material na naglalaman o may kinalaman sa anumang spyware, computer
                    virus, Trojan horse, worm, keystroke logger, rootkit at ano pa mang malisyosong
                    computer software. Dapat siguruhin ng User na lahat ng impormasyon na ibibigay
                    at ilalagay sa Proveek.com ay totoo, tama, kumpleto at hindi nagbibigay ng
                    kalituhan sa sinuman.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.3<u>Lisensya ng Paggamit Para sa mga
                    Manggagawa na Naghahanap ng Trabaho (License to Use by Users who are Job
                    Seekers)</u></span></b><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>. Binibigyang kayo ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na magkaroon ng limitado, at hindi eksklusibong karapatan na
                    gamitin ang Website para sa pansariling gamit sa inyong paghahanap ng trabaho. <span
                    style='color:red'>Maaari kayong tumingin o mag-download ng isang kopya ng
                    material sa Website para sa pansariling gamit lamang</span>. Sa paggawa nito,
                    sumasang-ayon ka na ikaw lamang ang may responsibilidad sa anumang ilalagay o
                    ipo-post sa Website at sa anumang problemang lulutang sa pagpo-post na ito. <span
                    style='color:red'>Dapat tandaan na ang lahat ng ito ay isang pribilehiyo</span>
                    at karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na tanggalin
                    ang pribilehiyong ito para sa anumang dahilan, anumang oras, sa kanyang
                    kagustuhan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.4<u>Lisensya ng Paggamit Para sa mga
                    Employers na Naghahanap ng Trabahador (License to Use by Users who are Job
                    Providers or Employers)</u></span></b><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>. Binibigyang kayo ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na magkaroon ng limitado, at hindi eksklusibong karapatan na
                    gamitin ang Website para sa pansariling gamit sa inyong paghahanap ng
                    trabahador. <span style='color:red'>Maaari kayong tumingin o mag-download ng
                    isang kopya ng material sa Website para sa pansariling gamit lamang na may
                    kaugnayan lamang sa paghahanap ng pinakamainam na manggagawa</span>. Binibigyan
                    din kayo ng limitado at hindi eksklusibong lisensya na gamitin ang Proveek
                    Materials and Services para sa internal na gamit lamang. Hindi maaaring ibenta,
                    ilipat o ibigay ang anumang serbisyong ito sa kaninuman na walang kaukulang
                    permiso mula sa <i style='mso-bidi-font-style:normal'>Proveek</i>. Sumasang-ayon
                    ka na ikaw lamang ang may responsibilidad sa anumang ilalagay o ipo-post sa
                    Website at sa anumang problemang lulutang sa pagpo-post na ito. <span
                    style='color:red'>Dapat tandaan na ang lahat ng ito ay isang pribilehiyo</span>
                    at karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na tanggalin
                    ang pribilehiyong ito para sa anumang dahilan, anumang oras, sa kanyang
                    kagustuhan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.5<u>Iba pang Patakaran sa Paggamit ng Website
                    (Other Specific Rules Regarding Site Usage)</u></span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. Pinapatunayan
                    at sumasang-ayon ka na ikaw ay (a) labing-walong taong gulang (18 years old),
                    at (b) hindi gagamit (o hindi babalaking gamitin o tulungan ang iba na gumamit)ng
                    Website sa anumang paraan na ipinagbabawal ng mga patakarang nakasaad sa
                    kasunduang ito. Responsibilidad ng User na ang paggamit niya ay naaayon sa
                    patakaran ng <i style='mso-bidi-font-style:normal'>Proveek</i>.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Pagtatala
                    at Mga Account (Registration and Accounts)</span></b><b><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>4.1 <u>Para sa Magbibigay ng Trabaho
                    (Employers)</u></span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat panatilihing
                    konpidensyal (confidential) ang iyong Employer account, Profile at password.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Hindi mo
                    dapat hayaan ang sinuman na gamitin ang iyong Employer account upang i-access
                    ang Website pati na ang content at serbisyo nito.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    mong ipagbigay-alam kaagad sa<i style='mso-bidi-font-style:normal'>Proveek</i>kung
                    may mapansin kang hindi autorisadong paggamit sa iyong account. Para sakaragdagang
                    tulong, abutin ang Proveek sa </span><a href="mailto:service.proveek@gmail.com"><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Alam at
                    naiintindihan mo na kung sakaling tanggalin o i-deactivate mo ang iyong
                    Employer account, lahat ng impormasyong nakaimbak dito – kabilang ang saved
                    resumes, network contacts, at email mailing lists – ay mabubura at maaaring
                    mabura ng tuluyan mula sa database ng Proveek. Gayunman, maaaring magtagal pa
                    ito ng ilang panahon dahil sa delay sa network at web servers.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong job posting ay hindi maaaring maglaman ng mga sumusunod:<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hyperlinks,
                    maliban sa mga autorisado ng Proveek.com;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>nakakalito
                    (misleading), hindi mabasa (unreadable),onakatagong (&quot;hidden&quot;)
                    keywords, inuulit (repeated)na keywords o keywords na walang kinalaman sa
                    trabahong iyong ibinibigay;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>pangalan,
                    logo o trademarks ng mga kumpanyang hindi sa iyo;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>pangalan
                    ng mga pamantasan, siyudad, bayan o bansang walang kaugnayan sa trabahong iyong
                    ibinibigay;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>higit sa
                    isang trabaho o deskripsyon ng trabaho, higit sa isang lokasyon o higit sa
                    isang kategorya ng trabaho, maliban na lamang kung kinakailangan;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hindi
                    totoo, hindi tama at nakakalitong mga impormasyon;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materyal
                    o links sa materyal na umaabuso sa tao sa paraang sekswal, bayolente at iba pa,
                    maging ang paghingi ng impormasyon mula sa sinumang menor de edad; at,<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materyal
                    o links sa materyal na magbubunga sa mga gawaing ipinagbabawal ng batas tulad
                    ng human trafficking, iligal na droga (illegal drug trade), at iba pa.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong User ID ay hindi maaaring magbigay ng kalituhan sa <i style='mso-bidi-font-style:
                    normal'>Proveek</i>, naghahanap ng trabaho (Job Seekers), at sa iba pang
                    gumagamit ng Website; hindi mo maaaring gamitin ang iyong account at User ID
                    upang gayahin ang katauhan ng iba.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Dapat pag-ingatan at ilihim ang iyong password</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ipagbigay-alam
                    agad sa Proveek kung may ibang makaalam ng iyong password na maging sanhi ng
                    hacking ng iyong account. Abutin lamang kami sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>para sa
                    tulong na kinakailangan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Responsibilidad
                    mo ang anumang aktibidad sa Website na resulta ng iyong kapabayaan sa iyong
                    password at maging ang pagkalugi dahil dito.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    siguruhin na lahat ng personal na impormasyon na maaaring i-access ng <i
                    style='mso-bidi-font-style:normal'>Proveek</i> at manggagawa ay tama, kumpleto,
                    napapanahon (up-to-date) at hindi magreresulta ng pagkalito. Hindi ka maaaring
                    gumaya sa anumang tao, buhay man o patay, o anumang kumpanyang walang kaugnayan
                    sayo.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(k)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Maaari mong i-deactivate ang iyong account sa Proveek.com gamit ang
                    account control panel sa iyong profile.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>4.2 <u>Para sa Manggagawa (Workers)</u></span><o:p></o:p></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    ikaw ay labing-walong taong gulang (18 yrs old) o higit pa upang makagawa ng
                    account sa Proveek Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Maaari
                    kang magparehistro ng account sa Proveek.com sa pamamagitan ng pagkumpleto at
                    pagsumite ng account registration form, at pag-click sa verification link sa
                    email na matatanggap ninyo. <span style='color:red'>Ang registration para sa
                    manggagawa ay LIBRE (walang bayad)</span>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Hindi mo
                    maaaring payagan ang sinuman na gamitin ang iyong account sa Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    mong ipagbigay-alam kaagad sa<i style='mso-bidi-font-style:normal'>Proveek</i>kung
                    may mapansin kang hindi autorisadong paggamit sa iyong account. Para sa
                    karagdagang tulong, abutin ang Proveek sa </span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong User ID ay hindi maaaring magbigay ng kalituhan sa <i style='mso-bidi-font-style:
                    normal'>Proveek</i>, naghahanap ng trabahador (Employer), at sa iba pang
                    gumagamit ng Website; hindi mo maaaring gamitin ang iyong account at User ID
                    upang gayahin ang katauhan ng iba. <o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Dapat pag-ingatan at ilihim ang iyong password</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ipagbigay-alam
                    agad sa Proveek kung may ibang makaalam ng iyong password na maging sanhi ng
                    hacking ng iyong account. Abutin lamang kami sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> para sa
                    tulong na kinakailangan.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Responsibilidad
                    mo ang anumang aktibidad sa Website na resulta ng iyong kapabayaan sa iyong
                    password at maging ang pagkalugi dahil dito.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    siguruhin na lahat ng personal na impormasyon na maaaring i-access ng <i
                    style='mso-bidi-font-style:normal'>Proveek</i> at Employer ay tama, kumpleto,
                    napapanahon (up-to-date) at hindi magreresulta ng pagkalito. Hindi ka maaaring
                    gumaya sa anumang tao, buhay man o patay.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Maaari mong i-deactivate ang iyong account sa Proveek.com gamit ang
                    account control panel sa iyong profile.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Pagbabayad
                    ng kaukulang Bayarin (Fees)Para sa Employers<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Lahat ng
                    karampatang bayarin sa<i style='mso-bidi-font-style:normal'>Proveek</i> ay
                    dapat mabayaran sa paraang napagkasunduan (payment terms) sa loob ng
                    nakatakdang panahonmula ng matanggap ang invoice. Ang hindi pagbabayad sa oras
                    ay magkakaroon in interes na <span style='color:red'>8% kada taon. Lahat ng
                    presyo ay eksklusibo sa alinmang buwis liban na lamang kung nakasaad</span>.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Kung sakali mang dumating ang panahon na i-deactivate mo ang iyong
                    account, karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na
                    tanggapin lahat ng natitirang bayarin para sa serbisyong ginamit hanggang sa
                    i-deactivate ang account at 50% pa ng natitirang hindi pa nagagamit na
                    serbisyong naitala na (Service Agreement).</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial;
                    color:red'><o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial;color:red'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limitadong
                    Garantiya (Limited Warranties)<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi ginagarantiya ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i> ang mga sumusunod: na kumpleto o tama ang impormasyong
                    nailathala sa Website; na ang material sa Website ay napapanahon; o na ang
                    Website o anumang serbisyo nito ay mananatiling nasa Internet sa lahat ng
                    panahon.</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Karapatan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na hindi ipagpatuloy o baguhin ang annuman o lahat ng
                    serbisyo sa Website, at itigil ang paglalathala sa Website sa anumang oras ayon
                    sa kagustuhan ng Proveek ng walang pasabi o eksplenasyon. Ang sinumang User ay
                    hindi makakatanggap ng anumang kabayaran sakaling baguhin ang anuman o lahat ng
                    serbisyo sa Website, o itigil ang paglalathala sa Website.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi nagbibigay ang<i style='mso-bidi-font-style:
                    normal'>Proveek</i> ng anumang insurance o anumang proteksyon para sa employer
                    at manggagawa.</span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin'>Hindi sinisigurado ng<i
                    style='mso-bidi-font-style:normal'>Proveek</i>na kumpleto at tama ang User information
                    dahil ang User identification ay mahirap mapatunayan online. Ngunit maaaring
                    magbigay ang Proveek ng ilang User information base sa third party background
                    check o beripikasyon(verification) ng katauhan o kredensyal (identity or
                    credentials)pero tandaan na lahat ng ito ay base lamang sa mga impornasyong
                    ibinigay ng User at ang mga impormasyon na ito ay para makatulong sa ibang User
                    at hindi dapat tanawing introduksyon o rekomendasyon ng<i style='mso-bidi-font-style:
                    normal'>Proveek</i>.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Mga
                    Limitasyon at Eksklusyon (Limitations and exclusions of liability)</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang mga patakaran at kondisyong nakasaad dito
                    ay: nililimitahan o tinatanggal ang pananagutan sa kamatayan o pisikal na
                    injury na ibinunga ng kapabayaan; nililimitahan o tinatanggal ang pananagutan
                    sa panloloko (fraud) o maling representasyon nito (fraudulent representation);
                    nililimitahan ang pananagutan na pinapayagan sa ilalim ng nasasakop na batas; o
                    tinatanggalan ng pananagutan sa mga bagay na hindi sinasakop ng batas.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Sa kadahilanang ang Website na ito ay libre,
                    hindi pananagutan ng <i style='mso-bidi-font-style:normal'>Proveek</i>ang anu
                    mang pagkawala, pagkalugi o anumang klase ng damages lalo na kung ito ay hindi
                    kontrolado ng kumpanya.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi pananagutan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>sa Employers or Job Providers ang anumang pagkalugi (tulad
                    ng ng loss of or damage to profits, income, revenue, use, production,
                    anticipated savings, business, contracts, commercial opportunities o goodwill).</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi pananagutan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>ang anumang pagkawala ng anumang data, database o software.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Paglabag
                    sa Patakaran (Breaching these Terms)</span></b><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung sakali mang labagin mo ang alinman sa mga
                    nakasaad na patakaran o paghinalaan ka ng Proveek na may nilabag kang
                    patakaran, maaaring:</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(a)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>mapadalhan ka ng isa o higit pang babala</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>;</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(b)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>magkaroon lamang ng limitadong access sa
                    Website</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>;<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>(c)<span
                    style='mso-tab-count:1'>        </span>masuspinde o mabura ang account mula sa
                    Website;<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(d)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>permanentenghindi ma-access ang Website; at/o</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(e)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>makasuhan, para sa paglabag sa patakaran
                    o iba pang kadahilanan.<span style='mso-tab-count:1'>          </span><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung masuspinde ka ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>at harangin ka sa pag-access sa Website, dapat mong
                    siguruhin na hindi ka gagawa ng hakbang upang lusutan ito tulad ng paggawa o
                    paggamit ng ibang account.</span><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>9.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>Severability<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung mayroon isang probisyon sa mga patakarang
                    ito ang mapatunayan ng anumang korte na hindi naayon sa batas, ang mga
                    natitirang probisyon ay mananatili pa din ang epekto.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Gayundin, kung mayroon isang probisyon sa mga
                    patakarang ito na kung babaguhin ay magiging ayon na sa batas, ito ay
                    ikinokonsiderang bago na at mananatiling epektibo.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>10.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><span
                    style='mso-spacerun:yes'> </span>Karapatan ng mga Third party (Third party
                    rights)</span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang kontratang ito ay para sa kapakanan mo at
                    ng <i style='mso-bidi-font-style:normal'>Proveek</i>at hindi binuo para sa
                    kapakanan ng iba (third party)</span><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang paggamit saparties' rights sa ilalim ng mga
                    patakarang ito ay hindi nakadepende sa permiso ng anumang third party.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>11.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kasunduan (Entire agreement)</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang mga patakarang ito, kasama ang Privacy
                    Policy ng Proveek ang bubuo sa kabuuang kasunduan sa pagitan mo bilang User at
                    ng Proveek na may kaugnayan sa paggamit mo ng Website at siyang magiging batas
                    na sumasakop sa paggamit ng Website.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>12.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><span style='mso-spacerun:yes'> </span>Batas at
                    Hurisdiksyon (Law and Jurisdiction)</span></b><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang kontratang kinapapalooban ng mga patakarang
                    ito ay na nasa ilalim ng batas ng Pilipinas.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>13.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Detalye ng PROVEEK</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang Proveek.com ay pagmamay-ari at pinapalakad
                    ng Proveek Inc.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang<i style='mso-bidi-font-style:normal'>Proveek</i>ay
                    rehistradosa<span style='color:#EC8514'>Securities And Exchange Commission
                    (SEC) of the Philippines</span>na may rehistro (registration number) na <span
                    style='color:#EC8514'>CS201516637</span>, at rehistradong opisina sa <span
                    style='color:#EC8514'>Brgy. Paciano Rizal, Bay, Laguna.</span></span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Maaari ninyo kaming abutin sa pamamagitan ng
                    pagsulat sa address sa itaas, sa pamamagitan ng contact form na makikita sa
                    Website, sa pamamagitan ng email sa<span style='color:#EC8514'>service.proveek@gmail.com
                    </span>opagtawag sa<span style='color:#EC8514'>(+63) 926-315-8641.</span></span><a
                    name="_GoBack"></a><span style='font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>
                </div>
            </div>
        </div>
    </div>
    {{--MODA LFOR TERMS - TAGALOG -- END--}}

    {{--MODAL FOR TERMS -- START--}}
    <div class="modal modal-vcenter fade lato-text" id="TERMSMODAL" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                    <h3>Terms of Service - Proveek BETA</h3>
                    <a href="#" data-target="#TERMSMODAL_TAGALOG" data-toggle="modal">Click here for TOS Tagalog Version</a>
                </div>
                <div class="modal-body" style="padding: 4em">
                    <div class="TOS_ENGLISH">
                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>The
                        following information below is important. Please read this page carefully.
                        Effective <b style='mso-bidi-font-weight:normal'><span style='color:#EC8514'>DATE,
                        2016</span></b>, and unless otherwise revised, this Terms of Use will be used
                        as reference as to how Users may use the Proveek.comWebsite and access other
                        services offered by <span class=SpellE>Proveek</span> Inc. If you do not accept
                        these Terms or you do not meet or comply with the set provisions, you may not
                        use the Proveek.com Website or any of its services. If you have any questions,
                        please don’t hesitate to contact </span><a
                        href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Binding
                        Agreement</span></b><b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>These
                        Terms constitute a binding agreement between You and <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Site, and are
                        deemed accepted by You each time You use or access the <span class=SpellE>Proveek</span>
                        Site and its Services. You also agree to use the Proveek.com Website at your
                        own risk. These Terms will be used as basis in the case of any conflict between
                        You and any contract you have with <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span>. </span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Updates
                        will be made to these Terms of Use from time to time so we encourage You to
                        check on these updates regularly. If you continue to use the <span
                        class=SpellE>Proveek</span> Site after modifications have been made in the
                        Terms, we shall assume that You agree to the new Terms and therefore be bound
                        to the Terms.</span><span style='font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Definitions<o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Terms</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – Terms of service. These are the conditions
                        that apply in using Proveek.com<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – User. This refers to everybody using or
                        browsing the Proveek.com. This includes both Employer and Employee.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Site</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – Proveek.com which is the website<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        class=SpellE><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
                        normal'><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Proveek</span></i></b></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> – <span
                        class=SpellE>Proveek</span> Inc. is the company.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Copyright
                        and Use of <span class=SpellE>Proveek</span> Content<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.5in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.1 <u>Copyright</u></span></b><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.
                        Subject to the provisions set forth in these Terms:</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(a)</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><span style='mso-tab-count:1'>  </span></span><span class=SpellE><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>ProveekInc</span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>,
                        together with its licensors, owns and controls all the copyright and other
                        intellectual property rights in the Site and all its contents; and</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(b)</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>All the copyright and other intellectual
                        property rights in the Site and the material on it are reserved.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You are allowed to view content, download or
                        print a copy of the content for your own private, personal and non-commercial
                        use, provided you refer and keep bound to the Terms and Conditions set in this
                        page. The contents of the Site, such as but not limited to designs, text,
                        graphics, images, video, information, logos, button icons, software, audio
                        files and other Proveek.com content (collectively, &quot;Proveek.com
                        Content&quot;), are protected under copyright, trademark and other laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You may not modify, copy, reproduce, republish,
                        upload, post, transmit, or distribute, in any manner, the content on our
                        website, including text, graphics, code and/or software. You must retain all
                        copyright and other proprietary notices contained in the original content on
                        any copy you make of the content. You may not sell or modify the content or
                        reproduce, display, publicly perform, distribute, or otherwise use the content
                        in any way for any public or commercial purpose. The use of paid content on any
                        other website or in a networked computer environment for any purpose is
                        prohibited. If you violate any of the terms or conditions, your permission to
                        use the content automatically terminates and you must immediately destroy any
                        copies you have made of the content.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.2 <u>General Use of Website</u></span></b><u><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.</span></u><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>The Site
                        is intended for individuals, specifically skilled Workers, seeking employment
                        and for Employers seeking candidates for employment. You may use the Site only
                        for lawful purposes within the stated context of <span class=SpellE>Proveek's</span>
                        intended and acceptable use of the Site. </span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Use
                        ofthe Site or taking any action in any way that causes, or may cause, damage to
                        <span class=SpellE>Proveek</span> or impairment of the performance,
                        availability or accessibility of the Site is prohibited. Likewise, the use
                        oftheSite in any way that is unlawful, illegal, fraudulent or harmful, or in
                        connection with any unlawful, illegal, fraudulent or harmful purpose or
                        activity will be dealt with accordingly. You are not allowed to use theSite to
                        copy, store, host, transmit, send, use, publish or distribute any material
                        which consists of (or is linked to) any spyware, computer virus, Trojan horse,
                        worm, keystroke logger, rootkit or other malicious computer software. You must
                        ensure that all the information you supply to us through the Proveek.com
                        Website, or in relation to the Site, is true, accurate, current, complete and
                        non-misleading.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.3<u>License to Use by Users who are Job
                        Seekers</u></span></b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> hereby grants You a limited, terminable,
                        non-exclusive right to access and use the Site only for Your personal use of
                        seeking employment opportunities for yourself. <span style='color:red'>This
                        authorizes You to view and download a single copy of the material on the Site
                        solely for Your personal, noncommercial use</span>. You agree that You are
                        solely responsible for the content of any document You post to the Site and any
                        consequences arising from such posting. <span style='color:red'>Your use of the
                        Site is a privilege</span>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> reserves the right to suspend or terminate that
                        privilege for any reason at any time, in its sole discretion.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.4<u>License to Use by Users who are Job
                        Providers or Employers</u></span></b><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> hereby grants You a limited, terminable,
                        non-exclusive right to access and use the Site only for Your internal business
                        use of seeking candidates for employment.<span style='color:red'> This
                        authorizes You to view and download a single copy of the material on the Site
                        solely for Your personal use directly related to searching for and recruiting
                        job <span class=SpellE>prospects.<i style='mso-bidi-font-style:normal'><span
                        style='color:windowtext'>Proveek</span></i></span></span> also grants You a
                        limited, terminable, non-exclusive license to use the <span class=SpellE>Proveek</span>
                        Materials and Services for Your internal use only. You may not sell, transfer
                        or assign any of the Services or Your rights to any of the <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span>-provided Services to any
                        third party without the express written authorization of <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span>. You agree that You are
                        solely responsible for the content of any Document You post to the Site and any
                        consequences arising from such posting. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> reserves the right to suspend or terminate Your
                        access and use at any time if <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> determines that You breached these Terms and
                        Conditions.</span><span style='font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.5<u>Other Specific Rules Regarding Site Usage</u></span></b><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. You
                        represent, warrant and agree that you (a) are at least 18 years of age or
                        older, and (b) will not use (or plan, encourage or help others to use) the Site
                        for any purpose or in any manner that is prohibited by these Terms or by
                        applicable law. It is your responsibility to ensure that your use of
                        Proveek.com complies with these Terms and all applicable laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Registration
                        and Accounts</span></b><b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>4.1 <u>For Job Providers (Employers)</u></span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        maintain the confidentiality of your Employer account, Profile and password.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        not allow any other person or entity to use your Employer account to access the
                        Site and its Contents and Services.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        immediately if you become aware of any unauthorized use of your account.
                        Contact </span><a href="mailto:service.proveek@gmail.com"><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You
                        understand and acknowledge that if You terminate Your employer account, all
                        Your account information from Proveek.com, including saved resumes, network
                        contacts, and email mailing lists, will be marked as deleted and may be permanently
                        deleted from <span class=SpellE>Proveek's</span> databases. However, information
                        may continue to be available for some period of time because of delays in
                        propagating such deletion through <span class=SpellE>Proveek’s</span> web
                        servers.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your job
                        posting may not contain the following:<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hyperlinks,
                        other than those specifically authorized by Proveek.com;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>misleading,
                        unreadable, or &quot;hidden&quot; keywords, repeated keywords or keywords that
                        are irrelevant to the job opportunity being presented;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>the
                        names, logos or trademarks of unaffiliated companies other than those of your
                        own;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>the
                        names of colleges, cities, states, towns or countries that are unrelated to
                        Your posting;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>more
                        than one job or job description, more than one location, or more than one job
                        category, unless the specific job so allows;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>inaccurate,
                        false, or misleading information;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>material
                        or links to material that exploits people in a sexual, violent or other manner,
                        or solicits personal information from anyone under 18; and<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materials
                        or links to material that leads to activities prohibited by law such as human
                        trafficking, illegal drug trade, etc.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your
                        user ID must not be liable to mislead <span class=SpellE>Proveek</span>, Job
                        Seekers, and other users of the Site; you must not use your account or user ID
                        for or in connection with the impersonation of any person. <o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You must keep your password confidential</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify us immediately if you become aware of any disclosure of your password. Contact
                        </span><a href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You are
                        responsible for any activity on our website arising from any failure to keep
                        your password confidential, and may be held liable for any losses arising from
                        such failure.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        ensure that all personal information that <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Worker have
                        access to are accurate, complete, up to date and not misleading. You may not
                        impersonate another person, living or dead, or company you don't have any
                        connection to.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(k)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You may deactivate your account on Proveek.com using your account
                        control panel on your profile.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>4.2 <u>For Job Seekers (Workers)</u></span><o:p></o:p></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        be 18 years old and above tobe eligible to create an account on the Site.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You may
                        register for an account with Proveek.com by completing and submitting the
                        account registration form, and clicking on the verification link in the email
                        that will be sent to you. <span style='color:red'>Registration for Workersis
                        FREEof charge</span>.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        not allow any other person to use your account to access the Website.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify <span class=SpellE>Proveek</span> immediately if you become aware of any
                        unauthorized use of your account. Contact </span><a
                        href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your
                        user ID must not be liable to mislead <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span>, Job Providers, and other users of the Site; you
                        must not use your account or user ID for or in connection with the
                        impersonation of any person. <o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You must keep your password confidential</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify us immediately if you become aware of any disclosure of your password.
                        Contact </span><a href="mailto:service.proveek@gmail.com"><span
                        style='font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You are
                        responsible for any activity on our website arising due to any failure to keep
                        your password confidential, and may be held liable for any losses arising due
                        to such failure.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        ensure that all personal information that <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Employer have
                        access to are accurate, complete, up to date and not misleading. You may not
                        impersonate another person, living or dead.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You may deactivate your account on Proveek.com using your account
                        control panel on your profile.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Payment
                        of Fees (For Job Providers or Employers)<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>All fees
                        owed to Proveek.com must be paid within the specified payment terms from the
                        date of the invoice. Late payment may be charged an interest of <span
                        style='color:red'>8% per annum</span>. <span style='color:red'>All prices
                        quoted are exclusive of any applicable taxes unless specifically noted
                        otherwise.</span></span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>If at any time during the course of this Agreement you should
                        terminate Your Account in which these Terms have been incorporated by
                        reference, then <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        reserves the right to receive all payments from You for the Services You used
                        up to termination and for fifty percent (50%) of the remaining unused portion
                        of the Service Agreement.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial;color:red'><o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial;color:red'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limited
                        Warranties<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek.com does not warrant the following: the
                        completeness or accuracy of the information published on the Site;that the
                        material on the Site is up to date; orthat the Site or any service will remain
                        available in a certain period of time.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>
                        reserves the right to discontinue or alter any or all of theSite’s services,
                        and to stop publishing the Site at any time in its discretion without notice or
                        explanation, and save to the extent expressly provided otherwise in these
                        Terms. You will not be entitled to any compensation or other payment upon the
                        discontinuance or alteration of any services, or if we stop publishing the
                        Site.</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> does
                        not offer any form of insurance, or other Employer or Worker protection.</span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin'> does not
                        ensure the completeness or accuracy of Users information since User
                        identification on the internet is difficult. We, however, may provide some User
                        information based on the conducted third party background check or verification
                        of identity or credentials though such information are solely based on the
                        details that the User submitsand these data were only provided solely for the convenience
                        of Users and not in any way an introduction, endorsement or recommendation by <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>.<o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limitations
                        and exclusions of liability</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>These terms and conditions will:limit or
                        exclude any liability for death or personal injury resulting from
                        negligence;limit or exclude any liability for fraud or fraudulent
                        misrepresentation;limit any liabilities in any way that is not permitted under
                        applicable law; orexclude any liabilities that may not be excluded under
                        applicable law.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>To the extent that the Site and its contents
                        are provided free of charge, <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> will not be liable for any loss or damage of any
                        nature. <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        will not be liable in any case of losses arising out of any event or events
                        beyond reasonable control.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> will
                        not be liable to Employers or Job Providers regarding any business losses,
                        including (without limitation to) loss of or damage to profits, income,
                        revenue, use, production, anticipated savings, business, contracts, commercial
                        opportunities or goodwill.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> will
                        not be liable in any loss or corruption of any data, database or software.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Breaching
                        these Terms</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Without prejudice to <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i>’s</span> other rights under
                        theseTerms, if You breach these Terms in any way, or if <span class=SpellE>Proveek</span>
                        reasonably suspect that you have breached these Terms in any way, You may be: </span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(a)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>sent one or more formal warnings;</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(b)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>allowed limited access to the Site;<o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>(c)<span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>suspended or your account deleted from the Site;</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(c)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>permanently prohibited from accessing the Site;
                        and/or</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(d)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>filed a legal action against You, whether for
                        breach of contract or otherwise.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>       </span><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>When<i
                        style='mso-bidi-font-style:normal'>Proveek</i></span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>
                        suspends or prohibits or blocks Your access to the Site, You must not take any
                        action to evade such suspension or prohibition or blocking (including without
                        limitation creating and/or using a different account).</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>9.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>Severability<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>If a provision under these Terms is determined
                        by any court or other competent authority to be unlawful and/or unenforceable,
                        the other remaining provisions will continue in effect.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>If any unlawful and/or unenforceable provision
                        under these Terms would be considered lawful or enforceable if part of it were
                        deleted, that part will be deemed to be deleted, and the rest of the provision
                        will continue in effect. </span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>10.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Third party rights</span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>A contract under these Terms is for You and <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i>’s</span>
                        benefit, and is not intended to benefit or be enforceable by any third party.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>The exercise of the parties' rights under these
                        Terms is not subject to the consent of any third party.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>11.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Entire agreement</span></b><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>These Terms, together with <span class=SpellE>Proveek.com’s</span>
                        Privacy Policy, shall constitute the entire agreement between You and <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span> in relation
                        to your use of theSite and shall supersede all previous agreements between You
                        and <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        in relation to your use of theSite.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>12.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Law and jurisdiction</span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>A contract under these Terms shall be governed
                        by and construed in accordance with the Philippine laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>13.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><span style='mso-spacerun:yes'> </span>PROVEEK
                        Details</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek.com is owned and operated by <span
                        class=SpellE>Proveek</span> Inc.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Inc</span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. is registered in the <span style='color:#EC8514'>Securities
                        And Exchange Commission (SEC) of the Philippines</span> under registration
                        number <span style='color:#EC8514'>CS201516637</span>, with registered office
                        at <span class=SpellE><span style='color:#EC8514'>Brgy</span></span><span
                        style='color:#EC8514'>. <span class=SpellE>Paciano</span> Rizal, Bay, Laguna.</span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You can contact us by writing to the business
                        address given above, by using our website contact form, by email to <span
                        style='color:#EC8514'>service.proveek@gmail.com </span>or by telephone on <a
                        name="_GoBack"><span style='color:#EC8514'>(+63) 926-315-8641.</span></a></span><span
                        style='mso-bookmark:_GoBack'></span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--MODAL FOR TERMS -- END--}}

</body>

</html>
