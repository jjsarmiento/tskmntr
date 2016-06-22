@extends('layouts.usermain')


@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
    </style>
@stop

@section('title')
    Manage Task Categories and Skills
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/" style="cursor: pointer;"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Manage Task Categories and Skills
                    </li>
                </ul>
            </div>
        </div>
        @if(Session::has('errorm'))
            <span style="color: red">{{ Session::get('errorMsg') }}</span>
        @elseif(Session::has('succmsg'))
            <span style="color: green">{{ Session::get('successMsg') }}</span>
        @endif
        <br/>
        <div class="row">
            <div class="col-md-6 well">
                <div style="overflow: scroll; max-height: 30em; overflow-x: hidden;">
                    @foreach($taskCategory as $tc)
                        <span style="font-weight: bolder; font-size: 1.3em;">{{ $tc->categoryname }} <a data-categorycode="{{$tc->categorycode}}" href="#" class="deleteCategory"><i class="fa fa-close"></i></a>:<br/></span>
                        <ul>
                            @foreach(TaskItem::where('item_categorycode', $tc->categorycode)->orderBy('id', 'ASC')->get() as $ti)
                                <li>{{ $ti->itemname }} <a data-itemname="{{$ti->itemname}}" data-skillcode="{{$ti->itemcode}}" href="#" class="deleteSkill"><i class="fa fa-close"></i></a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">
                        Add New Skill
                        <form method="POST" action="/newSkill">
                            <div class="form-group">
                                <select class="form-control newSkill" id="category" name="category" >
                                    @foreach($taskCategory as $tc)
                                        <option value="{{ $tc->categorycode }}">{{ $tc->categoryname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="newSkillInput" name="newSkillInput" placeholder="enter new skill here" required="required"/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        Add New Category
                        <form method="POST" action="/newCategory">
                            <div class="form-group">
                                <input class="form-control" type="text" id="newCategoryInput" name="newCategoryInput" placeholder="enter new skill here" required="required" />
                            </div>
                            <div class="form-group pull-right">
                                <button type="submit" class="newCategory btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section('body-scripts')
<script>
    $(document).ready(function(){
        $('.deleteCategory').click(function(){
            if(confirm('If you delete this category, all the skills related to it will also be deleted. Do you want to proceed?')){
                location.href = '/deleteCategory='+$(this).data('categorycode');
            }
        });

        $('.deleteSkill').click(function(){
            if(confirm('Please confirm the deleteion of the skill '+$(this).data('itemname'))){
                location.href = '/deleteSkill='+$(this).data('skillcode');
            }
        });
    })
</script>
@stop