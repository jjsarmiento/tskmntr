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
    <!--
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic') }}
    {{ HTML::style('https://fonts.googleapis.com/css?family=Lato:300') }}
    -->

    {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
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
    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
    {{ HTML::script('js/taskminator.js') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <!--
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        -->
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
                        var checkoutPricePerWorker = $('#SYSSETTINGS_CHECKOUTPRICE').val();
                        var totalPrice = checkoutPricePerWorker * (data.length);
                        var pointsLeft = parseFloat($('#CRT_PTSLEFT').data('ptsleft')) - totalPrice;
                        $('#CRT_PRICEPERITEM').empty().text(checkoutPricePerWorker);
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
                            if(pointsLeft < 0){
                                $('#CHECKOUTBTN').prop('disabled', true);
                                $('#CART-WARNING').show();
                            }else{
                                $('#CHECKOUTBTN').prop('disabled', false);
                                $('#CART-WARNING').hide();
                            }
                        }

//                        INITLISTENER();
                    }
                })
            });
        });
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

        .JOB-BOX:hover {
            background-color: #cce6ff;
        }

    </style>
    @yield('head-content')
</head>
<body id="page-top">
<input type="hidden" id="SYSSETTINGS_POINTSPERAD" value="{{SystemSetting::where('type', 'SYSSETTINGS_POINTSPERAD')->pluck('value')}}">
<input type="hidden" id="SYSSETTINGS_CHECKOUTPRICE" value="{{SystemSetting::where('type', 'SYSSETTINGS_CHECKOUTPRICE')->pluck('value')}}">
<!-- NAVIGATION MASTER USER LAYOUT -->
    @if(Auth::check())
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

            <?php
                if(Auth::check()){
                    $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                    ->where('user_has_role.user_id', Auth::user()->id)
                    ->pluck('role');
                }
            ?>
    <!-- FOR SEARCH ON THE NAVIGATION BAR -->
        <!-- ADMIN -->
            @if ($role == 'ADMIN')
            <div class="col-sm-3 col-md-3 pull-left navbar-form">
                <div class="input-group">
                    <input data-url="/ADMINNavSearch=" type="text" class="form-control input-trans srchAnim" value="{{@$keyword}}" placeholder="Search" required name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
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
                        <div id="notificationContainer" class="messages" style="min-height: 1em !important;">
                            <div id="notificationTitle">Notifications</div>
                            <div id="notificationsBody" style="min-height: 1em !important;" class="notifications">
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
                        <li>
                            <a href="/bookmarkedUsers" style="background:transparent; font-size: 14pt;">
                                <i class="fa fa-bookmark fa-fw"></i>
                            </a>
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
                                <li>
                                    <a href="/admessages" style="color: #e74c3c;">
                                        <i class="fa fa-comment fa-fw"></i> Message Admin
                                    </a>
                                </li>
                            @endif
                            <li><a href="#"><i class="fa fa-camera-retro fa-fw"></i> Edit Cover Photo</a></li>
                            @if($role == 'ADMIN')
                                <li><a href="/cms"><i class="fa fa-edit fa-fw"></i> CMS</a></li>
                            <li><a href="/SYSTEMSETTINGS"><i class="fa fa-cog fa-fw"></i> Settings</a></li>
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
    @endif

    <!-- MODALS FOR AUTHORIZED LOGIN -->
    @if(Auth::check())
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
                                        <span id="CRT_PRICEPERITEM"></span>
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
    @endif

    @if(@$MULTIJOB)
        <form method="POST" action="/INVITEMULTIJOB">
            <input type="hidden" value="{{$users->id}}" name="workerID">
            <div class="modal modal-vcenter fade lato-text" id="INVITEMULTIJOB" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body" style="padding-top: 2em;">
                            <div class="row">
                                <div class="col-md-6">
                                    @if($MULTIJOB->count() > 0)
                                        <center><h3 style="margin: 0; margin-bottom: 1em;">Jobs</h3></center>
                                        @foreach($MULTIJOB as $job)
                                            <div class="col-md-12 JOB-BOX" style="padding: 0.4em;">
                                                <div class="col-md-2">
                                                    <input type="checkbox" name="INVITEMULTIJOB_jobID[]" class="form-control" value="{{$job->id}}" >
                                                </div>
                                                <div class="col-md-10">
                                                    <h5 style="margin:0;"><a target="_tab" href="/jobDetails{{$job->id}}">{{$job->title}}</a></h5>
                                                    <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <center><i>No job ads applicable for this worker</i></center>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Invite Message</label>
                                        <textarea name="INVITEMULTIJOB_message" rows="10" class="form-control" placeholder="Invitation Message (Worker will see these invitations seperately)">Hi! We've seen your profile and we would like to invite you to apply!</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Send Invites</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

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


    {{--MODA LFOR TERMS - TAGALOG -- START--}}
    <div class="modal modal-vcenter fade lato-text" id="TERMSMODAL_TAGALOG" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                    <h3>Terms of Service - Proveek BETA</h3>
                    <a href="#" data-target="#TERMSMODAL_TAGALOG" data-toggle="modal">Click here for TOS Tagalog Version</a>
                </div>
                <div class="modal-body" style="padding: 4em;">
                    <p class=MsoNormal align=center style='text-align:center'><b><span
                    style='font-size:16.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>TERMS
                    OF SERVICE</span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:16.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang mga
                    impormasyong nakasaad sa kasunduang ito ay mahalaga. Marapat lamang na basahin
                    ito ng buo at maigi upang malaman ang mga dapat tandaan sa paggamit ng Proveek.
                    Magmula (DATE), ang mga kondisyong ito ay magiging basehan sa kung paano mo
                    gagamitin ang website na ito. Kung ikaw ay hindi sasang-ayon sa mga panuntunang
                    ito, hindi mo maaaring gamitin ang Proveek website o alinmang serbisyo nito.
                    Kung ikaw ay may katanungan, maaari ninyo kaming maabot sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Kasunduan
                    (Binding Agreement)</span></b><b><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang mga
                    patakarang nakasaad dito ang bumubuo sa isang kasunduan sa pagitan mo na User
                    at ng kumpanya na Proveek Inc., at nangangahulugang tinanggap mo ang mga ito
                    tuwing gagamitin mo ang Website at ang aming mga serbisyo. Sumasang-ayon ka rin
                    na gamitin ang Website sa iyong sariling kagustuhan at pananagutan. Ang mga
                    patakarang ito ang gagamiting basehan sa ano mang isyu na lumutang sa pagitan
                    mo at ng Proveek.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>May mga
                    pagbabagong maaaring gawin sa mga patakarang ito kaya mabuting lagi mong
                    tingnan kung may mga updates. Kung patuloy mong gagamitin ang Proveek.com
                    pagkatapos maidagdag ang mga pagbabago sa patakaran, ibig sabihin ay
                    sumasang-ayon ka sa mga pagbabagong ito.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Tala-Salitaan
                    (Definitions)<o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Patakaran (Terms)</span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> – Terms
                    of service. Mga patakaran o batas sa paggamit ng Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>User</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – Ikaw.Lahat ng gumagamit ng Proveek.com.Kasama
                    dito ang employer at manggagawa.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Content</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – lahat ng, ngunit hindi limitado sa disenyo (designs),
                    text, graphics, imahe (images), bidyo (video), impormasyon, logos, button
                    icons, software, audio files at iba pang laman ng Proveek.com website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Website</span></b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'> – Proveek.com<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:normal'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Proveek</span></i></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> –
                    Proveek Inc. na pangalan ng kumpanya.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Copyright
                    at Pag-gamit ng Nilalaman (Copyright and Use of Proveek Content)<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.5in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.1 <u>Copyright</u></span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. Narito
                    ang mga probisyon:</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(a)</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Proveek Inc, kasama ng mga lisensyor nito, ang
                    nagmamay-ari at kumokontrol sa lahat ng copyright at intellectual property
                    rights ng Website pati lahat ng nilalaman ng Website; at</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(b)</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Lahat ng <span
                    style='mso-spacerun:yes'> </span>copyrightat ibang intellectual property rights
                    sa Website lahat ng material dito ay pagmamay-ari at nakareserba para sa <i
                    style='mso-bidi-font-style:normal'>Proveek</i>lamang.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Pinapayagan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i> ang mga User na tingnan ang content, i-download at ilimbag
                    (i-print) ang isang kopya ng content para sa pansarili at hindi pang-komersyong
                    gamit lamang. Ang content ng Website at protektado ng copyright, trademark at
                    iba pang batas.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi maaaring baguhin, kopyahin, padamihin,
                    i-upload o ipamigay sa ano mang paraan ang content ng Websitekabilang na ang
                    code at ang software. Dapat ding panatilihin ng User ang lahat naproprietary
                    notices na laman ng orihinal na laman ng anumang kopya ng anumang content mula
                    sa Website. Hindi maaaring ibenta o baguhin ang content, paramihin, i-display,
                    ipamigay o gamitin ang content para sa pampubliko o komersyal na gamit. Ang
                    bagay na ito ay mahigpit na ipinagbabawal ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>. Kung ang User ay lalabag sa mga patakarang ito, maaaring
                    maalis ang karapatan mong gamitin ang content ng Website at kakailanganin mong
                    sirain ang lahat ng kopya mo ng <i style='mso-bidi-font-style:normal'>Proveek</i>
                    content.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.2 <u>Pangkalahatang Paggamit sa Website (General
                    Use of Website)</u></span></b><u><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>.</span></u><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang Website ay inilaan para sa mga tao, lalo na
                    sa mga manggagawa (skilled workers) na naghahanap ng trabaho at sa mga Employer
                    na naghahanap ng pinakamainam na trabahador. Maaari ninyong gamitin ang Website
                    ayon sa batas at nakapaloob sa konteksto ng itinakdang gamit at
                    katanggap-tanggap na gamit sa Website.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    paggamit sa Website sa anumang paraan na magbubunga o maaaring magbunga ng
                    pinsala sa Proveek, o magkaroon ng diperensya ang Website ay mahigpit na
                    ipinagbabawal. Gayundin, ang paggamit ng Website sa anumang paraan na hindi
                    naaayon sa batas (unlawful), iligal (illegal), panloloko (fraudulent) o
                    naglalagay sa kapahamakan (harmful) ay hindi maaaring palagpasin. Maaaring
                    gumawa ng legal na aksyon ang Proveek sa ganitong sitwasyon. Hindi rin maaaring
                    gamitin ang Website upang kumopya, mag-imbak (store), mag-host, mag-transmit,
                    magpadala (send), gumamit, mag-limbag (publish), o mamigay (distribute) ng
                    anumang material na naglalaman o may kinalaman sa anumang spyware, computer
                    virus, Trojan horse, worm, keystroke logger, rootkit at ano pa mang malisyosong
                    computer software. Dapat siguruhin ng User na lahat ng impormasyon na ibibigay
                    at ilalagay sa Proveek.com ay totoo, tama, kumpleto at hindi nagbibigay ng
                    kalituhan sa sinuman.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.3<u>Lisensya ng Paggamit Para sa mga
                    Manggagawa na Naghahanap ng Trabaho (License to Use by Users who are Job
                    Seekers)</u></span></b><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>. Binibigyang kayo ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na magkaroon ng limitado, at hindi eksklusibong karapatan na
                    gamitin ang Website para sa pansariling gamit sa inyong paghahanap ng trabaho. <span
                    style='color:red'>Maaari kayong tumingin o mag-download ng isang kopya ng
                    material sa Website para sa pansariling gamit lamang</span>. Sa paggawa nito,
                    sumasang-ayon ka na ikaw lamang ang may responsibilidad sa anumang ilalagay o
                    ipo-post sa Website at sa anumang problemang lulutang sa pagpo-post na ito. <span
                    style='color:red'>Dapat tandaan na ang lahat ng ito ay isang pribilehiyo</span>
                    at karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na tanggalin
                    ang pribilehiyong ito para sa anumang dahilan, anumang oras, sa kanyang
                    kagustuhan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.4<u>Lisensya ng Paggamit Para sa mga
                    Employers na Naghahanap ng Trabahador (License to Use by Users who are Job
                    Providers or Employers)</u></span></b><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>. Binibigyang kayo ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na magkaroon ng limitado, at hindi eksklusibong karapatan na
                    gamitin ang Website para sa pansariling gamit sa inyong paghahanap ng
                    trabahador. <span style='color:red'>Maaari kayong tumingin o mag-download ng
                    isang kopya ng material sa Website para sa pansariling gamit lamang na may
                    kaugnayan lamang sa paghahanap ng pinakamainam na manggagawa</span>. Binibigyan
                    din kayo ng limitado at hindi eksklusibong lisensya na gamitin ang Proveek
                    Materials and Services para sa internal na gamit lamang. Hindi maaaring ibenta,
                    ilipat o ibigay ang anumang serbisyong ito sa kaninuman na walang kaukulang
                    permiso mula sa <i style='mso-bidi-font-style:normal'>Proveek</i>. Sumasang-ayon
                    ka na ikaw lamang ang may responsibilidad sa anumang ilalagay o ipo-post sa
                    Website at sa anumang problemang lulutang sa pagpo-post na ito. <span
                    style='color:red'>Dapat tandaan na ang lahat ng ito ay isang pribilehiyo</span>
                    at karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na tanggalin
                    ang pribilehiyong ito para sa anumang dahilan, anumang oras, sa kanyang
                    kagustuhan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>3.5<u>Iba pang Patakaran sa Paggamit ng Website
                    (Other Specific Rules Regarding Site Usage)</u></span></b><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. Pinapatunayan
                    at sumasang-ayon ka na ikaw ay (a) labing-walong taong gulang (18 years old),
                    at (b) hindi gagamit (o hindi babalaking gamitin o tulungan ang iba na gumamit)ng
                    Website sa anumang paraan na ipinagbabawal ng mga patakarang nakasaad sa
                    kasunduang ito. Responsibilidad ng User na ang paggamit niya ay naaayon sa
                    patakaran ng <i style='mso-bidi-font-style:normal'>Proveek</i>.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Pagtatala
                    at Mga Account (Registration and Accounts)</span></b><b><span style='font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>4.1 <u>Para sa Magbibigay ng Trabaho
                    (Employers)</u></span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat panatilihing
                    konpidensyal (confidential) ang iyong Employer account, Profile at password.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Hindi mo
                    dapat hayaan ang sinuman na gamitin ang iyong Employer account upang i-access
                    ang Website pati na ang content at serbisyo nito.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    mong ipagbigay-alam kaagad sa<i style='mso-bidi-font-style:normal'>Proveek</i>kung
                    may mapansin kang hindi autorisadong paggamit sa iyong account. Para sakaragdagang
                    tulong, abutin ang Proveek sa </span><a href="mailto:service.proveek@gmail.com"><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Alam at
                    naiintindihan mo na kung sakaling tanggalin o i-deactivate mo ang iyong
                    Employer account, lahat ng impormasyong nakaimbak dito – kabilang ang saved
                    resumes, network contacts, at email mailing lists – ay mabubura at maaaring
                    mabura ng tuluyan mula sa database ng Proveek. Gayunman, maaaring magtagal pa
                    ito ng ilang panahon dahil sa delay sa network at web servers.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong job posting ay hindi maaaring maglaman ng mga sumusunod:<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hyperlinks,
                    maliban sa mga autorisado ng Proveek.com;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>nakakalito
                    (misleading), hindi mabasa (unreadable),onakatagong (&quot;hidden&quot;)
                    keywords, inuulit (repeated)na keywords o keywords na walang kinalaman sa
                    trabahong iyong ibinibigay;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>pangalan,
                    logo o trademarks ng mga kumpanyang hindi sa iyo;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>pangalan
                    ng mga pamantasan, siyudad, bayan o bansang walang kaugnayan sa trabahong iyong
                    ibinibigay;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>higit sa
                    isang trabaho o deskripsyon ng trabaho, higit sa isang lokasyon o higit sa
                    isang kategorya ng trabaho, maliban na lamang kung kinakailangan;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hindi
                    totoo, hindi tama at nakakalitong mga impormasyon;<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materyal
                    o links sa materyal na umaabuso sa tao sa paraang sekswal, bayolente at iba pa,
                    maging ang paghingi ng impormasyon mula sa sinumang menor de edad; at,<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:0in;
                    margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                    text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materyal
                    o links sa materyal na magbubunga sa mga gawaing ipinagbabawal ng batas tulad
                    ng human trafficking, iligal na droga (illegal drug trade), at iba pa.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong User ID ay hindi maaaring magbigay ng kalituhan sa <i style='mso-bidi-font-style:
                    normal'>Proveek</i>, naghahanap ng trabaho (Job Seekers), at sa iba pang
                    gumagamit ng Website; hindi mo maaaring gamitin ang iyong account at User ID
                    upang gayahin ang katauhan ng iba.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Dapat pag-ingatan at ilihim ang iyong password</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ipagbigay-alam
                    agad sa Proveek kung may ibang makaalam ng iyong password na maging sanhi ng
                    hacking ng iyong account. Abutin lamang kami sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>para sa
                    tulong na kinakailangan.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Responsibilidad
                    mo ang anumang aktibidad sa Website na resulta ng iyong kapabayaan sa iyong
                    password at maging ang pagkalugi dahil dito.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    siguruhin na lahat ng personal na impormasyon na maaaring i-access ng <i
                    style='mso-bidi-font-style:normal'>Proveek</i> at manggagawa ay tama, kumpleto,
                    napapanahon (up-to-date) at hindi magreresulta ng pagkalito. Hindi ka maaaring
                    gumaya sa anumang tao, buhay man o patay, o anumang kumpanyang walang kaugnayan
                    sayo.<o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                    margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                    mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(k)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Maaari mong i-deactivate ang iyong account sa Proveek.com gamit ang
                    account control panel sa iyong profile.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>4.2 <u>Para sa Manggagawa (Workers)</u></span><o:p></o:p></b></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    ikaw ay labing-walong taong gulang (18 yrs old) o higit pa upang makagawa ng
                    account sa Proveek Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Maaari
                    kang magparehistro ng account sa Proveek.com sa pamamagitan ng pagkumpleto at
                    pagsumite ng account registration form, at pag-click sa verification link sa
                    email na matatanggap ninyo. <span style='color:red'>Ang registration para sa
                    manggagawa ay LIBRE (walang bayad)</span>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Hindi mo
                    maaaring payagan ang sinuman na gamitin ang iyong account sa Website.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    mong ipagbigay-alam kaagad sa<i style='mso-bidi-font-style:normal'>Proveek</i>kung
                    may mapansin kang hindi autorisadong paggamit sa iyong account. Para sa
                    karagdagang tulong, abutin ang Proveek sa </span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ang
                    iyong User ID ay hindi maaaring magbigay ng kalituhan sa <i style='mso-bidi-font-style:
                    normal'>Proveek</i>, naghahanap ng trabahador (Employer), at sa iba pang
                    gumagamit ng Website; hindi mo maaaring gamitin ang iyong account at User ID
                    upang gayahin ang katauhan ng iba. <o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Dapat pag-ingatan at ilihim ang iyong password</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Ipagbigay-alam
                    agad sa Proveek kung may ibang makaalam ng iyong password na maging sanhi ng
                    hacking ng iyong account. Abutin lamang kami sa</span><a
                    href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> para sa
                    tulong na kinakailangan.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Responsibilidad
                    mo ang anumang aktibidad sa Website na resulta ng iyong kapabayaan sa iyong
                    password at maging ang pagkalugi dahil dito.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Dapat
                    siguruhin na lahat ng personal na impormasyon na maaaring i-access ng <i
                    style='mso-bidi-font-style:normal'>Proveek</i> at Employer ay tama, kumpleto,
                    napapanahon (up-to-date) at hindi magreresulta ng pagkalito. Hindi ka maaaring
                    gumaya sa anumang tao, buhay man o patay.<o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                    auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Maaari mong i-deactivate ang iyong account sa Proveek.com gamit ang
                    account control panel sa iyong profile.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                    <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Pagbabayad
                    ng kaukulang Bayarin (Fees)Para sa Employers<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Lahat ng
                    karampatang bayarin sa<i style='mso-bidi-font-style:normal'>Proveek</i> ay
                    dapat mabayaran sa paraang napagkasunduan (payment terms) sa loob ng
                    nakatakdang panahonmula ng matanggap ang invoice. Ang hindi pagbabayad sa oras
                    ay magkakaroon in interes na <span style='color:red'>8% kada taon. Lahat ng
                    presyo ay eksklusibo sa alinmang buwis liban na lamang kung nakasaad</span>.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                    color:red'>Kung sakali mang dumating ang panahon na i-deactivate mo ang iyong
                    account, karapatan ng <i style='mso-bidi-font-style:normal'>Proveek</i> na
                    tanggapin lahat ng natitirang bayarin para sa serbisyong ginamit hanggang sa
                    i-deactivate ang account at 50% pa ng natitirang hindi pa nagagamit na
                    serbisyong naitala na (Service Agreement).</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial;
                    color:red'><o:p></o:p></span></p>

                    <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial;color:red'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                    mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limitadong
                    Garantiya (Limited Warranties)<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi ginagarantiya ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i> ang mga sumusunod: na kumpleto o tama ang impormasyong
                    nailathala sa Website; na ang material sa Website ay napapanahon; o na ang
                    Website o anumang serbisyo nito ay mananatiling nasa Internet sa lahat ng
                    panahon.</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Karapatan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>na hindi ipagpatuloy o baguhin ang annuman o lahat ng
                    serbisyo sa Website, at itigil ang paglalathala sa Website sa anumang oras ayon
                    sa kagustuhan ng Proveek ng walang pasabi o eksplenasyon. Ang sinumang User ay
                    hindi makakatanggap ng anumang kabayaran sakaling baguhin ang anuman o lahat ng
                    serbisyo sa Website, o itigil ang paglalathala sa Website.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi nagbibigay ang<i style='mso-bidi-font-style:
                    normal'>Proveek</i> ng anumang insurance o anumang proteksyon para sa employer
                    at manggagawa.</span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin'>Hindi sinisigurado ng<i
                    style='mso-bidi-font-style:normal'>Proveek</i>na kumpleto at tama ang User information
                    dahil ang User identification ay mahirap mapatunayan online. Ngunit maaaring
                    magbigay ang Proveek ng ilang User information base sa third party background
                    check o beripikasyon(verification) ng katauhan o kredensyal (identity or
                    credentials)pero tandaan na lahat ng ito ay base lamang sa mga impornasyong
                    ibinigay ng User at ang mga impormasyon na ito ay para makatulong sa ibang User
                    at hindi dapat tanawing introduksyon o rekomendasyon ng<i style='mso-bidi-font-style:
                    normal'>Proveek</i>.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Mga
                    Limitasyon at Eksklusyon (Limitations and exclusions of liability)</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang mga patakaran at kondisyong nakasaad dito
                    ay: nililimitahan o tinatanggal ang pananagutan sa kamatayan o pisikal na
                    injury na ibinunga ng kapabayaan; nililimitahan o tinatanggal ang pananagutan
                    sa panloloko (fraud) o maling representasyon nito (fraudulent representation);
                    nililimitahan ang pananagutan na pinapayagan sa ilalim ng nasasakop na batas; o
                    tinatanggalan ng pananagutan sa mga bagay na hindi sinasakop ng batas.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Sa kadahilanang ang Website na ito ay libre,
                    hindi pananagutan ng <i style='mso-bidi-font-style:normal'>Proveek</i>ang anu
                    mang pagkawala, pagkalugi o anumang klase ng damages lalo na kung ito ay hindi
                    kontrolado ng kumpanya.<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi pananagutan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>sa Employers or Job Providers ang anumang pagkalugi (tulad
                    ng ng loss of or damage to profits, income, revenue, use, production,
                    anticipated savings, business, contracts, commercial opportunities o goodwill).</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Hindi pananagutan ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>ang anumang pagkawala ng anumang data, database o software.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                    "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Paglabag
                    sa Patakaran (Breaching these Terms)</span></b><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung sakali mang labagin mo ang alinman sa mga
                    nakasaad na patakaran o paghinalaan ka ng Proveek na may nilabag kang
                    patakaran, maaaring:</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(a)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>mapadalhan ka ng isa o higit pang babala</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>;</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(b)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>magkaroon lamang ng limitadong access sa
                    Website</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                    mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                    mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>;<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>(c)<span
                    style='mso-tab-count:1'>        </span>masuspinde o mabura ang account mula sa
                    Website;<o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(d)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>permanentenghindi ma-access ang Website; at/o</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>(e)</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                    style='mso-tab-count:1'>        </span>makasuhan, para sa paglabag sa patakaran
                    o iba pang kadahilanan.<span style='mso-tab-count:1'>          </span><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung masuspinde ka ng <i style='mso-bidi-font-style:
                    normal'>Proveek</i>at harangin ka sa pag-access sa Website, dapat mong
                    siguruhin na hindi ka gagawa ng hakbang upang lusutan ito tulad ng paggawa o
                    paggamit ng ibang account.</span><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>9.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>Severability<o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kung mayroon isang probisyon sa mga patakarang
                    ito ang mapatunayan ng anumang korte na hindi naayon sa batas, ang mga
                    natitirang probisyon ay mananatili pa din ang epekto.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Gayundin, kung mayroon isang probisyon sa mga
                    patakarang ito na kung babaguhin ay magiging ayon na sa batas, ito ay
                    ikinokonsiderang bago na at mananatiling epektibo.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>10.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><span
                    style='mso-spacerun:yes'> </span>Karapatan ng mga Third party (Third party
                    rights)</span></b><b style='mso-bidi-font-weight:normal'><span
                    style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang kontratang ito ay para sa kapakanan mo at
                    ng <i style='mso-bidi-font-style:normal'>Proveek</i>at hindi binuo para sa
                    kapakanan ng iba (third party)</span><span style='font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang paggamit saparties' rights sa ilalim ng mga
                    patakarang ito ay hindi nakadepende sa permiso ng anumang third party.</span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>11.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Kasunduan (Entire agreement)</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang mga patakarang ito, kasama ang Privacy
                    Policy ng Proveek ang bubuo sa kabuuang kasunduan sa pagitan mo bilang User at
                    ng Proveek na may kaugnayan sa paggamit mo ng Website at siyang magiging batas
                    na sumasakop sa paggamit ng Website.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>12.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'><span style='mso-spacerun:yes'> </span>Batas at
                    Hurisdiksyon (Law and Jurisdiction)</span></b><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang kontratang kinapapalooban ng mga patakarang
                    ito ay na nasa ilalim ng batas ng Pilipinas.</span><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
                    mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p>&nbsp;</o:p></span></p>

                    <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                    mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                    normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                    107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                    mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>13.<span
                    style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Detalye ng PROVEEK</span></b><b
                    style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                    12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang Proveek.com ay pagmamay-ari at pinapalakad
                    ng Proveek Inc.</span><span style='font-size:12.0pt;line-height:107%;
                    font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                    mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Ang<i style='mso-bidi-font-style:normal'>Proveek</i>ay
                    rehistradosa<span style='color:#EC8514'>Securities And Exchange Commission
                    (SEC) of the Philippines</span>na may rehistro (registration number) na <span
                    style='color:#EC8514'>CS201516637</span>, at rehistradong opisina sa <span
                    style='color:#EC8514'>Brgy. Paciano Rizal, Bay, Laguna.</span></span><span
                    style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                    mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                    Arial'><o:p></o:p></span></p>

                    <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                    line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                    major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                    major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                    mso-bidi-theme-font:major-bidi'>Maaari ninyo kaming abutin sa pamamagitan ng
                    pagsulat sa address sa itaas, sa pamamagitan ng contact form na makikita sa
                    Website, sa pamamagitan ng email sa<span style='color:#EC8514'>service.proveek@gmail.com
                    </span>opagtawag sa<span style='color:#EC8514'>(+63) 926-315-8641.</span></span><a
                    name="_GoBack"></a><span style='font-size:12.0pt;line-height:107%;font-family:
                    "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                    major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>
                </div>
            </div>
        </div>
    </div>
    {{--MODA LFOR TERMS - TAGALOG -- END--}}

    {{--MODAL FOR TERMS -- START--}}
    <div class="modal modal-vcenter fade lato-text" id="TERMSMODAL" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                    <h3>Terms of Service - Proveek BETA</h3>
                    <a href="#" data-dismiss="modal" data-target="#TERMSMODAL_TAGALOG" data-toggle="modal">Click here for TOS Tagalog Version</a>
                </div>
                <div class="modal-body" style="padding: 4em">
                    <div class="TOS_ENGLISH">
                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>The
                        following information below is important. Please read this page carefully.
                        Effective <b style='mso-bidi-font-weight:normal'><span style='color:#EC8514'>DATE,
                        2016</span></b>, and unless otherwise revised, this Terms of Use will be used
                        as reference as to how Users may use the Proveek.comWebsite and access other
                        services offered by <span class=SpellE>Proveek</span> Inc. If you do not accept
                        these Terms or you do not meet or comply with the set provisions, you may not
                        use the Proveek.com Website or any of its services. If you have any questions,
                        please don’t hesitate to contact </span><a
                        href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Binding
                        Agreement</span></b><b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>These
                        Terms constitute a binding agreement between You and <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Site, and are
                        deemed accepted by You each time You use or access the <span class=SpellE>Proveek</span>
                        Site and its Services. You also agree to use the Proveek.com Website at your
                        own risk. These Terms will be used as basis in the case of any conflict between
                        You and any contract you have with <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span>. </span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Updates
                        will be made to these Terms of Use from time to time so we encourage You to
                        check on these updates regularly. If you continue to use the <span
                        class=SpellE>Proveek</span> Site after modifications have been made in the
                        Terms, we shall assume that You agree to the new Terms and therefore be bound
                        to the Terms.</span><span style='font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Definitions<o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Terms</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – Terms of service. These are the conditions
                        that apply in using Proveek.com<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – User. This refers to everybody using or
                        browsing the Proveek.com. This includes both Employer and Employee.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Site</span></b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'> – Proveek.com which is the website<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        class=SpellE><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
                        normal'><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Proveek</span></i></b></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> – <span
                        class=SpellE>Proveek</span> Inc. is the company.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Copyright
                        and Use of <span class=SpellE>Proveek</span> Content<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.5in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.1 <u>Copyright</u></span></b><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.
                        Subject to the provisions set forth in these Terms:</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(a)</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><span style='mso-tab-count:1'>  </span></span><span class=SpellE><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>ProveekInc</span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>,
                        together with its licensors, owns and controls all the copyright and other
                        intellectual property rights in the Site and all its contents; and</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>(b)</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><span style='mso-tab-count:1'>  </span></span><span style='font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>All the copyright and other intellectual
                        property rights in the Site and the material on it are reserved.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You are allowed to view content, download or
                        print a copy of the content for your own private, personal and non-commercial
                        use, provided you refer and keep bound to the Terms and Conditions set in this
                        page. The contents of the Site, such as but not limited to designs, text,
                        graphics, images, video, information, logos, button icons, software, audio
                        files and other Proveek.com content (collectively, &quot;Proveek.com
                        Content&quot;), are protected under copyright, trademark and other laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You may not modify, copy, reproduce, republish,
                        upload, post, transmit, or distribute, in any manner, the content on our
                        website, including text, graphics, code and/or software. You must retain all
                        copyright and other proprietary notices contained in the original content on
                        any copy you make of the content. You may not sell or modify the content or
                        reproduce, display, publicly perform, distribute, or otherwise use the content
                        in any way for any public or commercial purpose. The use of paid content on any
                        other website or in a networked computer environment for any purpose is
                        prohibited. If you violate any of the terms or conditions, your permission to
                        use the content automatically terminates and you must immediately destroy any
                        copies you have made of the content.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.2 <u>General Use of Website</u></span></b><u><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.</span></u><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>The Site
                        is intended for individuals, specifically skilled Workers, seeking employment
                        and for Employers seeking candidates for employment. You may use the Site only
                        for lawful purposes within the stated context of <span class=SpellE>Proveek's</span>
                        intended and acceptable use of the Site. </span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Use
                        ofthe Site or taking any action in any way that causes, or may cause, damage to
                        <span class=SpellE>Proveek</span> or impairment of the performance,
                        availability or accessibility of the Site is prohibited. Likewise, the use
                        oftheSite in any way that is unlawful, illegal, fraudulent or harmful, or in
                        connection with any unlawful, illegal, fraudulent or harmful purpose or
                        activity will be dealt with accordingly. You are not allowed to use theSite to
                        copy, store, host, transmit, send, use, publish or distribute any material
                        which consists of (or is linked to) any spyware, computer virus, Trojan horse,
                        worm, keystroke logger, rootkit or other malicious computer software. You must
                        ensure that all the information you supply to us through the Proveek.com
                        Website, or in relation to the Site, is true, accurate, current, complete and
                        non-misleading.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.3<u>License to Use by Users who are Job
                        Seekers</u></span></b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> hereby grants You a limited, terminable,
                        non-exclusive right to access and use the Site only for Your personal use of
                        seeking employment opportunities for yourself. <span style='color:red'>This
                        authorizes You to view and download a single copy of the material on the Site
                        solely for Your personal, noncommercial use</span>. You agree that You are
                        solely responsible for the content of any document You post to the Site and any
                        consequences arising from such posting. <span style='color:red'>Your use of the
                        Site is a privilege</span>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> reserves the right to suspend or terminate that
                        privilege for any reason at any time, in its sole discretion.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.4<u>License to Use by Users who are Job
                        Providers or Employers</u></span></b><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> hereby grants You a limited, terminable,
                        non-exclusive right to access and use the Site only for Your internal business
                        use of seeking candidates for employment.<span style='color:red'> This
                        authorizes You to view and download a single copy of the material on the Site
                        solely for Your personal use directly related to searching for and recruiting
                        job <span class=SpellE>prospects.<i style='mso-bidi-font-style:normal'><span
                        style='color:windowtext'>Proveek</span></i></span></span> also grants You a
                        limited, terminable, non-exclusive license to use the <span class=SpellE>Proveek</span>
                        Materials and Services for Your internal use only. You may not sell, transfer
                        or assign any of the Services or Your rights to any of the <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span>-provided Services to any
                        third party without the express written authorization of <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span>. You agree that You are
                        solely responsible for the content of any Document You post to the Site and any
                        consequences arising from such posting. <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> reserves the right to suspend or terminate Your
                        access and use at any time if <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> determines that You breached these Terms and
                        Conditions.</span><span style='font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify;text-indent:.25in'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>3.5<u>Other Specific Rules Regarding Site Usage</u></span></b><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>. You
                        represent, warrant and agree that you (a) are at least 18 years of age or
                        older, and (b) will not use (or plan, encourage or help others to use) the Site
                        for any purpose or in any manner that is prohibited by these Terms or by
                        applicable law. It is your responsibility to ensure that your use of
                        Proveek.com complies with these Terms and all applicable laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Registration
                        and Accounts</span></b><b><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>4.1 <u>For Job Providers (Employers)</u></span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        maintain the confidentiality of your Employer account, Profile and password.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        not allow any other person or entity to use your Employer account to access the
                        Site and its Contents and Services.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        immediately if you become aware of any unauthorized use of your account.
                        Contact </span><a href="mailto:service.proveek@gmail.com"><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You
                        understand and acknowledge that if You terminate Your employer account, all
                        Your account information from Proveek.com, including saved resumes, network
                        contacts, and email mailing lists, will be marked as deleted and may be permanently
                        deleted from <span class=SpellE>Proveek's</span> databases. However, information
                        may continue to be available for some period of time because of delays in
                        propagating such deletion through <span class=SpellE>Proveek’s</span> web
                        servers.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l0 level1 lfo2'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your job
                        posting may not contain the following:<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>1)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>hyperlinks,
                        other than those specifically authorized by Proveek.com;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>2)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>misleading,
                        unreadable, or &quot;hidden&quot; keywords, repeated keywords or keywords that
                        are irrelevant to the job opportunity being presented;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>3)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>the
                        names, logos or trademarks of unaffiliated companies other than those of your
                        own;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>4)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>the
                        names of colleges, cities, states, towns or countries that are unrelated to
                        Your posting;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>more
                        than one job or job description, more than one location, or more than one job
                        category, unless the specific job so allows;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>inaccurate,
                        false, or misleading information;<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>material
                        or links to material that exploits people in a sexual, violent or other manner,
                        or solicits personal information from anyone under 18; and<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:0in;
                        margin-bottom:0in;margin-left:1.0in;margin-bottom:.0001pt;mso-add-space:auto;
                        text-align:justify;text-indent:-.25in;mso-list:l1 level1 lfo3'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>materials
                        or links to material that leads to activities prohibited by law such as human
                        trafficking, illegal drug trade, etc.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your
                        user ID must not be liable to mislead <span class=SpellE>Proveek</span>, Job
                        Seekers, and other users of the Site; you must not use your account or user ID
                        for or in connection with the impersonation of any person. <o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You must keep your password confidential</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify us immediately if you become aware of any disclosure of your password. Contact
                        </span><a href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You are
                        responsible for any activity on our website arising from any failure to keep
                        your password confidential, and may be held liable for any losses arising from
                        such failure.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        ensure that all personal information that <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Worker have
                        access to are accurate, complete, up to date and not misleading. You may not
                        impersonate another person, living or dead, or company you don't have any
                        connection to.<o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
                        margin-left:.75in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
                        mso-list:l0 level1 lfo2'><![if !supportLists]><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(k)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You may deactivate your account on Proveek.com using your account
                        control panel on your profile.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpFirst style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>4.2 <u>For Job Seekers (Workers)</u></span><o:p></o:p></b></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(a)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        be 18 years old and above tobe eligible to create an account on the Site.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(b)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You may
                        register for an account with Proveek.com by completing and submitting the
                        account registration form, and clicking on the verification link in the email
                        that will be sent to you. <span style='color:red'>Registration for Workersis
                        FREEof charge</span>.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(c)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        not allow any other person to use your account to access the Website.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(d)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify <span class=SpellE>Proveek</span> immediately if you become aware of any
                        unauthorized use of your account. Contact </span><a
                        href="mailto:service.proveek@gmail.com"><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(e)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Your
                        user ID must not be liable to mislead <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span>, Job Providers, and other users of the Site; you
                        must not use your account or user ID for or in connection with the
                        impersonation of any person. <o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(f)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You must keep your password confidential</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(g)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        notify us immediately if you become aware of any disclosure of your password.
                        Contact </span><a href="mailto:service.proveek@gmail.com"><span
                        style='font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>service.proveek@gmail.com</span></a><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>for
                        further assistance regarding this matter.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(h)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You are
                        responsible for any activity on our website arising due to any failure to keep
                        your password confidential, and may be held liable for any losses arising due
                        to such failure.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(i)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>You must
                        ensure that all personal information that <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i></span> and the Employer have
                        access to are accurate, complete, up to date and not misleading. You may not
                        impersonate another person, living or dead.<o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='margin-left:.75in;mso-add-space:
                        auto;text-align:justify;text-indent:-.25in;mso-list:l6 level2 lfo5'><![if !supportLists]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>(j)<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>You may deactivate your account on Proveek.com using your account
                        control panel on your profile.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><o:p></o:p></span></p>

                        <p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>5.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Payment
                        of Fees (For Job Providers or Employers)<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>All fees
                        owed to Proveek.com must be paid within the specified payment terms from the
                        date of the invoice. Late payment may be charged an interest of <span
                        style='color:red'>8% per annum</span>. <span style='color:red'>All prices
                        quoted are exclusive of any applicable taxes unless specifically noted
                        otherwise.</span></span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi;
                        color:red'>If at any time during the course of this Agreement you should
                        terminate Your Account in which these Terms have been incorporated by
                        reference, then <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        reserves the right to receive all payments from You for the Services You used
                        up to termination and for fifty percent (50%) of the remaining unused portion
                        of the Service Agreement.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial;color:red'><o:p></o:p></span></p>

                        <p class=MsoNormal style='margin-left:.25in;text-align:justify'><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial;color:red'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Calibri Light";
                        mso-fareast-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        "Calibri Light";mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>6.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limited
                        Warranties<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek.com does not warrant the following: the
                        completeness or accuracy of the information published on the Site;that the
                        material on the Site is up to date; orthat the Site or any service will remain
                        available in a certain period of time.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>
                        reserves the right to discontinue or alter any or all of theSite’s services,
                        and to stop publishing the Site at any time in its discretion without notice or
                        explanation, and save to the extent expressly provided otherwise in these
                        Terms. You will not be entitled to any compensation or other payment upon the
                        discontinuance or alteration of any services, or if we stop publishing the
                        Site.</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> does
                        not offer any form of insurance, or other Employer or Worker protection.</span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin'> does not
                        ensure the completeness or accuracy of Users information since User
                        identification on the internet is difficult. We, however, may provide some User
                        information based on the conducted third party background check or verification
                        of identity or credentials though such information are solely based on the
                        details that the User submitsand these data were only provided solely for the convenience
                        of Users and not in any way an introduction, endorsement or recommendation by <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>.<o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>7.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Limitations
                        and exclusions of liability</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>These terms and conditions will:limit or
                        exclude any liability for death or personal injury resulting from
                        negligence;limit or exclude any liability for fraud or fraudulent
                        misrepresentation;limit any liabilities in any way that is not permitted under
                        applicable law; orexclude any liabilities that may not be excluded under
                        applicable law.</span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>To the extent that the Site and its contents
                        are provided free of charge, <span class=SpellE><i style='mso-bidi-font-style:
                        normal'>Proveek</i></span> will not be liable for any loss or damage of any
                        nature. <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        will not be liable in any case of losses arising out of any event or events
                        beyond reasonable control.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> will
                        not be liable to Employers or Job Providers regarding any business losses,
                        including (without limitation to) loss of or damage to profits, income,
                        revenue, use, production, anticipated savings, business, contracts, commercial
                        opportunities or goodwill.</span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'> will
                        not be liable in any loss or corruption of any data, database or software.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>8.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-fareast-font-family:
                        "Times New Roman";mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>Breaching
                        these Terms</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Without prejudice to <span class=SpellE><i
                        style='mso-bidi-font-style:normal'>Proveek</i>’s</span> other rights under
                        theseTerms, if You breach these Terms in any way, or if <span class=SpellE>Proveek</span>
                        reasonably suspect that you have breached these Terms in any way, You may be: </span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(a)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>sent one or more formal warnings;</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(b)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>allowed limited access to the Site;<o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>(c)<span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>suspended or your account deleted from the Site;</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(c)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>permanently prohibited from accessing the Site;
                        and/or</span><span style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>(d)</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>        </span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>filed a legal action against You, whether for
                        breach of contract or otherwise.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><span
                        style='mso-tab-count:1'>       </span><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>When<i
                        style='mso-bidi-font-style:normal'>Proveek</i></span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-fareast-font-family:"Times New Roman";
                        mso-fareast-theme-font:major-fareast;mso-hansi-theme-font:major-latin;
                        mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:major-bidi'>
                        suspends or prohibits or blocks Your access to the Site, You must not take any
                        action to evade such suspension or prohibition or blocking (including without
                        limitation creating and/or using a different account).</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>9.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp; </span></span></span></b><![endif]><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'>Severability<o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>If a provision under these Terms is determined
                        by any court or other competent authority to be unlawful and/or unenforceable,
                        the other remaining provisions will continue in effect.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>If any unlawful and/or unenforceable provision
                        under these Terms would be considered lawful or enforceable if part of it were
                        deleted, that part will be deemed to be deleted, and the rest of the provision
                        will continue in effect. </span><span style='font-size:12.0pt;line-height:107%;
                        font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>10.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Third party rights</span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>A contract under these Terms is for You and <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i>’s</span>
                        benefit, and is not intended to benefit or be enforceable by any third party.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>The exercise of the parties' rights under these
                        Terms is not subject to the consent of any third party.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>11.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Entire agreement</span></b><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>These Terms, together with <span class=SpellE>Proveek.com’s</span>
                        Privacy Policy, shall constitute the entire agreement between You and <span
                        class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span> in relation
                        to your use of theSite and shall supersede all previous agreements between You
                        and <span class=SpellE><i style='mso-bidi-font-style:normal'>Proveek</i></span>
                        in relation to your use of theSite.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>12.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Law and jurisdiction</span></b><b
                        style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>A contract under these Terms shall be governed
                        by and construed in accordance with the Philippine laws.</span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:14.0pt;
                        mso-bidi-font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p>&nbsp;</o:p></span></p>

                        <p class=MsoListParagraph style='text-align:justify;text-indent:-.25in;
                        mso-list:l2 level1 lfo1'><![if !supportLists]><b style='mso-bidi-font-weight:
                        normal'><span style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Calibri Light";mso-fareast-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Calibri Light";
                        mso-bidi-theme-font:major-latin'><span style='mso-list:Ignore'>13.<span
                        style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span></span></span></b><![endif]><b><span style='font-size:14.0pt;mso-bidi-font-size:
                        12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'><span style='mso-spacerun:yes'> </span>PROVEEK
                        Details</span></b><b style='mso-bidi-font-weight:normal'><span
                        style='font-size:14.0pt;mso-bidi-font-size:12.0pt;line-height:107%;font-family:
                        "Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;mso-hansi-theme-font:
                        major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></b></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek.com is owned and operated by <span
                        class=SpellE>Proveek</span> Inc.</span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span class=SpellE><i
                        style='mso-bidi-font-style:normal'><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:major-fareast;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Proveek</span></i><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>Inc</span></span><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>. is registered in the <span style='color:#EC8514'>Securities
                        And Exchange Commission (SEC) of the Philippines</span> under registration
                        number <span style='color:#EC8514'>CS201516637</span>, with registered office
                        at <span class=SpellE><span style='color:#EC8514'>Brgy</span></span><span
                        style='color:#EC8514'>. <span class=SpellE>Paciano</span> Rizal, Bay, Laguna.</span></span><span
                        style='font-size:12.0pt;line-height:107%;font-family:"Calibri Light","sans-serif";
                        mso-ascii-theme-font:major-latin;mso-hansi-theme-font:major-latin;mso-bidi-font-family:
                        Arial'><o:p></o:p></span></p>

                        <p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
                        line-height:107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:
                        major-latin;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:
                        major-fareast;mso-hansi-theme-font:major-latin;mso-bidi-font-family:"Times New Roman";
                        mso-bidi-theme-font:major-bidi'>You can contact us by writing to the business
                        address given above, by using our website contact form, by email to <span
                        style='color:#EC8514'>service.proveek@gmail.com </span>or by telephone on <a
                        name="_GoBack"><span style='color:#EC8514'>(+63) 926-315-8641.</span></a></span><span
                        style='mso-bookmark:_GoBack'></span><span style='font-size:12.0pt;line-height:
                        107%;font-family:"Calibri Light","sans-serif";mso-ascii-theme-font:major-latin;
                        mso-hansi-theme-font:major-latin;mso-bidi-font-family:Arial'><o:p></o:p></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--MODAL FOR TERMS -- END--}}


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