<?php

// Importing the BotDetectCaptcha class
use Captcha\Integration\BotDetectCaptcha;
use Carbon\Carbon;

class HomeController extends BaseController {

    public function TESTINGROUTE(){
        return BaseController::PROVEEK_PROFILE_PERCENTAGE_EMPLOYER(2);
    }

    function generateConfirmationCode(){
        $random = '';
        while(1){
            $random = md5(uniqid(rand(), true));
            if(User::where('confirmationCode', $random)->count() == 0){
                break;
            }
        }
        return $random;
    }

    function emailValidate($email){
        return preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $email);
    }


    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function register(){
        return View::make('register')->with('regions', Region::all());
    }

    public function toProfile($username){
        if(User::where('username', $username)->count()!= 0){
            // OWNER OF THE PROFILE'S DETAILS
            $temp = User::where('username', '=', $username)->first();

            // PROFILE OWNER'S ROLE
            $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                ->where('user_has_role.user_id', $temp->id)
                ->pluck('role');

            $QUERY_CONTACT = Contact::where('user_id', $temp->id);
            $mobile = $QUERY_CONTACT->where('ctype', 'mobileNum')->pluck('content');

            // DETERMINE IF USER HAS CHECKEDOUT WORKER -- START by Jan Sarmiento
            $USERINCART = false;
            $PURCHASED = false;
            $CLIENTFLAG = false;
            $MULTIJOB = false;

            if(Auth::check()){
                if($temp->total_profile_progress < 50){
                    return Redirect::to('/');
                }

                if($role == 'TASKMINATOR'){
                    $HAS_INVITES = null;
                    if(User::GETROLE(Auth::user()->id) == 'CLIENT_IND' || User::GETROLE(Auth::user()->id) == 'CLIENT_CMP'){
                        $CLIENTFLAG = true;
                    }

                    $CLIENT_PROGRESSFLAG = (Auth::user()->total_profile_progress >= 50) ? true : false;

                    if($role == 'TASKMINATOR' && $CLIENTFLAG){
                        $USERINCART =  Cart::where('worker_id', $temp->id)
                            ->where('company_id', Auth::user()->id)
                            ->count();

                        $PURCHASED = Purchase::where('worker_id', $temp->id)
                            ->where('company_id', Auth::user()->id)
                            ->count();

                        $MULTIJOB = Job::where('user_id', Auth::user()->id)
                            ->whereIn('skill_code', User::getSkillsCODE_ARRAY($temp->id))
                            ->whereNotIn('id', $this->WORKERGETINVITES_JOBID($temp->id))
                            ->get();

                        $HAS_INVITES = Job::join('job_invites', 'job_invites.job_id', '=', 'jobs.id')
                            ->whereIn('job_invites.job_id', BaseController::ALL_JOBS_STATIC(Auth::user()->id))
                            ->select([
                                'jobs.id',
                                'jobs.title',
                                'job_invites.created_at'
                            ])
                            ->get();
                    }
                    // DETERMINE IF USER HAS CHECKEDOUT WORKER -- END by Jan Sarmiento
                    return View::make('profile_worker')
                        ->with("users", User::where('username', '=', $username)->get()->first())
                        ->with('roles', $role)
                        ->with('mobile', $mobile)
                        ->with('DOCS', $this->DOCUMENTS_GETEXISTINGLABELS($temp->id))
                        ->with('CLIENT_PROGRESSFLAG', $CLIENT_PROGRESSFLAG)
                        ->with('CLIENTFLAG', $CLIENTFLAG)
                        ->with('USERINCART', $USERINCART)
                        ->with('PURCHASED', $PURCHASED)
                        ->with('MULTIJOB', $MULTIJOB)
                        ->with('HAS_INVITES', $HAS_INVITES);
                }else{
                    $users = User::leftJoin('regions', 'regions.regcode', '=', 'users.region')
                                ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
                                ->leftJoin('barangays', 'barangays.bgycode', '=', 'users.barangay')
                                ->leftJoin('provinces', 'provinces.provcode', '=', 'users.province')
                                ->where('users.id', $temp->id)
                                ->select([
                                    'users.id',
                                    'users.address',
                                    'users.businessDescription',
                                    'users.businessNature',
                                    'users.companyName',
                                    'users.fullName',
                                    'users.years_in_operation',
                                    'users.number_of_branches',
                                    'users.working_hours',
                                    'regions.regname',
                                    'provinces.provname',
                                    'cities.cityname',
                                    'barangays.bgyname',
                                ])
                                ->first();

                    $license = Document::where('user_id', $users->id)->where('type', 'DOLE_POEA_LISENCE')->first();
                    return View::make('profile_clients')
                        ->with('license', $license)
                        ->with("users", $users);
                }
            }else{
                if($role == 'TASKMINATOR'){
                    return View::make("publicProfile")
                        ->with("users", User::where('username', '=', $username)->get()->first())
                        ->with('roles', $role)
                        ->with('mobile', $mobile)
                        ->with('CLIENTFLAG', $CLIENTFLAG)
                        ->with('USERINCART', $USERINCART)
                        ->with('PURCHASED', $PURCHASED)
                        ->with('MULTIJOB', $MULTIJOB);
                }else{
                    return View::make('ERRORPAGE');
                }
            }

        }else{
//            return "ROUTE DOESN'T EXIST";
            return View::make('ERRORPAGE');
        }
    }

    public function regEmployer(){
        $captcha=$_POST['g-recaptcha-response'];
        $privatekey = "6LfpJyITAAAAAHn92bsWJxBb4TFCggUdSndYmZPo";

        if(!$captcha){
            echo 'captch not checked!';
        }else{
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $data = json_decode($response);
//            if(isset($data->success) AND $data->success==false){
            if(false){
                echo "Hey! Spammer I'm Using Google reCAPTCHA! Get Out";
            }else{
                // back up checking for username - Jan Sarmiento
                if(User::where('username', Input::get('uName'))->count() > 0){
                    return Redirect::to('/');
                }

                Input::merge(array_map('trim', Input::all()));

                $points = 300;

                date_default_timezone_set("Asia/Manila");
                $userId = User::insertGetId(array(
                    'companyName'           =>  Input::get('compName'),
                    'fullName'              =>  Input::get('compName'),
                    'username'              =>  Input::get('uName'),
                    'password'              =>  Hash::make(Input::get('primary_pass')),
                    'confirmationCode'      =>  $this->generateConfirmationCode(),
                    'status'                =>  'VERIFY_EMAIL_REGISTRATION',
                    'country'               =>  'PHILIPPINES',
                    'created_at'            =>  date("Y:m:d H:i:s"),
                    'updated_at'            =>  date("Y:m:d H:i:s"),
                    'points'                =>  $points,
                    'accountType'           =>  'BASIC',
                ));

                UserHasRole::insert(array(
                    'user_id'   =>  $userId,
                    'role_id'   =>  '4'
                ));

                ContactPerson::insert(array(
                    'user_id'       => $userId,
                    'firstName'     => Input::get('fName'),
                    'midName'       => NULL,
                    'lastName'      => Input::get('lName'),
                    'contactNum'    => NULL,
                    'position'      => NULL,
                    'country'       => 'PHILIPPINES'
                ));

                Contact::insert(array(
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'email',
                        'content'       =>  Input::get('txtEmail'),
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'businessNum',
                        'content'       =>  NULL,
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'mobileNum',
                        'content'       =>  Input::get('mobileNum'),
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'facebook',
                        'content'       =>  NULL,
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'twitter',
                        'content'       =>  NULL,
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'linkedin',
                        'content'       =>  NULL,
                    )
                ));

                AuditTrail::insert(array(
                    'user_id'   =>  $userId,
                    'content'   =>  'Created a Client Company account at '.date('D, M j, Y \a\t g:ia'),
                    'created_at'    =>  date("Y:m:d H:i:s"),
                    'at_url'        =>  '/viewUserProfile/'.$userId
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
                ));

                // VALIDATE EMAIL - SEND MAIL NOTIFICATION -- START
                // insert activation code
                $activationCode = uniqid().'_'.time();
                $codecreated_at = time(); //date("Y:m:d H:i:s");
                $duration = $codecreated_at+86400;
                ActivationCode::insert([
                    'user_id'       =>  $userId,
                    'code'          =>  $activationCode,
                    'created_at'    =>  date("Y:m:d H:i:s", $codecreated_at),
                    'duration'      =>  date("Y:m:d H:i:s", $duration)
                ]);

                $data = array(
                    'msg'   =>  'CLICK ON THE LINK OR COPY AND PASTE IT ON THE BROWSER TO VALIDATE YOUR PROVEEK ACCOUNT',
                    'url'   =>  URL::to('/').'/VRFYACCT='.$activationCode
                );

                $email = Input::get('txtEmail');

                Mail::send('emails.REGISTRATION_SUCCESS', $data, function($message) use($email){
                    $message->from('admin@proveek.com', 'Proveek');
                    $message->to($email)->subject('Proveek BETA - Validate Account');
                });
                // VALIDATE EMAIL - SEND MAIL NOTIFICATION -- END

//                Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
                Session::flash('successMsg', 'We have sent a validation link to your email! <br/> Please validate your account to start using Proveek');
                return Redirect::to('/login');
//            return Redirect::to('/')->with('successMsg', 'Registration Success. You may now login.');
            }
        }
    }

    public function doRegisterComp(){
        Input::merge(array_map('trim', Input::all()));

        $check = SimpleCaptcha::check($_POST['captcha']);

        if(!$check) {
            return Redirect::back()->with('errorMsg', 'Captcha does not match. Please retry.')->withInput(Input::except('password', 'captcha'));
        }

        $rules = array(
            'companyName'           => 'required',
            'businessNature'        => 'required',
            'experience'            => 'required',
            'businessDescription'   => 'required',
            'address'               => 'required',
            'businessNum'           => 'required|numeric',
            'firstName-keyperson'   => 'required',
            'midName-keyperson'    => 'required',
            'lastName-keyperson'    => 'required',
            'position-keyperson'    => 'required',
            'regNum'                => 'required',
            'email'                 => 'required|email',
            'username'          => 'required|unique:users,username',
            'password'          => 'required|min:8',
            'confirmpass'       => 'required|min:8|same:password',
            'TOS'               => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::back()->with('errorMsg', $validator->messages()->first())->withInput(Input::except('password', 'captcha'));
        }
        // else validation successful

        if(User::count() < 30){
            $points = 100;
        }else{
            $points = 0;
        }

        date_default_timezone_set("Asia/Manila");
        $userId = User::insertGetId(array(
            'companyName'           =>  Input::get('companyName'),
            'fullName'              =>  Input::get('companyName'),
            'address'               =>  strip_tags(Input::get('address')),
            'businessNature'        =>  Input::get('businessNature'),
            'businessDescription'   =>  Input::get('businessDescription'),
            'businessPermit'        =>  Input::get('regNum'),
            'username'              =>  Input::get('username'),
            'password'              =>  Hash::make(Input::get('password')),
            'confirmationCode'      =>  $this->generateConfirmationCode(),
            'yearsOfExperience'     =>  Input::get('experience'),
            'status'                =>  'PRE_ACTIVATED',
            'country'               =>  'PHILIPPINES',
            'created_at'            =>  date("Y:m:d H:i:s"),
            'updated_at'            =>  date("Y:m:d H:i:s"),
            'points'                =>  $points,
            'accountType'           =>  'BASIC',
        ));

        UserHasRole::insert(array(
            'user_id'   =>  $userId,
            'role_id'   =>  '4'
        ));

        ContactPerson::insert(array(
            'user_id'       => $userId,
            'firstName'     => Input::get('firstName-keyperson'),
            'midName'       => Input::get('midName-keyperson'),
            'lastName'      => Input::get('lastName-keyperson'),
            'contactNum'    => Input::get('mobileNum-keyperson'),
            'position'      => Input::get('position-keyperson'),
            'country'       => 'PHILIPPINES'
        ));

        Contact::insert(array(
            array(
                'user_id'       =>  $userId,
                'ctype'         =>  'email',
                'content'       =>  Input::get('email'),
            ),
            array(
                'user_id'       =>  $userId,
                'ctype'         =>  'businessNum',
                'content'       =>  Input::get('businessNum'),
            )
        ));

        AuditTrail::insert(array(
            'user_id'   =>  $userId,
            'content'   =>  'Created a Client Company account at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$userId
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

        // send email verification for registration - jan sarmiento

        $msg = 'Your registration has been successful!<br/>You may now login to your account!';
        $url =  URL::to('/').'/login';
        $email = Input::get('email');

        $data = [
            'url'   => $url,
            'msg'   => $msg
        ];

        Mail::send('emails.changepass_Template', $data, function($message) use($email)
        {
            $message->from('taskminator.mail@gmail.com', 'Proveek');
            $message->to($email)->subject('Proveek Beta Password Management');
        });

        Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
        return Redirect::to('/')->with('successMsg', 'Registration Success. You may now login.');
    }

    public function checkCaptcha(){
        // check captcha
        $check = SimpleCaptcha::check($_POST['captcha']);

        if(!$check) {
            return false;
        }
    }

    public function doRegisterIndi(){
        Input::merge(array_map('trim', Input::all()));
        $check = SimpleCaptcha::check($_POST['captcha']);

        if(!$check) {
            return Redirect::back()->with('errorMsg', 'Captcha does not match. Please retry.')->withInput(Input::except('password', 'captcha'));
        }

        $rules = array(
            'firstName' => "required|regex:/^[\p{L}\s'.-]+$/",
            'midName'  => "required|regex:/^[\p{L}\s'.-]+$/",
            'lastName' => "required|regex:/^[\p{L}\s'.-]+$/",
            'gender' => 'required',
            'occupation' => "required|regex:/^[\p{L}\s'()]+$/",
            'month' => 'required',
            'date' => 'required',
            'year' => 'required',
            'mobileNum' => 'required|numeric|min:11',
            'tin1' => 'required|regex:/^[0-9]+$/|digits:3',
            'tin2' => 'required|regex:/^[0-9]+$/|digits:3',
            'tin3' => 'required|regex:/^[0-9]+$/|digits:3',
            'email' => 'required|email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'confirmpass' => 'required|min:8|same:password',
            'TOS' => 'required'
        );

        $messages = array(
            'firstName.regex' => 'Name must be letters only',
            'midName.regex' => 'Name must be letters only',
            'lastName.regex' => 'Name must be letters only',
            'occupation.regex' => 'Occupation should not have special characters',
            'tin1.regex' => 'Wrong TIN number',
            'tin2.regex' => 'Wrong TIN number',
            'tin3.regex' => 'Wrong TIN number',
            'tin1.required' => 'Fill up all fields for TIN number',
            'tin2.required' => 'Fill up all fields for TIN number',
            'tin3.required' => 'Fill up all fields for TIN number',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails()){
            return Redirect::back()->with('errorMsg', $validator->messages()->first())->withInput(Input::except('password', 'captcha'));
        }

        // if validation is successful
        if(User::count() < 30){
            $points = 100;
        }else{
            $points = 0;
        }

        $userId = User::insertGetId(array(
            'username'      =>  Input::get('username'),
            'password'      =>  Hash::make(Input::get('password')),
            'firstName'     =>  Input::get('firstName'),
            'midName'       =>  Input::get('midName'),
            'lastName'      =>  Input::get('lastName'),
            'fullName'      =>  Input::get('firstName').' '.Input::get('midName').' '.Input::get('lastName'),
            'birthdate'     =>  Input::get('year').'-'.Input::get('month').'-'.Input::get('date'),
            'tin'           =>  Input::get('tin1').'-'.Input::get('tin2').'-'.Input::get('tin3').'-000',
            'gender'        =>  Input::get('gender'),
            'status'        =>  'PRE_ACTIVATED',
            'created_at'    =>  date("Y:m:d H:i:s"),
            'updated_at'    =>  date("Y:m:d H:i:s"),
            'points'        =>  $points,
            'accountType'   =>  'BASIC',
        ));

        UserHasRole::insert(array(
            'user_id'   =>  $userId,
            'role_id'   =>  '3'
        ));

        Contact::insert(array(
            array(
                'user_id'       =>  $userId,
                'ctype'       =>  'email',
                'content'       =>  Input::get('email'),
            ),
            array(
                'user_id'       =>  $userId,
                'ctype'       =>  'mobileNum',
                'content'       =>  Input::get('mobileNum'),
            )
        ));

        AuditTrail::insert(array(
            'user_id'   =>  $userId,
            'content'   =>  'Created a Client Individual account at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$userId
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

        Auth::attempt(array('username' => Input::get('uName'), 'password' => Input::get('primary_pass')));
        return Redirect::to('/')->with('successMsg', 'Registration Success. You may now login.');
    }


//  NEW REGISTRATION REGISTER WORKER 
    public function regWorker()
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $privatekey = "6LfpJyITAAAAAHn92bsWJxBb4TFCggUdSndYmZPo";
        $captcha=$_POST['g-recaptcha-response'];

        if(!$captcha){
//            echo 'captch not checked!';
            return Redirect::to('/');
        }else{

            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $data = json_decode($response);
//            if(isset($data->success) AND $data->success==false){
            if(false){
              echo "Hey! Spammer I'm Using Google reCAPTCHA! Get Out";
            }else{
                Input::merge(array_map('trim', Input::all()));

                $userId = User::insertGetId(array(
                    'username'              =>  Input::get('uName'),
                    'password'              =>  Hash::make(Input::get('pass')),
                    'firstName'             =>  Input::get('fName'),
                    'lastName'              =>  Input::get('lName'),
                    'fullName'              =>  Input::get('fName').' '.Input::get('lName'),
                    'created_at'            =>  date("Y:m:d H:i:s"),
                    'updated_at'            =>  date("Y:m:d H:i:s"),
                    'status'                =>  'ACTIVATED',
//                    'status'                =>  'PRE_ACTIVATED',
                    'confirmationCode'      =>  $this->generateConfirmationCode()
                ));

                UserHasRole::insert(array(
                    'user_id'   =>  $userId,
                    'role_id'   =>  '2'
                ));

                Contact::insert(array(
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'email',
                        'content'       =>  Input::get('txtEmail'),
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'mobileNum',
                        'content'       =>  Input::get('mblNum'),
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'facebook',
                        'content'       =>  NULL,
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'twitter',
                        'content'       =>  NULL,
                    ),
                    array(
                        'user_id'       =>  $userId,
                        'ctype'         =>  'linkedin',
                        'content'       =>  NULL,
                    )
                ));

                AuditTrail::insert(array(
                    'user_id'   =>  $userId,
                    'content'   =>  'Created a Worker account at '.date('D, M j, Y \a\t g:ia'),
                    'created_at'    =>  date("Y:m:d H:i:s"),
                    'at_url'        =>  '/viewUserProfile/'.$userId
                ));

                // VALIDATE EMAIL - SEND MAIL NOTIFICATION -- START
                $data = array(
                    'msg'   =>  'You have successfully registered in Proveek BETA',
                    'url'   =>  URL::to('/').'/login'
                );

                $email = Input::get('txtEmail');

                Mail::send('emails.REGISTRATION_SUCCESS', $data, function($message) use($email){
                    $message->from('admin@proveek.com', 'Proveek');
                    $message->to($email)->subject('Proveek BETA - Registration Successful!');
                });
                // VALIDATE EMAIL - SEND MAIL NOTIFICATION -- END

                Auth::attempt(array('username' => Input::get('uName'), 'password' => Input::get('pass')));

                // return Redirect::to('/doVerifyMobileNumber');
                return Redirect::to('/');
            }//end of inner if else
        }//end of outer if else

    }//end regWorker

    public function  doRegisterTaskminator(){
        Input::merge(array_map('trim', Input::all()));
        
        $check = SimpleCaptcha::check($_POST['captcha']);

        if(!$check) {
            return Redirect::back()->with('errorMsg', 'Captcha does not match. Please retry.')->withInput(Input::except('password', 'captcha'));
        }
        
        $rules = array(
            'firstName'         => "required|regex:/^[\p{L}\s'.-]+$/",
            'midName'           => "required|regex:/^[\p{L}\s'.-]+$/",
            'lastName'          => "required|regex:/^[\p{L}\s'.-]+$/",
            'month'             => 'required',
            'date'              => 'required',
            'year'              => 'required',
            'gender'            => 'required',
            'mobileNum'         => 'required|numeric|min:11',
            'nationality'       => 'required',
            'preferredJob'      => 'required',
            'experience'        => 'required',
            'minRate'           => 'required',
            'maxRate'           => 'required',
            'tin1'              => 'required_with_all: tin2, tin3|regex:/^[0-9]+$/|digits:3',
            'tin2'              => 'required_with_all: tin1, tin3|regex:/^[0-9]+$/|digits:3',
            'tin3'              => 'required_with_all: tin1, tin2|regex:/^[0-9]+$/|digits:3',
            'username'          => 'required|unique:users,username',
            'password'          => 'required|min:8',
            'confirmpass'       => 'required|min:8|same:password',
            'TOS'               => 'required'
        );

        $messages = array(
            'firstName.regex' => 'Name must be letters only',
            'midName.regex' => 'Name must be letters only',
            'lastName.regex' => 'Name must be letters only',
            'tin1.regex' => 'Wrong TIN number',
            'tin2.regex' => 'Wrong TIN number',
            'tin3.regex' => 'Wrong TIN number',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails()){
            return Redirect::back()->with('errorMsg', $validator->messages()->first())->withInput(Input::except('password' , 'confirmpass'));
        }
        // validation successful

        $userId = User::insertGetId(array(
            'username'              =>  Input::get('username'),
            'password'              =>  Hash::make(Input::get('password')),
            'firstName'             =>  Input::get('firstName'),
            'midName'               =>  Input::get('midName'),
            'lastName'              =>  Input::get('lastName'),
            'fullName'              =>  Input::get('firstName').' '.Input::get('midName').' '.Input::get('lastName'),
            'gender'                =>  Input::get('gender'),
            'birthdate'             =>  Input::get('year').'-'.Input::get('month').'-'.Input::get('date'),
            //'nationality'           =>  Input::get('nationality'),
            'yearsOfExperience'     =>  Input::get('experience'),
            'tin'                   =>  Input::get('tin1').'-'.Input::get('tin2').'-'.Input::get('tin3').'-000',
            'confirmationCode'      =>  $this->generateConfirmationCode(),
            'status'                =>  'PRE_ACTIVATED',
            'skills'                =>  Input::get('preferredJob'),
            'minRate'               =>  Input::get('minRate'),
            'maxRate'               =>  Input::get('maxRate'),
            'created_at'            =>  date("Y:m:d H:i:s"),
            'updated_at'            =>  date("Y:m:d H:i:s"),
        ));

        UserHasRole::insert(array(
            'user_id'   =>  $userId,
            'role_id'   =>  '2'
        ));

        Contact::insert(array(
            array(
                'user_id'       =>  $userId,
                'ctype'         =>  'mobileNum',
                'content'       =>  Input::get('mobileNum'),
            ),
            array(
                'user_id'       =>  $userId,
                'ctype'         =>  'email',
                'content'       =>  Input::get('email'),
            )
        ));
/*
        if(Input::get('skills') !== null){
            foreach(Input::get('skills') as $skill){
                $skillCode = TaskCategory::where('categorycode', TaskItem::where('itemcode', $skill)->pluck('item_categorycode'))->pluck('categorycode');

                TaskminatorHasSkill::insert(array(
                    'user_id'           =>  $userId,
                    'taskitem_code'     =>  $skill,
                    'taskcategory_code' =>  $skillCode
                ));
            }
        }
*/
        AuditTrail::insert(array(
            'user_id'   =>  $userId,
            'content'   =>  'Created a Worker account at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$userId
        ));

        Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));

        // return Redirect::to('/doVerifyMobileNumber');
        return Redirect::to('/');

    }

    public function login(){
        if(Auth::check()){
            return Redirect::to('/');
        }else{
            return View::make('login');
        }
    }

    public function home(){

        return View::make('home');
    }

    public function employer()
    {
        return View::make('employerhome');
    }

    public function howitworks(){

        return View::make('howitworks');
    }

    public function whychooseproveek(){

        return View::make('whychooseproveek');
    }  

    public function pricing(){

        return View::make('pricing');
    }

    public function dashboard(){

        return View::make('userdashboard');
    }  

    public function initWORKER(){}
    public function initCOMPANY(){}

    public function index(){
        if(Auth::check()){
            switch(Auth::user()->status){
                case 'DEACTIVATED'      :
                case 'SELF_DEACTIVATED' :
                case 'ADMIN_DEACTIVATED':
                    Auth::logout();
                    return Redirect::to('/login')->with('errorMsg', 'Your account has been deactivated. Contact us for more information');
            }

            $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                ->where('user_has_role.user_id', Auth::user()->id)
                ->pluck('role');

            switch($role){
                case 'ADMIN' :
                    return Redirect::to('/admin');
                    break;
                case 'TASKMINATOR' :
                    $skillCodeArray = $this->GETTASKCODES(Auth::user()->id);

                    $taskList = Task::where('hiringType', 'BIDDING')
                    ->where('status', 'OPEN')
                    ->whereIn('taskType', $skillCodeArray)
                    ->orderBy('created_at','DESC')->paginate(10);

                    // NEW JOB MODULE -- START by JAN SARMIENTO
                    $jobs = Job::join('users', 'users.id', '=', 'jobs.user_id')
                        ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                        ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
                        ->whereIn('jobs.skill_code', $skillCodeArray)
                        ->where('expired', false)
                        ->orderBy('jobs.created_at', 'DESC')
                        ->select([
                            'users.id as user_id',
                            'users.fullName',
                            'users.profilePic',
                            'jobs.title',
                            'jobs.id as job_id',
                            'jobs.expires_at',
                            'jobs.expired',
                            'jobs.salary',
                            'jobs.created_at',
                            'jobs.description',
                            'jobs.hiring_type',
                            'cities.cityname',
                            'regions.regname',
                        ])
                        ->groupBy('jobs.id')
                        ->take('5')
                        ->get();
                    $applicationCount = JobApplication::where('applicant_id', Auth::user()->id)->count();
                    $invitesCount = JobInvite::where('invited_id', Auth::user()->id)->count();
                    // NEW JOB MODULE -- END by JAN SARMIENTO
                    return View::make('taskminator.index')
                            ->with('accountRole', $role)
                            ->with('tasks', $taskList)
                            ->with('jobs', $jobs)
//                            ->with('PROFILE_PROG', $this->PROFILE_PERCENTAGE_WORKER(Auth::user()->id))
                            ->with('PROFILE_PROG', $this->PROVEEK_PROFILE_PERCENTAGE_WORKER(Auth::user()->id))
                            ->with('applicationsCount', $applicationCount)
                            ->with('invitesCount', $invitesCount);
                    break;
                case 'CLIENT_IND' :
                case 'CLIENT_CMP' :
                    // CHECKER FOR the first 3 FREE MONTHS SUBSCRIPTION
                    $tempDate = Auth::user()->created_at->addMonths(3);
                    $freeDuration = null;
                    if($tempDate->lte(Carbon::today())){
                        $freeDuration = Carbon::now()->diffInDays($tempDate, false); // CALCULATION OF DAYS
                        $freeDuration = "Your first free 3-Month Subscription is over";
                    }
                    else{
                        $freeDuration = Carbon::now()->diffInDays($tempDate, false). " days until 3-Month Subscription expires";
                    }

                    $jobs = Job::where('user_id', Auth::user()->id)
                            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
                            ->select([
                                'jobs.title',
                                'jobs.id as job_id',
                                'jobs.expires_at',
                                'jobs.salary',
                                'jobs.created_at',
                                'jobs.description',
                                'jobs.expired',
                                'jobs.hiring_type',
                                'cities.cityname',
                                'regions.regname',
                            ])
                            ->groupBy('jobs.id')
                            ->take('5')
                            ->get();

                    // $freeDuration = $tempDate->diffInDays(Carbon::now());
                    return View::make('client.index')
                    ->with('freeDuration', $freeDuration)
                    ->with('categories', TaskCategory::orderBy('categoryname', 'ASC')->get())
                    ->with('categorySkills', TaskItem::where('item_categorycode', '006')->orderBy('itemname', 'ASC')->get())
                    ->with('TOTALPROG', $this->PROFILE_PERCENTAGE_COMPANY(Auth::user()->id))
                    ->with('tasks', Task::where('user_id', Auth::user()->id)->whereNotIn('status', ['CANCELLED', 'COMPLETE'])->orderBy('created_at', 'DESC')->paginate(10))
                    ->with('jobs', $jobs);
                    break;
                default :
                    return Redirect::to('/');
                    break;
            }
        }else{
            $jobs = Job::join('users', 'jobs.user_id', '=', 'users.id')
                ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
                ->select([
                    'users.fullName',
                    'jobs.title',
                    'jobs.id as job_id',
                    'jobs.expires_at',
                    'jobs.salary',
                    'jobs.created_at',
                    'jobs.description',
                    'jobs.hiring_type',
                    'cities.cityname',
                    'regions.regname',
                ])
                ->groupBy('jobs.id')
                ->paginate(3);

//            $jobs = Job::orderBy('created_at', 'DESC')->paginate(3);
            return View::make('home')
                    ->with('jobs', $jobs)
                    ->with('tasks', $jobs);
        }
    }

    public function doLogin(){
        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){

            date_default_timezone_set("Asia/Manila");
            AuditTrail::insert(array(
                'user_id'   =>  Auth::user()->id,
                'content'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
                'created_at'    =>  date("Y:m:d H:i:s")
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
            ));

            switch(Auth::user()->status){
                case 'VERIFY_EMAIL_REGISTRATION':
                    $userId = Auth::user()->id;
                    Auth::logout();
                    return Redirect::back()->with('errorMsg', 'You must validate your account first.<br/>Validation link has been sent to your email upon registration.<br/> <a href="/RESENDVALIDATION='.$userId.'">Resend validation email</a> or click <a href="/VERIFY_changeEmail_'.$userId.'">here</a> to change your email')->withInput();
                case 'DEACTIVATED'          :
                case 'ADMIN_DEACTIVATED'    :
                    Auth::logout();
                    return Redirect::back()->with('errorMsg', 'This account has been deactivated. Please email us at service.proveek@gmail.com for account management.')->withInput();
                    break;
                case 'SELF_DEACTIVATED'     :
                    $user = Auth::user()->id;
                    Auth::logout();
                    return Redirect::to('/SLFACTVT='.time().'='.$user);
            }

            return Redirect::to('/');
        }else if(User::where('username', Input::get('username'))->count() == 0){
            return Redirect::back()->with('successMsg', 'This account has not been registered. Click <a href="/">here</a> to register.');
        }else{
            return Redirect::back()->with('errorMsg', 'Username or Password is incorrect')->withInput();
        }
    }

    public function chainCity(){
        if(Input::get('city') != null){
            $city = Input::get('city');
        }else if(Input::get('city-comp') != null){
            $city = Input::get('city-comp');
        }else if(Input::get('city-task') != null){
            $city = Input::get('city-task');
        }else{
            $city = 'NONE';
        }

        if($city == 'NONE'){
            return Barangay::all();
        }else{
            return Barangay::where('citycode', $city)->orderBy('bgyname', 'ASC')->get();
        }
    }

    public function chainRegion(){
        if(Input::get('region') != null){
            $region = Input::get('region');
        }else if(Input::get('region-comp') != null){
            $region = Input::get('region-comp');
        }else if(Input::get('region-task') != null){
            $region = Input::get('region-task');
        }else{
            $region = 'NONE';
        }

        if($region == 'NONE'){
            return City::all();
        }else{
            return City::where('regcode', $region)->orderBy('cityname', 'ASC')->get();
        }
    }

    public function chainProvince(){
        if(Input::get('region') != null){
            $region = Input::get('region');
        }else if(Input::get('region-comp') != null){
            $region = Input::get('region-comp');
        }else if(Input::get('region-task') != null){
            $region = Input::get('region-task');
        }else{
            $region = 'NONE';
        }

        if($region == 'NONE'){
            return City::all();
        }else{
            return Province::where('regcode', $region)->orderBy('provname', 'ASC')->get();
        }
    }

    public function regTaskminator(){
        $fName = Input::get('fName');
        $lName = Input::get('lName');
        $uName = Input::get('uName');
        $txtEmail = Input::get('txtEmail');
        $primary_pass = Input::get('pass');
        $cPass = Input::get('cPass');
        $vMsg = null;
        if(Request::isMethod('post'))
        {
            $vMsg = "Please complete your details.";
            return View::make('reg-taskminator')
            ->with('firstName', $fName)
            ->with('lastName', $lName)
            ->with('username', $uName)
            ->with('txtEmail', $txtEmail)
            ->with('primary_pass', $primary_pass)
            ->with('cPass', $cPass)
            ->with('vMsg', $vMsg)
            ->with('regions', Region::all())
            ->with('barangays', Barangay::where('citycode', '012801')->orderBy('bgyname', 'ASC')->get())
            ->with('cities', City::where('regcode', '01')->orderBy('cityname', 'ASC')->get())
            ->with('categories', TaskCategory::orderBy('categoryname', 'ASC')->get())
            ->with('skillsList', TaskItem::where('item_categorycode', '006')->orderBy('itemname', 'ASC')->get());
        }
        else
        {
            $vMsg = "";
            return View::make('reg-taskminator')
            ->with('firstName', $fName)
            ->with('lastName', $lName)
            ->with('username', $uName)
            ->with('txtEmail', $txtEmail)
            ->with('primary_pass', $primary_pass)
            ->with('cPass', $cPass)
            ->with('vMsg', $vMsg)
            ->with('regions', Region::all())
            ->with('barangays', Barangay::where('citycode', '012801')->orderBy('bgyname', 'ASC')->get())
            ->with('cities', City::where('regcode', '01')->orderBy('cityname', 'ASC')->get())
            ->with('categories', TaskCategory::orderBy('categoryname', 'ASC')->get())
            ->with('skillsList', TaskItem::where('item_categorycode', '006')->orderBy('itemname', 'ASC')->get());
        }
    }

    public function regClientComp(){
        $compName = Input::get('compName');
        $fName = Input::get('fName');
        $lName = Input::get('lName');
        $uName = Input::get('uName');
        $txtEmail = Input::get('txtEmail');
        $primary_pass = Input::get('primary_pass');
        $cPass = Input::get('cPass');
        $vMsg = null;
        if(Request::isMethod('post'))
        {
        return View::make('reg-clientcomp')
            ->with('compName', $compName)
            ->with('firstName', $fName)
            ->with('lastName', $lName)
            ->with('username', $uName)
            ->with('txtEmail', $txtEmail)
            ->with('primary_pass', $primary_pass)
            ->with('cPass', $cPass)
            ->with('vMsg', $vMsg)
            ->with('regions', Region::all())
            ->with('barangays', Barangay::where('citycode', '012801')->orderBy('bgyname', 'ASC')->get())
            ->with('cities', City::where('regcode', '01')->orderBy('cityname', 'ASC')->get());
        }
        else
        {   
            $vMsg = "";
            return View::make('reg-clientcomp')
            ->with('compName', $compName)
            ->with('firstName', $fName)
            ->with('lastName', $lName)
            ->with('username', $uName)
            ->with('txtEmail', $txtEmail)
            ->with('primary_pass', $primary_pass)
            ->with('cPass', $cPass)
            ->with('vMsg', $vMsg)
            ->with('regions', Region::all())
            ->with('barangays', Barangay::where('citycode', '012801')->orderBy('bgyname', 'ASC')->get())
            ->with('cities', City::where('regcode', '01')->orderBy('cityname', 'ASC')->get());
        }
    }

    public function regClientIndi(){
        return View::make('reg-clientindi')
            ->with('regions', Region::all())
            ->with('barangays', Barangay::where('citycode', '012801')->orderBy('bgyname', 'ASC')->get())
            ->with('cities', City::where('regcode', '01')->orderBy('cityname', 'ASC')->get());
    }

    public function changePassword(){
        $flag = 'SUCCESS';
        $msg = '';
        $userId = Contact::where('ctype', 'email')->where('content', Input::get('email'))->pluck('user_id');

        // EMAIL VALIDATE
        if(!$this->emailValidate(Input::get('email'))){
            $msg = 'Please enter a valid email';
            $flag = 'FAILED';
        }else if(Contact::where('ctype', 'email')->where('content', Input::get('email'))->count() == 0){
            $msg = 'This email is not registered';
            $flag = 'FAILED';
        }else if(User::where('id', $userId)->pluck('status') == 'ADMIN_DEACTIVATED'){
            $msg = 'The account registered to this email has been deactivated by an admin. <br/> For more inquiries please email us at service.proveek@gmail.com';
            $flag = 'FAILED';
        }

        if($flag == 'SUCCESS'){
            // DEACTIVATE USER
            User::where('id', $userId)->update(array(
                'status'        =>  'DEACTIVATED'
            ));

            $email = Input::get('email');


            if(Input::get('process') == 'CHPASS'){
                $msg = 'Please click the link below to initialize changing your password';
                $url = URL::to('/').'/activateChangePass/'.User::where('id', $userId)->pluck('confirmationCode');
            }else{
                $msg = 'Please click the link below to initialize resetting your password';
                $url = URL::to('/').'/activateResetPass/'.User::where('id', $userId)->pluck('confirmationCode');
            }

            $data = ['url'  =>  $url, 'msg' => $msg];

            Mail::send('emails.changepass_Template', $data, function($message) use($email)
            {
                $message->from('taskminator.mail@gmail.com', 'Proveek');
                $message->to($email)->subject('Proveek Beta Password Management');
            });

            $msg = 'Forgot Password link has been sent';
        }

        return array(
            'msg'       =>  $msg,
            'flag'      =>  $flag
        );
    }

