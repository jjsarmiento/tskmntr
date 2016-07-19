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
@stop

@section('user-name')
    Bookmarks | {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
        </div>
        <div class="row">
            <div class="col-md-9">
                @if($bookmarks->count() == 0)
                    <center><i>No bookmarked users</i></center>
                @else
                    @foreach($bookmarks as $bm)
                        <div class="col-md-4" style="margin-bottom: 1em;">
                            <div class="widget-container fluid-height padded" style="word-wrap: break-word; min-height: 1em; height: 7em; max-height: 7em;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                            @if(in_array($bm->userID, $CHECKED_OUT_USERS))
                                                {{$bm->firstName }} {{$bm->lastName}}
                                            @else
                                                {{substr_replace($bm->firstName, str_repeat('*', strlen($bm->firstName)-1), 1)}}
                                                &nbsp;
                                                {{substr_replace($bm->lastName, str_repeat('*', strlen($bm->lastName)-1), 1)}}
                                            @endif
                                        </h3>
                                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                                            Bookmarked at {{ date('m/d/y', strtotime($bm->bookmarked_at)) }}
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        @if(in_array($bm->userID, $CHECKED_OUT_USERS))
                                            <input type="checkbox" class="BM_CHKBX" data-workerid="{{$bm->userID}}" />
                                        @elseif(in_array($bm->userID, $INCART))
                                            <a href="#" data-target="#CARTMODAL" data-toggle="modal" class="SHWCRT btn btn-xs btn-danger btn-block" style="border-radius: 0.3em;">Added to Cart</a>
                                        @else
                                            <a href="/addToCart={{$bm->userID}}" class="btn btn-warning btn-xs btn-block" style="border-radius: 0.3em;"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-3">
                <div class="widget-container">
                    <div class="widget-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop