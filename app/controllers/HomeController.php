<?php

// Importing the BotDetectCaptcha class
use Captcha\Integration\BotDetectCaptcha;
use Carbon\Carbon;

class HomeController extends BaseController {

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
        date_default_timezone_set("Asia/Manila");
        AuditTrail::insert(array(
            'user_id'       =>  Auth::user()->id,
            'content'       =>  'Logged out at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s")
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));
        Auth::logout();
        return Redirect::to('/');
    }

    public function register(){
        return View::make('register')->with('regions', Region::all());
    }

    public function toProfile($username)
    {
        $temp = User::where('username', '=', $username)->get()->first();
        $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                ->where('user_has_role.user_id', $temp->id)
                ->pluck('role');
        $QUERY_CONTACT = Contact::where('user_id', Auth::user()->id);
        $mobile = $QUERY_CONTACT->where('ctype', 'mobileNum')->pluck('content');
        return View::make("profile_worker")
        ->with("users", User::where('username', '=', $username)->get()->first())
        ->with('roles', $role)
        ->with('mobile', $mobile);
    }

    public function regEmployer()
    {
        Input::merge(array_map('trim', Input::all()));

        $points = 300;

        date_default_timezone_set("Asia/Manila");
        $userId = User::insertGetId(array(
            'companyName'           =>  Input::get('compName'),
            'fullName'              =>  Input::get('compName'),
            'username'              =>  Input::get('uName'),
            'password'              =>  Hash::make(Input::get('primary_pass')),
            'confirmationCode'      =>  $this->generateConfirmationCode(),
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

        Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
        return Redirect::to('/');
//        return Redirect::to('/')->with('successMsg', 'Registration Success. You may now login.');
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
            echo 'captch not checked!';
        }else{
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $data = json_decode($response);
            if(isset($data->success) AND $data->success==false){
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
                    'status'                =>  'PRE_ACTIVATED',
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
                    $message->from('hello@proveek.com', 'Proveek');
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
  

    public function index(){
        if(Auth::check()){
            // if(Auth::user()->id!=19) {
            //     Auth::logout();
            //     return View::make('profile');
            // }
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
                    $bidCount = Task::join('task_has_bidders', 'task_has_bidders.task_id', '=', 'tasks.id')
                        ->where('task_has_bidders.taskminator_id', Auth::user()->id)
                        ->where('tasks.status', 'OPEN')
                        ->where('tasks.hiringType', 'BIDDING')->count();

                    $offerCount = Task::join('taskminator_has_offer', 'taskminator_has_offer.task_id', '=', 'tasks.id')
                        ->where('taskminator_has_offer.taskminator_id', Auth::user()->id)
                        ->where('tasks.status', 'OPEN')->count();

                    $ongoingCount = Task::join('task_has_taskminator', 'task_has_taskminator.task_id', '=', 'tasks.id')
                        ->where('task_has_taskminator.taskminator_id', Auth::user()->id)
                        ->where('tasks.status', 'ONGOING')->count();

                    $completedCount = Task::join('task_has_taskminator', 'task_has_taskminator.task_id', '=', 'tasks.id')
                        ->where('task_has_taskminator.taskminator_id', Auth::user()->id)
                        ->where('tasks.status', 'COMPLETE')->count();

                    $taskList = new Task;
                    $taskList = $taskList->where('hiringType', 'BIDDING')
                    ->where('status', 'OPEN')
                    ->orderBy('created_at','DESC')->paginate(10);

                    $reqMeter = 0;
                    $optMeter = 0;

                    $intProgress = 0;
                    $reqProgress = 0;
                    $optProgress = 0;
                    
                    // INITIAL REQUIRED
                    if(Auth::user()->firstName != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->lastName != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->username != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->password != "")
                    {
                        $reqMeter++;
                    }
                    if(Contact::where('user_id', Auth::user()->id)->get() != "")
                    {
                        $reqMeter++;
                    }
                    // END OF INITIAL REQUIRED

                    $intProgress = ($reqMeter / 5) * 30;
                    $reqMeter = 0; // to reset the value;

                    // REQUIRED
                    if(Auth::user()->profilePic != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->birthdate != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->gender != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->preferredJob != "")
                    {
                        $reqMeter++;
                    }
                    if(Contact::where('user_id', Auth::user()->id)->get() != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->city != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->address != "")
                    {
                        $reqMeter++;
                    }
                    // END OF REQUIRED

                    $reqProgress = ($reqMeter/7) * 40;

                    // OPTIONAL PROGRESS
                    if(Auth::user()->midName != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->nationality != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->minRate != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->maxRate != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->tin != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->skills != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->yearsOfExperience != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->barangay != "")
                    {
                        $optMeter++;
                    }

                    $optProgress = ($optMeter / 7) * 30;
                    // END OF OPTIONAL PROGRESS

                    return View::make('taskminator.index')
                            ->with('bidCount', $bidCount)
                            ->with('offerCount', $offerCount)
                            ->with('ongoingCount', $ongoingCount)
                            ->with('completedCount', $completedCount)
                            ->with('accountRole', $role)
                            ->with('tasks', $taskList)
                            ->with('intProgress', $intProgress)
                            ->with('reqProgress', $reqProgress)
                            ->with('optProgress', $optProgress)
                            ->with('TOTALPROG', $this->getProfilePercentage(Auth::user()->id));
                    break;
                case 'CLIENT_IND' :
                case 'CLIENT_CMP' :

                    // CHECKER FOR the first 3 FREE MONTHS SUBSCRIPTION
                    $tempDate = Auth::user()->created_at->addMonths(3);
                    $freeDuration = null;
                    if($tempDate->lte(Carbon::today()))
                    {
                        $freeDuration = Carbon::now()->diffInDays($tempDate, false); // CALCULATION OF DAYS
                        $freeDuration = "Your first free 3-Month Subscription is over";
                    }
                    else
                    {
                        $freeDuration = Carbon::now()->diffInDays($tempDate, false). " days until 3-Month Subscription expires";
                    }

                    // $freeDuration = $tempDate->diffInDays(Carbon::now());


                    $reqMeter = 0;
                    $optMeter = 0;

                    $intProgress = 0;
                    $reqProgress = 0;
                    $optProgress = 0;
                    
                    // INITIAL REQUIRED
                    if(Auth::user()->firstName != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->lastName != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->companyName != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->username != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->password != "")
                    {
                        $reqMeter++;
                    }
                    if(Contact::where('user_id', Auth::user()->id)->get() != "")
                    {
                        $reqMeter++;
                    }
                    // END OF INITIAL REQUIRED

                    $intProgress = ($reqMeter / 6) * 30;
                    $reqMeter = 0; // to reset the value;

                    // REQUIRED
                    if(Auth::user()->profilePic != "")
                    {
                        $reqMeter++;
                    }
                    if(Contact::where('user_id', Auth::user()->id)->get() != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->city != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->address != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->businessPermit != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->businessDescription != "")
                    {
                        $reqMeter++;
                    }
                    if(Auth::user()->businessNature != "")
                    {
                        $reqMeter++;
                    }

                    // END OF REQUIRED

                    $reqProgress = ($reqMeter/7) * 50;

                    // OPTIONAL PROGRESS
                    if(Auth::user()->midName != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->yearsOfExperience != "")
                    {
                        $optMeter++;
                    }
                    if(Auth::user()->barangay != "")
                    {
                        $optMeter++;
                    }

                    $optProgress = ($optMeter / 3) * 20;
                    // END OF OPTIONAL PROGRESS
                    return View::make('client.index')
                    ->with('intProgress', $intProgress)
                    ->with('reqProgress', $reqProgress)
                    ->with('optProgress', $optProgress)
                    ->with('freeDuration', $freeDuration)
                    ->with('TOTALPROG', $this->getProfilePercentage(Auth::user()->id));
                    break;
                default :
                    return Redirect::to('/');
                    break;
            }
        }else{

            $task = new Task;
            $task = $task->where('hiringType', 'BIDDING')
            ->where('status', 'OPEN')
            ->orderBy('created_at','DESC')->paginate(3);
            // $task = DB::table('tasks')->where('hiringType', '=', 'BIDDING')
            // ->where('status', '=', 'OPEN')->orderBy('created_at', 'DESC')
            // ->get();
            return View::make('home')->with('tasks', $task);
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
                case 'DEACTIVATED'          :
                case 'ADMIN_DEACTIVATED'    :
                case 'SELF_DEACTIVATED'     :
                    Auth::logout();
                    return Redirect::back()->with('errorMsg', 'This account has been deactivated. Please email us at service.proveek@gmail.com for account management.')->withInput();
                    break;
            }

            return Redirect::to('/');
        }else if(User::where('username', Input::get('username'))->count() == 0){
            return Redirect::back()->with('successMsg', 'This account has not been registered. Click <a href="/register">here</a> to register.');
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
            case '2'    :
                $pincode = Contact::where('user_id',  Auth::user()->id)->pluck('pincode');
                return View::make('editProfile_tskmntr')
                            ->with('user', User::where('id', Auth::user()->id)->first())
                            ->with('pincode', $pincode);
            case '3'    :
            case '4'    :
                return View::make('editProfile_client')
                    ->with('user', User::where('id', Auth::user()->id)->first())
                    ->with('contacts', Contact::where('user_id', Auth::user()->id)->get());
        }

        return Redirect::back();
    }

    public function uploadProfilePic(){
        date_default_timezone_set("Asia/Manila");
        $pic = Input::file('profilePic');
        $newFileName = md5(uniqid(rand(), true));

        $destinationPath = 'public/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

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
}

