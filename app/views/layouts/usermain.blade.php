<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8 w/o DOM">
	<title>@yield('title')</title>
	<!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css"> -->
    

    <!-- Custom Fonts -->
<!--     <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'> -->

    <!-- Plugin CSS -->
    
    <!-- <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css"> -->

    <!-- Custom CSS -->
<!--     <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/isotope.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/jquery.fancybox.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/fullcalendar.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/fullcalendar.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/select2.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/morris.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/datatables.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/datepicker.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/timepicker.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/colorpicker.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/bootstrap-switch.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/daterange-picker.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/typeahead.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/summernote.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/pygments.css" type="text/css"> -->

    {{ HTML::style('frontend/css/bootstrap.min.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic') }}
    {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('https://fonts.googleapis.com/css?family=Lato:300') }}

    {{ HTML::style('frontend/css/animate.min.css') }}

    {{ HTML::style('frontend/css/creative.css') }}
    {{ HTML::style('frontend/css/vegas.css') }}
    {{ HTML::style('frontend/css/custom.css') }}

    {{ HTML::style('stylesheets/isotope.css') }}
    {{ HTML::style('stylesheets/jquery.fancybox.css') }}
    {{ HTML::style('stylesheets/fullcalendar.css') }}
    {{ HTML::style('stylesheets/wizard.css') }}
    {{ HTML::style('stylesheets/select2.css') }}
    {{ HTML::style('stylesheets/morris.css') }}
    {{ HTML::style('stylesheets/datatables.css') }}
    {{ HTML::style('stylesheets/datepicker.css') }}
    {{ HTML::style('stylesheets/timepicker.css') }}
    {{ HTML::style('stylesheets/colorpicker.css') }}
    {{ HTML::style('stylesheets/bootstrap-switch.css') }}
    {{ HTML::style('stylesheets/daterange-picker.css') }}
    {{ HTML::style('stylesheets/typeahead.css') }}
    {{ HTML::style('stylesheets/summernote.css') }}
    {{ HTML::style('stylesheets/pygments.css') }}

    {{ HTML::script('frontend/js/jquery.js') }}
    {{ HTML::script('js/taskminator.js') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">
    <script>
        $(document).ready(function(){

            CHAINLOCATION($('#adSearch_REG'), $('#adSearch_CITY'));
            CHAINCATEGORYANDSKILL($('#adSearch_CATEGORY'), $('#adSearch_SKILL'));

            $('#adSearch_BTN').click(function(){
                var keyword = ($('#adSearch_KEYWORD').val() ? $('#adSearch_KEYWORD').val() : "NONE"),
                    region = $('#adSearch_REG').val(),
                    city = $('#adSearch_CITY').val(),
                    duration = $('#adSearch_DUR').val(),
                    orderBy = $('#orderBy').val(),
                    category = $('#adSearch_CATEGORY').val(),
                    skill = $('#adSearch_SKILL').val(),
                    customSkill = ($('#adSearch_CUSTSKILL').val() ? $('#adSearch_CUSTSKILL').val() : "NONE");

                location.href = "/ADMINJbSrch:"+keyword+":"+region+":"+city+":"+duration+":"+orderBy+":"+category+":"+skill+":"+customSkill;
            });

            $('.srchAnim').keyup(function(e){
                if(e.keyCode == 13){
                    var searchParam = ($(this).val() ? $(this).val() : "NONE");
                    location.href = $(this).data('url')+''+searchParam;
                }
            });

            $('.SHWCRT').click(function(){
                $('#MAINCARTBODY').hide();
                $('#CARTLOADING').show();
                $('#CARTCONTENTS').empty();
                $.ajax({
                    type    :   'GET',
                    url     :   '/GET_CART_CONTENTS',
                    success :   function(data) {
                        var totalPrice = 20 * (data.length);
                        var pointsLeft = parseFloat($('#CRT_PTSLEFT').data('ptsleft')) - totalPrice;

                        $('#CRT_QTY').empty().append(data.length);
                        $('#CRT_TOTAL').empty();
                        $('#CHECKOUTFORM').empty();
                        $.each(data, function(key,value){
                            $('#CARTCONTENTS').append('<a class="CART-ITEMS" href="/'+value['username']+'" target="_tab">'+value['fullName']+'</a>&nbsp;&nbsp;<a href="/removeCartItem:'+value['cartID']+'"><i class="fa fa-close"></i></a><br/>');
                            $('#CHECKOUTFORM').append('<input type="hidden" name="WORKERID[]" value="'+value['workerID']+'" />')
                        });
                        $('#CRT_TOTAL').empty().append(totalPrice);
                        $('#CRT_PTSLEFT').empty().append(pointsLeft);
                        $('#CARTLOADING').hide();
                        $('#MAINCARTBODY').show();

                        if(data.length == 0){
                            $('#CHECKOUTBTN').prop('disabled', true);
                                $('#CART-WARNING').hide();
                        }else{
                            if(totalPrice > pointsLeft){
                                $('#CHECKOUTBTN').prop('disabled', true);
                                $('#CART-WARNING').show();
                            }else{
                                $('#CHECKOUTBTN').prop('disabled', false);
                                $('#CART-WARNING').hide();
                            }
                        }

                        INITLISTENER();
                    }
                })
            });
        });

        function INITLISTENER(){
            $('.CART-ITEMS').click(function(){
                alert('FUCK');
            });
        }
    </script>
    <style type="text/css">
        .lato-text { font-family: 'Lato', sans-serif}
        /*section{padding:0px 0px;}*/

        .srchAnim
        {
            width: 200px !important;
        }
        .srchAnim:focus
        {
            widtH: 400px !important;
        }

        .hrLine
        {
            background:#ccc;
            max-width:100%;
            border:none;
            height:1px;
            max-height:1px;
        }

    </style>
    @yield('head-content')
</head>
<body id="page-top">
<!-- NAVIGATION MASTER USER LAYOUT -->
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top affix" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navCollapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll logoImg" href="/" style="padding:0; margin:0;"></a>
            </div>
            
            <?php $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.user_id', Auth::user()->id)
            ->pluck('role'); ?>
    <!-- FOR SEARCH ON THE NAVIGATION BAR -->
        <!-- ADMIN -->
            @if ($role == 'ADMIN')
            <div class="col-sm-3 col-md-3 pull-left">
                {{ Form::open(array('method' => 'GET', 'url' => 'adminDoSearch', 'class' => 'navbar-form')) }}
                    <div class="input-group">
                        <input type="text" class="form-control input-trans srchAnim" placeholder="Search" required name="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        <!-- END OF ADMIN -->
        <!-- TASKMINATOR / WORKERS -->
            @elseif($role == 'TASKMINATOR')
                @if(@$TOTALPROG >= 50)
                    <div class="col-sm-3 col-md-3 pull-left navbar-form">
                        <div class="input-group">
                            <input type="text" data-url="/WSRCH=" class="form-control input-trans srchAnim" placeholder="Search for companies" required name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                @endif
        <!-- END OF TASKMINATOR / WORKER -->
        <!-- EMPLOYERS / COMPANIES -->
            @elseif($role == 'CLIENT_IND' || $role == 'CLIENT_CMP')
                {{--@if(@$total_prog >= 50)--}}
                    {{--<div class="col-sm-3 col-md-3 pull-left navbar-form">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" data-url="/CISRCH/{{@$total_prog}}=" value="{{@$keyword}}" class="form-control input-trans srchAnim" placeholder="Search for workers / preffered skills" required name="search">--}}
                            {{--<div class="input-group-btn">--}}
                                {{--<button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            @endif
        <!-- END OF EMPLOYER / COMPANIES -->
    <!-- END OF SEARCH FOR NAV BAR -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navCollapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background:transparent; font-size: 14pt;">
                            <i class="fa fa-bell fa-fw"></i><span class="visible-xs-inline hidden-sm hidden-md" style="text-transform:none; font-size:11pt;">Notification</span>
                        </a>
                        <div class="notifPane-sm dropdown-menu" style="">
                            <div class="text-center" style="display:block; height:40px; border-bottom:1px solid #ccc; margin:0; padding: 10px 0 10px 0;">Notifications</div>
                            <div id="notifPane" class="list-group" style="overflow:auto; height:315px; width:100%; text-align:left;">
                                <p class="list-group-item"><i class="fa fa-phone fa-fw text-primary"></i>&nbsp; +(63) 949-554-8249</p>
                                <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw text-primary"></i>&nbsp; Like our page on Facebook for more updates and announcements.</a>
                                <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw text-primary"></i>&nbsp; Follow our Twitter page for more updates and news about us.</a>
                                <p class="list-group-item"><i class="fa fa-phone fa-fw text-primary"></i>&nbsp; Icons will need a basis to use as the standard icons for every type of notification.</p>
                                <p class="list-group-item"><i class="fa fa-thumbs-up fa-fw text-primary"></i>&nbsp; Proveek Inc. follows you. Follow back now.</p>
                                <p class="list-group-item"><i class="fa fa-phone fa-fw text-primary"></i>&nbsp; +(63) 949-554-8249</p>
                                <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw text-primary"></i>&nbsp; Follow our Instagram to witness the success of our customers.</a>
                                <p class="list-group-item"><i class="fa fa-heart fa-fw text-primary"></i>&nbsp; Some liked your page and follows your page. Would you like to love her?</p>
                            </div>
                            <div class="text-center" style="display:block; width:100%; position:absolute; bottom:0;">
                                <a class="link-default-light" href="#" style="height:40px; text-decoration:none; width:100%; padding: 8px 0 8px 0;">See all notifications</a>
                            </div>
                        </div>
                    </li> -->
                    <li class="dropdown messages hidden-xs">

                        <a id="notificationLink" class="dropdown-toggle" data-toggle="dropdown" href="#" style="background:transparent; font-size: 14pt;">
                            <i class="fa fa-bell fa-fw"></i><span class="visible-xs-inline hidden-sm hidden-md" style="text-transform:none; font-size:11pt;">Notification</span>
                        </a>
                        <div class="sr-only">
                            Notifications
                        </div>
                        <div class="fb-bar">
                          <div id="notif-icon" class="notif-icon">
                              @if(User::getNotif()->count() > 0)
                                <id id="notification_count" style="">{{ User::getNotif()->count() }}</id>
                              @else
                                  <id id="notification_count" style="display: none;"></id>
                              @endif
                            <!--<span id="notification_count">3</span>-->
                          </div>
                        </div>
                        <div id="notificationContainer" class="messages">
                        <div id="notificationTitle">Notifications</div>
                        <div id="notificationsBody" class="notifications">
                            <ul class="dropdown-msg">
                            @if(User::getNotif()->count() > 0)
                                @foreach(User::getNotif() as $notif)
                                  <li onclick="location.href='{{$notif->notif_url}}'">
                                      <a href="{{$notif->notif_url}}">
                                          {{ $notif->content }}
                                      </a>
                                  </li>
                                @endforeach
                            @else
                                <center><i>You have no notifications yet</i></center>
                            @endif
                            </ul>
                        </div>
                        <div id="notificationFooter"><a href="/showAllNotif" onclick="location.href='/showAllNotif'">See All</a></div>
                        </div>
                    </li>

                    <li>
                        <a href="/messages" style="background:transparent; font-size: 14pt;">
                            <i class="fa fa-comment fa-fw"></i><span class="visible-xs-inline hidden-sm hidden-md" style="text-transform:none; font-size:11pt;">Message</span>
                        </a>
                    </li>
                    @if(User::GETROLE(Auth::user()->id) == 'CLIENT_CMP' || User::GETROLE(Auth::user()->id) == 'CLIENT_IND')
                        <li>
                            <a href="#" style="background:transparent; font-size: 14pt;" class="SHWCRT" data-target="#CARTMODAL" data-toggle="modal">
                                <i class="fa fa-shopping-cart fa-fw"></i>
                                <span class="visible-xs-inline hidden-sm hidden-md" style="text-transform:none; font-size:11pt;">{{User::GETROLE(Auth::user()->id)}}</span>
                            </a>
                            @if(Cart::where('company_id', Auth::user()->id)->count() != 0)
                                <div class="fb-bar">
                                    <div id="notif-icon" class="notif-icon">
                                        <id id="notification_count">{{Cart::where('company_id', Auth::user()->id)->count()}}</id>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/')."/".Auth::user()->username }}" class="user lato-text" style="display:inline-block; padding-right:0;">
                            @if(Auth::user()->profilePic)
                                <img style="width:24px; height:24px; border-radius:100%;" src="{{ Auth::user()->profilePic }}" />
                            @else
                                <img style="width:24px; height:24px; border-radius:100%;" src="/images/default_profile_pic.png" />
                            @endif
                            <span class="" style="text-transform:none; font-size:11pt;">
                                @if($role == 'TASKMINATOR')
                                    {{ Auth::user()->firstName }}
                                @elseif($role == 'CLIENT_CMP' || $role == 'CLIENT_IND')
                                    {{ Auth::user()->companyName }}
                                @elseif($role == 'ADMIN')
                                    {{ Auth::user()->fullName }}
                                @endif
                            </span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0; padding-right:0;display:inline-block; font-size: 14pt; background:transparent;" href="#"><i class="fa fa-caret-down fa-fw"></i></a> <!-- visible-xs-inline hidden-sm hidden-md | class of span -->
                        <ul id="dropMenu" class="dropdown-menu">
                            @if($role != 'ADMIN')
                                <li>
                                    <a href="/editProfile"><i class="fa fa-pencil fa-fw"></i> Edit Profile</a>
                                </li>
                            @endif
                            <li><a href="#"><i class="fa fa-camera-retro fa-fw"></i> Edit Cover Photo</a></li>
                            @if(Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')->where('user_has_role.user_id', Auth::user()->id)->pluck('role') == 'ADMIN')
                                <li><a href="/cms"><i class="fa fa-edit fa-fw"></i> CMS</a></li>
                            @endif
                            <li><a href="#"><i class="fa fa-cog fa-fw"></i> Settings</a></li>
                            @if($role != 'ADMIN')
                                <li>
                                    <a href="/admessages" style="color: #e74c3c;">
                                        <i class="fa fa-comment fa-fw"></i> Message Admin
                                    </a>
                                </li>
                            @endif
                            @if($role == 'CLIENT_CMP' || $role == 'CLIENT_IND')
                            <li>
                                <a href="/checkouts">
                                    <i class="fa fa-users fa-fw"></i> Checkouts
                                </a>
                            </li>
                            @endif
                            <li class="divider"></li>
                            <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    {{--MODAL FOR CART -- START--}}
    <div class="modal modal-vcenter fade lato-text" id="CARTMODAL" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" style="padding-top: 2em;">
                    <div id="CARTLOADING">
                        <center><i class="fa fa-circle-o-notch fa-spin" style="font-size: 4em; opacity: 0.4"></i></center>
                    </div>
                    <div class="row" style="display: none;" id="MAINCARTBODY">
                        <div class="col-md-6" id="CARTCONTENTS" style="text-align: center;">

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">Number of items</div>
                                <div class="col-md-6">
                                    <span id="CRT_QTY"></span>
                                </div>
                                <div class="col-md-6">Price per item</div>
                                <div class="col-md-6">
                                    <span id="CRT_PRICEPERITEM">20 Points</span>
                                </div>
                                <div class="col-md-6" style="font-weight: bold;">TOTAL PRICE</div>
                                <div class="col-md-6" style="font-weight: bold;">
                                    <span id="CRT_TOTAL"></span>
                                </div>
                                <div class="col-md-6" style="font-weight: bold;">Your points</div>
                                <div class="col-md-6" style="font-weight: bold;">
                                    <span>{{Auth::user()->points}}</span>
                                </div>
                                <div class="col-md-6" style="font-weight: bold;">Total points after purchase</div>
                                <div class="col-md-6" style="font-weight: bold;">
                                    <span id="CRT_PTSLEFT" data-ptsleft="{{Auth::user()->points}}">{{Auth::user()->points}}</span>
                                </div>
                                <div class="col-md-12" id="CART-WARNING" style="color: red;">You don't have enough points to make this purchase</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/doCheckout" id="CHECKOUTFORM">
                    </form>
                    <button disabled type="button" onclick="$('#CHECKOUTFORM').submit()" id="CHECKOUTBTN" class="btn btn-primary">Checkout</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    {{--MODAL FOR CART -- END--}}

    {{--MODAL -- START--}}

    {{--MODAL FOR CHANGE PASS--}}
    <form method="POST" action="/CHNGPSS">
        <div class="modal modal-vcenter fade lato-text" id="CHNGPSS-MODAL" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="margin: 0; padding: 0; text-align: center;">Change password</h3>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Input Old Password</label>
                                <input type="password" name="OLD_PASS" class="form-control" placeholder="********" required="required">
                            </div>
                            <div class="form-group">
                                <label>Input New Password</label>
                                <input type="password" name="NEW_PASS" class="form-control" placeholder="********" required="required">
                            </div>
                            <div class="form-group">
                                <label>Confirm new Password</label>
                                <input type="password" name="CNEW_PASS" class="form-control" placeholder="********" required="required">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--MODAL FOR DEACTIVATION (USER)--}}

    <form method="POST" action="/DEACACCT">
        <div class="modal modal-vcenter fade lato-text" id="DEACTIVATE-MODAL" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="margin: 0; padding: 0; text-align: center;"><i class="fa fa-warning" style="color: red;"></i> Deactivate Account</h3>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <p style="font-weight: bolder;">Input your password to proceed with deactivation.</p>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="INPUT PASSWORD" name="DEAC_PASS" required="required"/>
                            <input type="text" style="display: none;" name="xx"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-lg btn-danger btn-block">DEACTIVATE</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-lg btn-primary btn-block" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--MODAL FOR USER SEARCH--}}
    <div class="modal modal-vcenter fade lato-text" id="userSearchModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="margin: 0; padding: 0; text-align: center;">Search for User</h3>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Search</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{--MODAL FOR AD SEARCH--}}
    <div class="modal modal-vcenter fade lato-text" id="adSearchModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="margin: 0; padding: 0; text-align: center;">Search for Job Ads</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title keyword</label>
                                        <input type="text" class="form-control" placeholder="Enter keyword for job ad title" id="adSearch_KEYWORD" name="jobsrch_keyword" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select id="adSearch_REG" data-loctype="REGION_TO_CITY" class="form-control">
                                            <option value="ALL" selected>Display from all regions</option>
                                            @foreach(Region::get() as $reg)
                                                <option value="{{ $reg->regcode }}">{{ $reg->regname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <select id="adSearch_CITY" class="form-control">
                                            <option value="ALL" selected>Display from all cities</option>
                                            @foreach(City::get() as $city)
                                                <option value="{{$city->citycode }}">{{ $city->cityname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration</label>
                                        <select id="adSearch_DUR" class="form-control">
                                            <option value="ALL">Display all duration</option>
                                            <option value="LT6MOS">Less Than 6 months</option>
                                            <option value="GT6MOS">Greater Than 6 months</option>
                                        </select>
                                    </div>
                                    {{--<center><h4><i class="fa fa-map-marker"></i> Job Status</h4></center>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<select id="adSearch_STAT" class="form-control">--}}
                                            {{--<option>Open</option>--}}
                                            {{--<option>Closed</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" id="orderBy" name="orderBy">
                                        <option value="ASC">Oldest ads first</option>
                                        <option value="DESC">Newest ads first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Skill Category</label>
                                        <select class="form-control" id="adSearch_CATEGORY" name="adSearch_CATEGORY">
                                            <option value="ALL">Display from all category</option>
                                            @foreach(TaskCategory::orderBy('categoryname', 'ASC')->get() as $c)
                                                <option value="{{$c->categorycode}}">{{$c->categoryname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select class="form-control" id="adSearch_SKILL" name="adSearch_SKILL">
                                            <option value="ALL">Display from all skills</option>
                                            @foreach(TaskItem::get() as $skill)
                                                <option value="{{$skill->itemcode}}">{{$skill->itemname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Search by custom skill</label>
                                        <input type="text" placeholder="Enter keyword for custom skill search" class="form-control" name="adSearch_CUSTSKILL" id="adSearch_CUSTSKILL"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="adSearch_BTN">Search</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    {{--MODAL -- END--}}

<!-- END OF MASTER USER LAYOUT-->

<!-- CONTENT OF THE PAGE -->

  	@yield('content')

<!-- END OF CONTENT -->

<!-- All scripts and plugin should be placed here so the page can load -->
<!-- jQuery -->
    <!-- <script src="frontend/js/jquery.js"></script> -->

<!-- Bootstrap Core JavaScript -->
    {{ HTML::script('frontend/js/bootstrap.min.js') }}
    <!-- <script src="frontend/js/bootstrap.min.js"></script> -->

<!-- Plugin JavaScript -->
    {{ HTML::script('frontend/js/jquery.easing.min.js') }}
    {{ HTML::script('frontend/js/jquery.fittext.js') }}
    {{ HTML::script('frontend/js/wow.min.js') }}
    {{ HTML::script('frontend/js/vegas.js') }}
    {{ HTML::script('javascripts/jquery.fancybox.pack.js') }}

    <!-- <script src="frontend/js/jquery.easing.min.js"></script>
    <script src="frontend/js/jquery.fittext.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/vegas.js"></script>
    <script src="javascripts/jquery.fancybox.pack.js"></script> -->

<!-- Custom Theme JavaScript -->
    <!-- <script src="frontend/js/creative.js"></script> -->
    {{ HTML::script('frontend/js/jquery.nicescroll.js') }}
    <!-- <script src="frontend/js/jquery.nicescroll.js"></script> -->

<!-- ADD INS -->

<script type="text/javascript">
    $(document).ready(function(){
//        setInterval(function(){
//                    $.ajax({
//                        type        :   'GET',
//                        url         :   '/checkMsgCount',
//                        success     :   function(data){
//                            if(data > 0){
//                                $('#msg_count').empty().append(data).show();
//                            }else{
//                                $('#msg_count').empty().hide();
//                            }
//                        }
//                    })
//                }, 3000);
//
//        setInterval(function(){
//            $.ajax({
//                type        :   'POST',
//                url         :   '/taskminator/notify',
//                success     :   function(data){
//                    console.log(data);
//                }
//            })
//        }, 10000);
    });

          $(function(){
            var thetitle = $('title').text();
            var totalNotif = parseInt($('#notification_count').text()) + parseInt($('#msg_count').text());
            $('.notif').click(function(){

              var countNotif = parseInt($('#notification_count').text());
              var newcountNotif = ++countNotif;
              totalNotif++;
              $('#notif-icon').removeClass('notif-icon').addClass('notif-iconh');
              $('#notification_count').text(newcountNotif).show();
              $('title').text('('+totalNotif+') '+thetitle);

                     jQuery('<div/>', {
                        id: 'notif-bot',
                        class : 'notif-bot alert alert-info',
                        text: 'You just got a notification!'
                        }).appendTo('.notif-bot-cnt')
                            .delay(5000)
                            .fadeOut();

            });

            $('.message').click(function(){

              var countNotif = parseInt($('#msg_count').text());
              var newcountNotif = ++countNotif;
              totalNotif++;
              $('#msg-icon').removeClass('msg-icon').addClass('msg-iconh');
              $('#msg_count').text(newcountNotif).show();
              $('title').text('('+totalNotif+') '+thetitle);

                     jQuery('<div/>', {
                        id: 'notif-bot',
                        class : 'notif-bot alert alert-success',
                        text: 'You just got a message!'
                        }).appendTo('.notif-bot-cnt')
                            .delay(5000)
                            .fadeOut();

            });

            /*$('#notif-icon').click(function(){
                $('this').removeClass('notif-iconh').addClass('notif-icon');
                $('#notification_count').text('0').hide();
                $('.notif-bot').hide();
                $('title').text(thetitle);
            });

            $('#msg-icon').click(function(){
                $('this').removeClass('msg-iconh').addClass('msg-icon');
                $('#msg_count').text('0').hide();
                $('.notif-bot').hide();
                $('title').text(thetitle);
            });*/

            $("#messageLink").click(function(){
              //$("#notificationContainer").fadeToggle(300);
              totalNotif = totalNotif - parseInt($('#msg_count').text());
              $('#msg_count').text('0').hide();
              $("#msg_count").fadeOut("slow");
              if(totalNotif!=0)
                $('title').text('('+totalNotif+') '+thetitle);
              else
                $('title').text(thetitle);
              //return false;
            });

            $("#notificationLink").click(function(){
              $("#notificationContainer").fadeToggle(300);
              totalNotif = totalNotif - parseInt($('#notification_count').text());
              $('#notification_count').text('0').hide();
              $("#notification_count").fadeOut("slow");
              if(totalNotif!=0)
                $('title').text('('+totalNotif+') '+thetitle);
              else
                $('title').text(thetitle);
              return false;
            });

            //Document Click
            $(document).click(function(){
              $("#notificationContainer").hide();
            });

            //Popup Click
            $("#notificationContainer").click(function(){
              return false;
            });
          });

</script>


<!-- HTML SMOOTH MOUSEWHEEL SCROLLING -->
    <script>
    $(document).ready(

      function() { 
        $("html").niceScroll();
      }
    );
    </script>
<!-- END OF SMOOTH MOUSEWHEEL SCROLLING -->

    <script>
        // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
        $('.dropdown').on('show.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
        });

        // ADD SLIDEUP ANIMATION TO DROPDOWN //
        $('.dropdown').on('hide.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
        });
    </script>
    
<!-- FOR WOW ANIMATION ( I DISABLED THE creative.js theme plugin ) -->
    <script>
        new WOW().init();
    </script>
<!-- END OF WOW ANIMATION -->
@yield('body-scripts')
</body>
</html>