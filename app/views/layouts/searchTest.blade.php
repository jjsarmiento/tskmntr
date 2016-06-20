<!DOCTYPE html>
<html>
<head>
	<title>@yield('head')</title>
	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">
	<!-- jQuery -->
    <script src="frontend/js/jquery.js"></script>
	<!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">
	
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">

	<style type="text/css">
		.noborder
		{
			padding:0; margin:0;
		}
		article
		{
			border-bottom:1px solid #ccc;
			padding-top:0;
		}
		article h2
		{
			
		}
		a
		{
			text-decoration: none;
			
		}
	</style>
	@yield('head-content')
</head>
<body class="noborder">
	@yield('content')
	<div class="panel panel-default">
		{{ Form::open(array('method' => 'GET' , 'url' => 'search')) }}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Search by Username, Name or keyword...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">Search</button>
			    </span>
			</div>
		{{ Form::close() }}
	</div>
	@yield('content-result')

<!-- All scripts and plugin should be placed here so the page can load -->

	
<!-- Bootstrap Core JavaScript -->
    <script src="frontend/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
    <script src="frontend/js/jquery.easing.min.js"></script>
    <script src="frontend/js/jquery.fittext.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/vegas.js"></script>

<!-- Custom Theme JavaScript -->
    <script src="frontend/js/creative.js"></script>
    <script src="frontend/js/jquery.nicescroll.js"></script>

<!-- HTML SMOOTH MOUSEWHEEL SCROLLING -->
    <script>
    $(document).ready(

      function() { 

        $("html").niceScroll();

      }
    );
    </script>
<!-- END OF SMOOTH MOUSEWHEEL SCROLLING -->
</body>
</html>