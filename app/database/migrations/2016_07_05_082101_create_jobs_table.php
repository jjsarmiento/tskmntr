<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('user_id');
            $table->string('title');
            $table->longText('description');
            $table->longText('requirements');
            $table->string('skill_category_code');
            $table->string('skill_code');
            $table->string('regcode');
            $table->string('bgycode');
            $table->string('citycode');
            $table->string('hiring_type');
            $table->float('salary');
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
		Schema::drop('jobs');
	}

}
