<?php

namespace App\Http\Controllers;

use App\ClassName;
use App\Year;
use Illuminate\Http\Request;
use DB;

class StudentAttendanceController extends Controller
{
    public function batchSelectionFormForAttendanceAdd()
    {
    	$classes = ClassName::where('status','=',1)->get();
    	$years = Year::where('status','=',1)->get();
    	return view('admin.student.attendance.batch-selection-form-for-attendance-add',[
    		'classes'=>$classes,
    		'years'=>$years
    	]);
    }

    public function batchWiseStudentListForAttendance(Request $request)
    {
    	$students = DB::table('students')
            ->join('schools','students.school_id','=','schools.id')
            ->join('studenttype_details','studenttype_details.student_id','=','students.id')
            ->join('batches','studenttype_details.batch_id','=','batches.id')
            ->select('students.*','schools.school_name','studenttype_details.roll_on','batches.batch_name')
            ->where([
                'students.status'=>1,
                'students.class_id'=>$request->class_id,
                'studenttype_details.type_id'=>$request->type_id,
                'studenttype_details.batch_id'=>$request->batch_id,
                'studenttype_details.type_status'=>1,
            ])
            ->orderBy('studenttype_details.roll_on','ASC')->get();
        return view('admin.student.attendance.student-list-for-attendence-add',[
        	'students'=>$students,
        ]);
    }

    public function saveStudentAttendance(Request $request)
    {
    	return $request->all();
    }


}
