<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request){
    
});


App::after(function($request, $response){
    // THIS CODE PREVENTS BACKING UP TO PAGES (WITH THE USE OF "BACK BUTTON") AFTER LOGGING OUT - JAN SARMIENTO
    $response->headers->set("Cache-Control","no-cache, no-store, must-revalidate");
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('ADMIN-ONLY', function(){
   if(Auth::check()){
       switch(Auth::user()->status){
           case 'DEACTIVATED'      :
           case 'SELF_DEACTIVATED' :
           case 'ADMIN_DEACTIVATED':
               Auth::logout();
               return Redirect::to('/login')->with('errorMsg', 'Your account has been deactivated. Contact us for more information');
       }

       if(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') != 1){
           return Redirect::to('/');
       }
   }else{
       return Redirect::to('/');
   }
});

Route::filter('EMPLOYER-UPDATE-PROFILE-PROGRESS', function(){
    if(BaseController::PROVEEK_PROFILE_PERCENTAGE_EMPLOYER(Auth::user()->id) < 50){
        Session::flash('errorMsg', 'You must first complete at least 50% of your profile to complete this action');
        return Redirect::to('/');
    };
});

Route::filter('WORKER-UPDATE-PROFILE-PROGRESS', function(){
    if(BaseController::PROVEEK_PROFILE_PERCENTAGE_WORKER(Auth::user()->id) < 50){
        Session::flash('errorMsg', 'You must first complete at least 50% of your profile to complete this action');
        return Redirect::to('/');
    }
});

Route::filter('worker_bookmark_limit', function(){
    $basecontroller = new BaseController;
    if($basecontroller->SUBSCRIPTION_RESTRICTIONS(Auth::user()->id, 'worker_bookmark_limit')){
        return View::make('error.SUBSCRIPTION_ERROR')
            ->with('msg', 'You have reached your subscriptions bookmark limit!')
            ->with('sub', $basecontroller->SUBSCRIPTION_DETAILS(Auth::user()->id));
    }
});

Route::filter('invite_limit', function(){
    $basecontroller = new BaseController;
    if($basecontroller->SUBSCRIPTION_RESTRICTIONS(Auth::user()->id, 'invite_limit')){
        return View::make('error.SUBSCRIPTION_ERROR')
                ->with('msg', 'You have reached your subscriptions invite limit!')
                ->with('sub', $basecontroller->SUBSCRIPTION_DETAILS(Auth::user()->id));
    }
});

Route::filter('JOB_LIMITS', function(){
    $basecontroller = new BaseController;
    if($basecontroller->SUBSCRIPTION_RESTRICTIONS(Auth::user()->id, 'job_ad_limit_month')){
        return View::make('error.SUBSCRIPTION_ERROR')
            ->with('msg', "You have reached your subscription's monthly job ad limit!")
            ->with('sub', $basecontroller->SUBSCRIPTION_DETAILS(Auth::user()->id));
    }elseif($basecontroller->SUBSCRIPTION_RESTRICTIONS(Auth::user()->id, 'job_ad_limit_week')){
        return View::make('error.SUBSCRIPTION_ERROR')
            ->with('msg', "You have reached your subscription's weekly job ad limit!")
            ->with('sub', $basecontroller->SUBSCRIPTION_DETAILS(Auth::user()->id));
    }
});

Route::filter('CLIENT-ONLY', function(){
    if(Auth::check()){
        switch(Auth::user()->status){
            case 'DEACTIVATED'      :
            case 'SELF_DEACTIVATED' :
            case 'ADMIN_DEACTIVATED':
                Auth::logout();
                return Redirect::to('/login')->with('errorMsg', 'Your account has been deactivated. Contact us for more information');
        }

        if(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') != 3 && UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') != 4){
            return Redirect::to('/');
        }


        // check for expired job ads
        BaseController::ROUTE_UPDATE_JOBADS(Auth::user()->id);
        // check if subscription is expired
        BaseController::SUBSCRIPTION_UPDATE(Auth::user()->id);
    }else{
        return Redirect::to('/');
    }
});

Route::filter('TASKMINATOR-ONLY', function(){
    if(Auth::check()){
        switch(Auth::user()->status){
            case 'DEACTIVATED'      :
            case 'SELF_DEACTIVATED' :
            case 'ADMIN_DEACTIVATED':
                Auth::logout();
                return Redirect::to('/login')->with('errorMsg', 'Your account has been deactivated. Contact us for more information');
        }

        if(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') != 2){
            return Redirect::to('/');
        }

        BaseController::PROVEEK_PROFILE_PERCENTAGE_WORKER(Auth::user()->id);
    }else{
        return Redirect::to('/');
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
