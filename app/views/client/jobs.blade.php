@extends('layouts.usermain')

@section('title')
    {{ Auth::user()->username }} | Job List
@stop

@section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-4">
            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                <div class="row" style="font-size: 1.2em; font-weight: bolder; text-align: center;">
                    <div class="col-md-6">
                        <i class="fa fa-diamond" style="color: #2980B9;"></i>&nbsp;
                        {{ Auth::user()->points }}
                    </div>
                    <div class="col-md-6">
                        <i class="fa fa-user" style="color: #2980B9;"></i>&nbsp;
                        {{ Auth::user()->accountType }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if($jobs->count() != 0)
                @foreach($jobs as $job)
                    <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style=" word-wrap: break-word; padding-left:1em; padding-right:10px; min-height: 1em; max-height: 10">
                        <div style="display:flex;padding-bottom:5px;">
                            <div style="flex:11;">
                                <a href="/jobDetails={{$job->job_id}}" style="text-decoration:none;">
                                    <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                        {{ $job->title}}
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
                <center><i>
                    No Jobs posted yet.<br/>
                    Click <a href="/createJob">here</a> to create jobs!
                </i></center>
            @endif
        </div>
    </div>
</section>
@stop