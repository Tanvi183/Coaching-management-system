<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudenttypeDetails extends Model
{
    protected $fillable = [ 
    	'student_id',
		'class_id',
		'type_id',
		'batch_id',
		'roll_on',
		'type_status',
    ];
}
