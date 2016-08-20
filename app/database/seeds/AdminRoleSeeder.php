<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 8/20/2016
 * Time: 9:50 AM
 */


class AdminRoleSeeder extends Seeder {
    public function run(){
        AdminRole::create([
            'role'  =>  'SUPER_ADMINISTRATOR'
        ]);

        AdminRole::create([
            'role'  =>  'ADMINISTRATOR'
        ]);

        AdminRole::create([
            'role'  =>  'CONTENT_EDITOR'
        ]);

        AdminRole::create([
            'role'  =>  'SUPPORT'
        ]);
    }
}