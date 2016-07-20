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
        <div class="col-md-6">
            @if($hasInvite)
                <div class="widget-container padded" style="min-height: 10px; display:block !important;">
                    <span style="color: #2980B9; font-weight: bold;">
                        Invitation sent at {{$hasInvite->created_at}}
                    </span><br/><br/>
                    {{$hasInvite->message}}
                </div><br/>
            @endif
                @if($application)
                    <div class="widget-container padded" style="min-height: 10px; display:block !important;">
                        <i class="fa fa-check-circle" style="color: #2ECC71; font-size: 1.5em;"></i>&nbsp;You have applied for this job.<br/>
                        <span style="color: #7F8C8D; font-size: 0.8em;">Application sent at {{$application->created_at}}</span>
                        <br/>
                        <br/>
                        <a class="btn btn-danger btn-block" href="/CNCLAPPLCTN:{{$job->jobId}}">Cancel Application</a>
                    </div><br/>
                @else
                    <div class="widget-container padded" style="min-height: 10px; display:block !important;">
                        <a href="/APPLYFRJB:{{$job->jobId}}" class="btn btn-primary btn-block">Apply</a>
                    </div><br/>
                @endif
        </div>
        <div class="col-md-6">
            <div class="widget-container padded" style="word-wrap: break-word; display: flex; min-height:125px; display:block !important;">
                <h3 style="margin: 0;">{{$job->title}}</h3>
                <span style="color: #7F8C8D; font-size: 1em;">by <a target="_tab" href="/{{$job->username}}">{{$job->fullName}}</a></span><Br/>
                <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                <br/>
                <br/>
                <div class="row" style="text-align: left">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        {{ $job->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop