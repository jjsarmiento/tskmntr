@extends('layouts.usermain')


@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container{
            background-color: rgba(245,245,245,0.3);
        }
        .breadcrumb, .panel-heading{
            background-color: rgba(245,245,245,0.7);
        }
        .breadcrumb>li{
            color: white !important;
        }
        a.sidemenu {
            color: white;
        }
        a.sidemenu:hover {
            transition: 0.3s;
            color: #d9d9d9;
            text-decoration: none;
        }
        .col-md-7, .col-md-5{
            color: white;
        }
        /*-----------------*/
    </style>
@stop

@section('title')
    Manage Task Categories and Skills
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
            <div class="col-lg-12 no-padding">
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
            <div class="col-md-8">
                <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                    <table class="table table-striped table-condensed table-hover">
                        <thead>
                            <th>Categories</th>
                            <th>Category Code</th>
                            <th>Skills Qty</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($taskCategory as $c)
                                <tr>
                                    <td>
                                        <a href="/categoryFullDetails={{$c->categorycode}}" id="label_{{$c->categorycode}}" data-label="label_{{$c->categorycode}}">{{$c->categoryname}}</a>
                                        <form method="POST" action="doEditCategory" id="form_{{$c->categorycode}}">
                                            <input type="text" class="form-control" required="required" id="input_{{$c->categorycode}}" name="category_name" value="{{$c->categoryname}}" style="display: none;" />
                                            <input type="hidden" name="category_id" value="{{$c->categorycode}}" />
                                        </form>
                                    </td>
                                    <td>{{$c->categorycode}}</td>
                                    <td>
                                        {{ TaskItem::where('item_categorycode', $c->categorycode)->count() }}
                                    </td>
                                    <td>
                                        {{--SAVE BUTTON--}}
                                        <div id="edit_mode_actions_{{$c->categorycode}}" style="display: none;">
                                            <a href="#"
                                                class="cancel_edit"
                                                data-editdiv="#edit_mode_actions_{{$c->categorycode}}"
                                                data-defaultdiv="#default_actions_{{$c->categorycode}}"
                                                data-label="#label_{{$c->categorycode}}"
                                                data-form="#form_{{$c->categorycode}}"
                                                data-txtfield="#input_{{$c->categorycode}}"
                                            >

                                                <i class="fa fa-close"></i>
                                            </a>
                                        </div>

                                        <div id="default_actions_{{$c->categorycode}}">
                                            <a class="EDIT-CATEGORY"
                                                data-label="#label_{{$c->categorycode}}"
                                                data-form="#form_{{$c->categorycode}}"
                                                data-txtfield="#input_{{$c->categorycode}}"
                                                data-editdiv="#edit_mode_actions_{{$c->categorycode}}"
                                                data-defaultdiv="#default_actions_{{$c->categorycode}}"
                                                href="#" data-href="/editCategory={{$c->categorycode}}
                                            ">
                                                <i class="fa fa-edit" title="Edit category - {{$c->categoryname}}"></i>
                                            </a>
                                            &nbsp;
                                            <a href="#" data-href="/deleteCategory={{$c->categorycode}}" class="a-validate" data-message="Are you sure you want to delete {{$c->categoryname}}">
                                                <i class="fa fa-trash" title="Delete category - {{$c->categoryname}}"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <center>{{$taskCategory->links()}}</center>
                </div>
            </div>
            <div class="col-md-4">
                <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                    <form method="POST" action="doAddCategory">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" type="text" name="category_name" placeholder="Category Name" required="required" />
                        </div>
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section('body-scripts')
<script>
    $(document).ready(function(){
        $('.EDIT-CATEGORY').click(function(){
            $($(this).data('defaultdiv')).toggle();
            $($(this).data('editdiv')).toggle();
            $($(this).data('label')).toggle();
            $($(this).data('txtfield')).toggle();
        });

       $('.cancel_edit').click(function(){
            $($(this).data('editdiv')).toggle();
            $($(this).data('defaultdiv')).toggle();
            $($(this).data('label')).toggle();
            $($(this).data('txtfield')).toggle();
       });

//       $('.do-save').click()
    })
</script>
@stop