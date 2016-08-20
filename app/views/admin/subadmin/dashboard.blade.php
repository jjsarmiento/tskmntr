@extends('layouts.admin.master')
    @section('header')
    @stop

    @section('title')
        Admin Proveek
    @stop

    @section('content_header')
      <h1>
        Welcome {{Auth::user()->username}}
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    @stop

    @section('body')
        <div class="row">
            @foreach($roles as $r)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Administrator</span>
                        <span class="info-box-number">
                            @if($r == 'CONTENT_EDITOR')
                                Content Editor
                            @elseif($r == 'ADMINISTRATOR')
                                Administrator
                            @elseif($r == 'SUPPORT')
                                Support
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @stop
@stop