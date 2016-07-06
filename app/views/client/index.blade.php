@extends('layouts.usermain')

@section('title')
    Proveek | Dashboard
@stop

@section('head-content')
{{ $calculated_prog = $intProgress + $reqProgress}}
{{ $total_prog = number_format($calculated_prog + $optProgress) }}
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
            width:{{ $calculated_prog }}%;
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
            width:{{ $optProgress }}%;
        }

        @keyframes reqProgress {
        from {width:0%;}
        to {width:{{ $calculated_prog }}%;}
        }

        @keyframes optProgress {
        from {width:0%;}
        to {width:{{ $optProgress }}%;}
        }

        body{background-color:#E9EAED;}
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
    <script>
        $(document).ready(function() {
            $('#SRCHBTN_SKILL').click(function(){
                var CTGRY = "N",
                    SKLL = "N";

                if($('#taskitems').val() != ''){
                    SKLL = $('#taskitems').val()
                }

                if($('#taskcategory').val() != ''){
                    CTGRY = $('#taskcategory').val()
                }

                location.href="/SRCHWRKRSKLL="+CTGRY+'='+SKLL;
            })


            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'GET',
                    url     :   '/SKILLCATCHAIN='+$('#taskcategory').val(),
//                    data    :   $('#doEditSkillInfo').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    },error :   function(){
                        alert('ERR500 : Please check network connectivity');
                    }
                })
            });

            $('.remove-skill').click(function(){
                if(confirm('Do you really want to remove this skill?')){
                    location.href = $(this).attr('data-href');
                }
            });
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
        <!-- PROFILE PIC / INFO  -->
            <div class="col-lg-4"> 
                <div class="widget-container" style="display: flex; min-height:125px; display:block !important;">
                    <div class="col-lg-3 no-padding" style="">
                        <div class="thumbnail">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                            @else
                                <a href="/editProfile"><img src="/images/default_profile_pic.png" class="portrait"/></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-9 padded">
                        <div class="heading">
                            <a href="/editProfile" style="font-size:14pt;">{{ Auth::user()->companyName }}</a><br>
                        </div>
                    </div>
                </div>

                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                        @if(Auth::user()->status == 'PRE_ACTIVATED')
                            {{--<div class="heading">--}}
                                {{--<i class="icon-signal"></i>Your Profile--}}
                            {{--</div>--}}
                            {{--<div style="margin: 0 15px;">--}}
                                <b><i class="fa fa-warning" style="color: red;"></i>
                                Your profile is being reviewed by our staff.<br/>
                                After your profile has been activated, you can start looking for tasks!<br/>
                                This could take 24 hours or less.</b>
                            {{--</div>--}}
                        @else
                            @if($total_prog >= 50)
                                <!--
                                OLD TASK/JOB MODULE LINKS
                                <a style="border-radius: 0.3em;" href="/createTask" class="btn btn-success btn-block btn-lg">Create Task</a>
                                <a style="border-radius: 0.3em;" href="/tasks" class="btn btn-primary btn-block">Tasks</a>
                                <a style="border-radius: 0.3em;" href="/tskmntrSearch" class="btn btn-primary btn-block">Search for Taskminators</a>
                                -->

                                <a style="border-radius: 0.3em;" href="/createJob" class="btn btn-success btn-block btn-lg">Create Job</a>
                                <a style="border-radius: 0.3em;" href="/jobs" class="btn btn-primary btn-block">Job</a>
                            @endif
                            <div class="row" style="font-size: 1.2em; font-weight: bolder; text-align: center;">
                                <div class="col-md-6 padded">
                                    <i class="fa fa-diamond" style="color: #2980B9;"></i>&nbsp;
                                    {{ Auth::user()->points }}
                                </div>
                                <div class="col-md-6 padded">
                                    <i class="fa fa-user" style="color: #2980B9;"></i>&nbsp;
                                    {{ Auth::user()->accountType }}
                                </div>
                            </div>
                        @endif
                </div>

                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                    <div class="form-group">
                        <select name="taskcategory" id="taskcategory" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->categorycode }}">{{ $category->categoryname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="taskitems" id="taskitems" class="form-control">
                            @foreach($categorySkills as $skill)
                                <option value="{{ $skill->itemcode }}">{{ $skill->itemname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary btn-block" id="SRCHBTN_SKILL"><i class="fa fa-search"></i> Search for workers</button>
                </div>
            </div>
<!-- ENF PROFILE PIC / INFO -->

            <div class="col-md-8">
                <div class="widget-container weather">
                    <div class="widget-content">
                        <div class="padded text-center" style="min-height:30px; text-align:left; border-bottom:1px solid #e6e6e6; color:#2980b9; font-size:18pt;">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ $total_prog }}% | {{ $freeDuration }}
                            @if($total_prog < 50)
                                <p style="color: #000000;">
                                    <i style="color: red" class="fa fa-warning"></i> <b>You can start posting jobs when you complete your profile above 50%. Click <a href="/editProfile">here</a> to edit your profile</b>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="padded text-center" style="border-bottom:1px solid #e6e6e6;color:#2980b9; font-size:18pt;">
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
                            {{--<span style="font-size:10pt;">Please complete your profile to be able to apply for jobs.</span>--}}
                        </div>
                    </div>
                    <div class="widget-content padded">

                    </div>
                </div>
                <br/>
                {{--<div class="col-md-2 col-md-offset-5"><p>My Jobs</p></div>--}}

                @if($tasks->count() != 0)
                    @foreach($tasks as $task)
                        <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".2s" data-wow-offset="0" data-wow-delay="0" style="padding-left:10px; padding-right:10px; min-height: 50px; margin-bottom: 1em;">
                              <a href="/taskDetails/{{$task->id}}"><h3>{{ $task->name }}</h3></a>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </div>
</section>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#uploadProfilePicForm').submit(function(){
                $('#uploadBtn').empty().append('Uploading..');
            });
        })
    </script>
@stop