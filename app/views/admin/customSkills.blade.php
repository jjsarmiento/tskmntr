@extends('layouts.usermain')

@section('title')
    Taskminator - Task Search
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}
    .detele-cust-skills {
        margin: 0;
        padding: 0.4em;
        border-radius: 0.3em;
    }
    .detele-cust-skills:hover{
        background-color: #3498DB;
        color: #ffffff !important;
    }
    a {
        color: #000000;
        text-decoration: none;
    }
</style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function() {
            $('.DELETE-CUST-SKILL').click(function(){
                if(confirm('Do you want to delete this skill?')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
@stop

@section('user-name')
    Custom Skills | Admin
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="widget-container">
                    <div class="heading">
                        <h5><i class="fa fa-list"></i> &nbsp;Custom Skills</h5><br/>
                    </div>
                    <div class="widget-content padded">
                        @foreach($customSkill as $cs)
                            <p class="detele-cust-skills">
                                <span style="font-weight: bolder;">{{ $cs->skill }}</span> created by <a target="_tab" href="/viewUserProfile/{{$cs->userID}}">{{$cs->fullName}}</a>
                                <i class="pull-right fa fa-trash DELETE-CUST-SKILL" data-href="/DELCSTSKLL={{$cs->customSkillID}}" style="cursor: pointer;"></i>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="widget-container">
                    <div class="heading">
                        {{--<h5><i class="fa fa-list"></i> &nbsp;Add Custom</h5><br/>--}}
                    </div>
                    <div class="widget-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop