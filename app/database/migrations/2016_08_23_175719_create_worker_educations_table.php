<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerEducationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_educations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('level')->nullable();
            $table->string('school_name')->nullable();
            $table->string('course_major')->nullable();
            $table->string('school_year')->nullable();
            $table->string('awards')->nullable();
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
		Schema::drop('worker_educations');
	}

}
