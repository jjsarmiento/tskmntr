@extends('layouts.usermain')

@section('title')
    {{$job->title}}
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }

        /*.hrLine*/
        /*{*/
            /*background:none;*/
            /*border:0;*/
            /*border-bottom:1px solid #2980b9;*/
            /*min-width: 100%;*/
            /*height:1px;*/
        /*}*/

        .applicant-container {
            min-height: 1em;
            border-bottom:
            #ECF0F1 1px solid;
            /*transition: 0.3s;*/
        }

        .applicant-container:hover {
            background-color: #F0FFFF;
        }

        .block-update-card {
                padding: 0.8em;
              height: 100%;
              border: 1px #FFFFFF solid;
              /*width: 380px;*/
              float: left;
              /*margin-left: 10px;*/
              /*margin-top: 0;*/
              /*padding: 0;*/
              box-shadow: 1px 1px 8px #d8d8d8;
              background-color: #FFFFFF;
            }
            .block-update-card .h-status {
              width: 100%;
              height: 7px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .v-status {
              width: 5px;
              height: 80px;
              float: left;
              margin-right: 5px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .update-card-MDimentions {
              width: 80px;
              height: 80px;
            }
            .block-update-card .update-card-body {
              margin-top: 10px;
              margin-left: 5px;
            }
            .block-update-card .update-card-body h4 {
              color: #737373;
              font-weight: bold;
              /*font-size: 13px;*/
            }
            .block-update-card .update-card-body p {
              color: #737373;
              font-size: 12px;
            }
            .block-update-card .card-action-pellet {
              padding: 5px;
            }
            .block-update-card .card-action-pellet div {
              margin-right: 10px;
              font-size: 15px;
              cursor: pointer;
              color: #dddddd;
            }
            .block-update-card .card-action-pellet div:hover {
              color: #999999;
            }
            .block-update-card .card-bottom-status {
              color: #a9a9aa;
              font-weight: bold;
              font-size: 14px;
              border-top: #e0e0e0 1px solid;
              padding-top: 5px;
              margin: 0px;
            }
            .block-update-card .card-bottom-status:hover {
              background-color: #dd4b39;
              color: #FFFFFF;
              cursor: pointer;
            }

            /*
            Creating a block for social media buttons
            */
            .card-body-social {
              font-size: 30px;
              margin-top: 10px;
            }
            .card-body-social .git {
              color: black;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .twitter {
              color: #19C4FF;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .google-plus {
              color: #DD4B39;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .facebook {
              color: #49649F;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .linkedin {
              color: #007BB6;
              cursor: pointer;
              margin-left: 10px;
            }
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-8">
            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                <a href="/editJob={{$job->id}}" type="button" class="close" style="opacity: 100;">
                    <i class="fa fa-edit" style="color: #27AE60;"></i>
                </a>
                <h3 style="margin: 0;">{{$job->title}}</h3>
                <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                <br/>
                <br/>
                <div class="row" style="text-align: left">
                    <div class="col-md-7">
                        <div class="col-md-4">Duration</div>
                        <div class="col-md-8">
                            @if($job->hiring_type == 'LT6MOS')
                                Less than 6 months
                            @else
                                Greater than 6 months
                            @endif
                        </div>
                        <br/><br/>
                        <div class="col-md-4">
                            Skill Category
                        </div>
                        <div class="col-md-8">
                            {{ $job->categoryname }}
                        </div>
                        <br/><br/>
                        <div class="col-md-4">
                            Skill
                        </div>
                        <div class="col-md-8">
                            {{ $job->itemname }}
                        </div>
                        <br/><br/><br/>
                        <div class="col-md-4">
                            Location
                        </div>
                        <div class="col-md-8">
                            {{ $job->cityname }}, {{ $job->bgyname }}<br/>
                            {{ $job->regname }}
                        </div>
                        <br/><br/><br/>
                        <div class="col-md-4">Salary</div>
                        <div class="col-md-8">P{{ $job->salary }}</div>
                        <br/><br/><br/>
                    </div>
                    <div class="col-md-5">
                        {{ $job->description }}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 padded" style=" margin-bottom: 0; padding-bottom: 0;">
                <div class="col-lg-4"><hr class="hrLine"></div>
                <div class="col-lg-4" style="padding-top: 10px; text-align: center"><p style="font-size:10pt;">Recommended Workers</p></div>
                <div class="col-lg-4"><hr class="hrLine"></div>
            </div>
            <div class="row">
                @if($workers->count() != 0)
                    @foreach($workers as $w)
                        <div class="col-md-4 padded" style="">
                            <div class="media block-update-card">
                                <a class="pull-left" href="#">
                                    @if($w->profilePic != "")
                                        <img class="media-object update-card-MDimentions" src="{{$w->profilePic}}">
                                    @else
                                        <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                    @endif
                                </a>
                                <div class="media-body update-card-body">
                                    <a href="#" style="font-weight: bolder;">
                                        {{ $w->fullName }}
                                    </a>
                                    <p>{{ $w->regname }}, {{ $w->cityname }}</p>
                                </div>
                                <br/>
                                @if($w->inviteID)
                                    <a href="/SNDINVT:{{$w->id}}:{{$job->id}}" class="btn btn-block btn-xs btn-success" style="border-radius: 0.3em;"><i class="fa fa-envelope"></i> Invite Sent</a>
                                @else
                                    <a href="/SNDINVT:{{$w->id}}:{{$job->id}}" class="btn btn-block btn-xs btn-primary" style="border-radius: 0.3em;"><i class="fa fa-envelope"></i> Send Invite</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-4 padded text-center"><br/>
                        <a href="/WRKRSRCH:{{$job->id}}:{{$job->categorycode}}:{{$job->itemcode}}:{{$job->regcode}}:{{$job->citycode}}:{{$job->bgycode}}">
                            <i class="fa fa-search" style="font-size: 3em;"></i><br/>
                            Look for more workers..
                        </a>
                    </div>
                @else
                    <div class="padded" style="font-size: 1.5em;">
                    <center><i class="fa fa-info"></i> <i>No Workers match the skills required.</i></center>
                    </div>
                @endif
                <!--
                <div class="col-md-4 padded">
                    <div class="media block-update-card">
                        <a class="pull-left" href="#">
                            <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                        </a>
                        <div class="media-body update-card-body">
                            <a href="#" style="font-weight: bolder;">Blas Celestino</a>
                            <p>Dasmarinas City, Cavite.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 padded text-center"><br/>
                    <a href="/WRKRSRCH:{{$job->id}}:{{$job->categorycode}}:{{$job->itemcode}}:{{$job->regcode}}:{{$job->citycode}}:{{$job->bgycode}}">
                        <i class="fa fa-search" style="font-size: 3em;"></i><br/>
                        Look for more workers..
                    </a>
                </div>
                -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-container stats-container" style="display:block !important;">
                <div class="col-lg-6 lato-text">
                    <a id="APPLICANTSLINK" href="#" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-users"></i>
                            {{ $applications->count() }}
                        </div>
                        <div class="text" style="color:#2980b9;">
                            Applicants
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 lato-text">
                    <a id="INVITEDSLINK" href="#" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-envelope-square"></i>
                            3
                        </div>
                        <div class="text" style="color:#2980b9;">
                            Invited
                        </div>
                    </a>
                </div>
            </div><br/>

            <div id="APPLICANTS">
                {{--<div class="widget-container padded applicant-container" style="">--}}
                    {{--<h4 style="margin: 0;">J** S********</h4>--}}
                {{--</div>--}}
                <div class="padded text-center">Applicants</div>
                @if($applications->count() != 0)
                    @foreach($applications as $a)
                        <div class="media block-update-card">
                            <a class="pull-left" href="#">
                                @if($a->profilePic != "")
                                    <img class="media-object update-card-MDimentions" src="{{$a->profilePic}}">
                                @else
                                    <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                @endif
                            </a>
                            <div class="media-body update-card-body">
                                <a href="#">
                                    <h4 class="media-heading">{{ $a->fullName }}</h4>
                                </a>
                                <p>{{ $a->regname }}, {{ $a->cityname }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop