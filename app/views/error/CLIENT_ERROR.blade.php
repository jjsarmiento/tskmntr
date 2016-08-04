<html>
    <head>
        <title>Proveek Beta</title>
        {{ HTML::style('frontend/css/bootstrap.min.css') }}
        {{ HTML::style('frontend/css/custom.css') }}
        {{ HTML::script('frontend/js/jquery.js') }}
        {{ HTML::script('frontend/js/bootstrap.min.js') }}
        {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
        <style>
            body {
                background-color: #E9EAED;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            }
        </style>
    </head>
    <body>
        <center>
        <div style="margin-top: 3em;">
            <img src="frontend/img/proveek-logo-300.png" class="img-responsive center-block">
            <div class="col-md-4 col-md-offset-4">
                <div class="widget-container padded" style="min-height: 1em;">
                    <div class="widget-content">
                    <div class="row">
                        <i class="fa fa-warning fa-4x" style="color: #E74C3C;"></i><br/>
                        {{$msg}}
                        <hr/>
                        {{--Click <a href="/TOPUP">here</a> to top up your points!<br/>--}}
                        Click <a href="/">here</a> to go back to home<br/>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </center>
    </body>
</html>