@extends('layouts.usermain')

@section('title')
    Company Clients
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }
    </style>
@stop

@section('body-scripts')
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop
 -->
@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                Job Advertisements
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Job Ads
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget-container">
                    <div class="widget-content">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                User Account List</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/admin" class="sidemenu">Pending Users</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Worker</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Job Ads&nbsp;&nbsp;
                                <span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">
                                    <i class="fa fa-search"></i> Search
                                </span>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/showJobAds" class="sidemenu">All Job Ads</a><br>
                            {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>--}}
                            {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>--}}
                            {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>--}}
                            {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>--}}
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Audit Trail</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Category & Skills</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">Manage</a><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="widget-container">
                    <div class="widget-content padded">
                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                            {{ $job->title}}
                        </h3>
                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                            Created at {{ date('m/d/y', strtotime($job->created_at)) }} by <a href="/{{$job->username}}">{{$job->fullName}}</a>
                        </span>
                        <br/><br/>
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
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12 well">
                                    <label>Requirements</label><br/>
                                    {{$job->requirements}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label>Other Skills</label><br/>
                                    @foreach($custom_skills as $cs)
                                        <span class="badge">{{$cs->skill}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop