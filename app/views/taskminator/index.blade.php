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
        max-width: 70%;
        width:{{ $PROFILE_PROG['CALCULATED_PROG'] }}%;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

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

    @keyframes reqProgress {
    from {width:0%;}
    to {width:{{ $PROFILE_PROG['CALCULATED_PROG'] }}%;}
    }

    @keyframes optProgress {
    from {width:0%;}
    to {width:{{ $PROFILE_PROG['OPTIONAL_PROGRESS'] }}%;}
    }

    body{background-color:#E9EAED;}
    .accordion-toggle
    {
        text-decoration: none !important; 
    }

    h5 {
        margin: 0;
    }
    .thumbnail {
        border: 1px solid #BDC3C7;
        border-radius: 0.3em;
        cursor: pointer;
        position: relative;
        width: 80px;
        height: 80px;
        overflow: hidden;
        /*float: left;*/
        margin-left: 20px;
        margin-top: 15px;
        margin-right: 1em;
        margin-bottom: 0em;
        /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
        /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
        /*box-shadow: 0 8px 6px -6px black;*/
    }

    .thumbnail img {
        display: inline;
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        /*-webkit-transform: translate(-50%,-50%);*/
        /*-ms-transform: translate(-50%,-50%);*/
        transform: translate(-50%,-50%);
    }
    .thumbnail img.portrait {
        width: 100%;
        height: auto;
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
                <div class="widget-container" style="display:flex; min-height:125px; display:block !important;">
                    <div class="col-lg-3 no-padding" style="">
                        <div class="thumbnail">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                            @else
                                <a href="/editProfile"><img src="/images/default_profile_pic.png" class="portrait"/></a><br>
                            @endif
                        </div>
                            
                    </div>
                    <div class="col-lg-9 padded">
                        <div class="heading">
                            <a href="/editProfile" style="font-weight:bold; font-size:14pt;">{{ Auth::user()->fullName }}</a><br>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding-left:24px;">
                        <a href="/editProfile">Edit Profile</a>
                    </div>
                </div>
                <br>
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <!-- <input name="searchWord" id="searchWord" type="text" class="form-control input-trans" placeholder="Search for workers" required> -->
                                        <div class="col-lg-12">
                                            @if($PROFILE_PROG['TOTAL_PROGRESS'] >= 50)
                                               <a href="/jobSearch:NO_KW_INPT:ALL:ALL:ALL:ALL:ALL:DESC" class="btn btn-default btn-block" style="border-radius: 0.3em;">
                                                <i class="fa fa-search"></i> Click here to search for jobs
                                               </a>
                                                <!--
                                                <button name="searchBtn" id="searchBtn" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">
                                                    @if (Session::has('err_search'))
                                                        <i style="color: red" class="fa fa-warning"></i> {{ Session::get('err_search')  }}
                                                    @else
                                                        Click here to search for jobs
                                                    @endif
                                                </button>
                                                -->
                                            @else
                                                <button disabled="true" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">Please complete atleast 50% of profile</button>
                                            @endif
                                        </div>
                                        <!-- <div class="btn-group" data-toggle="buttons" style="width:100%;">
                                            <input value="<?php if(@$searchWord != 0){ echo($searchWord); } ?>" type="text" name="searchWord" id="searchWord" class="form-control" placeholder="Enter keyword" />
                                        </div> -->
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
                <div class="col-lg-12">
                    <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                        <div class="widget-content">
                            <div class="padded" style="color:#2980b9; font-size:18pt;">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ $PROFILE_PROG['TOTAL_PROGRESS'] }}%
                                @if($PROFILE_PROG['TOTAL_PROGRESS'] < 50)
                                    <p style="color: #000000;">
                                        <i style="color: red" class="fa fa-warning"></i> <b>You can start applying for jobs when you complete your profile above 50%. Click <a href="/editProfile">here</a> to edit your profile</b>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PROFILE OOMPLETENESS METER -->
                <div class="col-lg-12">
                    <div class="widget-container" style="min-height:30px; border-bottom:1px solid #e6e6e6">
                        <div class="widget-content">
                            <div class="padded text-center" style="color:#2980b9; font-size:18pt;">
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
                        </div>
                    </div>
                </div>
                <!-- END OF PROFILE  COMPLETENESS METER -->
                <div class="col-lg-12">
                    <div class="widget-container stats-container" style="display:block !important;">
                        <div class="col-lg-6 lato-text">
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
                        <div class="col-lg-6 lato-text">
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                        <!-- NEW JOBS MODULE LOOP -- START by Jan Sarmiento -->
                        @if($PROFILE_PROG['TOTAL_PROGRESS'] >= 50)
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
                                                            <i class="fa fa-clock-o"></i>Ad Expires at {{ date('m/d/y', strtotime($job->expires_at)) }}
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
                        <!-- NEW JOBS MODULE LOOP -- END by Jan Sarmiento -->
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