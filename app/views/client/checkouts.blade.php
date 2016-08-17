@extends('layouts.usermain')

@section('title')
    {{ Auth::user()->username }} | Job List
@stop

@section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-4">
            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                <div class="row" style="font-size: 1.2em; font-weight: bolder; text-align: center;">
                    <div class="col-md-6">
                        <i class="fa fa-diamond" style="color: #2980B9;"></i>&nbsp;
                        {{ Auth::user()->points }}
                    </div>
                    <div class="col-md-6">
                        <i class="fa fa-user" style="color: #2980B9;"></i>&nbsp;
                        {{ Auth::user()->accountType }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if($workers->count() != 0)
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <th>Checkout Date</th>
                        <th>Name</th>
                    </thead>
                    <tbody>
                        @foreach($workers as $w)
                            <tr>
                                <td>{{$w->purchased_at}}</td>
                                <td><a href="/{{$w->username}}">{{$w->fullName}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <center><i>
                    No workers checked out yet.<br/>
                </i></center>
            @endif
        </div>
    </div>
</section>
@stop