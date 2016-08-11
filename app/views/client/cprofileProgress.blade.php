@extends('...layouts.usermain')

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
            padding: 1em;
            background-color: #C5EFF7;
            font-weight: bold;
            border-bottom: solid 1px #BDC3C7;
        }

        .item {
            padding: 0.4em;
            border-bottom: solid 1px #BDC3C7;
        }
        .item:hover{
            background-color: #E9EAED;
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
                        <div class="widget-content">
                            Percentage of Completeness : {{Auth::user()->total_profile_progress}}%
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="widget-container fluid-height padded">
                        <div class="widget-content">
                            @foreach($reqs as $r)
                                <a href="{{$r['url']}}">{{$r['content']}}</a><br/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop