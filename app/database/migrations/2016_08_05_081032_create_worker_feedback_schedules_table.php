<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerFeedbackSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_feedback_schedules', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('employer_id');
            $table->string('job_id');
            $table->string('worker_id');
            $table->timestamp('start_date');
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
		Schema::drop('worker_feedback_schedules');
	}

}
