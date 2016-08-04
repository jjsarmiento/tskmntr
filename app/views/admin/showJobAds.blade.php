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
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/UsrAccntLstCMPNY" class="sidemenu">Company</a><br>
                            <!--
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
                            -->
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
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_workers" class="sidemenu">Workers</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_companies" class="sidemenu">Company</a><br>
                            <!--
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                            -->
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Category & Skills</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">System Skills</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/customSkills" class="sidemenu">Custom Skills</a><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if($jobs->count() != 0)
                    @foreach($jobs as $job)

                        <div class="widget-container fluid-height padded" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style=" word-wrap: break-word; padding-left:1em; padding-right:10px; min-height: 1em; max-height: 10">
                            <div style="display:flex;padding-bottom:5px;">
                                <div style="flex:11;">
                                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important;">
                                            <a href="/ADMIN_jobDetails={{$job->job_id}}">
                                                {{ $job->title}}
                                            </a>
                                            by
                                            <a href="/viewUserProfile/{{$job->user_id}}">{{$job->fullName}}</a>
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
                                                @if($job->salary)
                                                <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{--<div class="widget-container fluid-height padded" style="word-wrap: break-word; padding-left:10px; padding-right:10px; min-height: 50px;">--}}
                            {{--<div style="display:flex;padding-bottom:5px; border-bottom:1px solid #e6e6e6">--}}
                                {{--<div style="flex:11;">--}}
                                {{--<a href="/ADMIN_jobDetails={{$job->JOBID}}" style="text-decoration:none;">--}}
                                    {{--<h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">--}}
                                        {{--{{ $job->title}}--}}
                                    {{--</h3>--}}
                                    {{--<span class="text-right" style="padding:0;margin:0; color:#ccc;">--}}
                                        {{--Created at {{ date('m/d/y', strtotime($job->created_at)) }} by <a href="/{{$job->username}}">{{$job->fullName}}</a>--}}
                                    {{--</span>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<p class="lato-text no-padding" style="font-size: 1em">--}}
                                {{--{{ $job->description }}--}}
                            {{--</p>--}}
                        {{--</div>--}}
                        {{--<br>--}}
                    @endforeach
                @else
                    <center><i>No job ads available</i></center>
                @endif
                {{$jobs->links()}}
            </div>
        </div>
    </div>
</section>
@stop