<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email_address')->nullable();
            $table->string('sms_mobile');
            $table->date('date_of_admission');
            $table->string('student_photo')->nullable();
            $table->text('address');
            $table->tinyInteger('status');
            $table->text('password');
            $table->text('encripted_password');
            $table->integer('user_id');

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
        Schema::dropIfExists('students');
    }
}
