@extends('layouts.usermain')

@section('title')
    Taskminator - Task Search
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}

    .block-update-card {
        padding: 0.8em;
      height: 100%;
      border: 1px #FFFFFF solid;
      /*width: 380px;*/
      float: left;
      /*margin-left: 10px;*/
      /*margin-top: 0;*/
      /*padding: 0;*/
      box-shadow: 1px 1px 8px #d8d8d8;
      background-color: #FFFFFF;
    }
    .block-update-card .h-status {
      width: 100%;
      height: 7px;
      background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
    }
    .block-update-card .v-status {
      width: 5px;
      height: 80px;
      float: left;
      margin-right: 5px;
      background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
    }
    .block-update-card .update-card-MDimentions {
      width: 80px;
      height: 80px;
    }
    .block-update-card .update-card-body {
      margin-top: 10px;
      margin-left: 5px;
    }
    .block-update-card .update-card-body h4 {
      color: #737373;
      font-weight: bold;
      /*font-size: 13px;*/
    }
    .block-update-card .update-card-body p {
      color: #737373;
      font-size: 12px;
    }
    .block-update-card .card-action-pellet {
      padding: 5px;
    }
    .block-update-card .card-action-pellet div {
      margin-right: 10px;
      font-size: 15px;
      cursor: pointer;
      color: #dddddd;
    }
    .block-update-card .card-action-pellet div:hover {
      color: #999999;
    }
    .block-update-card .card-bottom-status {
      color: #a9a9aa;
      font-weight: bold;
      font-size: 14px;
      border-top: #e0e0e0 1px solid;
      padding-top: 5px;
      margin: 0px;
    }
    .block-update-card .card-bottom-status:hover {
      background-color: #dd4b39;
      color: #FFFFFF;
      cursor: pointer;
    }

    /*
    Creating a block for social media buttons
    */
    .card-body-social {
      font-size: 30px;
      margin-top: 10px;
    }
    .card-body-social .git {
      color: black;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .twitter {
      color: #19C4FF;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .google-plus {
      color: #DD4B39;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .facebook {
      color: #49649F;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .linkedin {
      color: #007BB6;
      cursor: pointer;
      margin-left: 10px;
    }

    .music-card {
      background-color: green;
    }
</style>
@stop

@section('body-scripts')
    <!-- <script src="/js/jquery-1.11.0.min.js" type="text/javascript"></script> -->
    <script>
        $(document).ready(function(){

            $('#SRCHBTN_SKILL').click(function(){
                var CTGRY = "N",
                    SKLL = "N";

                if($('#taskitems').val() != ''){
                    SKLL = $('#taskitems').val()
                }

                if($('#taskcategory').val() != ''){
                    CTGRY = $('#taskcategory').val()
                }

                location.href="/SRCHWRKRSKLL="+CTGRY+'='+SKLL;
            })


            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'GET',
                    url     :   '/SKILLCATCHAIN='+$('#taskcategory').val(),
//                    data    :   $('#doEditSkillInfo').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    },error :   function(){
                        alert('ERR500 : Please check network connectivity');
                    }
                })
            });

            $('.remove-skill').click(function(){
                if(confirm('Do you really want to remove this skill?')){
                    location.href = $(this).attr('data-href');
                }
            });
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            {{--<h3 style="color: #2980b9">Results for <u>{{ $keyword }}</u></h3>--}}
        </div>
        <div class="row">
            @if(Session::has('error'))
                <div class="col-lg-12">
                    <h4><i class="fa fa-warning" style="color:red"></i> {{ Session::get('error') }}</h4>
                </div>
            @endif
            <div class="col-md-4">
                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                    <div class="form-group">
                        <select name="taskcategory" id="taskcategory" class="form-control">
                            @foreach($categories as $category)
                                <option <?php if($categoryId == $category->categorycode){echo "selected";} ?> value="{{ $category->categorycode }}">{{ $category->categoryname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="taskitems" id="taskitems" class="form-control">
                            @foreach($categorySkills as $skill)
                                <option <?php if($skillId == $skill->itemcode){echo "selected";} ?> value="{{ $skill->itemcode }}">{{ $skill->itemname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary btn-block" id="SRCHBTN_SKILL"><i class="fa fa-search"></i> Search for workers</button>
                </div>
            </div>
            <div class="col-md-8">
                @if($users->count() == 0)
                    <center><i>No data available</i></center>
                @else
                    <h4>{{$users->count()}} result(s) found</h4>
                    @foreach($users as $user)
                        <div class="media block-update-card">
                            <a class="pull-left" href="/{{$user->username}}">
                                @if($user->profilePic)
                                    <img class="media-object update-card-MDimentions" src="{{$user->profilePic}}">
                                @else
                                    <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                @endif
                            </a>
                            <div class="media-body update-card-body">
                                @if(in_array($user->id, $CHECKED_OUT_USERS))
                                    <a href="/{{$user->username}}">
                                        <h4 class="media-heading">
                                            {{$user->fullName}}
                                            <span style="color: #3498db">{{'@'.$user->username}}</span>
                                            <i class="fa fa-check-circle" style="color: #1ABC9C"></i>
                                        </h4>
                                    </a>
                                @else
                                    <a href="/{{$user->username}}">
                                        <h4 class="media-heading">
                                            {{substr_replace($user->firstName, str_repeat('*', strlen($user->firstName)-1), 1)}}
                                            &nbsp;
                                            {{substr_replace($user->lastName, str_repeat('*', strlen($user->lastName)-1), 1)}}
                                            <span style="color: #3498db">{{'@'.$user->username}}</span>
                                        </h4>
                                    </a>
                                @endif
                                <span>{{$user->address}}, {{$user->regname}}, {{$user->cityname}}, {{$user->bgyname}}</span><br>
                                <span><b>Profile Rating: </b>70%</span><br>
                                <span><b>Last login: </b>2 Days ago</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop