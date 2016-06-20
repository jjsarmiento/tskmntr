<?php


class searchTestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('searchTest');
	}

	public function compDoSearch()
	{
		$search = Input::get('search');
		$msg = null;

			$users = DB::table('users')->where('username', '=', $search)
			->orWhere('fullName', 'LIKE', '%'. $search .'%')
			->orWhere('username', 'LIKE', $search .'%')
			->orWhere('skills', 'LIKE', '%'. $search . '%')
			->get();
	    	return View::make("searchTestResult")->with("users", $users);
	}

	public function workerDoSearch()
	{
		$search = Input::get('search');
		$msg = null;
		if($search == "")
		{
			return View::make("searchTestResult")->with("users", $users);
		}
		else
		{
			$users = DB::table('users')->where('username', '=', $search)
			->orWhere('fullName', 'LIKE', '%'. $search .'%')
			->orWhere('username', 'LIKE', $search .'%')
			->get();
	    	return View::make("searchTestResult")->with("users", $users);
    	}
	}

	public function doSearch()
	{
		$search = Input::get('search');
		$msg = null;
		if($search == "")
		{
			return View::make("searchTestResult")->with("users", $users);
		}
		else
		{
			$users = DB::table('users')->where('username', '=', $search)
			->orWhere('fullName', 'LIKE', '%'. $search .'%')
			->orWhere('username', 'LIKE', $search .'%')
			->get();
	    	return View::make("searchTestResult")->with("users", $users);
    	}
	}
	public function toProfile($username)
	{
		// $temp = User::where('username', '=', $username)->get()->first();.

		$temp = User::where('username', '=', $username)->get()->first();
		$role = Role::join('user_has_role', 'roles.id', '=', 'user_has_role.role_id')
                ->where('user_has_role.user_id', $temp->id)
                ->pluck('role');

		return View::make("profile_worker")->with("users", $temp)->with('roles', $role);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$users = DB::table('users')->get();
		return View::make('searchTestResult', compact('users'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
