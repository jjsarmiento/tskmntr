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

        .hrLine
        {
            background:none;
            border:0;
            border-bottom:1px solid #2980b9;
            min-width: 100%;
            height:1px;
        }

        .applicant-container {
            min-height: 1em;
            border-bottom:
            #ECF0F1 1px solid;
            /*transition: 0.3s;*/
        }

        .applicant-container:hover {
            background-color: #F0FFFF;
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
        </div>
        <div class="col-md-4">
            <div class="widget-container stats-container" style="display:block !important;">
                <div class="col-lg-6 lato-text">
                    <a id="APPLICANTSLINK" href="#" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-users"></i>
                            12
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
            </div>
        </div>
    </div>
</section>
@stop