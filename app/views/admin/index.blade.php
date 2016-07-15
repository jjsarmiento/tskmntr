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
                        User List : Workers
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
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">Manage</a><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="well selected-filters">
                            <h3 style="margin: 0; cursor: pointer;" onclick="$('#SEARCH_PARAMETERS').slideToggle('fast');">Search for Workers <i class="fa fa-search"></i></h3>
                            <div id="SEARCH_PARAMETERS" class="row" style="display: none;">
                                <br/>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Status</label>
                                        <select class="form-control" id="search_acctStatus" name="search_acctStatus">
                                            <option <?php if(@$acctStatus == "ACTIVATED"){ echo('selected'); } ?> value="ACTIVATED">Activated</option>
                                            <option <?php if(@$acctStatus == "DEACTIVATED"){ echo('selected'); } ?> value="DEACTIVATED">Deactivated</option>
                                        </select>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <select class="form-control" id="search_rating" name="search_rating">
                                            <option value="ASC" <?php if(@$rating == "ASC"){ echo('selected'); } ?>>Lowest First</option>
                                            <option value="DESC" <?php if(@$rating == "DESC"){ echo('selected'); } ?>>Highest First</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hiring Status</label>
                                        <select class="form-control" id="search_hiring" name="search_hiring">
                                            <option value="H">Hired</option>
                                            <option value="NH">Not Hired</option>
                                        </select>
                                    </div>
                                    -->
                                    <div class="form-group">
                                        <label>Order by</label>
                                        <select class="form-control" id="search_orderBy" name="search_orderBy">
                                            <option value="DESC" <?php if(@$orderBy == "DESC"){ echo('selected'); } ?>>Oldest first</option>
                                            <option value="ASC" <?php if(@$orderBy == "ASC"){ echo('selected'); } ?>>Newest first</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Search Keywords (Name or Username)</label>
                                        <input type="text" class="form-control" value="{{@$keyword}}" placeholder="KEYWORD FOR NAME/USERNAME" id="search_keyword" name="search_keyword" />
                                    </div>
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary" id="search_btn">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--@if($users->count() > 0)--}}
                            {{--@foreach($users as $user)--}}
                                {{--<div class="widget-container lato-text" style="padding-bottom: 5px; border-bottom: 1px solid #ECF0F1; min-height: 1em;">--}}
                                    {{--<div class="widget-content padded">--}}
                                        {{--<div>--}}
                                            {{--<h3 style="margin : 0;"><a class="lato-text" href="/viewUserProfile/{{ $user->id }}">{{ $user->fullName }} {{ '@'.$user->username }}</a></h3>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<span style="color: rgb(72, 157, 179);">Registered at {{ date('m/d/y', $user->created_at->getTimeStamp()) }}</span><br/>--}}
                                                    {{--<span style="color: rgb(72, 157, 179);"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{ $user->bgyname }}, {{ $user->cityname }}, {{$user->regname}}</span><br/>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--@if($user->status == 'PRE_ACTIVATED')--}}
                                                        {{--<div class="row">--}}
                                                            {{--<a href="/adminActivate/{{$user->id}}" class="btn btn-xs btn-info">Fully Activate Account</a><br/>--}}
                                                            {{--<a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>--}}
                                                        {{--</div>--}}
                                                    {{--@elseif($user->status == 'ACTIVATED')--}}
                                                        {{--<a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger btn-xs">Deactivate Account</a><br/>--}}
                                                    {{--@elseif($user->status == 'DEACTIVATED')--}}
                                                        {{--<a href="/adminActivate/{{$user->id}}" class="btn btn-success btn-xs">Activate Account</a><br/>--}}
                                                    {{--@elseif($user->status == 'SELF_DEACTIVATED')--}}
                                                        {{--<a href="/adminActivate/{{$user->id}}" class="btn btn-success btn-xs">Activate Account</a><br/>--}}
                                                    {{--@elseif($user->status == 'ADMIN_DEACTIVATED')--}}
                                                        {{--<a href="/adminActivate/{{$user->id}}" class="btn btn-success btn-xs">Activate Account</a><br/>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<div class="well selected-filters" style="text-align: center">--}}
                                {{--<font style="color: red">No data available.</font>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        @if($users->count() == 0)
                            <div class="well selected-filters" style="text-align: center">
                                <font style="color: red">No data available.</font>
                            </div>
                        @endif
                        @foreach($users as $user)
                            <div class="widget-container lato-text" style="min-height: 150px; padding-bottom: 5px; border-bottom: 1px solid #ECF0F1;">
                                <div class="widget-content padded">
                                    <div>
                                        <h3 style="margin: 0;"><a class="lato-text" href="/viewUserProfile/{{ $user->id }}">{{ $user->fullName }} {{ '@'.$user->username }}</a> <span class="badge">{{ $user->status }}</span></h3>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Registered at {{$user->created_at}}</span><Br/>
                                        @if($user->status == 'PRE_ACTIVATED')
                                            <span style="color: red;">Please check credentials of this user before fully activating their account.</span>
                                        @endif
                                        <br/>
                                        @if($user->status == 'PRE_ACTIVATED')
                                            <div class="row">
                                                <a href="/adminActivate/{{$user->id}}" class="btn btn-info">Fully Activate Account</a><br/>
                                                <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                            </div>
                                        @elseif($user->status == 'ACTIVATED')
                                            <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                        @elseif($user->status == 'DEACTIVATED')
                                            <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                        @elseif($user->status == 'SELF_DEACTIVATED')
                                            <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                        @elseif($user->status == 'ADMIN_DEACTIVATED')
                                            <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <center>{{ $users->links() }}</center>
                    </div>
                </div>
            </div>
        </section>
@stop