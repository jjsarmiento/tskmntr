<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 7/20/2016
 * Time: 1:14 PM
 */
class SystemSettingsSeeder extends Seeder {

    public function run(){

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_POINTSPERAD",
            'value'         =>  "5"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_JOBADDURATION",
            'value'         =>  "168"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_CHECKOUTPRICE",
            'value'         =>  "10"
        ));
    }
}