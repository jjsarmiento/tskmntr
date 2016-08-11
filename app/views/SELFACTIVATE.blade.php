<html>
    <head>

        {{ HTML::style('frontend/css/bootstrap.min.css') }}
        {{ HTML::script('frontend/js/jquery.js') }}
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <style>
            body{background-color:#E9EAED;}
        </style>
    </head>
    <body>
        <section>
            <div class="col-md-8 col-md-offset-2" style="margin-top: 5em;">
                <div class="panel-body" style="background-color: #ffffff;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Personal Information</h4>
                            Name : {{ $user->fullName }}
                        </div>
                        <div class="col-md-6">
                            <h4>Account Information</h4>
                            Username : {{ $user->username }}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="/ACTVTACCT={{$user->id}}" class="btn btn-success btn-xs">Activate Account</a>
                </div>
            </div>
        </section>
    </body>
</html>