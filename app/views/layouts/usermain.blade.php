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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">
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
            <div class="col-sm-3 col-md-3 pull-left">
                {{ Form::open(array('method' => 'GET', 'url' => 'workerDoSearch', 'class' => 'navbar-form')) }}
                    <div class="input-group">
                        <input type="text" class="form-control input-trans srchAnim" placeholder="Search for companies" required name="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        <!-- END OF TASKMINATOR / WORKER -->

        <!-- EMPLOYERS / COMPANIES -->
            @elseif($role == 'CLIENT_IND' || $role == 'CLIENT_CMP')
            <div class="col-sm-3 col-md-3 pull-left">
                {{ Form::open(array('method' => 'GET', 'url' => 'compDoSearch', 'class' => 'navbar-form')) }}
                    <div class="input-group">
                        <input type="text" class="form-control input-trans srchAnim" placeholder="Search for workers / preffered skills" required name="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-trans" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
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
                            <li>
                                @if($role == 'TASKMINATOR')
                                    <a href="/editProfile"><i class="fa fa-pencil fa-fw"></i> Edit Profile</a>
                                @elseif($role == 'CLIENT_CMP' || $role == 'CLIENT_IND')
                                    <a href="/editProfile"><i class="fa fa-pencil fa-fw"></i> Edit Profile</a>
                                @elseif($role == 'ADMIN')
                                @endif
                            </li>
                            <li><a href="#"><i class="fa fa-camera-retro fa-fw"></i> Edit Cover Photo</a></li>
                            <li><a href="#"><i class="fa fa-cog fa-fw"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
<!-- END OF MASTER USER LAYOUT-->

<!-- CONTENT OF THE PAGE -->

  	@yield('content')

<!-- END OF CONTENT -->

<!-- All scripts and plugin should be placed here so the page can load -->
<!-- jQuery -->
    {{ HTML::script('frontend/js/jquery.js') }}
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
        setInterval(function(){
                    $.ajax({
                        type        :   'GET',
                        url         :   '/checkMsgCount',
                        success     :   function(data){
                            if(data > 0){
                                $('#msg_count').empty().append(data).show();
                            }else{
                                $('#msg_count').empty().hide();
                            }
                        }
                    })
                }, 3000);

                setInterval(function(){
                    $.ajax({
                        type        :   'POST',
                        url         :   '/taskminator/notify',
                        success     :   function(data){
                            console.log(data);
                        }
                    })
                }, 10000);
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