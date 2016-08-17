<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 8/4/2016
 * Time: 8:55 AM
 */

class TestSeeder extends Seeder {
    public function run(){
        $today = \Carbon\Carbon::now();
        $nextWeek = \Carbon\Carbon::now()->addWeek();
        $TwoDaysFromToday = \Carbon\Carbon::now()->addDays(2);
        $ThreeDaysFromToday = \Carbon\Carbon::now()->addDays(3);
        $FourDaysFromToday = \Carbon\Carbon::now()->addDays(4);

        Job::create([
            'user_id'               =>  2,
            'title'                 =>  'First Job',
            'description'           =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'skill_category_code'   =>  '002',
            'skill_code'            =>  '002001',
            'regcode'               =>  '01',
            'provcode'              =>  '0128',
            'citycode'              =>  '012801',
            'hiring_type'           =>  'LT6MOS',
            'expires_at'            =>  $today,
            'created_at'            =>  $today
        ]);

        Job::create([
            'user_id'               =>  2,
            'title'                 =>  'Second Job',
            'description'           =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'skill_category_code'   =>  '002',
            'skill_code'            =>  '002001',
            'regcode'               =>  '01',
            'provcode'              =>  '0128',
            'citycode'              =>  '012801',
            'hiring_type'            =>  'LT6MOS',
            'expires_at'            =>  $TwoDaysFromToday,
            'created_at'            =>  $today
        ]);

        Job::create([
            'user_id'               =>  2,
            'title'                 =>  'Third Job',
            'description'           =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'skill_category_code'   =>  '002',
            'skill_code'            =>  '002001',
            'regcode'               =>  '01',
            'provcode'              =>  '0128',
            'citycode'              =>  '012801',
            'hiring_type'            =>  'LT6MOS',
            'expires_at'            =>  $ThreeDaysFromToday,
            'created_at'            =>  $today
        ]);
    }
}