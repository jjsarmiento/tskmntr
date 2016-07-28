<html>
    <head>
        <title>Resend Validation link to new email</title>
        {{ HTML::style('frontend/css/bootstrap.min.css') }}
        {{ HTML::style('frontend/css/custom.css') }}
        {{ HTML::script('frontend/js/jquery.js') }}
        {{ HTML::script('frontend/js/bootstrap.min.js') }}
        <style>
            body {
                background-color: #E9EAED;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            }
        </style>
    </head>
    <body>
        <center>
        <div style="margin-top: 4em;">
            <img src="frontend/img/proveek-logo-300.png" class="img-responsive center-block">
            <div class="col-md-4 col-md-offset-4">
                <div class="widget-container" style="min-height: 1em;">
                    <div class="widget-content padded">
                        @if(Session::has('errorMsg'))
                            <div class="padded" style="background-color: #ffcccc; margin-bottom: 1em; border-radius: 0.3em;">{{Session::get('errorMsg')}}</div>
                        @elseif(Session::has('successMsg'))
                            <div class="padded" style="background-color: #b3ffb3; margin-bottom: 1em; border-radius: 0.3em;">{{Session::get('successMsg')}}</div>
                        @endif
                        <form method="POST" action="doVERIFY_changeEmail">
                            <input type="hidden" name="userID" value="{{$user->id}}" />
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required="required" />
                            </div>
                            <div class="form-group">
                                <label>New Email</label>
                                <input type="email" class="form-control" name="email" required="required" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-success btn-block btn">SEND VERIFICATION LINK</button>
                            </div>
                        </form>
                        <p><i>*The verification will be sent to the new email you will input.</i></p>
                    </div>
                </div>
            </div>
        </div></center>
    </body>
</html>