<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->rememberToken();
            $table->tinyInteger('is_active')->default(1);
            $table->integer('created_userid')->unsigned()->default(0);
            $table->integer('updated_userid')->unsigned()->default(0);
            $table->integer('password_updated_userid')->unsigned()->default(0);
            $table->integer('deleted_userid')->unsigned()->default(0);
            $table->timestamp('last_logged_in_at')->nullable();
            $table->timestamps();
            $table->timestamp('password_updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

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
