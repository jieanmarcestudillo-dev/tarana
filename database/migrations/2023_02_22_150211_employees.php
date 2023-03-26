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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->integer('companyId');
            $table->text('photos');
            $table->text('lastname');
            $table->text('firstname');
            $table->text('middlename');
            $table->text('extention');
            $table->text('gender');
            $table->text('position');
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
            $table->text('token');
            $table->integer('is_active');
            $table->integer('is_utilized');
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
