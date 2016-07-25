@extends('layouts.usermain')

@section('title')
    Proveek Job Search
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}
</style>
@stop

@section('body-scripts')
    <!-- <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script> -->
    <script>
        $(document).ready(function(){
            CHAINLOCATION($('#jobSearch_region'), $('#jobSearch_city'));
            CHAINCATEGORYANDSKILL($('#jobSearch_category'), $('#jobSearch_skill'));
            $('#INIT_JOBSEARCH').click(function(){
                var keyword = ($('#jobSearch_keyword').val() ? $('#jobSearch_keyword').val() : "NO_KW_INPT"),
                workDuration = $('#jobSearch_workDuration').val(),
                region = $('#jobSearch_region').val(),
                city = $('#jobSearch_city').val(),
                category = $('#jobSearch_category').val(),
                skill = $('#jobSearch_skill').val(),
                orderBy = $('#jobSearch_orderBy').val();

                location.href = "/jobSearch:"+keyword+":"+workDuration+":"+region+":"+city+":"+category+":"+skill+":"+orderBy;
            });
        });
    </script>
@stop

@section('user-name')
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget-container padded">
                    <div class="form-group">
                        <label>Keyword</label>
                        <input value="{{$keyword}}" name="jobSearch_keyword" id="jobSearch_keyword" type="text" placeholder="Enter keyword for title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Work Duration</label>
                        <select id="jobSearch_workDuration" name="jobSearch_workDuration" class="form-control">
                            <option <?php if($workDuration == "ALL"){echo "selected";} ?> value="ALL">All duration</option>
                            <option <?php if($workDuration == "LT6MOS"){echo "selected";} ?> value="LT6MOS">Less than 6 months</option>
                            <option <?php if($workDuration == "GT6MOS"){echo "selected";} ?> value="GT6MOS">Greater than 6 months</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Region</label>
                        <select id="jobSearch_region" name="jobSearch_region" data-loctype="REGION_TO_CITY" class="form-control">
                            <option value="ALL">All regions</option>
                            @foreach($regions as $r)
                                <option <?php if($regionFIELD == $r->regcode){echo "selected";} ?> value="{{$r->regcode}}">{{$r->regname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select id="jobSearch_city" data-loctype="REGION_TO_CITY" name="jobSearch_city" class="form-control">
                            <option value="ALL">All citites</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Skill Category</label>
                        <select id="jobSearch_category" name="jobSearch_category" class="form-control">
                            <option value="ALL">All skill categories</option>
                            @foreach($category as $c)
                                <option <?php if($categoryFIELD == $c->categorycode){echo "selected";} ?> value="{{$c->categorycode}}">{{$c->categoryname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>
                        <select id="jobSearch_skill" name="jobSearch_skill" class="form-control">
                            <option value="ALL">Display all from category</option>
                            @if($skills_OBJECTS)
                                @foreach($skills_OBJECTS as $s)
                                    <option <?php if($skill == $s->itemcode){echo "selected";} ?> value="{{$s->itemcode}}">{{$s->itemname}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Order by</label>
                        <select id="jobSearch_orderBy" name="jobSearch_orderBy" class="form-control">
                            <option <?php if($orderBy == 'ASC'){echo "selected";} ?> value="ASC">Newest first</option>
                            <option <?php if($orderBy == 'DESC'){echo "selected";} ?> value="DESC">Oldest first</option>
                        </select>
                    </div>
                </div>
                <div class="panel-footer">
                    <button id="INIT_JOBSEARCH" class="btn btn-primary btn-block" style="border-radius: 0.3em;">Search</button>
                    <a href="/jobSearch:NO_KW_INPT:ALL:ALL:ALL:ALL:ALL:DESC" class="btn btn-success btn-xs btn-block" style="border-radius: 0.3em;">Show All Jobs</a>
                </div>
            </div>
            <div class="col-md-8">
                @if($jobs->count() == 0)
                    <center><i>No jobs found</i></center>
                @else
                    @foreach($jobs as $job)
                        <div class="widget-container fluid-height padded" style="word-wrap: break-word; padding-left:10px; padding-right:10px; min-height: 50px;">
                            <div style="display:flex;padding-bottom:5px;">
                                <span style="padding:0;margin:0; flex:1">
                                    <img src="{{ $job->profilePic }}" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                </span>
                                <div style="flex:11; padding-left: 5px;">
                                <a href="/jbdtls={{$job->job_id}}" style="text-decoration:none;">
                                    <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                        {{ $job->title}} by {{ $job->fullName }}
                                    </h3>
                                    <div class="row" style="color:#95A5A6;">
                                        <div class="col-md-4">
                                            <span style="padding:0;margin:0;">
                                                <i class="fa fa-briefcase"></i>
                                                @if($job->hiring_type == 'LT6MOS')
                                                    Less than 6 months
                                                @else
                                                    Greater than 6 months
                                                @endif
                                            </span><br>
                                            <span class="text-right" style="padding:0;margin:0;">
                                                <i class="fa fa-clock-o"></i>Ad Expires at {{ date('m/d/y', strtotime($job->expires_at)) }}
                                            </span>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                            <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop