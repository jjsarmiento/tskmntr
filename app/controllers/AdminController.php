<?php

class AdminController extends \BaseController {

    public function userList(){
        return View::make('admin.userlist')
                ->with('users', User::orderBy('name')->get());
    }

    public function userListTaskminators(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')

                    // join ROLES table
                    ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                    // join RATINGS table
                    ->leftJoin('ratings', 'ratings.taskminator_id', '=', 'users.id')
                    // join region/city/barangay
                    ->leftJoin('regions', 'regions.regcode', '=', 'users.region')
                    ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
                    ->leftJoin('barangays', 'barangays.bgycode', '=', 'users.barangay')

                    ->where('user_has_role.role_id', '=', '2')
                    ->whereNotIn('users.status', ['PRE_ACTIVATED'])
                    ->select([
                        'users.id',
                        'users.fullName',
                        'users.status',
                        'users.username',
                        DB::raw('AVG(ratings.stars) as avg_stars'),
                        'users.created_at',
                        'regions.regname',
                        'cities.cityname',
                        'barangays.bgyname',
                    ])
                    ->orderBy('users.created_at', 'DESC')
                    ->groupBy('users.id')
                    ->paginate(10);

        // return View::make('admin.userlist_taskminators')
        //         ->with('users', $userList);

        return View::make('admin.index')
            ->with('users', $userList);
    }

    public function userListClientIndi(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->paginate(10);

        return View::make('admin.userlist_client_indi')
            ->with('users', $userList);
    }

    public function userListClientComp(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->paginate(10   );

        return View::make('admin.userlist_client_comp')
            ->with('users', $userList);
    }

    public function adminActivate($id){
        $query = User::where('id', $id);

        $query->update(array(
            'status'    =>  'ACTIVATED'
        ));

        // TRAIL FOR ADMIN
        AuditTrail::insert(array(
            'user_id'   =>  Auth::user()->id,
            'content'   =>  'Administratively activate account for <span style="color: #2980B9;">'.$query->pluck('fullName').'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$id
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

        // TRAIL FOR USER
        AuditTrail::insert(array(
            'user_id'   =>  $id,
            'content'   =>  'Account administratively activated by <span style="color: #E74C3C;">'.Auth::user()->fullName.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$id
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

//        return Redirect::back();
        return Redirect::to('/viewUserProfile/'.$id);
    }

    public function adminDeactivate($id){
        $query = User::where('id', $id);
        $query->update(array(
            'status'    =>  'ADMIN_DEACTIVATED'
        ));

        // TRAIL FOR ADMIN
        AuditTrail::insert(array(
            'user_id'   =>  Auth::user()->id,
            'content'   =>  'Administratively deactivate account for <span style="color: #2980B9;">'.$query->pluck('fullName').'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$id
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

        // TRAIL FOR USER
        AuditTrail::insert(array(
            'user_id'   =>  $id,
            'content'   =>  'Account administratively deactivated by <span style="color: #E74C3C;">'.Auth::user()->fullName.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.$id
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

//        return Redirect::back()->with('successMsg', 'User has been deactivated.');
        return Redirect::to('/viewUserProfile/'.$id)->with('successMsg', 'User has been deactivated.');
    }

    public function viewUserProfile($id){
        if(UserHasRole::where('user_id', $id)->pluck('role_id') == '1'){
            Auth::logout();
            return Redirect::to('/');
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '2'){
            $maxStars = Rate::where('taskminator_id', $id)->max('stars');
            $starCount = Rate::where('taskminator_id', $id)->count();

            if($maxStars != 0 && $starCount != 0){
                $starRatings = $maxStars / $starCount;
            }else{
                $starRatings = 0;
            }

            return View::make('admin.viewUserProfile_tskmntr')
                ->with('user', User::where('id', $id)->first())
                ->with('contactpersons', ContactPerson::where('user_id', $id)->get())
                ->with('keyskills', Photo::where('user_id', $id)->where('type', 'KEYSKILLS')->get())
                ->with('photos', Photo::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get())
                ->with('docs', Document::where('user_id', $id)->where('type', 'DOCUMENT')->get())
                ->with('miscDocs', Document::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get())
                ->with('ratings', Rate::where('taskminator_id', $id)->count())
                ->with('starRatings', $starRatings)
                ->with('skills', TaskminatorHasSkill::where('user_id', $id)->get());
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '3'){
            return View::make('admin.viewUserProfile_cindi')
                ->with('user', User::where('id', $id)->first())
                ->with('contactpersons', ContactPerson::where('user_id', $id)->get())
                ->with('docs', Document::where('user_id', $id)->get())
                ->with('photos', Document::where('user_id', $id));
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '4'){
            return View::make('admin.viewUserProfile_ccomp')
                ->with('user', User::where('id', $id)->first())
                ->with('keyperson', ContactPerson::where('user_id', $id)->get())
                ->with('photos', Photo::where('user_id', $id)->get())
                ->with('docs', Document::where('user_id', $id)->get())
                ->with('miscDocs', Document::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get());
        }else{
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function pendingTskmntr(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '2')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Taskminator Accounts')
            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function pendingTskmntrSearch($searchBy, $searchWord){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '2')
            ->where('users.status', ['PRE_ACTIVATED']);

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $userList = $userList->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('pageTitle', 'Pending Taskminator Accounts')
            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function pendingClientIndi(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Client (Individual) Accounts')
            ->with('formUrl', '/pendingClientIndi=search');
    }

    public function pendingClientIndiSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->where('users.status', 'PRE_ACTIVATED');

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $query = $query->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('pageTitle', 'Pending Client (Individual) Accounts')
            ->with('users', $query)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('formUrl', '/pendingClientIndi=search');
    }

    public function pendingClientComp(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Client (Company) Accounts')
            ->with('formUrl', '/pendingClientComp=search');
    }

    public function pendingClientCompSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->where('users.status', 'PRE_ACTIVATED');

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $query = $query->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('pageTitle', 'Pending Client (Company) Accounts')
            ->with('users', $query)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('formUrl', '/pendingClientComp=search');
    }

//    public function categoryAndSkills(){
    public function skills(){
        return View::make('admin.categoryAndSkills')->with('taskCategory', TaskCategory::orderBy('categoryCode', 'ASC')->get());
    }

    public function auditTrail($role){
        $query = User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                     ->join('roles', 'roles.id', '=', 'user_has_role.role_id');

        switch($role){
            case 'taskminator'  :
                $query->where('roles.role', 'TASKMINATOR');
                break;
            case 'clientindi'  :
                $query->where('roles.role', 'CLIENT_IND');
                break;
            case 'clientcomp'  :
                $query->where('roles.role', 'CLIENT_CMP');
                break;
            default :
                return Redirect::back()->with('errorMsg', 'UNKNOWN REQUEST');
        }

        $query->select(array(
            'users.id',
            'users.fullName',
            'users.status',
        ));

        return View::make('admin.AT_userList')->with('users', $query->paginate(10));
    }

    public function userAuditTrail($id){
        return View::make('admin.userTrail')
            ->with('user', User::where('id', $id)->first())
            ->with('trails', AuditTrail::where('user_id', $id)->paginate(10));
    }

    public function taskDetails($taskid){
        $taskQuery = Task::where('id', $taskid)->first();
        $taskminator = null;

        if($taskQuery->status == 'ONGOING' || $taskQuery->status == 'COMPLETE'){
            $taskminator = User::join('task_has_taskminator', 'task_has_taskminator.taskminator_id', '=', 'users.id')
                            ->where('task_has_taskminator.task_id', $taskQuery->id)
                            ->select([
                                'users.fullName',
                                'users.id',
                                'task_has_taskminator.created_at'
                            ])
                            ->first();
        }

        return View::make('admin.taskDetails')
                ->with('task', $taskQuery)
                ->with('client', User::where('id', $taskQuery->user_id)->first())
                ->with('taskminator', $taskminator);
    }

    public function viewRatings($tskmntrId){
        return View::make('admin.ratings')
                ->with('ratings', Rate::where('ratings.taskminator_id', $tskmntrId)->get())
                ->with('tskmntr', User::where('id', $tskmntrId)->first());
    }

    public function index(){
        return View::make('admin.taskList')
            ->with('pendingCount', $this->countPendingUsers())
            ->with('pendingUsers', User::where('status', 'PRE_ACTIVATED')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Proveek Admin | Dashbooard')
            ->with('formUrl', '/pendingUserSearch');
    }

    public function taskListBiddingSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

//        return View::make('admin.taskList')
        return View::make('admin.jobAds')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Bidding Tasks')
            ->with('formUrl', '/taskListBidding=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }

    public function taskListAuto(){
        return View::make('admin.taskList')
            ->with('tasks', Task::where('hiringType', 'AUTOMATIC')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Automatic Tasks')
            ->with('formUrl', '/taskListAuto=search');
    }

    public function taskListAutoSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'AUTOMATIC')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

        return View::make('admin.taskList')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Automatic Tasks')
            ->with('formUrl', '/taskListAuto=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }

    public function taskListDirect(){
        return View::make('admin.taskList')
            ->with('tasks', Task::where('hiringType', 'DIRECT')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Direct Tasks')
            ->with('formUrl', '/taskListDirect=search');
    }

    public function taskListDirectSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'DIRECT')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

        return View::make('admin.taskList')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Direct Tasks')
            ->with('formUrl', '/taskListDirect=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }


    public function searchWorker($acctStatus, $rating, $hiring, $orderBy, $keyword){
//        NOTE : whereNotIn clause inserted multiple times.
//        bugs occur because of conditional additions of queries
//        to adapt to  multiple search parameters
//        - Jan Sarmiento
        
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
                    ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                    ->leftJoin('ratings', 'ratings.taskminator_id', '=', 'users.id')
                    ->where('user_has_role.role_id', '2')
                    ->whereNotIn('users.status', ['PRE_ACTIVATED']);

        if($keyword != 'NONE'){
            $query->where('users.fullName', 'LIKE', '%'.$keyword.'%')
                ->orWhere('users.username', 'LIKE', '%'.$keyword.'%')
                ->where('user_has_role.role_id', '2')
                ->whereNotIn('users.status', ['PRE_ACTIVATED']);
        }else{
            $keyword = null;
        }


        $query->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('avg_stars', $rating)
            ->orderBy('users.created_at', $orderBy)
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
                DB::raw('AVG(ratings.stars) as avg_stars')
            ])
            ->groupBy('users.id');

        return View::make('admin.index')
                ->with('users', $query->paginate(10))
                ->with('rating', $rating)
                ->with('orderBy', $orderBy)
                ->with('keyword', $keyword);
    }

//    public function adminTskmntrSearch(){
//        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
//            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
//            ->where('user_has_role.role_id', '2')
//            ->whereNotIn('users.status', ['PRE_ACTIVATED']);
//
//        if(Input::get('searchBy') != '0'){
//            if(Input::get('searchWord') != ''){
//                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
//            }
//        }
//
//        $query = $query->orderBy('users.created_at', 'DESC')
//                    ->select([
//                        'users.id',
//                        'users.fullName',
//                        'users.status',
//                        'users.username',
//                    ]);
//        return View::make('admin.userlist_taskminators')
//                ->with('users', $query->get())
//                ->with('searchBy', Input::get('searchBy'))
//                ->with('searchWord', Input::get('searchWord'));
//    }

    public function adminClientIndiSearch(){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->whereNotIn('users.status', ['PRE_ACTIVATED']);

        if(Input::get('searchBy') != '0'){
            if(Input::get('searchWord') != ''){
                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ]);

        return View::make('admin.userlist_client_indi')
            ->with('users', $query->get())
            ->with('searchBy', Input::get('searchBy'))
            ->with('searchWord', Input::get('searchWord'));
    }

    public function adminClientCompSearch(){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->whereNotIn('users.status', ['PRE_ACTIVATED']);
//            ->orderBy('users.created_at', 'DESC')
//            ->select([
//                'users.id',
//                'users.fullName',
//                'users.username',
//                'users.status',
//            ])->get();

        if(Input::get('searchBy') != '0'){
            if(Input::get('searchWord') != ''){
                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ]);

        return View::make('admin.userlist_client_comp')
            ->with('users', $query->get())
            ->with('searchBy', Input::get('searchBy'))
            ->with('searchWord', Input::get('searchWord'));
    }

    public function viewUsersTasks($clientid){
        return View::make('admin.clientTask')
                ->with('tasks', Task::where('user_id', $clientid)->orderBy('created_at', 'DESC')->paginate(10))
                ->with('client', User::where('id', $clientid)->first());
    }

    public function viewUsersTasksSearch(){
        $query = Task::where('user_id', Input::get('clientid'));

        if(Input::get('hiringType') != 'ALL'){
            $query = $query->where('hiringType', Input::get('hiringType'));
        }

        if(Input::get('searchBy') == 'name'){
            if(Input::get('searchWord') != ''){
                $query = $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }else if(Input::get('searchBy') == 'workTime'){
            $query = $query->where(Input::get('searchBy'), Input::get('workTimeValue'));
            if(Input::get('searchWord') != ''){
                $query = $query->where('name', 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        if(Input::get('status') != 'ALL'){
            $query = $query->where('status', Input::get('status'));
        }

        return View::make('admin.clientTask')
            ->with('tasks', $query->get())
            ->with('client', User::where('id', Input::get('clientid'))->first())
            ->with('searchBy', Input::get('searchBy'))
            ->with('workTimeValue', Input::get('workTimeValue'))
            ->with('hiringType', Input::get('hiringType'));
    }

    public function userListTaskminatorsSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')->where('users.status', 'ACTIVATED')->where('user_has_role.role_id', '2');

        if($searchBy != '0'){
            $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
        }

        return View::make('admin.index')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('users', $query->orderBy('fullName', 'ASC')->paginate(10));
    }

    public function userListClientIndiSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->where('users.status', 'ACTIVATED')
            ->whereIn('user_has_role.role_id', ['3', '4']);
//            ->where('user_has_role.role_id', '3');

        if($searchBy != '0'){
            $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
        }

        return View::make('admin.userlist_client_indi')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('users', $query->orderBy('fullName', 'ASC')->paginate(10));
    }

    public function userListClientCompSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')->where('users.status', 'ACTIVATED')->where('user_has_role.role_id', '4');

        if($searchBy != '0'){
            $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
        }

        return View::make('admin.userlist_client_comp')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('users', $query->orderBy('fullName', 'ASC')->paginate(10));
    }

    public function newSkill(){
        if(strlen(trim(Input::get('newSkillInput'))) == 0){
            Session::flash('errorm', 'New skill cannot be empty');
            return Redirect::back();
        }else if(Input::get('newSkillInput') == ''){
            Session::flash('errorm', 'New skill cannot be empty');
            return Redirect::back();
        }

        if(Input::get('category') == ''){
            Session::flash('errorm', 'Please select a category');
            return Redirect::back();
        }

        if(TaskCategory::where('categorycode', Input::get('category'))->count() == 0){
            Session::flash('errorm', 'Please select a valid category');
            return Redirect::back();
        }
        $maxSkillCode = str_replace(Input::get('category'), '', TaskItem::where('item_categorycode', Input::get('category'))->max('itemcode'));
        $maxSkillCode = ++$maxSkillCode;
        $maxSkillCode = str_pad($maxSkillCode, 3, '0', STR_PAD_LEFT);

        TaskItem::insert(array(
            'item_categorycode'     =>  Input::get('category'),
            'itemname'              =>  Input::get('newSkillInput'),
            'itemcode'              =>  Input::get('category').''.$maxSkillCode
        ));

        Session::flash('succmsg', 'Skill '.Input::get('newSkillInput').' has been successfully added.');
        return Redirect::to('/skills');
    }

    public function newCategory(){
        if(Input::get('newCategoryInput') == ''){
            return Redirect::back()->with('errorm', 'Please input a valid category name');
        }

        $maxCatCode = TaskCategory::whereNotIn('categoryname', ['Others'])->max('categorycode');
        $maxCatCode = ++$maxCatCode;
        $maxCatCode = str_pad($maxCatCode, 3, '0', STR_PAD_LEFT);

        TaskCategory::insert(array(
            'categoryname'      =>  Input::get('newCategoryInput'),
            'categorycode'      =>  $maxCatCode
        ));

        return Redirect::to('/skills')->with('succmsg', 'New category is successfully added');
    }

    public function deleteCategory($categorycode){
        TaskCategory::where('categorycode', $categorycode)->delete();
        TaskItem::where('item_categorycode', $categorycode)->delete();

        return Redirect::back()->with('successMsg', 'Category has been successfully deleted');
    }

    public function deleteSkill($skillcode){
        TaskItem::where('itemcode', $skillcode)->delete();
        return Redirect::back()->with('successMsg', 'Skill has been successfully deleted');
    }

    public function cms(){
        return View::make('admin.cms')
            ->with('tasks', Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Proveek Admin | Content Management System')
            ->with('formUrl', '/taskListBidding=search');
    }

    public function jobAds($adType){
        switch($adType){
            case 'INDIVIDUAL' :
                break;
            case 'FEATURED' :
                break;
            case 'HIRING' :
                break;
            case 'REFERRAL' :
                break;
        }

        return View::make('admin.jobAds')
            ->with('pageName', 'Proveek | Job Ads - '.$adType)
            ->with('pageTitle', 'Proveek | Job Ads - '.$adType)
            ->with('tasks', Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('formUrl', '/taskListBidding=search');
    }

    public function pendingUserSearch($searchBy, $searchUserType, $searchWord){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('users.status', ['PRE_ACTIVATED']);

        if($searchUserType != 'ALL'){
            $userList->where('user_has_role.role_id', $searchUserType);
        }

        if($searchBy != 'ALL'){
            $searchByQuery = 'users.'.$searchBy;
//            $searchWordQuery = 'users.'.$searchWord;
//            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWord.'%');
        }

        $userList = $userList->orderBy('users.created_at', 'ASC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.taskList')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('searchUserType', $searchUserType)
            ->with('pendingUsers', $userList)
            ->with('pageName', 'Proveek Admin | Dashbooard')
            ->with('formUrl', '/pendingUserSearch');

//            ->with('users', $userList)
//            ->with('searchBy', $searchBy)
//            ->with('searchWord', $searchWord)
//            ->with('pageTitle', 'Pending Taskminator Accounts')
//            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function countPendingUsers(){
        return User::where('status', 'PRE_ACTIVATED')->count();
    }

    public function search_PUSR($keyword, $acctType, $orderBy){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('users.status', ['PRE_ACTIVATED']);

        if($keyword != "NONE"){
            $userList = $userList
                        ->where('users.fullName', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('users.username', 'LIKE', '%'.$keyword.'%');
        }

        if($acctType != "ALL"){
            $userList = $userList->where('users.accountType', $acctType);
        }

        $userList = $userList->orderBy('users.created_at', $orderBy)
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.taskList')
            ->with('pendingUsers', $userList)
            ->with('pendingCount', $this->countPendingUsers())
            ->with('search_keyword', $keyword)
            ->with('search_acctType', $acctType)
            ->with('search_orderBy', $orderBy)
            ->with('pageName', 'Proveek Admin | Dashbooard');
    }

    public function adminSearchChatUser(){
        return User::where('fullName', 'LIKE', '%'.Input::get('chatSearch').'%')
                ->orWhere('username', 'LIKE', '%'.Input::get('chatSearch').'%')
                ->select([
                    'fullName',
                    'username',
                    'id'
                ])->get();
    }

    public function getCHAT($with_userId){

        $QUERY = AdminMessage::whereIn('user_id', array(Auth::user()->id, $with_userId))
                    ->whereIn('sender_id', array(Auth::user()->id, $with_userId));
        if($QUERY->count() > 0){
            $QUERY->update(['status'    =>  'OLD']);
            return $QUERY->get();
        }else{
            return "NOCHATHISTORY";
        }
    }

    public function ADMINSENDMESSAGE(){
        $msg_timestamp = date("Y:m:d H:i:s");
        AdminMessage::insert(array(
            'user_id'   =>  Input::get('USERID'),
            'sender_id' =>  Input::get('SENDERID'),
            'content'   =>  Input::get('ADMIN_sendMsgContent'),
            'created_at'=>  $msg_timestamp,
        ));

//        date('D, M j, Y \a\t g:ia')
        return array(
            'msg'       =>  Input::get('ADMIN_sendMsgContent'),
            'tstamp'    =>  $msg_timestamp
        );
    }

    public function ADMINGETNEWMSG($userid, $senderid){
        $NEWMSG = AdminMessage::where('user_id', Auth::user()->id)
                    ->where('status', 'NEW')
                    ->where('sender_id', $userid);

        $ALL_NEW_MESSAGES = $NEWMSG->get();

        $NEWMSG->update(['status' => 'OLD']);

        return $ALL_NEW_MESSAGES;
    }

    public function showJobAds(){
        $jobs = Job::join('users', 'users.id', '=', 'jobs.user_id')
                ->orderBy('created_at', 'DESC')
                ->select([
                    'users.id as USERID',
                    'users.username',
                    'users.fullName',
                    'jobs.id as JOBID',
                    'jobs.title',
                    'jobs.description',
                    'jobs.created_at',
                ])
                ->paginate(10);

        return View::make('admin.showJobAds')
                ->with('jobs', $jobs);
    }

    public function ADMIN_jobDetails($job_id){
        $custom_skills = CustomSkill::where('company_job_id', $job_id)->get();
        $job = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->join('taskcategory', 'jobs.skill_category_code', '=', 'taskcategory.categorycode')
            ->join('taskitems', 'jobs.skill_code', '=', 'taskitems.itemcode')
            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->leftJoin('barangays', 'barangays.bgycode', '=', 'jobs.bgycode')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->where('jobs.id', $job_id)
            ->select([
                'users.username',
                'users.id as USERID',
                'users.fullName',
                'jobs.id',
                'jobs.title',
                'jobs.created_at',
                'jobs.description',
                'jobs.requirements',
                'jobs.salary',
                'jobs.hiring_type',
                'regions.regname',
                'regions.regcode',
                'barangays.bgyname',
                'barangays.bgycode',
                'cities.cityname',
                'cities.citycode',
                'taskcategory.categoryname',
                'taskcategory.categorycode',
                'taskitems.itemname',
                'taskitems.itemcode'
            ])
            ->first();

        return View::make('admin.ADMIN_jobDetails')
                ->with('job', $job)
                ->with('custom_skills', $custom_skills);
    }

    public function ADMINJbSrch($keyword, $regcode, $citycode, $hiringType, $orderBy, $categoryID, $skillID, $customSkill){
        if($keyword == 'NONE'){ $keyword = ''; }
        if($customSkill == 'NONE'){ $customSkill = ''; }


        $QUERY = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->join('taskcategory', 'jobs.skill_category_code', '=', 'taskcategory.categorycode')
            ->join('taskitems', 'jobs.skill_code', '=', 'taskitems.itemcode')
            ->join('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->leftJoin('custom_skills', 'custom_skills.company_job_id', '=', 'jobs.id')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->where('jobs.title', 'LIKE', '%'.$keyword.'%')
            ->where('custom_skills.skill', 'LIKE', '%'.$customSkill.'%');

        if($regcode != 'ALL'){
            $QUERY = $QUERY->where('regions.regcode', $regcode);
        }
//
        if($citycode != 'ALL'){
            $QUERY = $QUERY->where('cities.citycode', $citycode);
        }

        if($hiringType != 'ALL'){
            $QUERY = $QUERY->where('jobs.hiring_type', $hiringType);
        }

        if($categoryID != 'ALL'){
            $QUERY = $QUERY->where('taskcategory.categorycode', $categoryID);
        }

        if($skillID != 'ALL'){
            $QUERY = $QUERY->where('taskitems.itemcode', $skillID);
        }

        $QUERY = $QUERY->orderBy('jobs.created_at', $orderBy)
            ->select([
                'users.username',
                'users.id as USERID',
                'users.fullName',
                'jobs.id as JOBID',
                'jobs.title',
                'jobs.created_at',
                'jobs.description',
                'jobs.requirements',
                'jobs.salary',
                'jobs.hiring_type',
                'regions.regname',
                'regions.regcode',
                'cities.cityname',
                'cities.citycode',
                'taskcategory.categoryname',
                'taskcategory.categorycode',
                'taskitems.itemname',
                'taskitems.itemcode'
            ])
            ->groupBy('jobs.id')
            ->paginate(10);

        return View::make('admin.showJobAds')
                ->with('jobs', $QUERY);
    }

    public function ADMIN_DELETEJOB($jobId){
        Job::where('id', $jobId)->delete();
        JobInvite::where('job_id', $jobId)->delete();
        JobApplication::where('job_id', $jobId)->delete();
        CustomSkill::where('company_job_id', $jobId)->delete();

        return Redirect::to('/showJobAds');
    }

    public function UsrAccntLstCMPNY(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->whereIn('user_has_role.role_id', ['3', '4'])
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->paginate(10);

        return View::make('admin.userlist_client_indi')
            ->with('users', $userList);

    }
}
