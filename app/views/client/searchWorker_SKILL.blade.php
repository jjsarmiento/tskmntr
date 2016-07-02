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
    <!-- <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script> -->
    <script>
    </script>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            {{--<h3 style="color: #2980b9">Results for <u>{{ $keyword }}</u></h3>--}}
        </div>
        <div class="row">
            @if(Session::has('error'))
                <div class="col-lg-12">
                    <h4><i class="fa fa-warning" style="color:red"></i> {{ Session::get('error') }}</h4>
                </div>
            @endif
            <div class="col-md-8 col-md-offset-4">
                @if($users->count() == 0)
                    <center><i>No data available</i></center>
                @else
                    <h4>{{$users->count()}} result(s) found</h4>
                    @foreach($users as $user)
                        <div class="widget-container fluid-height padded">
                            <a href="/{{$user->username}}">{{ $user->fullName }}</a>
                        </div><br/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop