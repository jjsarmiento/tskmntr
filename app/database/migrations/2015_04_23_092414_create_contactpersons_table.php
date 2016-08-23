<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactpersonsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactpersons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->nullable();

            /*
            $table->integer('user_id')->nullable();
            $table->string('firstName')->nullable();
            $table->string('midName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('contactNum')->nullable();
            $table->string('email')->nullable();
            $table->string('position')->nullable();
            $table->string('country')->nullable();
            */

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
        Schema::drop('contactpersons');
    }

}
