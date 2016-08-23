<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_experiences', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('position')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->string('time_period')->nullable();
            $table->string('roles_and_resp')->nullable();
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
		Schema::drop('worker_experiences');
	}

}
