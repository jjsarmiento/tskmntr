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
    
    @stop
@stop