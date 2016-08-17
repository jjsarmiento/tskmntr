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
            <div class="widget-container padded fluid-height">
                @if($carts->count() != 0)
                    <div class="row">
                        <form method="POST" action="/doCheckout">
                        <div class="col-md-7">
                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($carts as $c)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="WORKERID[]" value="{{$c->user_id}}">
                                                <a href="/{{$c->username}}">{{$c->fullName}}</a>
                                            </td>
                                            <td><a href="/removeCartItem:{{$c->cart_id}}"><i class="fa fa-close" style="color: #E74C3C;" title="Remove from cart"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <center>{{$carts->links()}}</center>
                        </div>
                        <div class="col-md-5">
                            <table width="100%">
                                <tr>
                                    <td>Your Current Points</td>
                                    <td style="font-weight: bold; text-align: right;">{{Auth::user()->points}}</td>
                                </tr>
                                <tr>
                                    <td>Point(s) per Worker's Profile</td>
                                    <td style="font-weight: bold; text-align: right;">{{$points_per_worker}}</td>
                                </tr>
                                <tr>
                                    <td>Number of Worker Profiles</td>
                                    <td style="font-weight: bold; text-align: right;">{{$qty}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 1em;">Total Price</td>
                                    <td style="padding-bottom: 1em; font-weight: bold; text-align: right;">{{$total_price}}</td>
                                </tr>
                                <tr style="border-top: 1px solid black;">
                                    <td style="padding-top: 1em;">Points after checkout</td>
                                    <td style="font-weight: bold; padding-top: 1em; text-align: right;">
                                        @if($points_after_checkout < 0)
                                            <span style="color: red;">{{$points_after_checkout}}</span>
                                        @else
                                            {{$points_after_checkout}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            @if($points_after_checkout < 0)
                                <i><center>Your points are not enough</center></i>
                            @else
                                <button type="submit" class="btn btn-danger btn-block">CHECKOUT</button>
                            @endif
                        </div>
                        </form>
                    </div>
                @else
                    <center>Your cart has no content</center>
                @endif
            </div>
        </div>
        <div class="col-md-4">
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