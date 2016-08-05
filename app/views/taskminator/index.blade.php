@extends('layouts.usermain')

@section('title')
    Proveek | Dashboard
@stop

@section('head-content')
<style>
    #progressbar {
        background-color: #f6f6f6;
        border-radius: 13px; /* (height of inner div) / 2 + padding */
        padding: 3px;
        border:1px solid #2980b9;
        display:flex;
    }
        
    #progressbar > #prog-meter-req {
        background-color: #2980b9;
        animation-name: reqProgress;
        animation-duration: 3s;
        height: 20px;
        border-radius: 10px;
        max-width: 100%;
        width:{{ Auth::user()->total_profile_progress }}%;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    /*
    #progressbar > #prog-meter-opt {
        background-color: orange;
        animation-name: optProgress;
        animation-duration: 3s;
        height: 20px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        max-width: 30%;
        width:{{ $PROFILE_PROG['OPTIONAL_PROGRESS'] }}%;
    }
    */

    @keyframes reqProgress {
    from {width:0%;}
    to {width:{{Auth::user()->total_profile_progress}}%;}

    }

    {{--@keyframes optProgress {--}}
    {{--from {width:0%;}--}}
    {{--to {width:{{ $PROFILE_PROG['OPTIONAL_PROGRESS'] }}%;}--}}
    {{--}--}}


    body{background-color:#E9EAED;}
    .accordion-toggle
    {
        text-decoration: none !important; 
    }

    h5 {
        margin: 0;
    }


    .link-btn
    {
        border:1px solid #2980b9;
        border-radius: 4px;
        background-color: white;
        color: #2980b9 !important;
    }

    .link-btn:hover
    {
        background-color:#2980b9;
        color:white !important;
    }
    .hrLine
    {
        background:#ccc;
        max-width:100%;
        border:none;
        height:1px;
        max-height:1px;
    }
    a.clickHere {
        background: transparent;
        border: 2px solid;
        border-radius: 5px;
        padding: 5px 15px;
        font-size: 15px !important;
        text-transform: uppercase;
    }
    a.clickHere:hover {
        background-color: #2980b9;
        border: 2px solid #226ea0;
        transition : 0.3s;
        color:white;
        text-decoration: none;
    }
    a.viewSal{
        background-color: #2980b9;
        border: 2px solid #226ea0;
        transition: 0.3s;
        color: white; 
        padding: 5px;      
        text-transform: uppercase; 
        font-size: 14px;
    }
    a.viewSal:hover{
        background: transparent;
        color: #2980b9;
        text-decoration: none;
    }
    .thumbnail {
        border: 0px solid #ddd !important;
        margin-bottom: 0;
        padding:15px;
        width: 120px;
        height: 120px;
        margin:auto;
    }
    .thumbnail img {
        border-radius: 60px;
        border: 1px solid #ddd;
    }
    @media (max-width: 768px) {
        .padded {
            padding: 0px 15px 15px;
        }
        .col-lg-6.lato-text.col-xs-12.id2 {
            margin-top: 2px !important;
            background: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

    }
    @media (max-width: 320px) {
        a.clickHere {
            font-size: 12px !important;
        }
        .padded {
            font-size: 19pt !important;
        }
    }
    li {
        font-size: 17px;
        line-height: 1.7em;
    }
    p.content{
        margin-bottom: 10px !important;
    }
</style>

@stop


@section('content')
<section>
    <div class="container main-content lato-text">
        <!-- Statistics -->
        @if(Session::has('error'))
            <center><h4> <i class="fa fa-warning" style="color: red;"></i> {{ Session::get('error') }}</h4></center>
        @endif
        <div class="row">
<!-- PROFILE PIC / INFO  -->
            <div class="col-lg-4"> 
                <div class="widget-container" style="display:flex; min-height:120px; display:block !important;">
                    <div class="col-md-4" style="">
                        <div class="thumbnail">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                            @else
                                <a href="/editProfile"><img src="/images/default_profile_pic.png" class="portrait"/></a><br>
                            @endif
                        </div>                            
                    </div>
                    <div class="col-md-8 padded">
                        <div class="heading" style="padding: 10px 0; text-align:center;">
                            <a href="/editProfile" style="font-weight:bold; font-size:14pt;">{{ Auth::user()->fullName }}</a><br>
                        </div>
                        <span><b>Employment Status:</b> Not Hired</span><br>
                        <span><b>Last Login:</b> 08/02/16</span>
                    </div>
                    <!-- <div class="col-lg-12" style="padding-left:24px;">
                        <a href="/editProfile">Edit Profile</a>
                    </div> -->
                </div>
                <br>
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <!-- <input name="searchWord" id="searchWord" type="text" class="form-control input-trans" placeholder="Search for workers" required> -->
                                        <!-- <div class="col-lg-12">
                                            @if($PROFILE_PROG['TOTAL_PROGRESS'] >= 50)
                                               <a href="/jobSearch:NO_KW_INPT:ALL:ALL:ALL:ALL:ALL:DESC" class="btn btn-default btn-block" style="border-radius: 0.3em;">
                                                <i class="fa fa-search"></i> Click here to search for jobs
                                               </a>
                                                
                                                <button name="searchBtn" id="searchBtn" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">
                                                    @if (Session::has('err_search'))
                                                        <i style="color: red" class="fa fa-warning"></i> {{ Session::get('err_search')  }}
                                                    @else
                                                        Click here to search for jobs
                                                    @endif
                                                </button>
                                                
                                            @else
                                                <button disabled="true" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">Please complete atleast 50% of profile</button>
                                            @endif
                                        </div> -->
                                        <!-- <div class="btn-group" data-toggle="buttons" style="width:100%;">
                                            <input value="<?php if(@$searchWord != 0){ echo($searchWord); } ?>" type="text" name="searchWord" id="searchWord" class="form-control" placeholder="Enter keyword" />
                                        </div> -->
                                <div class="padded" style="color:#2980b9; font-size:20pt;">
{{--                            <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ $PROFILE_PROG['TOTAL_PROGRESS'] }}%--}}
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ Auth::user()->total_profile_progress }}%

                                <div class="padded text-center" style="padding:10px 0 0; color:#2980b9; font-size:18pt;">
                                    <div id="progressbar">
                                        <div id="prog-meter-req"></div>
                                        <div id="prog-meter-opt"></div>
                                    </div>
                                    <div style="text-align:left; font-size:12pt; display:flex;">
                                        <div style="width:20%;">0%</div>
                                        <div style="width:20%;">20%</div>
                                        <div style="width:20%; text-align:center;">50%</div>
                                        <div style="width:20%; text-align:right;">80%</div>
                                        <div style="width:20%; text-align:right;">100%</div>
                                    </div>
                                    <span style="font-size:10pt;"></span>
                                </div>

                                @if(Auth::user()->total_profile_progress < 50)
                                    <p style="color: #000000; margin-top: 5px;">
                                        <i style="color: red" class="fa fa-warning"></i> <b>You can start applying for jobs when you complete your profile above 50%.</b><br><br>
                                        <a class="clickHere" href="/editProfile"> Click here to edit your profile </a>
                                    </p>
                                @endif
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--GEN INFO-->

                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Personal Information
                                        </div>     
                                        <div class="panel-body">
                                            <span><b>Address:</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</span><br>
                                            <span><b>Birthdate:</b> 01/01/01</span><br>
                                            <span><b>Gender:</b> Male</span><br>
                                            <span><b>Marital Status:</b> Single</span><br>
                                            <span><b>Age:</b> 42</span><br>
                                            <span><b>Account Status:</b> Activated</span><br>
                                            <span><b>Account Created:</b> 01/01/01</span><br>
                                        </div>  
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information
                                        </div>     
                                        <div class="panel-body">
                                             <span><b>Email:</b> <a href="mailto:taskminator0@taskminator.com" target="_top">taskminator0@taskminator.com</a></span><br>
                                             <span><b>Facebook:</b> <a href="facebook.com/januarystays" target="_blank">facebook.com/januarystays</a></span><br>
                                             <span><b>Linkedin:</b> <a href="linkedin.com/sample" target="_blank">linkedin.com/sample</a></span><br>
                                             <span><b>Mobile:</b> 639276274641</span><br>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CERT -->
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="fa fa-certificate" style="font-size:14pt; color:#2980b9"></i>&nbsp Certification
                                        </div> 
                                        <div class="panel-body">
                                            <span>N/A</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ENF PROFILE PIC / INFO -->
            <!-- MAIN CONTENT STATISTICS / AVAILABLE JOBS -->
            <div class="col-lg-8">
                <!-- END OF PROFILE  COMPLETENESS METER -->
                <div class="col-lg-12 no-padding">
                    <div class="widget-container stats-container" style="display:block !important;">
                        <div class="col-lg-6 lato-text col-xs-12 id1">
                            {{--<a href="/tskmntr_taskBids" style="text-decoration:none;">--}}
                            <a href="/WRKR_APPLCTNS" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-gavel"></i>
                                    {{ $applicationsCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Applications
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 lato-text col-xs-12 id2">
                            {{--<a href="/tskmntr_taskOffers" style="text-decoration:none;">--}}
                            <a href="/WRKR_INVTS" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-globe"></i>
                                    {{ $invitesCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Invites
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                        @if(Auth::user()->total_profile_progress >= 50)
                            @if($jobs->count() != 0)
                                <div class="col-lg-12 padded" style="padding-top: 25px;">
                                    <div class="col-lg-5"><hr class="hrLine"></div>
                                    <div class="col-lg-2" style="margin-top:10px;"><p style="font-size:10pt;">Available Jobs</p></div>
                                    <div class="col-lg-5"><hr class="hrLine"></div>
                                </div>
                                <br><br><br><br>
                                @foreach($jobs as $job)
                                    <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style="word-wrap: break-word; padding-left:10px; padding-right:10px; min-height: 50px;">
                                        <div style="display:flex;padding-bottom:5px">
                                            <span style="padding:0;margin:0; flex:1">
                                                <img src="{{ $job->profilePic }}" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                            </span>
                                            <div style="flex:11; padding-left: 5px;">
                                            <a href="/jbdtls={{$job->job_id}}" style="text-decoration:none;">
                                                <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                                    {{ $job->title}} by {{ $job->fullName }}
                                                </h3>
                                                <div class="row" style="color:#95A5A6;">
                                                    <div class="col-md-4">
                                                        <span style="padding:0;margin:0;">
                                                            <i class="fa fa-briefcase"></i>
                                                            @if($job->hiring_type == 'LT6MOS')
                                                                Less than 6 months
                                                            @else
                                                                Greater than 6 months
                                                            @endif
                                                        </span><br>
                                                        <span class="text-right" style="padding:0;margin:0;">
                                                            @if($job->expired)
                                                                <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                                            @else
                                                                <i class="fa fa-clock-o"></i> Expires at {{ date('m/d/y', strtotime($job->expires_at)) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                                        <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <center><i>No jobs available.</i></center>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
                -->
            </div>

            <!--PREFERED JOB -->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="widget-content">
                        <div class="panel-body" style="color:#2980b9; font-size:20pt;">
                            <i class="fa fa-search" aria-hidden="true"></i> Preferred Job
                        </div>
                        <div class="panel-body" style="padding: 0 15px 15px;">
                            <div class="col-md-12 no-padding">
                                @if($jobs->count() > 0)
                                    @foreach($jobs as $job)
                                        <div class="col-md-4 padded">
                                            <b class="title">{{$job->title}}</b>
                                            <p class="content">
                                                <span style="padding:0;margin:0;">
                                                    <i class="fa fa-user"></i> {{$job->fullName}}
                                                </span><br/>
                                                <span style="padding:0;margin:0;">
                                                    <i class="fa fa-briefcase"></i>
                                                    @if($job->hiring_type == 'LT6MOS')
                                                        Less than 6 months
                                                    @else
                                                        Greater than 6 months
                                                    @endif
                                                </span><br>
                                                <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                                @if($job->salary)
                                                    <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                                @endif
                                            </p>
                                            <a href="/jbdtls={{$job->job_id}}" class="viewSal">View full details</a>
                                        </div>
                                    @endforeach
                                @else
                                    <center><i>No jobs applicable to your skills!</i></center>
                                @endif
                                <!--
                                @for($i=0; $i<3; $i++)
                                    <div class="col-md-4 padded">
                                        <b class="title">Praesent volutpat dapibus mauris nec blandit.</b>
                                        <p class="content">Vivamus metus nulla, tempor vel varius fermentum, molestie nec enim. Suspendisse eu ultricies lorem. </p>
                                        <a href="#" class="viewSal">View full details</a>
                                    </div>
                                @endfor
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="widget-content">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                            <i class="fa fa-graduation-cap" style="font-size:14pt; color:#2980b9"></i>&nbsp Educational Background
                        </div>                        
                        <div class="panel-body" style="padding: 0 15px 15px;">
                            <div class="col-md-12">
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experiences/ SKILLS -->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="col-md-6">
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-lightbulb-o" style="font-size:14pt; color:#2980b9"></i>&nbsp Experience
                            </div>                        
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-star" style="font-size:14pt; color:#2980b9"></i>&nbsp Skills
                            </div>                        
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span> 
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div style="clear:both;"></div>             

                </div>
            </div>

            <!-- Additional Info-->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="widget-content">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                            <i class="fa fa-file" style="font-size:14pt; color:#2980b9"></i>&nbsp Supporting Documents
                        </div>                        
                        <div class="panel-body" style="padding: 0 15px 15px;">
                            <div class="col-md-12">
                                @for($i=0; $i<=3; $i++)
                                    <div class="col-md-3">
                                        <img style="width:100%;" src="../images/sample_doc.jpg">
                                        <p style="text-align:center;">Sample Docx</p>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
<!-- END MAIN CONTENT -->
        </div>
    </div>
</section>

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
                                    <li><a href="#page-top" class="page-scroll">Home</a></li>
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
@stop

@section('body-scripts')
<script>
    $(document).ready(function(){
        $('#uploadProfilePicForm').submit(function(){
            $('#uploadBtn').empty().append('Uploading..');

        });

        

        $('#searchBtn').click(function(){
                var workingTime = 'PTIME',
                    searchField = 'name',
                    searchCity  = '175301',
                    searchWord  = '0',
                    rateRange   = '0',
                    rangeValue  = '0';

                if($('#searchWord').val() != ''){
                    searchWord = $('#searchWord').val();
                }

                location.href = '/tskmntr/doTaskSearch='+workingTime+'='+searchField+'='+searchCity+'='+searchWord+'='+rateRange+'='+rangeValue;
            });

        
    })
</script>
@stop