//    public function forgotPassword(){
//        $flag = 'SUCCESS';
//        $msg = '';
//        $userId = Contact::where('ctype', 'email')->where('content', Input::get('email'))->pluck('user_id');
//
//        // EMAIL VALIDATE
//        if(!$this->emailValidate(Input::get('email'))){
//            $msg = 'Please enter a valid email';
//            $flag = 'FAILED';
//        }else if(Contact::where('ctype', 'email')->where('content', Input::get('email'))->count() == 0){
//            $msg = 'This email is not registered';
//            $flag = 'FAILED';
//        }else if(User::where('id', $userId)->pluck('status') == 'ADMIN_DEACTIVATED'){
//            $msg = 'The account registered to this email has been deactivated by an admin. <br/> For more inquiries please email us at taskminator@gmail.com';
//            $flag = 'FAILED';
//        }
//
//        if($flag == 'SUCCESS'){
//            // DEACTIVATE USER
//            User::where('id', $userId)->update(array(
//                'status'        =>  'DEACTIVATED'
//            ));
//
//            $email = Input::get('email');
//            $url = URL::to('/').'/activateChangePass/'.User::where('id', $userId)->pluck('confirmationCode');
//
//            $data = ['url'  =>  $url];
//
//            Mail::send('emails.forgotpass', $data, function($message) use($email)
//            {
//                $message->from('taskminator.mail@gmail.com', 'Taskminator');
//                $message->to($email)->subject('Taskminator Forgot password');
//            });
//
//            $msg = 'Forgot Password link has been sent';
//        }
//
//        return array(
//            'msg'       =>  $msg,
//            'flag'      =>  $flag
//        );
//    }

    public function activateResetPass($confirmationCode){
        $user = User::where('confirmationCode', $confirmationCode);

        if($user->count() == 0){
            return Redirect::to('/');
        }else if($user->pluck('status') != 'DEACTIVATED'){
            return Redirect::to('/');
        }else{
            return View::make('forgotpass')->with('user', User::where('confirmationCode', $confirmationCode)->first());
        }
    }

    public function activateChangePass($confirmationCode){
        $user = User::where('confirmationCode', $confirmationCode);

        if($user->count() == 0){
            return Redirect::to('/');
        }else if($user->pluck('status') != 'DEACTIVATED'){
            return Redirect::to('/');
        }else{
            return View::make('changepass')->with('user', User::where('confirmationCode', $confirmationCode)->first());
        }
    }

    public function confirmReset(){

        if(!ctype_alnum(Input::get('password'))){
            return Redirect::back()->with('errorMsg', 'Password is alphanumeric (numbers and letters) only')->withInput(Input::except('password'));
        }else if(strlen(Input::get('password')) < 8){
            return Redirect::back()->with('errorMsg', 'Password must be more than 8 characters')->withInput(Input::except('password'));
        }else if(Input::get('password') != Input::get('confirmPassword')){
            return Redirect::back()->with('errorMsg', 'Passwords does not match')->withInput(Input::except('password'));
        }

        User::where('id', Input::get('userId'))->update(array(
            'password'      =>  Hash::make(Input::get('password')),
            'status'        =>  'ACTIVATED'
        ));

        Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
        return Redirect::to('/');
    }

    public function confirmChange(){
        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('old_password')))){
            Auth::logout();
        }else{
            return Redirect::back()->with('errorMsg', 'Old password is incorrect')->withInput(Input::except('password'));
        }

        if(!ctype_alnum(Input::get('password'))){
            return Redirect::back()->with('errorMsg', 'Password is alphanumeric (numbers and letters) only')->withInput(Input::except('password'));
        }else if(strlen(Input::get('password')) < 8){
            return Redirect::back()->with('errorMsg', 'Password must be more than 8 characters')->withInput(Input::except('password'));
        }else if(Input::get('password') != Input::get('confirmPassword')){
            return Redirect::back()->with('errorMsg', 'Passwords does not match')->withInput(Input::except('password'));
        }



        User::where('id', Input::get('userId'))->update(array(
            'password'      =>  Hash::make(Input::get('password')),
            'status'        =>  'ACTIVATED'
        ));

        Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
        return Redirect::to('/');
    }

    public function chainCategoryItems(){
        return TaskItem::where('item_categorycode', Input::get('taskcategory'))->get();
    }

    public function profile($id){

        if(UserHasRole::where('user_id', $id)->pluck('role_id') == 2){
            return View::make('profile')
                ->with('user', User::where('id', $id)->first())
                ->with('ratings', Rate::where('taskminator_id', $id));
        }else{
            return View::make('profile_clients')
                ->with('user', User::where('id', $id)->first())
                ->with('ratings', Rate::where('taskminator_id', $id));
        }
//        $userDetails = User::where('id', $id)->first();
//        switch(User::join('user_has_role', 'users.id', '=','user_has_role.user_id')->where('users.id', $id)->pluck('role_id')){
//            case '2' :
//                return View::make('profile_tskmntr')->with('user', $userDetails);
//            case '3' :
//                return View::make('profile_clientindi')->with('user', $userDetails);
//            case '4' :
//                return View::make('profile_clientcomp')->with('user', $userDetails);
//        }
//        return Redirect::back();
    }

    public function editProfile(){
        switch(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id')){
            case '1'    :
                return View::make('editProfile_admin')->with('user', User::where('id', Auth::user()->id)->first());
            case '2'    : // WORKER
                $pincode = Contact::where('user_id',  Auth::user()->id)->pluck('pincode');
                $docs = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')->select(['document_types.sys_doc_label'])->where('documents.user_id', Auth::user()->id)->get();
                return View::make('editProfile_tskmntr')
                            ->with('user', User::where('id', Auth::user()->id)->first())
                            ->with('pincode', $pincode)
                            ->with('customSkills', CustomSkill::where('created_by', Auth::user()->id)->get())
                            ->with('docs', $docs);
            case '3'    :
            case '4'    :
                $docs = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')->select(['document_types.sys_doc_label'])->where('documents.user_id', Auth::user()->id)->get();
                return View::make('editProfile_client')
                    ->with('docs', $docs)
                    ->with('user', User::where('id', Auth::user()->id)->first())
                    ->with('contacts', Contact::where('user_id', Auth::user()->id)->get());
        }

        return Redirect::back();
    }

    public function uploadProfilePic(){
        date_default_timezone_set("Asia/Manila");
        $pic = Input::file('profilePic');
        $newFileName = md5(uniqid(rand(), true));

////        FOR LOCALHOST
//        $destinationPath = 'public/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

//        FOR LIVE SITE
        $destinationPath = 'upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

        if(!isset($pic)){
            return Redirect::back()->with('errorMsg', 'Please attach an image file before submitting');
        }

        $rules = array('file' => 'required|mimes:png,jpeg,jpg');
        $validator = Validator::make(array('file'=> $pic), $rules);
        if($validator->passes()){
//            $filename = $pic->getClientOriginalName();
            $filename = $newFileName.'.'.$pic->getClientOriginalExtension();
            $upload_success = $pic->move($destinationPath, $filename);
            $path = '/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id.'/'.$filename;

            User::where('id', Auth::user()->id)->update(array(
                'profilePic' => $path
            ));

            Photo::insert(array(
                'user_id'   =>  Auth::user()->id,
                'path'      =>  $path,
                'type'      =>  'PROFILE_PIC',
                'created_at'      =>  date("Y:m:d H:i:s"),
            ));
        }else{
            return Redirect::back()->with('errorMsg', $validator);
        }

        return Redirect::back()->with('successMsg', 'Profile pic upload successful');
    }

    public function getNotification(){
        $query = Notification::where('status', 'NEW')->where('user_id', Auth::user()->id);
        return array(
            'notifCount'    =>  $query->count(),
            'notifContent'  =>  $query->orderBy('created_at', 'DESC')->take(5)->get(),
        );
    }

    public function showAllNotif(){
        switch(
            Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                ->where('user_has_role.user_id', Auth::user()->id)
                ->pluck('role')
        ){
            case 'ADMIN' :
                return View::make('showAllNotif')
                ->with('notifications', Notification::where('user_id', Auth::user()->id)->paginate(15));
            case 'TASKMINATOR' :
            case 'CLIENT_IND' :
            case 'CLIENT_CMP' :
            default :
                return Redirect::to('/');
                break;
        }
//        var_dump($this->getRole(Auth::user()->id));
//        if(in_array('ADMIN', (array) $this->getRole(Auth::user()->id))){
//            echo "ADMIN TO";
//        }else{
//
//        }
//        Notification::where('status', 'NEW')
//            ->where('user_id', Auth::user()->id)
//            ->update(array(
//                'status' => 'OLD'
//            ));
//
//        return View::make('showAllNotif')
//                ->with('notifications', Notification::where('user_id', Auth::user()->id)->paginate(15));
    }

    public function messages(){
        $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.user_id', Auth::user()->id)
            ->pluck('role');

        if($role != 'ADMIN'){
            return View::make('messages')->with('threads', Thread::where('user_id', Auth::user()->id)->where('status', 'OPEN')->orderBy('created_at', 'ASC')->get());
        }else{
            return View::make('admin.adminmessage');
        }
    }

    public function getMessages($threadCode){
        $messages = Message::join('users', 'users.id', '=', 'messages.user_id')
                    ->where('thread_code', $threadCode)
                    ->orderBy('messages.created_at', 'ASC')
                    ->select([
                        'users.fullName',
                        'users.id',
                        'messages.content',
                        'messages.created_at',
                    ]);

        Message::where('thread_code', $threadCode)->whereNotIn('user_id', [Auth::user()->id])->update(array('status' => 'OLD'));

        return array(
            'messages'  =>  $messages->get(),
            'msgCount'  =>  Message::where('thread_code', $threadCode)->count()
        );
    }

    public function sendMsg(){

        date_default_timezone_set("Asia/Manila");
        Message::insert(array(
            'thread_code'   =>  Input::get('threadCode'),
            'user_id'       =>  Auth::user()->id,
            'status'        =>  'NEW',
            'content'       =>  htmlspecialchars(Input::get('postMessage')),
            'created_at'    =>  date("Y:m:d H:i:s")
        ));

        return 'SUCCESS';
    }

    public function checkMsgThread($threadCode){
        $messages = Message::join('users', 'users.id', '=', 'messages.user_id')
            ->whereNotIn('messages.user_id', [Auth::user()->id])
            ->where('messages.thread_code', $threadCode)
            ->Where('messages.status', 'NEW')
            ->orderBy('messages.created_at', 'ASC')
            ->select([
                'users.fullName',
                'users.id',
                'messages.content',
                'messages.created_at',
            ])->get();

        if($messages->count() > 0){
            Message::where('thread_code', $threadCode)->update(array('status' => 'OLD'));
        }

        return array(
            'messages'  =>  $messages,
            'msgCount'  =>  $messages->count()
        );
    }

    public function checkMsgs($threadCode){
        $messages = Message::join('users', 'users.id', '=', 'messages.user_id')
            ->whereNotIn('messages.user_id', [Auth::user()->id])
            ->where('messages.thread_code', $threadCode)
            ->Where('messages.status', 'NEW')->count();

        return array(
            'msgCount'  =>  $messages,
            'threadCode'    =>  $threadCode
        );
    }

    public function checkMsgCount(){
        return User::getMessages()->count();
    }

    public function CHNGPSS(){
        $NEWPASS = Input::get('NEW_PASS');
        $OLDPASS = Input::get('OLD_PASS');
        $CNEW_PASS = Input::get('CNEW_PASS');

        // check if password is alphanumeric
        if(!ctype_alnum($NEWPASS)){
            return Redirect::back()->with('errorMsg', 'Password must be alphanumeric only');
        }

        // check if new pass and confirm pass are same
        if(!strcmp ($NEWPASS, $CNEW_PASS) == 0){
            return Redirect::back()->with('errorMsg', 'New passwords does not match');
        }

        // check if old pass is valid
        if(!Hash::check($OLDPASS, Auth::user()->password)){
            return Redirect::back()->with('errorMsg', 'Old password is incorrect');

        }

        User::where('id', Auth::user()->id)->update([
            'password'  =>  Hash::make($NEWPASS)
        ]);

        return Redirect::back()->with('successMsg', 'Your password has been successfully changed');
    }

    public function adminMessages(){
        $admins = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('roles.role', 'ADMIN')
            ->select([
                'users.id as id',
                'users.firstName'
            ])
            ->get();

        return View::make('adminmessages')
            ->with('admins', $admins);
    }

    public function SENDMSGTOADMIN(){
        $msg_timestamp = date("Y:m:d H:i:s");
        AdminMessage::insert(array(
            'user_id'   =>  Input::get('USERID'),
            'sender_id' =>  Auth::user()->id,
            'content'   =>  Input::get('ADMIN_sendMsgContent'),
            'created_at'=>  $msg_timestamp,
//            'status'    =>  'OLD'
        ));

//        date('D, M j, Y \a\t g:ia')
        return array(
            'msg'       =>  Input::get('ADMIN_sendMsgContent'),
            'tstamp'    =>  $msg_timestamp
        );
    }

    public function WGTCHT($adminId){
        $UPDATEQUERY = $QUERY = AdminMessage::whereIn('user_id', array(Auth::user()->id, $adminId))
            ->whereIn('sender_id', array(Auth::user()->id, $adminId));

        if($QUERY->count() > 0){
            return $QUERY->get();
        }else{
            return "NOCHATHISTORY";
        }
    }

    public function WGTMSG($userid){
        $NEWMSG = AdminMessage::where('user_id', Auth::user()->id)
            ->where('status', 'NEW')
            ->where('sender_id', $userid);

        $ALL_NEW_MESSAGES = $NEWMSG->get();

        $NEWMSG->update(['status' => 'OLD']);

        return $ALL_NEW_MESSAGES;
    }

    public function DEACACCT(){
        if(Hash::check(Input::get('DEAC_PASS'), Auth::user()->password)){
            User::where('id', Auth::user()->id)
                ->update([
                    'status'    =>  'SELF_DEACTIVATED'
                ]);
            Auth::logout();
            return Redirect::to('/login');
        }else{
            return Redirect::back()->with('errorMsg', 'Password is incorrect');
        }
    }

    public function SLFACTVT($time, $userid){
        return View::make('SELFACTIVATE')
                ->with('user', User::where('id', $userid)->first());
    }

    public function ACTVTACCT($userid){
        $QUERY = User::where('id', $userid);
        $user = $QUERY->first();
        $QUERY->update([
            'status'    =>  'ACTIVATED'
        ]);

        return Redirect::to('/login');
    }

    public function VRFYACCT($code){
        $CODE_DETAILS = ActivationCode::where('code', $code)->first();

        if(time() > strtotime($CODE_DETAILS->duration)){
            $msg = 'Activation code has expired. Click <a href="/RESENDVALIDATION='.$CODE_DETAILS->user_id.'">here</a> to request for another activation code';
            return $msg;
        }else{
            User::where('id', $CODE_DETAILS->user_id)->update([
                'status'    =>  'PRE_ACTIVATED'
            ]);

            return Redirect::to('/login')
                ->with('successMsg', 'You may now login your account!');
        }
    }

    public function RESENDVALIDATION($userid){

        $activationCode = uniqid().'_'.time();
        $codecreated_at = time();
        $duration = $codecreated_at + 86400;

        ActivationCode::insert([
            'user_id'       =>  $userid,
            'code'          =>  $activationCode,
            'created_at'    =>  date("Y:m:d H:i:s", $codecreated_at),
            'duration'      =>  date("Y:m:d H:i:s", $duration)
        ]);

        $data = array(
            'msg'   =>  'PLEASE VALIDATE YOUR EMAIL - REQUEST',
            'url'   =>  URL::to('/').'/VRFYACCT='.$activationCode
        );


        $email = User::join('contacts', 'users.id', '=', 'contacts.user_id')
            ->where('users.id', $userid)
            ->where('contacts.ctype', 'email')
            ->pluck('content');

        Mail::send('emails.REGISTRATION_SUCCESS', $data, function($message) use($email){
            $message->from('admin@proveek.com', 'Proveek');
            $message->to($email)->subject('Proveek BETA - Resend Validation Link');
        });

        return Redirect::to('/login')
                ->with('successMsg', 'A new validation link has been sent to your '.$email);
    }

    public function CHKRGWRKR(){
        $registrationErrors = array();
        // CHECK COMPANY NAME IF IT EXISTS
        if(Input::has('compName')){
            if(strlen(trim(Input::get('compName'))) < 5){
                array_push($registrationErrors, 'Company name must be more than 5 characters.');
            }
        }

        // CHECK USERNAME
        if(!ctype_alnum(Input::get('uName')) || strlen(Input::get('uName')) < 5){
            array_push($registrationErrors, 'Username is alphanumeric only and must contain at least 5 characters');
        }elseif(User::where('username', Input::get('uName'))->count() > 0){
            array_push($registrationErrors, 'Username already exists');
        }

        // CHECK FIRSTNAME
        if(!ctype_alnum(Input::get('fName'))){
            array_push($registrationErrors, 'First name can only contain letters');
        }

        // CHECK LASTNAME
        if(!ctype_alnum(Input::get('lName'))){
            array_push($registrationErrors, 'Last name can only contain letters');
        }

        // CHECK PASSWORDS
        $pass = (Input::has('primary_pass') ? Input::get('primary_pass') : Input::get('pass'));

        if(strcmp(Input::get('cPass'), $pass) == 0){
            if(!ctype_alnum($pass) || strlen($pass) < 5){
                array_push($registrationErrors, 'Password is alphanumeric only and must contain at least 5 characters');
            }
        }else{
            array_push($registrationErrors, 'Passwords does not match');
        }

        // CHECK EMAIL
        if(!$this->emailValidate(Input::get('txtEmail'))){
            array_push($registrationErrors, 'Please enter a valid email');
        }else if($this->IF_EMAIL_EXISTS(Input::get('txtEmail'))){
            array_push($registrationErrors, Input::get('txtEmail').' is already taken');
        }

        // CHECK MOBILE NUMBER

        $mobileNum = (Input::has('mobileNum') ? Input::get('mobileNum') : Input::get('mblNum'));
        if(!preg_match("/^09[0-9]{9}$/", $mobileNum, $output_array)){
            array_push($registrationErrors, 'Please enter a valid mobile number : 09xx-xxx-xxxx');
        }

        return $registrationErrors;
    }

    public function LOCCHAIN($chainType, $locationID){
        switch($chainType){
            case 'REGION_TO_CITY' :
                return City::where('regcode', $locationID)->orderBy('cityname', 'ASC')->get();
                break;
            case 'REGION_TO_PROVINCE' :
                return Province::where('regcode', $locationID)->orderBy('provname', 'ASC')->get();
                break;
            case 'CITY_TO_BARANGAY' :
                return Barangay::where('citycode', $locationID)->orderBy('bgyname', 'ASC')->get();
                break;
            default :
                return "FAILED";
                break;
        }
    }

    public function CHAINCATEGORYANDSKILL($categoryID){
        return TaskItem::where('item_categorycode', '=', $categoryID)->orderBy('itemname', 'ASC')->get();
    }

    public function ContactUs(){
        if(!$this->emailValidate(Input::get('ContactUs_email'))){
            Session::flash('errorMsg', 'Please input a valid email');
        }else{
            $data = array(
                'msg'   =>  Input::get('ContactUs_msg'),
                'name'  =>  Input::get('ContactUs_name'),
                'userMail'  =>  Input::get('ContactUs_email')
            );

            $email = Input::get('ContactUs_email');

            Mail::send('emails.CONTACTUS', $data, function($message) use($email){
                $message->from('admin@proveek.com', 'Inquiries - Proveek');
                $message->to('service.proveek@gmail.com')->subject('Inquiries - Proveek');
//                $message->from('admin@proveek.com', 'Inquiries - Proveek');
            });
        }

        return Redirect::back();
    }

    public function VERIFY_changeEmail($userID){
        return View::make('VERIFY_changeEmail')
                ->with('user', User::where('id', $userID)->first());
    }

    public function doVERIFY_changeEmail(){
        if(Auth::attempt(['username' => Input::get('username'), 'password' =>  Input::get('password')])){
            if(Auth::user()->status == 'VERIFY_EMAIL_REGISTRATION'){
                if($this->emailValidate(Input::get('email'))){
                    $userMail = Contact::where('user_id', Auth::user()->id)->where('ctype', 'email')->pluck('content');
                    $flag = Contact::where('content', Input::get('email'))->whereNotIn('content', [$userMail])->count();
                    if($flag == 0){
                        // delete previous activation code
                        ActivationCode::where('user_id', Auth::user()->id)->delete();

                        $activationCode = uniqid().'_'.time();
                        $codecreated_at = time(); //date("Y:m:d H:i:s");
                        $duration = $codecreated_at+86400;
                        ActivationCode::insert([
                            'user_id'       =>  Auth::user()->id,
                            'code'          =>  $activationCode,
                            'created_at'    =>  date("Y:m:d H:i:s", $codecreated_at),
                            'duration'      =>  date("Y:m:d H:i:s", $duration)
                        ]);

                        $data = array(
                            'msg'   =>  'CLICK ON THE LINK OR COPY AND PASTE IT TO VALIDATE YOUR EMAIL',
                            'url'   =>  URL::to('/').'/VRFYACCT='.$activationCode
                        );

                        $email = Input::get('email');

                        Mail::send('emails.REGISTRATION_SUCCESS', $data, function($message) use($email){
                            $message->from('admin@proveek.com', 'Proveek');
                            $message->to($email)->subject('Proveek BETA - Validate Account');
                        });

                        Auth::logout();
                        Session::flash('successMsg', 'We have sent a validation link to '.$email.' <br/> Please validate your account to start using Proveek');
                        return Redirect::to('/login');
                    }else{
                        Auth::logout();
                        Session::flash('errorMsg', 'This email is already taken by another user');
                    }
                }else{
                    Auth::logout();
                    Session::flash('errorMsg', 'Please input a valid email');
                }
            }else{
                Session::flash('errorMsg', 'Account is already activated');
                Auth::logout();
            }
        }else{
            Session::flash('errorMsg', 'Account login failed');
        }

        return Redirect::back();
    }
}

