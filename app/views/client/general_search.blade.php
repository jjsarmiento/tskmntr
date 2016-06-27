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
        $(document).ready(function(){
            if($('#rateRange').val() != '0'){
                $('#rangeValue').prop('disabled', false);
            }else{
                $('#rangeValue').prop('disabled', true);
            }

            $('#rateRange').change(function(){
               if($(this).val() != '0'){
                   $('#rangeValue').prop('disabled', false);
               }else{
                   $('#rangeValue').prop('disabled', true);
               }
            });

            if($('#searchField').val() == 'city'){
//                        $('#searchCity-controls').fadeIn();
                $('#searchCity').prop('disabled', false);
            }
            $('#searchField').change(function(){
                if($(this).val() == 'city'){
//                        $('#searchCity-controls').fadeIn();
                    $('#searchCity').prop('disabled', false);
                }else{
                    $('#searchCity').prop('disabled', true);
                }
            });

            $('.cancel-task').click(function(){
                if(confirm('Are you sure you want to cancel your bid?')){
                    location.href = $(this).attr('data-href');
                }
            });

            $('#searchBtn').click(function(){
                var workingTime = '0',
                    searchField = '0',
                    searchCity  = '0',
                    searchWord  = '0',
                    rateRange   = '0',
                    rangeValue  = '0';

                if($('#workingtime').val() != ''){
                    workingTime = $('#workingtime').val();
                }

                if($('#searchField').val() != ''){
                    searchField = $('#searchField').val();
                }

                if($('#searchCity').val() != ''){
                    searchCity = $('#searchCity').val();
                }

                if($('#searchWord').val() != ''){
                    searchWord = $('#searchWord').val();
                }

                if($('#rateRange').val() != '0'){
                    rateRange = $('#rateRange').val();
                }

                if($('#rangeValue').val() != ''){
                    rangeValue = $('#rangeValue').val();
                }

                location.href = '/tskmntr/doTaskSearch='+workingTime+'='+searchField+'='+searchCity+'='+searchWord+'='+rateRange+'='+rangeValue;
            });
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h3 style="color: #2980b9">Results for <u>{{ $keyword }}</u></h3>
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
                    <h4>{{ $users->count() }} worker/s found</h4>
                    @foreach($users as $user)
                        <div class="widget-container fluid-height padded">
                            {{ $user->fullName }}
                        </div><br/>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-6">
                @if($tasks->count() == 0)
                    <center><i>No data available</i></center>
                @else
                    <h4>{{ $users->count() }} job ad/ads found</h4>
                    @foreach($tasks as $tasks)
                        <div class="widget-container fluid-height padded">
                            {{ $tasks->name }}
                        </div><br/>
                    @endforeach
                @endif
                {{--<div class="widget-container fluid-height padded">xxx</div>--}}
            </div>
        </div>
    </div>
</section>
@stop