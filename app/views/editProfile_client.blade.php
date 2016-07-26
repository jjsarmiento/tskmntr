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
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    </style>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section style="padding-top:50px;">
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                Edit Profile
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                        After your profile has been activated, you can start looking for tasks!<br/>
                        This could take 24 hours or less.
                    </div>
                </div>
            </div>
            @endif

            <div class="col-lg-12">
                <div class="widget-container fluid-height">
                    <div class="widget-content padded row" style="padding-bottom: 30px">
                        <div class="col-sm-3" style="align-items: center; align-content: center; text-align: center;">
                            <h3 class="lato-text">{{ $user->companyName }}</h3>
                            @if($user->profilePic == null)
                                <div style="border: 1px solid #333333; padding: 0.4em; margin-top: 0.8em;">
                                    {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                    Please upload a profile picture<br/>
                                    <input type="file" name="profilePic" accept="image/*" required="required"/><br/>
                                    <button type="submit">Upload</button>
                                    {{ Form::close() }}
                                </div>
                            @else
                                <div style="width:100%; overflow:hidden; border-radius: 100%;" id="profilePicDiv">
                                    <a href="#" data-toggle="modal" data-target="#newProfilePic"><img src="{{ Auth::user()->profilePic }}" class="portrait" style="width: 100%" /></a>
                                </div>
                                <span style="margin-top: 1em; border-radius: 0.3em; padding : 0.3em; color: #ECF0F1; display: none; background-color: #2C3E50;" id="picNotice">Click to change profile picture</span>
                            @endif
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="heading" style="font-size:14pt; color:#2980b9">
                                        <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>Personal Information <button onclick="location.href='/cltEditPersonalInfo'" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                    </div>
                                    <div style="padding-left: 42px;">
                                        @if(UserHasRole::where('user_id', $user->id)->pluck('role_id') == 3)
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->firstName }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->midName }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->lastName }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Gender</span>
                                             :
                                            <span style="margin-left: 5px">{{ Auth::user()->gender }}</span><br/>
                                        @else
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Company Name</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->companyName }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Business Description</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->businessDescription }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Business Nature</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->businessNature }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Business Permit</span>
                                             :
                                            <span style="margin-left: 5px">{{ $user->businessPermit }}</span><br/>
                                        @endif
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Address</span>
                                         :
                                        <span style="margin-left: 5px">{{ $user->address }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City</span>
                                         :
                                        <span style="margin-left: 5px">{{ City::where('citycode', $user->city)->pluck('cityname') }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Barangay</span>
                                         :
                                        <span style="margin-left: 5px">{{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }}</span><br/>
                                    </div>
                                </div>
                                <div class="col-md-6 well" style="margin-bottom:0;">
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
                                        <a href="#" data-target="#DEACTIVATE-MODAL" data-toggle="modal" class="btn btn-danger btn-xs" style="border-radius: 4px;">Deactivate Account</a>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="heading" style="font-size:14pt; color:#2980b9">
                                        <i class="fa fa-briefcase" style="font-size:14pt; color:#2980b9"></i>
                                        Supporting Documents
                                        <a href="/editDocumentsCMP" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                                    </div>
                                    <div style="">

                                    @foreach($docs as $d)
                                        <i class="fa fa-check" style="color: #2ECC71;"></i>&nbsp;<span style="color: rgb(72, 157, 179); font-size: 1em;">{{$d->sys_doc_label}}</span><br/>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="heading" style="font-size:14pt; color:#2980b9">
                                        <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>
                                        Contact Information
                                        <button onclick="location.href='/cltEditContactInfo'" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                    </div>
                                    <div style="padding-left: 42px">
                                        @foreach($contacts as $contact)
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">
                                                @if($contact->ctype == "mobileNum") Mobile No.
                                                @elseif($contact->ctype == "businessNum") Business No.
                                                @else {{ $contact->ctype }} @endif
                                            </span>
                                             :
                                            <span style="margin-left: 5px">{{ $contact->content }}</span><br/>
                                        @endforeach
                                    </div>
                                </div>
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