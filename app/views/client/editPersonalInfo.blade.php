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
            <div class="page-title">
                <h1 class="lato-text">
                    Edit Company Information
                </h1>
            </div>
            <div class="row">
                {{--<div class="col-lg-12">--}}
                    {{--<ul class="breadcrumb">--}}
                        {{--<li>--}}
                            {{--<a href="/"><i class="fa fa-home"></i></a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="/editProfile">Edit Profile</a>--}}
                        {{--</li>--}}
                        {{--<li class="active">--}}
                            {{--Edit Personal Information--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}

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

                <div class="col-md-8" style="background-color: white; padding: 2.5em;">
                    {{--<div class="widget-container" style="padding-bottom: 5px; padding-top: 20px;">--}}
                        {{--<div class="widget-content padded">--}}
                           <form method="POST" action="{{$formUrl}}" id="editPersonalInfo">
                               @if(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') == 4)
                                    <div class="col-md-3">
                                        Company Name
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $user->companyName }}" name="companyName" required="required"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Business Nature
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $user->businessNature }}" name="businessNature" required="required"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Business Permit
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" value="{{ $user->businessPermit }}" name="businessPermit" required="required"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Business Description
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5" name="businessDescription" required="required">{{ $user->businessDescription }}</textarea><br/>
                                    </div>
                               @else
                                    <div class="col-md-3">
                                        First Name
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" value="{{ $user->firstName }}" name="firstName" required="required"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Middle Name
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" value="{{ $user->midName }}" name="midName"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Last Name
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" value="{{ $user->lastName }}" name="lastName" required="required"/><br/>
                                    </div>
                                    <div class="col-md-3">
                                        Gender
                                    </div>
                                    <div class="col-md-9">
                                        <select name="gender" class="form-control">
                                           <option value="FEMALE" <?php if($user->gender == 'FEMALE'){ echo('selected'); } ?>>Female</option>
                                           <option value="MALE" <?php if($user->gender == 'MALE'){ echo('selected'); } ?>>Male</option>
                                       </select><br/>
                                    </div>
                               @endif
                               <div class="col-md-3">
                                       Street
                                   </div>
                                   <div class="col-md-9">
                                       <input class="form-control" type="text" value="{{ $user->address }}" name="address" required="required"/><br/>
                                   </div>
                                   <div class="col-md-3">
                                       Region
                                   </div>
                                   <div class="col-md-9">
                                       <select name="reg-task" id="reg-task" class="form-control" required="required">
                                           <option value="">Please Select your region</option>
                                           @foreach($regions as $region)
                                               <option value="{{$region->regcode}}" <?php if($region->regcode == $user->region){ echo('selected'); } ?> >{{ $region->regname }}</option>
                                           @endforeach
                                       </select><br/>
                                   </div>
                                   <div class="col-md-3">
                                       City
                                   </div>
                                   <div class="col-md-9">
                                       <select disabled name="city-comp" id="city" required="required" class="form-control">
                                           @foreach($cities as $city)
                                              <option class="city-value-{{$city->regcode}}" value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
                                          @endforeach
                                       </select><br/>
                                   </div>
                                   <div class="col-md-3">
                                       Barangay
                                   </div>
                                   <div class="col-md-9">
                                       <select disabled class="form-control" required="required" name="barangay-comp" id="barangay">
                                          @foreach($barangays as $bgy)
                                          <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
                                          @endforeach
                                      </select><br/>
                                   </div>
                                <div class="text-right padded"><button type="submit" class="btn btn-primary">Edit</button></div>
                           </form>
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>
                   <form method="POST" action="{{$formUrl}}" id="editPersonalInfo">
                       Address : <input type="text" value="{{ $user->address }}" name="address" required="required"/><br/>
                       City : <select name="city-comp" id="city">
                           @foreach($cities as $city)
                           <option value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
                           @endforeach
                       </select><br/>
                       Barangay : <select name="barangay-comp" id="barangay">
                           @foreach($barangays as $bgy)
                           <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
                           @endforeach
                       </select><br/>
                       <button type="submit">Edit</button>
                   </form>
@stop

