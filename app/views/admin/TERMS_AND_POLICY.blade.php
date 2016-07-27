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
    <script>
        $(document).ready(function() {
            $('.DELETE_DOC_BTN').click(function(){
                if(confirm('Do you really want to delete this document type? ALL DOCUMENT IN RELATION WILL ALSO BE DELETED')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
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
                        <a href="/SYSTEMSETTINGS">System Settings</a>
                    </li>
                    <li>
                        Terms of Service and Policy Documents
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="widget-container stats-container" style="display:block !important;">
                    <div class="col-lg-6 lato-text">
                        <a id="APPLICANTSLINK" href="/WORKERDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Worker Doc Types
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-6 lato-text">
                        <a id="INVITEDSLINK" href="/COMPANYDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Company Doc Types
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop