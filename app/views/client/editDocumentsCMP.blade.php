@extends('layouts.usermain')

@section('title')
    Edit Personal Information
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
        h5 {
            margin: 0;
        }
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
            margin-left: 20px;
            margin-top: 15px;
            margin-right: 1em;
            margin-bottom: 0em;
            /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
            /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
            /*box-shadow: 0 8px 6px -6px black;*/
        }
        .thumbnail img {
            display: inline;
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100%;
            width: auto;
            /*-webkit-transform: translate(-50%,-50%);*/
            /*-ms-transform: translate(-50%,-50%);*/
            transform: translate(-50%,-50%);
        }
        .thumbnail img.portrait {
            width: 100%;
            height: auto;
        }
    </style>
    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/taskminator.js') }}
    <script>
        $(document).ready(function(){
            var citydropdown = $('#city');
            var ALLCTY = citydropdown.children('option');

            locationChain($('#city'), $('#barangay'),$('#editPersonalInfo'), '/chainCity');
            $('#reg-task').change(function(){
                citydropdown.prop('disabled', true);
                $('#barangay').prop('disabled', true);
                var regcode = 'city-value-'+$(this).val();
                var options = $('.'+regcode);
                citydropdown.val(options.eq(0).val());
                citydropdown.children('option').hide()
                options.show();
                citydropdown.prop('disabled', false);
            });
//            locationChain($('#city'), $('#barangay'),$('#editPersonalInfo'), '/chainCity');
        });
    </script>
@stop

@section('body-scripts')
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
    <section class="lato-text">
        <div class="container">
            <div class="row">
                @if(Session::has('errorMsg'))
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            {{ @Session::get('errorMsg') }}
                        </div>
                    </div>
                @endif
                @if(Session::has('successMsg'))
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            {{ @Session::get('successMsg') }}
                        </div>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="widget-container">
                        <div class="widget->content"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget-container">
                        <div class="widget->content"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

