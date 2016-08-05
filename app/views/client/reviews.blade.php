@extends('layouts.usermain')

@section('title')
    Reviews
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-6">
            <div class="widget-container padded fluid-height">
                <h3 style="margin: 0;">Reviewed Workers</h3>
                <br/>
                @if($rvwd_workers->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date Reviewed</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach($rvwd_workers as $r)
                                    <tr>
                                        <td>
                                            <a href="/{{$r->username}}">
                                            @if(in_array($r->user_id, BaseController::GETCHECKEDOUTUSERS_STATIC(Auth::user()->id)))
                                                {{$r->fullName}}
                                            @else
                                                {{substr_replace($r->firstName, str_repeat('*', strlen($r->firstName)-1), 1)}}
                                                &nbsp;
                                                {{substr_replace($r->lastName, str_repeat('*', strlen($r->lastName)-1), 1)}}
                                            @endif
                                            </a>
                                        </td>
                                        <td>{{ date("m/d/y", strtotime($r->created_at)) }}</td>
                                        <td><a href="/dispReview/{{$r->id}}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                @else
                    <center><i>No reviews made yet.</i></center>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="widget-container padded fluid-height">
                <h3 style="margin: 0;">Scheduled Reviews</h3>
                <br/>
                <table class="table table-hover"></table>
            </div>
        </div>
    </div>
</section>
@stop