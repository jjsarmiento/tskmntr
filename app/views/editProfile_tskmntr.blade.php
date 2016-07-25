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
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
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

            <div class="col-lg-12 padded" style="background-color:white; border-radius:8px;" >
                <div class="col-lg-3" style="align-items: center; align-content: center; text-align: center;">
                    <h3 class="lato-text">{{ $user->fullName }}</h3>
                    <!--
                    @if($user->profilePic == null)
                        <div style="border: 1px solid #333333;">
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
                        <span style="margin-top: 1em; border-radius: 0.3em; padding : 0.3em; color: #ECF0F1; display:none; background-color: #2C3E50;" id="picNotice">Click to change profile picture</span>
                    @endif
                    -->

                    <div class="widget-container small">
                        @if(Auth::user()->profilePic == null)
                            <div class="heading">
                                <i class="icon-signal"></i>Please upload a profile picture
                            </div>
                            <div class="widget-content padded">
                                {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                    <input type="file" name="profilePic" accept="image/*" class="form-control" /><br/>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                {{ Form::close() }}
                            </div>
                        @else
                            <div class="widget-content padded">
                                <div class="heading">
                                    <i class="glyphicon glyphicon-user"></i>{{ Auth::user()->fullName }}
                                </div>
                                <div class="thumbnail">
                                    <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Personal Information <button onclick="location.href='/editPersonalInfo'" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>
                            <div style="padding-left: 30px;" style="display:table">
                                <div style="display:table-row;">
                                    <span style="display:table-cell;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell;">{{ $user->firstName }}</span>
                                </div>
                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ $user->midName }}</span>
                                </div>
                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ $user->lastName }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Region</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Region::where('regcode', $user->region)->pluck('regname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Province</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Province::where('provcode', $user->province)->pluck('provname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ City::where('citycode', $user->city)->pluck('cityname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Barangay</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Gender</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                    <span style="display:table-cell">{{ Auth::user()->gender }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 well" style="margin-bottom:0;">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Account Information
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
                                <a href="#" data-target="#CHNGPSS-MODAL" data-toggle="modal" class="btn btn-primary btn-xs" style="border-radius: 4px; border:1px solid #2980b9">Change password</a><br/>
                                <a href="#" data-target="#DEACTIVATE-MODAL" data-toggle="modal" class="btn btn-danger btn-xs" style="border-radius: 4px;">Deactivate Account</a>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="heading" style="font-size:14pt; color:#2980b9">
                        <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editContactInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                    </div>
                    <div style="padding-left: 30px;">
                        @foreach(Contact::where('user_id', $user->id)->get() as $con)
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">
                                @if($con->ctype == "mobileNum") Mobile No.
                                @elseif($con->ctype == "businessNum") Business No.
                                @else {{ $con->ctype }} @endif
                            </span>
                             :
                            <span style="margin-left: 5px">{{ $con->content }}</span>
                            @if($con->ctype == "mobileNum")
                                @if(Contact::where('user_id',  Auth::user()->id)->pluck('pincode')!='verified')
                                    {{--<button class="btn btn-xs btn-primary" onclick="location.href='/doVerifyMobileNumber'" style="padding: 2px 10px 2px 10px; margin: 5px; text-transform: none;">Verify</button>--}}
                                @else
                                    {{--<span class="btn btn-xs btn-default" style=" margin: 5px;">Verified</span>--}}
                                @endif
                            @endif
                            <br/>
                        @endforeach
                    </div>
                    <hr/>
                    <div class="heading" style="font-size:14pt; color:#2980b9">
                        <i class="glyphicon glyphicon-star" style="font-size:14pt; color:#2980b9"></i>&nbsp Skills <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editSkillInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                    </div>
                    <div style="padding-left: 30px;">
                        @foreach(User::getSkills(Auth::user()->id) as $skill)
                            <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                        @endforeach
                        @foreach($customSkills as $cs)
                            <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $cs->skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--MODAL-->
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
                        <button type="submit">Upload</button>
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