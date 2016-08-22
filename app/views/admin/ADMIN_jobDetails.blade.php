@extends('layouts.usermain')

@section('title')
    Company Clients
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('.DELETE_JOB_BTN').click(function(){
                if(confirm('Do you want to delete this job advertisement?')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop
 -->
@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                Job Advertisements
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Job Ads
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="widget-container">
                    <div class="widget-content padded">
                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                            {{ $job->title}}
                            @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR', 'SUPER_ADMIN'], Auth::user()->id))
                                <a href="#" data-href="/ADMIN_DELETEJOB={{$job->id}}" type="button" class="close DELETE_JOB_BTN" style="opacity: 100;">
                                    <i class="fa fa-trash" style="background-color: #C0392B; color: white; border: 1px solid #C0392B; padding: 0.3em; border-radius: 0.2em;"></i>
                                </a>
                            @endif
                        </h3>
                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                            Created at {{ date('m/d/y', strtotime($job->created_at)) }} by <a href="/{{$job->username}}">{{$job->fullName}}</a>
                        </span>
                        <br/><br/>
                        <div class="row" style="text-align: left">
                            <div class="col-md-7">
                            <div class="col-md-4">Duration</div>
                            <div class="col-md-8">
                                @if($job->hiring_type == 'LT6MOS')
                                    Less than 6 months
                                @else
                                    Greater than 6 months
                                @endif
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill Category
                            </div>
                            <div class="col-md-8">
                                {{ $job->categoryname }}
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill
                            </div>
                            <div class="col-md-8">
                                {{ $job->itemname }}
                            </div>
                            <br/><br/><br/>
                            <div class="col-md-4">
                                Location
                            </div>
                            <div class="col-md-8">
                                {{ $job->cityname }}, {{ $job->bgyname }}<br/>
                                {{ $job->regname }}
                            </div>
                            <br/><br/><br/>
                            <div class="col-md-4">Salary</div>
                            <div class="col-md-8">P{{ $job->salary }}</div>
                            <br/><br/><br/>
                            </div>
                            <div class="col-md-5">
                                {{ $job->description }}
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12 well">
                                    <label>Requirements</label><br/>
                                    {{$job->requirements}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label>Other Skills</label><br/>
                                    @foreach($custom_skills as $cs)
                                        <span class="badge">{{$cs->skill}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop