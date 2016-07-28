<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //SYSSETTINGS_POINTSPERAD
        //SYSSETTINGS_JOBADDURATION
        //SYSSETTINGS_CHECKOUTPRICE
        //SYSSETTINGS_TOS_ES
        //SYSSETTINGS_TOS_TG
        //SYSSETTINGS_POLICY_ES
        //SYSSETTINGS_POLICY_TG
		Schema::create('system_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->longText('value');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_settings');
	}

}
