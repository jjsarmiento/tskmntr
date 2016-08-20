<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 8/20/2016
 * Time: 5:54 PM
 */

class SubAdminController extends \BaseController {
    public function pending_users(){
        $users = User::whereIn('status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])
            ->paginate(10);

        return View::make('admin.subadmin.pending_users')
            ->with('users', $users);
    }
}