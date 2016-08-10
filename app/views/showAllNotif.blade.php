@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }
        .item-new {
            padding: 0.4em;
            background-color: #C5EFF7;
            font-weight: bold;
            border-bottom: solid 1px #BDC3C7;
        }

        .item {
            padding: 0.4em;
            border-bottom: solid 1px #BDC3C7;
        }
        .item:hover{
            background-color: #C5EFF7;
        }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#search_btn').click(function(){
                var acctStatus = $('#search_acctStatus').val(),
                    rating = $('#search_rating').val(),
                    hiring = $('#search_hiring').val(),
                    orderBy = $('#search_orderBy').val(),
                    keyword = $('#search_keyword').val();

                    if(keyword == ""){
                        keyword = "NONE";
                    }

                    location.href = "/searchWorker:"+acctStatus+":"+rating+":"+hiring+":"+orderBy+":"+keyword;
            });
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
    <section>
        <div class="container main-content lato-text">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget-container fluid-height padded">
                        <div class="widget-content"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="widget-container fluid-height" style="padding: 0.5em;">
                        <div class="widget-content">
                            @foreach($notifs as $n)
                                <a href="{{$n->notif_url}}" style="text-decoration: none;">
                                    @if($n->status == 'NEW')
                                        <div class="item-new">
                                            {{$n->content}}
                                    @else
                                        <div class="item">
                                            {{$n->content}}
                                    @endif
                                        <Br/><span style="font-size: 0.8em; color: #7F8C8D;">{{ date('D M j, Y \a\t g:ia', strtotime($n->created_at)) }}</span>
                                        </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop