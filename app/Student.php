<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
      'student_name',
      'school_id',
      'class_id',
      'father_name',
      'mother_name',
      'email_address',
      'sms_mobile',
      'date_of_admission',
      'student_photo',
      'address',
      'status',
      'user_id',
      'password',
      'encripted_password',
    ];
}
