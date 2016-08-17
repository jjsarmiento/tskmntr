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
            $table->string('user_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('skill_category_code')->nullable();
            $table->string('skill_code')->nullable();
            $table->string('regcode')->nullable();
            $table->string('provcode')->nullable();
            $table->string('bgycode')->nullable();
            $table->string('citycode')->nullable();
            $table->string('hiring_type')->nullable();
//            $table->float('salary')->nullable();
            $table->string('salary')->nullable();
            $table->longText('AverageProcessingTime')->nullable();
            $table->longText('Industry')->nullable();
            $table->longText('CompanySize')->nullable();
            $table->longText('WorkingHours')->nullable();
            $table->longText('DressCode')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('expired')->nullable()->default(false);
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
