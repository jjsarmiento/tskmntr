@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
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
    <script>
        $(document).ready(function(){
            $('#search_btn').click(function(){
                var acctStatus = $('#search_acctStatus').val(),
                    rating = $('#search_rating').val(),
                    hiring = $('#search_hiring').val(),
                    orderBy = $('#search_orderBy').val(),
                    keyword = $('#search_keyword').val();

                    if(keyword == ""){
                        keyword = "NONE";
                    }

                    location.href = "/searchWorker:"+acctStatus+":"+rating+":"+hiring+":"+orderBy+":"+keyword;
            });
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
        <section style="margin-top:0;">
            <div class="container lato-text" style="">
                <div class="page-title">
                    <h1 class="lato-text">
                        Administrator | Notifications
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fa fa-home"></i></a>
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
                                        {{--<span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">--}}
                                            {{--<i class="fa fa-search"></i> Search--}}
                                        {{--</span>--}}
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>
                                </div>
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Audit Trail</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Taskminators</a><br>
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
                        @if($notifications->count() == 0)
                            <center><i>No notifications</i></center>
                        @else
                            @foreach($notifications as $notif)
                            <div class="widget-container lato-text" style="min-height: 150px; padding-bottom: 5px;">
                                <div class="widget-content padded">
                                    <div style="border: 2px solid black; padding: 0.4em; margin-bottom: 0.4em; cursor: pointer;" onclick="location.href='{{$notif->notif_url}}'">
                                        {{ $notif->content }}<br/>
                                        <span style="color: #7F8C8D; font-size: 0.8em">{{ $notif->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
@stop

{{--<html>--}}
    {{--<head></head>--}}
    {{--<body>--}}
        {{--<h1>Notifications</h1>--}}
        {{--@foreach($notifications as $notif)--}}
            {{--<div style="border: 2px solid black; padding: 0.4em; margin-bottom: 0.4em; cursor: pointer;" onclick="location.href='{{$notif->notif_url}}'">--}}
                {{--{{ $notif->content }}<br/>--}}
                {{--<span style="color: #7F8C8D; font-size: 0.8em">{{ $notif->created_at }}</span>--}}
            {{--</div>--}}
        {{--@endforeach--}}
        {{--{{ $notifications->links() }}--}}
    {{--</body>--}}
{{--</html>--}}