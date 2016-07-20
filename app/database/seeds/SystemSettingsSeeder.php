<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 7/20/2016
 * Time: 1:14 PM
 */
class SystemSettingsSeeder extends Seeder {

    public function run(){
        date_default_timezone_set("Asia/Manila");

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_POINTSPREAD",
            'value'         =>  "5",
            'created_at'    =>  date("Y:m:d H:i:s")
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_JOBADDURATION",
            'value'         =>  "168",
            'created_at'    =>  date("Y:m:d H:i:s")
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_CHECKOUTPRICE",
            'value'         =>  "10",
            'created_at'    =>  date("Y:m:d H:i:s")
        ));
    }
}