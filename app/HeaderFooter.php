<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderFooter extends Model
{
   	protected $fillable = [
   		'institute_name','title','address','mobile','email','copyright','status',
    ];
}
