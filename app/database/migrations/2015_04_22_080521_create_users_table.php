<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            // PERSONAL DETAILS
            $table->string('firstName')->nullable();
            $table->string('midName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('fullName')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();

            // LOCATION DETAILS
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->default('PHILIPPINES');

            // ACCOUNT DETAILS
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('profilePic')->nullable();
            $table->string('confirmationCode')->nullable();
            $table->string('status')->nullable();

            // OLD COLUMNS ??
            $table->string('workTime')->nullable();

            // FOR COMPANIES / EMPlOYERS
            // THERE ARE 3 TYPES OF ACCOUNTS FOR CLIENTS :
            // Basic Account : BASIC
            // Premium Account : PREMIUM
            // Ultimate Account : ULTIMATE
            $table->string('accountType')->nullable();
            $table->float('points')->nullable();
            $table->string('businessPermit')->nullable();
            $table->string('companyName')->nullable();
//            $table->longText('businessDescription_LONG')->nullable();
            $table->longText('businessDescription')->nullable();
            $table->longText('businessNature')->nullable();

            $table->string('years_in_operation')->nullable();
//            $table->longText('company_size')->nullable();
            $table->longText('number_of_branches')->nullable();
            $table->string('contact_person_position')->nullable();
            $table->longText('number_of_employees')->nullable();
            $table->longText('working_hours')->nullable();

            // FOR WORKERS
            $table->longText('educationalBackground')->nullable();
            $table->string('servicesOffered')->nullable();
            $table->string('skills')->nullable();
            // $table->integer('yearsOfExperience')->nullable();
            $table->longText('experience')->nullable();
            $table->string('marital_status')->nullable();

//            $table->integer('maxRate')->nullable();
//            $table->integer('minRate')->nullable();

            $table->float('total_profile_progress')->nullable();

            $table->string('remember_token')->nullable();
            $table->timestamp('last_login')->nullable();
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
        Schema::drop('users');
    }
}
