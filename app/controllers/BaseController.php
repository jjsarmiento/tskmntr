<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    function sendReply($mobile_number, $reply, $request_id, $type){
        //please see https://api.chikka.com/docs/handling-messages#reply-sms
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }

    public function sendSms($mobileNum, $message, $userId){
        date_default_timezone_set("Asia/Manila");
        $arr_post_body = array(
            "message_type"  => "SEND",
            "mobile_number" => $mobileNum,
            "shortcode"     => "2929062641",
            "message_id"    => Sms::max('id')+1,
            "message"       => urlencode($message),
            "client_id"     => "76b4f21bfbaeec04b3a79c83860fde6fc37810dd427918c21ebd973becff97e8",
            "secret_key"    => "a3e207f05220a9dae9821efe2b655444cbf5e6c366b3fc7077dbf433dd9bf39e"
        );

        $query_string = "";
        foreach($arr_post_body as $key => $frow)
        {
            $query_string .= '&'.$key.'='.$frow;
        }

        $URL = "https://post.chikka.com/smsapi/request";

        $curl_handler = curl_init();
        curl_setopt($curl_handler, CURLOPT_URL, $URL);
        curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
        curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handler);
        curl_close($curl_handler);

        Sms::insert(array(
            'user_id'       =>  $userId,
            'message'       =>  $message,
            'mobileNum'     =>  $mobileNum,
            'created_at'    =>  date("Y:m:d H:i:s")
        ));

