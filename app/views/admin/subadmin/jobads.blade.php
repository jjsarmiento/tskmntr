@extends('layouts.admin.master')
    @section('head')
    @stop

    @section('title')
        Job Advertisements | Proveek
    @stop

    @section('content_header')
      <h1>Job Advertisements
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin">Dashboard</a></li>
        <li>Job Advertisements</li>
      </ol>
    @stop

    @section('body')
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        @if($jobs->count() > 0)

                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Location</th>
                            <th>Work Duration</th>
                            <th>Salary</th>
                            <th>Expiration</th>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td><a href="/ADMIN_jobDetails={{$job->job_id}}">{{ $job->title}}</a>
                                    <td><a href="/viewUserProfile/{{$job->user_id}}">{{$job->fullName}}</a></td>
                                    <td>{{$job->regname}}, {{$job->provname}}, {{$job->cityname}}</td>
                                    <td>
                                        @if($job->hiring_type == 'LT6MOS')
                                            Less than 6 months
                                        @else
                                            Greater than 6 months
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->salary)
                                            {{$job->salary}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->expired)
                                            <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                        @else
                                            {{ date('m/d/y', strtotime($job->expires_at)) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                            <center>No data available</center>
                        @endif
                    </div>
                    <div class="panel-footer">
                        @if($jobs)
                            <center>{{$jobs->links()}}</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @stop
@stop