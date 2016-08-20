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

    public function workers(){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->where('user_has_role.role_id', '=', '2')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.created_at',
                'users.status'
            ])
            ->paginate(10);

        return View::make('admin.subadmin.userlist')
            ->with('title', 'Workers - User Accounts List')
            ->with('users', $users);
    }

    public function employers(){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->whereIn('user_has_role.role_id', [3, 4])
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.created_at',
                'users.status'
            ])
            ->paginate(10);

        return View::make('admin.subadmin.userlist')
            ->with('title', 'Employers - User Accounts List')
            ->with('users', $users);
    }
}