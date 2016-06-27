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
    public function getProfilePercentage($userid){

        $user = User::where('id', $userid)->first();

        $reqMeter = 0;
        $optMeter = 0;

        $intProgress = 0;
        $reqProgress = 0;
        $optProgress = 0;

        // INITIAL REQUIRED
        if($user->firstName != ""){
            $reqMeter++;
        }

        if($user->lastName != ""){
            $reqMeter++;
        }

        if($user->username != ""){
            $reqMeter++;
        }
        if($user->password != ""){
            $reqMeter++;
        }

        if(Contact::where('user_id', $user->id)->get() != ""){
            $reqMeter++;
        }
        // END OF INITIAL REQUIRED

        $intProgress = ($reqMeter / 5) * 30;
        $reqMeter = 0; // to reset the value;

        // REQUIRED
        if($user->profilePic != ""){
            $reqMeter++;
        }

        if($user->birthdate != ""){
            $reqMeter++;
        }

        if($user->gender != ""){
            $reqMeter++;
        }

        if($user->preferredJob != ""){
            $reqMeter++;
        }

        if(Contact::where('user_id', $user->id)->get() != ""){
            $reqMeter++;
        }

        if($user->city != ""){
            $reqMeter++;
        }

        if($user->address != ""){
            $reqMeter++;
        }
        // END OF REQUIRED

        $reqProgress = ($reqMeter/7) * 40;

        // OPTIONAL PROGRESS
        if($user->midName != ""){
            $optMeter++;
        }

        if($user->nationality != ""){
            $optMeter++;
        }

        if($user->minRate != ""){
            $optMeter++;
        }

        if($user->maxRate != ""){
            $optMeter++;
        }

        if($user->tin != ""){
            $optMeter++;
        }

        if($user->skills != ""){
            $optMeter++;
        }

        if($user->yearsOfExperience != ""){
            $optMeter++;
        }

        if($user->barangay != ""){
            $optMeter++;
        }

        $role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.user_id', $user->id)
            ->pluck('role');

        if($role == 'CLIENT_CMP' || $role == 'CLIENT_IND'){;
            return $total_prog = number_format(($intProgress + $reqProgress) + (($optMeter / 3) * 20));
        }else{
            return $total_prog = number_format(($intProgress + $reqProgress) + (($optMeter / 7) * 30));
        }


//        return $total_prog;
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
    // AUTHORED BY Jan Sarmiento -- END
}
