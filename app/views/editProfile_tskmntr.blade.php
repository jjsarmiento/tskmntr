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
    </style>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section style="padding-top:50px;">
    <div class="container lato-text">
        <div class="page-title" style="border-radius:3px;">
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
        </div>
        <div clsss="row">
            <div class="col-md-12" style="background-color:white; border-radius:3px;">
                <div class="col-md-3 container lato-text padded">
                    <div class="row padded" style="border-bottom: 1px solid #cdcdcd;">
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
                    </div>
                    <div class="row padded bord">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                           <i class="fa fa-certificate" style="font-size:14pt; color:#2980b9"></i>&nbsp Certification <button class="btn btn-xs btn-default pull-right" onclick="#" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                        </div>  
                        <span>N/A</span>
                    </div>

                </div>

                <div class="col-md-9 bord" style="border-left: 1px solid #cdcdcd;">
                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-sm-6 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Personal Information <button onclick="location.href='/editPersonalInfo'" class="btn btn-xs btn-default pull-right border: 1px solid #2980b9;" style="padding: 2px 10px 2px 10px; text-transform: none; border: 1px solid #2980b9;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>   
                            <div class="col-md-12" style="padding-left: 27px;">
                                <span><b>Name: </b>{{ $user->firstName }} {{ $user->midName }} {{ $user->lastName }}</span><br>
                                <!-- <span><b>Region: </b>{{ Region::where('regcode', $user->region)->pluck('regname') }}</span><br>
                                <span><b>Province: </b>{{ Province::where('provcode', $user->province)->pluck('provname') }}</span><br>
                                <span><b>City: </b>{{ City::where('citycode', $user->city)->pluck('cityname') }}</span><br>
                                <span><b>Barangay: </b>{{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }}</span> -->

                                <span><b>Birthdate: </b></span><br>
                                <span><b>Age: </b></span><br>
                                <span><b>Gender: </b>{{ Auth::user()->gender }}</span><br>
                                <span><b>Marital Status: </b></span><br>
                                <span ><b>Address: </b>Blk # Lt # Streetname Subdname{{ Region::where('regcode', $user->region)->pluck('regname') }} {{ Province::where('provcode', $user->province)->pluck('provname') }} {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }} {{ City::where('citycode', $user->city)->pluck('cityname') }}</span><br>
                                <span><b>Account Created: </b></span>
                            </div>     
                        </div>
                        <div class="col-sm-6 padded">
                            <div class="col-md-12 well" style="margin-bottom:0;">
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
                                    <a href="#" data-target="#DEACTIVATE-MODAL" data-toggle="modal" class="btn btn-danger btn-xs" style="border-radius: 4px; border: 1px solid #d9534f; ">Deactivate Account</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-graduation-cap" style="font-size:14pt; color:#2980b9"></i>&nbsp Educational Background <button class="btn btn-xs btn-default pull-right" onclick="#" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div> 
                            <div style="padding-left:27px;">
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
                            </div>      
                        </div>

                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-6 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editContactInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>       
                            <div style="padding-left: 27px;">
                                @foreach(Contact::where('user_id', $user->id)->get() as $con)
                                    <span style="text-transform: capitalize; font-weight:600; margin-right: 5px;">
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
                        </div>

                        <div class="col-md-6 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                               <i class="fa fa-lightbulb-o" style="font-size:14pt; color:#2980b9"></i>&nbsp Experience <button class="btn btn-xs btn-default pull-right" onclick="#'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>                                   
                            N/A
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-star" style="font-size:14pt; color:#2980b9"></i>&nbsp Skills <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editSkillInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div> 
                            <div style="padding-left:27px;">
                                @foreach(User::getSkills(Auth::user()->id) as $skill)
                                    <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                                @endforeach
                                @foreach($customSkills as $cs)
                                    <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $cs->skill }}</span>
                                @endforeach
                            </div>      
                        </div>
                    </div>

                    <div class="row" style="">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-file" style="font-size:14pt; color:#2980b9"></i>&nbsp Supporting Documents
                                <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editDocuments'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div> 
                            <div style="padding-left:27px;">
                                <span>N/A</span>
                                @foreach($docs as $d)
                                    <i class="fa fa-check" style="color: #2ECC71;"></i>&nbsp;<span style="color: rgb(72, 157, 179); font-size: 0.8em;">{{$d->sys_doc_label}}</span><br/>
                                @endforeach
                            </div>      
                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
</section>


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