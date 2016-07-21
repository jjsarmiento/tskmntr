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
                    <div class="widget-container padded" style="display: flex; min-height:5em; display:block !important; border-bottom: #ECF0F1 solid 1px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 style="margin: 0">
                                    <a href="/jobDetails={{$job->id}}">{{ $job->title }}</a>
                                </h3>
                                <span style="color: #7F8C8D;">
                                    Created at {{ date('D, M j, Y \a\t g:ia', strtotime($job->created_at)) }}<br/>
                                    @if($job->expired)
                                        <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                    @else
                                        Expires at {{ date('D, M j, Y \a\t g:ia', strtotime($job->expires_at)) }}<br/>
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-6">
                                {{$job->description}}
                            </div>
                        </div>
                    </div>
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