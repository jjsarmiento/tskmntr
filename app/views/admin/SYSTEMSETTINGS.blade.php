@extends('layouts.usermain')

@section('title')
    PROVEEK SYSTEM SETTINGS
@stop

@section('user-name')
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
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        System Settings
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget-container">
                    <div class="widget-content">
                        <div class="widget-content">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a class="accordion-toggle">
                                    User Account List</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/admin" class="sidemenu">Pending Users</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Worker</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/UsrAccntLstCMPNY" class="sidemenu">Company</a><br>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a class="accordion-toggle">
                                        Job Ads&nbsp;&nbsp;
                                        <span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">
                                            <i class="fa fa-search"></i> Search
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/showJobAds" class="sidemenu">All Job Ads</a><br>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a class="accordion-toggle">
                                        Audit Trail
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_workers" class="sidemenu">Workers</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_companies" class="sidemenu">Company</a><br>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a class="accordion-toggle">
                                    Category & Skills</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">System Skills</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/customSkills" class="sidemenu">Custom Skills</a><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <form method="POST" action="doSYSTEMSETTINGS">
                    <div class="widget-container" style="min-height: 1em;">
                        <div class="widget-content padded">
                            <div class="row">
                                @foreach($SYS_SETTINGS as $sys)
                                    @if($sys->type == "SYSSETTINGS_POINTSPERAD")
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Ad creation cost (POINTS)</label>
                                                <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_POINTSPERAD" id="SYSSETTINGS_POINTSPERAD" type="text" class="form-control" placeholder="POINTS" />
                                            </div>
                                        </div>
                                    @elseif($sys->type == "SYSSETTINGS_JOBADDURATION")
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Duration of Job Ad after creation (HOURS)</label>
                                                <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_JOBADDURATION" id="SYSSETTINGS_JOBADDURATION" type="text" class="form-control" placeholder="Job ad duration" />
                                            </div>
                                        </div>
                                    @elseif($sys->type == "SYSSETTINGS_CHECKOUTPRICE")
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Checkout Price of Workers (POINTS)</label>
                                                <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_CHECKOUTPRICE" id="SYSSETTINGS_CHECKOUTPRICE" type="text" class="form-control" placeholder="Job ad duration" />
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger" style="border-radius: 0.3em;">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop