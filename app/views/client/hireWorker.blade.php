@extends('layouts.usermain')

@section('title')
    {{$job->title}}
@stop

@section('head-content')
    <style type="text/css">
        .badge {
            background-color: #1ABC9C;
            width: auto;
            max-width: 8em;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
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
        <div class="col-md-7">

            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                <a href="#" data-href="/deleteJob={{$job->id}}" id="DELETE_AD" type="button" class="close" style="opacity: 0.5;">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="/editJob={{$job->id}}" type="button" class="close" style="opacity: 0.5;  margin-right: 0.4em;">
                    <i class="fa fa-edit"></i>
                </a>
                <h3 style="margin: 0;"><a href="/jobDetails={{$job->id}}">{{$job->title}}</a></h3>
                <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                <br/>
                <br/>
                <div class="row" style="text-align: left">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Work Duration : </label>
                            @if($job->hiring_type == 'LT6MOS')
                                Less than 6 months
                            @else
                                Greater than 6 months
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label>Work Location : </label>{{ $job->cityname }}, {{ $job->regname }}
                        </div>
                        @if($job->salary != 0)
                            <div class="col-md-12">
                                <label>Salary : </label>
                                P{{ $job->salary }}
                            </div>
                        @endif
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-md-12">
                            <label>Skill Category : </label>{{ $job->categoryname }}<br/>
                            <label>Skills Needed : </label>{{$job->itemname}}
                            @foreach($custom_skills as $cs)
                                {{$cs->skill}} <br/>
                            @endforeach
                            {{--<span style="background-color: #1ABC9C;" title="{{$job->categoryname}}" class="badge">--}}
                                {{--{{ $job->categoryname }}--}}
                            {{--</span>--}}
                            {{--<span style="background-color: #3498DB;" title="{{ $job->itemname }}" class="badge">--}}
                                {{--{{ $job->itemname }}--}}
                            {{--</span>--}}
                            {{--@foreach($custom_skills as $cs)--}}
                                {{--<span style="background-color: #3498DB;" title="{{$cs->skill}}" class="badge">{{$cs->skill}}</span>--}}
                            {{--@endforeach--}}
                        </div>
                        <br/><br/><br/>
                    </div>
                    <div class="col-md-6" style="word-wrap: break-word; text-align: justify;">
                        <label>Description</label><br/>
                        {{ $job->description }}
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 well" style="text-align: justify;">
                            <label>Requirements</label><br/>
                            {{$job->requirements}}
                        </div>
                    </div>
                    @if($job->AverageProcessingTime || $job->Industry || $job->CompanySize || $job->WorkingHours || $job->DressCode)
                        <div class="col-md-6" style="text-align: justify;">
                            <h4>Company Snaphots</h4>
                            @if($job->AverageProcessingTime)
                                <label>Average Processing Time</label><br/>
                                {{$job->AverageProcessingTime}}<br/>
                            @endif

                            @if($job->Industry)
                                <label>Industry</label><br/>
                                {{$job->Industry}}<br/>
                            @endif

                            @if($job->CompanySize)
                                <label>Company Size</label><br/>
                                {{$job->CompanySize}}<br/>
                            @endif

                            @if($job->WorkingHours)
                                <label>Working Hours</label><br/>
                                {{$job->WorkingHours}}<br/>
                            @endif

                            @if($job->DressCode)
                                <label>Dress Code</label><br/>
                                {{$job->DressCode}}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="widget-container fluid-height padded" style="display: flex; min-height:125px; display:block !important;">
                <h3 style="margin: 0;"><a href="/{{$worker->username}}">{{$worker->fullName}}</a></h3>
                <br/>
                @if($hired)
                    Hired at {{$hired->created_at}}
                @else
                    <a href="/doHireWorker={{$worker->id}}={{$job->id}}" class="btn btn-success btn-block">Hire Worker</a>
                @endif
            </div>
        </div>
    </div>
</section>
@stop