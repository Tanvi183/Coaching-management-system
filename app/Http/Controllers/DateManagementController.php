<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;

class DateManagementController extends Controller
{
    public function addYear()
    {
    	$currentYear = date('Y');
    	$check = Year::where('year','=',$currentYear)->get();
    	if (count($check)>0) {
    		return back()->with('error',"$currentYear already exist in database !!! Please Try again next year.");    	
    	}else{
    		$year = new Year();
    		$year->year = $currentYear;
    		$year->status = 1;
    		$year->save();
    		return back()->with('message',"Year $currentYear added in database successfully."); 
    	}
    }

    
}
