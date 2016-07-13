@extends('layouts.usermain')

@section('title')
    {{ $pageName }}
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

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
<!--     {{ HTML::script('js/jquery-1.11.0.min.js') }} -->
    <script>
        $(document).ready(function(){
            $('#search_PENDINGUSERS').click(function(){
                var keyword = "";
                if($('#search_keyword').val() == ""){
                    keyword = "NONE";
                }else{
                    keyword = $('#search_keyword').val();
                }
                location.href="/search_PUSR="+keyword+"="+$('#search_acctType').val()+"="+$('#search_orderBy').val();
            });
        });
    </script>
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                {{ $pageName }}
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    {{--<li class="active">--}}
                        {{--Bidding Tasks--}}
                    {{--</li>--}}
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
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/admin" class="sidemenu">Pending Users</a>&nbsp;&nbsp;<span style="background-color: red;" class="badge">{{ $pendingCount }}</span><br>
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
                        {{--<div class="panel-heading">--}}
                            {{--<div class="panel-title">--}}
                                {{--<a class="accordion-toggle" href="/categoryAndSkills">--}}
                                {{--Category & Skills</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!--
                {{--<div class="well selected-filters">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-2">--}}
                            {{--Search By:--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<select name="searchBy" id="searchBy" class="form-control">--}}
                                {{--<option value="0" <?php if(@$searchBy == '0'){ echo('selected'); } ?>>Display all tasks</option>--}}
                                {{--<option value="name" <?php if(@$searchBy == 'name'){ echo('selected'); } ?>>Task Name</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<select name="workTimeValue" id="workTimeValue" class="form-control">--}}
                                {{--<option value="0" <?php if(@$workTimeValue == '0'){ echo('selected'); } ?>>Display all employment type</option>--}}
                                {{--<option value="PTIME" <?php if(@$workTimeValue == 'PTIME'){ echo('selected'); } ?>>Part Time</option>--}}
                                {{--<option value="FTIME" <?php if(@$workTimeValue == 'FTIME'){ echo('selected'); } ?>>Full Time</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<input type="text" value="<?php if(@$searchWord){ echo($searchWord); } ?>" name="searchWord" id="searchWord" placeholder="search keyword" class="form-control"/>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row" style="padding-top:10px;">--}}
                        {{--<div class="col-md-2">--}}
                            {{--Status:--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<select name="status" id="status" class="form-control">--}}
                                {{--<option value="0" <?php if(@$status == '0'){ echo('selected'); } ?>>Display all status</option>--}}
                                {{--<option value="OPEN" <?php if(@$status == 'OPEN'){ echo('selected'); } ?>>Open</option>--}}
                                {{--<option value="ONGOING" <?php if(@$status == 'ONGOING'){ echo('selected'); } ?>>On Going</option>--}}
                                {{--<option value="COMPLETE" <?php if(@$status == 'COMPLETED'){ echo('selected'); } ?>>Complete</option>--}}
                                {{--<option value="CANCELLED" <?php if(@$status == 'CANCELLED'){ echo('selected'); } ?>>Cancelled</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<button type="submit" id="searchBtn" class="btn btn-block btn-primary">Search</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                -->

                {{--@if($tasks->count() == 0)--}}
                    {{--<div class="well selected-filters" style="text-align: center">--}}
                        {{--<font style="color: red">No data available.</font>--}}
                    {{--</div>--}}
                {{--@endif--}}

                {{--@foreach($tasks as $task)--}}
                    {{--<div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">--}}
                        {{--<div class="widget-content padded">--}}
                            {{--<div>--}}
                                {{--<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Name</span>--}}
                                 {{--: <span style="margin-left: 5px"><a target="_tab" href="/admin/taskDetails/{{$task->id}}">{{ $task->name }}</a></span><br/>--}}
                                {{--<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">By</span>--}}
                                 {{--: <span style="margin-left: 5px"><a target="_tab" href="/viewUserProfile/{{User::where('id', $task->id)->pluck('id')}}">{{ User::where('id', $task->id)->pluck('fullName') }}</a></span><br/>--}}
                                {{--<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Work Time</span>--}}
                                 {{--: <span style="margin-left: 5px">{{ $task->workTime }}</span><br/>--}}
                                {{--<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Created at</span>--}}
                                 {{--: <span style="margin-left: 5px">{{ $task->created_at }}</span><br/>--}}
                                {{--<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Status</span>--}}
                                 {{--: <span style="margin-left: 5px">{{ $task->status }}</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div><br/>--}}
                {{--@endforeach--}}
                {{--<center>{{ $tasks->links() }}</center>--}}

                <div class="well selected-filters">
                    <div class="row">
                        <div class="col-md-8">
                            {{--<div class="form-group"></div>--}}
                            <div class="form-group">
                                <input value="<?php if(@$search_keyword != 'NONE'){ echo(@$search_keyword); } ?>" class="form-control" type="text" id="search_keyword" name="search_keyword" placeholder="SEARCH KEYWORD FOR NAME/USERNAME" />
                            </div>
                            <div class="form-group">
                                <select id="search_acctType" name="search_acctType" class="form-control">
                                    <option value="ALL" <?php if(@$search_acctType == 'ALL'){ echo('selected'); } ?>>Display All Account Type</option>
                                    <option value="FREE" <?php if(@$search_acctType == 'FREE'){ echo('selected'); } ?>>Free</option>
                                    <option value="BASIC" <?php if(@$search_acctType == 'BASIC'){ echo('selected'); } ?>>Basic</option>
                                    <option value="PREMIUM" <?php if(@$search_acctType == 'CANCELLED'){ echo('PREMIUM'); } ?>>Premium</option>
                                    <option value="MASS_HIRING" <?php if(@$search_acctType == 'MASS_HIRING'){ echo('selected'); } ?>>Mass Hiring</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="search_orderBy" id="search_orderBy" class="form-control">
                                    <option value="DESC" <?php if(@$search_orderBy == 'DESC'){ echo('selected'); } ?>>Newest First</option>
                                    <option value="ASC" <?php if(@$search_orderBy == 'ASC'){ echo('selected'); } ?>>Oldest First</option>
                                </select>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary" id="search_PENDINGUSERS">Search</button>
                            </div>
                        </div>
                        <!--
                        {{--<div class="col-md-2">--}}
                            {{--<select id="searchBy" name="searchBy" class="form-control">--}}
                                {{--<option value="ALL" <?php if(@$searchBy == 'ALL'){ echo('selected'); } ?>>Display all</option>--}}
                                {{--<option value="fullName" <?php if(@$searchBy == 'fullName'){ echo('selected'); } ?>>Name</option>--}}
                                {{--<option value="username" <?php if(@$searchBy == 'username'){ echo('selected'); } ?>>Username</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<select id="searchUserType" name="searchUserType" class="form-control">--}}
                                {{--<option value="ALL" <?php if(@$searchUserType == 'ALL'){ echo('selected'); } ?>>Display All</option>--}}
                                {{--<option value="3" <?php if(@$searchUserType == '3'){ echo('selected'); } ?>>Client</option>--}}
                                {{--<option value="4" <?php if(@$searchUserType == '4'){ echo('selected'); } ?>>Company</option>--}}
                                {{--<option value="2" <?php if(@$searchUserType == '2'){ echo('selected'); } ?>>Worker</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<input value="<?php if(@$searchWord){ echo($searchWord); } ?>" id="searchWord" type="text" name="searchWord" placeholder="search keyword" class="form-control"/>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<button id="searchBtn" type="submit" class="btn btn-block btn-primary" style="margin: 0">Search</button>--}}
                        {{--</div>--}}
                        -->
                    </div>
                </div>

                @if($pendingUsers->count() == 0)
                    <div class="well selected-filters" style="text-align: center">
                        <font style="color: red">No data available.</font>
                    </div>
                @else
                    <div class="col-lg-12 padded" style="">
                        <div class="col-lg-5"><hr class="hrLine"></div>
                        <div class="col-lg-2" style="margin-top:10px;"><p style="font-size:10pt;">Pending Users</p></div>
                        <div class="col-lg-5"><hr class="hrLine"></div>
                    </div><br><br><br><br>
                    @foreach($pendingUsers as $user)
                        <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                            <div class="widget-content padded">
                                <div>
                                    <a style="font-weight: bold; font-size: 20px;" href="viewUserProfile/{{$user->id}}">{{$user->fullName}} | {{ $user->username }}</a><br/>
                                    Registered at {{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at)) }}
                                </div>
                            </div>
                        </div><br/>
                    @endforeach
                    <center>{{ $pendingUsers->links()  }}</center>
                @endif
            </div>
        </div>

        <!--
        {{--<form method="POST" action="{{ $formUrl }}">--}}
            {{--Search by : <select name="searchBy" id="searchBy">--}}
                {{--<option value="0">Display All</option>--}}
                {{--<option value="name" <?php if(@$searchBy == 'name'){ echo('selected'); } ?>>Task Name</option>--}}
                {{--<option value="workTime" <?php if(@$searchBy == 'workTime'){ echo('selected'); } ?>>Work Time</option>--}}
            {{--</select>--}}
            {{--<select name="workTimeValue" id="workTimeValue" disabled>--}}
                {{--<option value="PTIME" <?php if(@$workTimeValue == 'PTIME'){ echo('selected'); } ?>>Part Time</option>--}}
                {{--<option value="FTIME" <?php if(@$workTimeValue == 'FTIME'){ echo('selected'); } ?>>Full Time</option>--}}
            {{--</select>--}}
            {{--Status : <select name="status" id="status">--}}
                {{--<option value="ALL" <?php if(@$status == 'ALL'){ echo('selected'); } ?>>Display All</option>--}}
                {{--<option value="OPEN" <?php if(@$status == 'OPEN'){ echo('selected'); } ?>>Open</option>--}}
                {{--<option value="ONGOING" <?php if(@$status == 'ONGOING'){ echo('selected'); } ?>>On Going</option>--}}
                {{--<option value="COMPLETE" <?php if(@$status == 'COMPLETED'){ echo('selected'); } ?>>Complete</option>--}}
                {{--<option value="CANCELLED" <?php if(@$status == 'CANCELLED'){ echo('selected'); } ?>>Cancelled</option>--}}
            {{--</select>--}}
            {{--<input type="text" name="searchWord" placeholder="search keyword"/>--}}
            {{--<button type="submit">Search</button>--}}
        {{--</form>--}}

        {{--@if($tasks->count() == 0)--}}
            {{--<center><i>No data available.</i></center>--}}
        {{--@endif--}}

        {{--@foreach($tasks as $task)--}}
            {{--<div style="border: 1px solid black; padding: 0.4em; margin-bottom: 0.4em">--}}
                {{--Name : <a target="_tab" href="/admin/taskDetails/{{$task->id}}">{{ $task->name }}</a><br/>--}}
                {{--By : <a target="_tab" href="/viewUserProfile/{{User::where('id', $task->id)->pluck('id')}}">{{ User::where('id', $task->id)->pluck('fullName') }}</a><br/>--}}
                {{--Work Time : {{ $task->workTime }}<br/>--}}
                {{--Created at : {{ $task->created_at }}<br/>--}}
                {{--Status : {{ $task->status }}--}}
            {{--</div>--}}
        {{--@endforeach--}}
        -->
    </div>
</section>
@stop