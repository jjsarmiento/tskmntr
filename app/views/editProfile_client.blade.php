@extends('layouts.usermain')

@section('title')
    Edit your profile
@stop

@section('head-content')
    <style>
        i{cursor:default !important;}
        body{background-color:#E9EAED;}
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
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
        .form-control {
            padding:5px !important;
        }
        .btn {
            border-radius:3px;
            transition: 0.3s;
        }
        .btn-default {
            border-color: #ededed;
            color: #fff;
            background-color: #2980b9;
        }
        button.btn.btn-xs.btn-default.pull-right {
            border: 1px solid;
        }        
        .btn-default:hover{
            color: #2980b9;
            background-color:#fff;
            border-color: none !important;
        }
        a.btn.btn-danger.btn-xs:hover {
            color: #c9302c;
            background-color: transparent;          
        }
        .thumbnail{
            border-radius: 360px;
            width: 150px;
            height: 150px;
            margin: auto;     
        }
        button.btn.btn-success:hover{
            background: transparent;
            color: #5cb85c;
        }
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
        @media (max-width: 768px) {
            .col-md-9.bord{
                border: none !important;
            }
            .row.padded.bord{
                border-bottom: 1px solid #cdcdcd;
            }
        } 
        span#picNotice {
            margin-top: 55px;
            position: absolute;
            left: 0%;
            top: 0%;
        }   
        /*margin-top: 1em; border-radius: 0.3em; padding : 0.3em; color: #ECF0F1; background-color: #2C3E50;*/
    </style>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section style="padding-top:50px;">
    <div class="container lato-text">
        <div class="page-title" style="border-radius: 3px;">
            <h1 class="lato-text">
                Edit Profile
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li style="cursor:pointer !important;">
                        <a href="/" ><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Edit Profile
                    </li>
                </ul>
            </div>
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

            @if($user->status == 'PRE_ACTIVATED')
            <div class="col-sm-12">
                <div class="alert alert-warning">
                    <div>
                        Your profile is being reviewed by our staff.<br/>
                        After your profile has been activated, you can start posting job ads or search for workers<br/>
                        This could take 24 hours or less.
                    </div>
                </div>
            </div>
            @endif
        </div>

            <div class="col-md-12" style="background-color:white; border-radius:3px;">

                <div class="col-md-3 container lato-text padded">
                    <div class="row padded" style="border-bottom: 1px solid #cdcdcd; text-align: center;">
                        <!-- <div class="thumbnail">
                            @if($user->profilePic == null)
                                <div style="padding: 0.4em; margin-top: 0.8em;">
                                    {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                    Please upload a profile picture<br/>
                                    <input type="file" name="profilePic" accept="image/*" required="required"/><br/>
                                    <button type="submit">Upload</button>
                                    {{ Form::close() }}
                                </div>
                            @else
                                <div style="width:100%; overflow:hidden; border-radius: 100%;" id="profilePicDiv">
                                    <a href="#" data-toggle="modal" data-target="#newProfilePic"><img src="{{ Auth::user()->profilePic }}" class="portrait" style="width: 100%" /></a>
                                    <span style="display:none;" id="picNotice">Click to change profile picture</span>
                                </div>
                            @endif
                        </div> -->

                        @if(Auth::user()->profilePic == null)
                            <div class="thumbnail">
                                @if(Auth::user()->profilePic)
                                    <img src="{{ Auth::user()->profilePic }}" class="portrait"/><br>
                                @else
                                    <img src="/images/default_profile_pic.png"/><br>
                                @endif
                            </div>
                            <h3 class="lato-text" style="margin-top:0px;">{{ $user->fullName }}</h3>

                            <div class="heading" style="margin-bottom: 15px;">
                                <i class="icon-signal"></i>Please upload a profile picture
                            </div>

                            <div class="widget-content" style="width: 236px;">
                                {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                    <input type="file" name="profilePic" accept="image/*" class="form-control" /><br/>
                                    <button type="submit" class="btn btn-success" style="border: 1px solid #5cb85c;">Upload</button>
                                {{ Form::close() }}
                            </div>
                        @else
                            <div class="widget-content padded">
                                <div class="thumbnail">
                                    <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                                </div>
                                <div class="heading">
                                    <i class="glyphicon glyphicon-user"></i>{{ Auth::user()->fullName }}
                                </div>
                            </div>
                        @endif

                        <h3 class="lato-text">{{ $user->companyName }}</h3>
                    </div>
                    <div class="row padded bord">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                           <i class="fa fa-file-text-o" style="font-size:14pt; color:#2980b9"></i>&nbsp License <button class="btn btn-xs btn-default pull-right" onclick="#" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                        </div>  
                        <span>N/A</span>
                    </div>

                </div>

                <div class="col-md-9 bord" style="border-left: 1px solid #cdcdcd;">
                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt; color:#2980b9; word-wrap: break-word;">
                                    <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>Personal Information <button onclick="location.href='/cltEditPersonalInfo'" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                </div>
                                <div style="padding-left: 19px; word-wrap: break-word;">
                                    <span><b>Company Name: </b>{{ $user->companyName }}</span><br>
                                    <span><b>Business Description: </b>{{ $user->businessDescription }}</span><br>
                                    <span><b>Business Nature: </b>{{ $user->businessNature }}</span><br>
                                    <span><b>Business Permit: </b>{{ $user->businessPermit }}</span><br>
                                    <span><b>Address: </b>{{ $user->address }} {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }} {{ City::where('citycode', $user->city)->pluck('cityname') }}</span><br>
                                    <span><b>Years in Operation: </b></span><br>
                                    <span><b>Company Size: </b></span>
                                </div>
                            </div>  
                            <div class="col-md-6 well">
                                <div class="heading" style="font-size:14pt; color:#2980b9; background:none;">
                                        <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>Account Information
                                </div>
                                <div style="padding-left: 30px;" style="display:table">
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Username</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                        <span style="display:table-cell">{{ Auth::user()->username }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Password</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                        <span style="display:table-cell">******</span>
                                    </div>
                                    <br/>
                                    <a href="#" data-target="#CHNGPSS-MODAL" data-toggle="modal" class="btn btn-primary btn-xs" style="border-radius: 4px; border:1px solid #2980b9">Change password</a><Br/>
                                    <a href="#" data-target="#DEACTIVATE-MODAL" data-toggle="modal" class="btn btn-danger btn-xs" style="border-radius: 4px; border: 1px solid #d9534f;">Deactivate Account</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 padded" style="border-bottom: 1px solid #cdcdcd;">
                            <div class="col-md-6 padded">
                                <div class="heading" style="font-size:14pt; color:#2980b9">
                                    <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>
                                    Contact Information
                                    <button onclick="location.href='/cltEditContactInfo'" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                </div>
                                <div style="padding-left: 23px">
                                    @foreach($contacts as $contact)
                                        <span style="text-transform: capitalize; font-weight: 600; margin-right: 5px;">
                                            @if($contact->ctype == "businessNum") Business No
                                            @else {{ $contact->ctype }} @endif
                                        </span>
                                         :
                                        <span style="margin-left: 5px">{{ $contact->content }}</span><br/>
                                    @endforeach

                                    <span><b>Facebook: </b><a href="#"> </a>N/A</span><br>
                                    <span><b>Twitter: </b><a href="#"> </a>N/A</span><br>
                                    <span><b>Linkedin: </b><a href="#"> </a>N/A</span>
                                </div>
                            </div>

                            <div class="col-md-6 padded">
                                <div class="heading" style="font-size:14pt; color:#2980b9">
                                    <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>
                                    Key Contact Person
                                    <button onclick="#" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                </div>
                                <div style="padding-left: 23px">
                                    <span><b>Name: </b></span><br>
                                    <span><b>Position: </b></span><br>
                                    <span style="text-transform: capitalize; font-weight: 600; margin-right: 5px;">
                                         @if($contact->ctype == "mobileNum") Contact No :
                                         @endif
                                    </span>
                                    <span style="margin-left: 5px">{{ $contact->content }}</span><br/>
                                    <span><b>Email: </b></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 padded">
                            <div class="col-md-12">
                                <div class="heading" style="font-size:14pt; color:#2980b9; word-wrap: break-word;">
                                    <i class="fa fa-sticky-note" style="font-size:14pt; color:#2980b9"></i>&nbsp Supporting Documents<a href="/editDocumentsCMP" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                                </div>
                                <div style="padding-left: 19px; word-wrap: break-word;">
                                    @if($docs->count() > 0)
                                        @foreach($docs as $d)
                                            <i class="fa fa-check-circle" style="color: #2ECC71;"></i>&nbsp;<span style="color: rgb(72, 157, 179);">{{$d->sys_doc_label}}</span><br/>
                                        @endforeach
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<!--    MODAL-->

{{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
    <div class="modal fade" id="newProfilePic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload new profile picture</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 0;">
                        Please upload a profile picture<br/>
                        <input type="file" name="profilePic" accept="image/*" required="required"/><br/>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 0.8em;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#profilePicDiv').hover(function(){
                $('#picNotice').fadeToggle('fast');
            })
        })
    </script>
@stop