//        exit(0);
    }

    // AUTHORED BY Jan Sarmiento -- START
    // used to get profile percentage
    public function PROFILE_PERCENTAGE_COMPANY($userid){
        $user = User::where('id', $userid)->first();
        $reqMeter = 0;
        $optMeter = 0;

        $intProgress = 0;
        $reqProgress = 0;
        $optProgress = 0;

        // INITIAL REQUIRED
        if($user->firstName != ""){  $reqMeter++;}
        if($user->lastName != ""){   $reqMeter++;}
        if($user->companyName != ""){$reqMeter++;}
        if($user->username != ""){   $reqMeter++;}
        if($user->password != ""){   $reqMeter++;}
        if(Contact::where('user_id', $user->id)->get() != ""){   $reqMeter++;}
        // END OF INITIAL REQUIRED

        $intProgress = ($reqMeter / 6) * 30;
        $reqMeter = 0; // to reset the value;

        // REQUIRED
        if($user->profilePic != ""){                             $reqMeter++;}
        if(Contact::where('user_id', $user->id)->get() != ""){   $reqMeter++;}
        if($user->city != ""){                                   $reqMeter++;}
        if($user->address != ""){                                $reqMeter++;}
        if($user->businessPermit != ""){                         $reqMeter++;}
        if($user->businessDescription != ""){                    $reqMeter++;}
        if($user->businessNature != ""){                         $reqMeter++;}

        // END OF REQUIRED

        $reqProgress = ($reqMeter/7) * 50;
        // OPTIONAL PROGRESS
        if($user->midName != ""){            $optMeter++;}
        if($user->yearsOfExperience != ""){  $optMeter++;}
        if($user->barangay != ""){           $optMeter++;}

        $optProgress = ($optMeter / 3) * 20;
        $calculated_prog = $intProgress + $reqProgress;
        $total_prog = number_format($calculated_prog + $optProgress);

        User::where('id', $userid)->update([
            'total_profile_progress'    =>  $total_prog
        ]);

        return array(
            'OPTIONAL_PROGRESS' =>  $optProgress,
            'TOTAL_PROGRESS'    =>  $total_prog,
            'CALCULATED_PROG'   =>  $calculated_prog,
        );
    }

    public function PROFILE_PERCENTAGE_WORKER($userid){
        $user = User::where('id', $userid)->first();

        $reqMeter = 0;
        $optMeter = 0;
        $intProgress = 0;
        $reqProgress = 0;
        $optProgress = 0;

        // INITIAL REQUIRED
        if($user->firstName != ""){ $reqMeter++;}
        if($user->lastName != ""){  $reqMeter++;}
        if($user->username != ""){  $reqMeter++;}
        if($user->password != ""){  $reqMeter++;}
        if(Contact::where('user_id', $user)->get() != ""){  $reqMeter++;}
        // END OF INITIAL REQUIRED

        $intProgress = ($reqMeter / 5) * 30;
        $reqMeter = 0; // to reset the value;

        // REQUIRED
        if($user->profilePic != ""){$reqMeter++;}
        if($user->birthdate != ""){ $reqMeter++;}
        if($user->gender != ""){    $reqMeter++;}
        if($user->preferredJob != ""){  $reqMeter++;}
        if(Contact::where('user_id', $user)->get() != ""){  $reqMeter++;}
        if($user->city != ""){      $reqMeter++;}
        if($user->address != ""){   $reqMeter++;}
        // END OF REQUIRED

        $reqProgress = ($reqMeter/7) * 40;

        // OPTIONAL PROGRESS
        if($user->midName != ""){       $optMeter++;}
        if($user->nationality != ""){   $optMeter++;}
        if($user->minRate != ""){       $optMeter++;}
        if($user->maxRate != ""){       $optMeter++;}
        if($user->tin != ""){           $optMeter++;}
        if($user->skills != ""){        $optMeter++;}
        if($user->yearsOfExperience != ""){ $optMeter++;}
        if($user->barangay != ""){      $optMeter++;}

        $optProgress = ($optMeter / 7) * 30;
        $calculated_prog = $intProgress + $reqProgress;
        $total_prog = number_format($calculated_prog + $optProgress);

        User::where('id', $userid)->update([
            'total_profile_progress'    =>  $total_prog
        ]);

        return array(
            'OPTIONAL_PROGRESS' =>  $optProgress,
            'TOTAL_PROGRESS'    =>  $total_prog,
            'CALCULATED_PROG'   =>  $calculated_prog,
        );
    }

    // used to get user RATINGS
    // returns NULL of user has NO RATINGS
    public function getRatings($userId){
        return Rate::where('taskminator_id', $userId)->avg('stars');
    }

    // returns ROLE of users
    public function getRole($userId){
        return User::where('users.id', $userId)
                ->join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                ->select('roles.role')
                ->pluck('roles.role')
                ->first();

    }

    // GET SKILLS OF USER - Returns array
    public function GETTASKCODES($userId){
        $skills = User::getSkillsCODE($userId);
        $myArr = array();
        foreach($skills as $s){
            array_push($myArr, $s->itemcode);
        }

        return $myArr;
    }

    public function GETAPPLICANTS($jobId){
        $APPLICANTS = User::join('job_applications', 'job_applications.applicant_id', '=', 'users.id')
            ->where('job_applications.job_id', $jobId)
            ->select([
                'users.id'
            ])
            ->get();

        $myArr = array();
        foreach($APPLICANTS as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETINVITEDS($jobId){
        $INVITEDS = User::join('job_invites', 'job_invites.invited_id', '=', 'users.id')
            ->where('job_invites.job_id', $jobId)
            ->select([
                'users.id'
            ])
            ->get();

        $myArr = array();
        foreach($INVITEDS as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETINCART($companyID){
        $INCART = User::join('carts', 'carts.worker_id', '=', 'users.id')
                    ->where('carts.company_id', $companyID)
                    ->select([
                        'users.id'
                    ])
                    ->get();

        $myArr = array();
        foreach($INCART as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETCHECKEDOUTUSERS($companyID){
        $P = User::join('purchases', 'purchases.worker_id', '=', 'users.id')
                ->where('purchases.company_id', $companyID)
            ->select([
                'users.id'
            ])
            ->get();


        $myArr = array();
        foreach($P as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function IF_EMAIL_EXISTS($email){
        if(Contact::where('content', $email)->count() > 0){
            return true;
        }else{
            return false;
        }
    }


    public static function IS_PURCHASED($compID, $workerID){
        if(Purchase::where('company_id', $compID)->where('worker_id', $workerID)->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function WORKERGETINVITES_JOBID($workerID){
        $j = JobInvite::where('invited_id', $workerID)->get();

        $myArr = array();
        foreach($j as $o){
            array_push($myArr, $o->job_id);
        }

        return $myArr;
    }

    public function POINT_CHECK($USERPOINTS, $SCENARIO){
        switch($SCENARIO){
            case 'CREATE_JOB' :
                $POINT_PER_JOB = SystemSetting::where('type', 'SYSSETTINGS_POINTSPERAD')->pluck('value');
                if($POINT_PER_JOB > $USERPOINTS){
                    return false;
                }else{
                    return true;
                }
            default :
                return false;
        }
    }

    public function GET_JOBAD_EXPIRATION($timestamp){
        $SYSSETTINGS_JOBADDURATION = SystemSetting::where('type', 'SYSSETTINGS_JOBADDURATION')->pluck('value');
        return date("Y:m:d H:i:s", time($timestamp) + ((floatval($SYSSETTINGS_JOBADDURATION) * 60 * 60)));
    }

    public function UPDATE_JOBADS($userID){
        $jobs = Job::where('user_id', $userID)->get();

        // CHECK FOR EXPIRATION
        // Updates `expired` column to TRUE if job is expired, else, FALSE
        foreach($jobs as $j){
            if(time($j->expires_at) > time($j->created_at)){
                Job::where('id', $j->id)->update('expired', true);
            }
        }
    }

    public static function ROUTE_UPDATE_JOBADS($userID){
        $jobs = Job::where('user_id', $userID)->get();

        // CHECK FOR EXPIRATION
        // Updates `expired` column to TRUE if job is expired, else, FALSE
        foreach($jobs as $j){
            if(time($j->expires_at) > time($j->created_at)){
                Job::where('id', $j->id)->update('expired', true);
            }
        }
    }

    public function GETAPPLICATIONS_ID($workerID){
        $jobs = JobApplication::where('applicant_id', $workerID)->select(['job_id'])->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->job_id);
        }

        return $myArr;
    }

    public function NOTIFICATION_INSERT($receiverID, $msg, $url){
        Notification::insert([
            'user_id'   =>  $receiverID,
            'content'   =>  $msg,
            'notif_url' =>  $url,
            'status'    =>  'NEW',
            'created_at'=>  date("Y:m:d H:i:s")
        ]);
    }

    public function DOCUMENTS_GETEXISTINGTYPES($userID){
        $types = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')
                    ->where('documents.user_id', $userID)
                    ->select(['document_types.sys_doc_type'])
                    ->get();

        $myArr = array();
        foreach($types as $o){
            array_push($myArr, $o->sys_doc_type);
        }

        return $myArr;
    }

    public function DOCUMENTS_GETEXISTINGLABELS($userID){
        $types = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')
            ->where('documents.user_id', $userID)
            ->select(['document_types.sys_doc_label'])
            ->get();

        $myArr = array();
        foreach($types as $o){
            array_push($myArr, $o->sys_doc_label);
        }

        return $myArr;
    }

    public function ALL_JOBS($companyID){
        $jobs = Job::where('user_id', $companyID)->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static function ALL_JOBS_STATIC($companyID){
        $jobs = Job::where('user_id', $companyID)->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static function IS_AN_APPLICANT_FOR_COMPANY($workerID, $compID){
        $ALL_JOBS_OF_COMP = BaseController::ALL_JOBS_STATIC($compID);
        $flag = JobApplication::whereIn('job_id', $ALL_JOBS_OF_COMP)->where('applicant_id', $workerID)->count();
        return ($flag > 0);
    }

    // AUTHORED BY Jan Sarmiento -- END
}
