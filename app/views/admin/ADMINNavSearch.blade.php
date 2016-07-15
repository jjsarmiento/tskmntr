@extends('layouts.usermain')

@section('title')
    Taskminator - Task Search
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}
</style>
@stop

@section('body-scripts')
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            @if($keyword != "")
                <h3 style="color: #2980b9">Results for <u>{{ $keyword }}</u></h3>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{--<ul class="breadcrumb">--}}
                    {{--<li>--}}
                        {{--<a href="/"><i class=" fa fa-home"></i></a>--}}
                    {{--</li>--}}
                    {{--<li class="active">--}}
                        {{--Search Task--}}
                    {{--</li>--}}
                {{--</ul>--}}
            </div>
            @if(Session::has('error'))
                <div class="col-lg-12">
                    <h4><i class="fa fa-warning" style="color:red"></i> {{ Session::get('error') }}</h4>
                </div>
            @endif
            <div class="col-sm-6">
                @if($users->count() == 0)
                    <center><i>No data available</i></center>
                @else
                    <h4>{{ $users->count() }} company/companies</h4>
                    @foreach($users as $user)
                        <div class="widget-container fluid-height padded">
                            <a target="_tab" href="/{{$user->username}}">{{ $user->fullName }}</a>
                        </div><br/>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-6">
                @if($jobs->count() == 0)
                    <center><i>No data available</i></center>
                @else
                    <h4>{{ $jobs->count() }} job ad/ads found</h4>
                    @foreach($jobs as $job)
                        <div class="widget-container fluid-height padded">
                            <a target="_tab" href="/ADMIN_jobDetails={{$job->id}}">{{ $job->title }}</a>
                        </div><br/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop