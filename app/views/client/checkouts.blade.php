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