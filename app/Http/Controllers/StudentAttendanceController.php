<?php

namespace App\Http\Controllers;

use App\Year;
use App\ClassName;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $today = date('Y-m-d');
        $attendanceCheck = Attendance::where([
            'class_id' => $request->class_id,
            'batch_id' => $request->batch_id,
            'type_id' => $request->type_id,
        ])->whereDate('created_at',$today)->get();

        if(count($attendanceCheck)>0){
            return view('admin.student.attendance.error');
        }else{
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

            return view('admin.student.attendance.student-list-for-attendence-add',['students'=>$students,]);
        }
    }

    public function saveStudentAttendance(Request $request)
    {
    	// $request->except('_token');
        $today = date('Y-m-d');
        $attendanceCheck = Attendance::where([
            'class_id' => $request->class_id,
            'type_id' => $request->type_id,
            'batch_id' => $request->batch_id,
        ])->whereDate('created_at',$today)->get();

        if(count($attendanceCheck)>0){
            return back()->with('error_message','Attendance Already Submitted !!');
        }else{
            $this->saveAttendance($request);
            return redirect()->route('add-attendance')->with('message','Data added Successfully');
        }
    }

    protected function saveAttendance($request)
    {
        $session = $request->academic_session;
        $classId = $request->class_id;
        $typeId = $request->type_id;
        $batchId = $request->batch_id;
        $attendances = $request->attendance;
        $userId = Auth::user()->id;

        foreach($attendances as $studentId => $attendance){
            $data = new Attendance();
            $data->academic_session = $session;
            $data->class_id = $classId;
            $data->type_id = $typeId;
            $data->batch_id = $batchId;
            $data->student_id = $studentId;
            $data->attendance = $attendance;
            $data->user_id = $userId;
            $data->save();
        }
    }

}
