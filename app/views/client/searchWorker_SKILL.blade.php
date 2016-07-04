@extends('layouts.usermain')

@section('title')
    Taskminator - Task Search
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
                        <div class="widget-container fluid-height padded">
                            <a href="/{{$user->username}}">{{ $user->fullName }}</a>
                        </div><br/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop