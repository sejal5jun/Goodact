<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_users', function (Blueprint $table) {
           
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->integer('activation');
            $table->integer('status');
            $table->string('token');
            $table->string('pitcure');
            $table->string('organization');
            $table->string('linkedin');
            $table->string('twitter');
            $table->string('facebook');
            $table->integer('last_login');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            
            $table->string('name');
            $table->string('cause');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('country');
            $table->string('city');
            $table->string('organization');
            $table->string('goal');
            $table->string('pitcure');
            $table->integer('status');
            $table->integer('total_goal');
            $table->string('facebook');
            $table->index('created_by');
            $table->timestamps();
        });

        Schema::create('group', function (Blueprint $table) {
            
            $table->string('name');
            $table->string('description');
            $table->string('country');
            $table->string('city');
            $table->string('pitcure');
            $table->integer('status');
            $table->index('created_by');
            $table->timestamps();
        });

         Schema::create('message', function (Blueprint $table) {
            
            
            $table->index('to_id');
            $table->index('from_id');
            $table->string('message');
            $table->timestamps();
        });

         Schema::create('connection', function (Blueprint $table) {
            
            
            $table->index('to_id');
            $table->index('from_id');
            $table->integer('status');
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
        Schema::dropIfExists('website_users');
    }
}
