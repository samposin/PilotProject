<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefix',25);
            $table->string('firstname',50);
            $table->string('middlename',50);
            $table->string('lastname',50);
            $table->string('suffix',25);
            $table->string('email');
            $table->string('nickname',50);
            $table->string('pronounced',50);
            $table->string('gender',10);
            $table->date('birth_date');
            $table->string('street1',50);
            $table->string('street2',50);
            $table->string('city',50);
            $table->string('state',2);
            $table->string('county',50);
            $table->string('zip',5);
            $table->string('zip_ext',4);
            $table->string('phone1',14);
            $table->string('phone1_ext',10);
            $table->string('phone1_type',15);
            $table->string('phone2',14);
            $table->string('phone2_ext',10);
            $table->string('phone2_type',15);
            $table->string('phone3',14);
            $table->string('phone3_ext',10);
            $table->string('phone3_type',15);
            $table->string('image');
            $table->tinyInteger('is_active')->default(1);
            $table->integer('created_userid')->unsigned()->default(0);
            $table->integer('updated_userid')->unsigned()->default(0);
            $table->integer('deleted_userid')->unsigned()->default(0);
            $table->timestamps();
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
        Schema::drop('persons');
    }
}
