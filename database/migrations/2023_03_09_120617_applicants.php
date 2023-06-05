<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->text('photos');
            $table->text('lastname');
            $table->text('firstname');
            $table->text('middlename')->nullable();
            $table->text('extention')->nullable();
            $table->text('gender');
            $table->text('status');
            $table->integer('age');
            $table->date('birthday');
            $table->text('nationality');
            $table->text('religion');
            $table->text('address');
            $table->text('phoneNumber');
            $table->text('emailAddress');
            $table->text('username');
            $table->text('password');
            $table->text('personal_id1');
            $table->text('personal_id2');
            $table->text('token');
            $table->integer('is_active');
            $table->integer('is_utilized');
            $table->integer('is_blocked');
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
        //
    }
};
