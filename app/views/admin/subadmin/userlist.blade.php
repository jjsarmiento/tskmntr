@extends('layouts.admin.master')
    @section('head')
    @stop

    @section('title')
        {{$title}} | Proveek
    @stop

    @section('content_header')
      <h1>{{$title}}
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin">Dashboard</a></li>
        <li>{{$title}}</li>
      </ol>
    @stop

    @section('body')
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        @if($users->count() > 0)
                            <table class="table table-condensed table-hover table-responsive">
                                <thead>
                                    <th>Username</th>
                                    <th>FullName</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR'], Auth::user()->id))
                                        <th>Action</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td><a href="/{{$u->username}}">{{$u->username}}</a></td>
                                            <td><a href="/viewUserProfile/{{$u->id}}">{{$u->fullName}}</a></td>
                                            <td>{{$u->created_at}}</td>
                                            <td>{{$u->status}}</td>
                                            @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR'], Auth::user()->id))
                                                <td>
                                                    @if($u->status == 'ACTIVATED')
                                                        <a data-message="Confirm account DEACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-danger btn-xs" data-href="/adminDeactivate/{{$u->id}}">DEACTIVATE</a>
                                                    @elseif($u->status == 'DEACTIVATED' || $u->status == 'SELF_DEACTIVATED' || $u->status == 'ADMIN_DEACTIVATED')
                                                        <a data-message="Confirm account ACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-success btn-xs" data-href="/adminActivate/{{$u->id}}">ACTIVATE</a>
                                                    @else
                                                        <a data-message="Confirm account DEACTIVATION of {{$u->fullName}}" class="btn-block a-validate btn btn-danger btn-xs" data-href="/adminDeactivate/{{$u->id}}">DEACTIVATE</a>
                                                        <a data-message="Confirm account ACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-success btn-xs" data-href="/adminActivate/{{$u->id}}">ACTIVATE</a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <center>No data available</center>
                        @endif
                    </div>
                    <div class="panel-footer">
                        @if($users)
                            <center>{{$users->links()}}</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @stop
@stop