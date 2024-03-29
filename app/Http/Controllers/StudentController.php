<?php

namespace App\Http\Controllers;

use Image;
use App\Batch;
use App\School;
use App\Student;
use App\ClassName;
use App\StudentType;
use App\StudenttypeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Validation
    protected function studentValidation($request){
        $this->validate($request,[
            'student_name'=>'required|max:120',
            'school_id'=>'required',
            'class_id'=>'required',
            'father_name'=>'required|max:90',
            'mother_name'=>'required|max:90',
            'email_address'=>'required|max:255|unique:students',
            'sms_mobile'=>'required|max:15',
            'date_of_admission'=>'required',
            'student_photo'=>'image|mimes:jpg,bmp,png|max:10240',
            'address'   => 'required|max:255',
            'batch_id'  => 'required',
        ]);
    }

    protected function studentImageUpload($request)
    {
        $image = $request->file('student_photo');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.".".$ext;
            $upload_path = 'public/students/';
            $image_url = $upload_path.$image_full_name;
            Image::make($image)->save($image_url);
            Image::make($image)->resize(300, 300)->save($image_url);
            return $image_url;
        }
    }

    // Show Single Student
    protected function getSingleStudent($id)
    {
        $students = DB::table('students')
            ->join('schools','students.school_id','=','schools.id')
            ->join('class_names','students.class_id','=','class_names.id')
            ->join('studenttype_details','studenttype_details.student_id','=','students.id')
            ->join('student_types','studenttype_details.type_id','=','student_types.id')
            ->join('batches','studenttype_details.batch_id','=','batches.id')
            ->select('students.*','schools.school_name','studenttype_details.roll_on','batches.batch_name','class_names.class_name','student_types.student_type')
            ->where([
                // 'students.status'=>1,
                'students.id'=>$id,
            ])
            ->orderBy('studenttype_details.type_id','ASC')->get();
        return $students;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('students')
            ->join('schools','students.school_id','=','schools.id')
            ->join('class_names','students.class_id','=','class_names.id')
            ->select('students.*','schools.school_name','class_names.class_name')
            ->where([
                'students.status'=>1
            ])
            ->orderBy('students.class_id','ASC')->get();

        return view('admin.student.all-running-students',['students'=>$students]);
    }

    // Past All Student
    public function allPastStudent()
    {
        $students = DB::table('students')
            ->join('schools','students.school_id','=','schools.id')
            ->join('class_names','students.class_id','=','class_names.id')
            ->select('students.*','schools.school_name','class_names.class_name')
            ->where([
                'students.status'=>2
            ])
            ->orderBy('students.class_id','ASC')->get();

        return view('admin.student.all-past-students',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::where('status','=',1)->get();
    	$classes = ClassName::where('status','=',1)->get();
    	return view('admin.student.registation.registation-form',[
    		'schools'=>$schools,
    		'classes'=>$classes,
    	]);
    }


    public function bringStudentType(Request $request)
    {
    	$types = StudentType::where('class_id','=',$request->class_id)->get();
        $classes = ClassName::where('status','=',1)->get();
    	return view('admin.student.registation.student-type',[
    		'types'=>$types,
            'classes'=>$classes,
            'data'=>$request,
    	]);
    }

    public function batchRollForm(Request $request)
    {
        $batches = Batch::where([
            'class_id'=> $request->class_id,
            'student_type_id' => $request->type_id,
        ])->get();
        $type = StudentType::find($request->type_id);
        return view('admin.student.registation.batch-roll-form',[
            'batches'=>$batches,
            'type'=>$type,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->studentValidation($request);

        $students = new Student();
        $students->student_name = $request->student_name;
        $students->school_id = $request->school_id;
        $students->class_id = $request->class_id;
        $students->father_name = $request->father_name;
        $students->mother_name = $request->mother_name;
        $students->email_address = $request->email_address;
        $students->sms_mobile = $request->sms_mobile;
        $students->date_of_admission = $request->date_of_admission;
        $students->student_photo = $this->studentImageUpload($request);
        $students->address = $request->address;
        $students->status = 1;
        $students->user_id = Auth::user()->id;
        $students->password = $request->sms_mobile;
        $students->encripted_password = Hash::make($request->sms_mobile);
        $students->save();

        $studentId = $students->id;
        $batches = $request->batch_id;
        $rolls = $request->roll;

        $studentTypes = $request->student_type;
        foreach ($studentTypes as $key => $studentType) {
            $data = new StudenttypeDetails();
            $data->student_id = $studentId;
            $data->class_id = $request->class_id;
            $data->type_id = $key;
            $data->batch_id = $batches[$key];
            $data->roll_on = $rolls[$key];
            $data->type_status = 1;
            $data->save();
        }
        // Notification...
        $notification=array(
            'messege'=>'Student Add Successfully.',
            'alert-type'=>'success'
        );
    	return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function studentDetails($id)
    {
        $students= $this->getSingleStudent($id);
        $schools = School::all();
        return view('admin.student.details.profile',[
            'students'=>$students,
            'schools'=>$schools,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function uploadPhoto($request,$student){
        $image = $request->file('student_photo');
		$filename  = time() . '.' . $image->getClientOriginalExtension();
		$path = public_path('students/' . $filename);
		Image::make($image->getRealPath())->resize(468, 249)->save($path);
		$student->student_photo = 'public/students/'.$filename;
		$student->save();
    }

    protected function updateStudentPhoto($request)
    {
        $student = Student::find($request->student_id);
        if (isset($student->student_photo)) {
            @unlink($student->student_photo);
            $this->uploadPhoto($request,$student);
        }else{
            $this->uploadPhoto($request,$student);
        }
    }

    public function BasicInfoUpdate(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->student_name = $request->student_name;
        $student->school_id = $request->school_id;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->email_address = $request->email_address;
        $student->sms_mobile = $request->sms_mobile;

        if (isset($request->student_photo)) {
            $this->updateStudentPhoto($request);
        }

        $student->address = $request->address;
        $student->password = $request->sms_mobile;
        $student->encripted_password = Hash::make($request->sms_mobile);
        $student->save();

        return $this->studentDetails($request->student_id)->with('message','Student Information Update Successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function classwiseStudent()
    {
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.class.class-selection-form',['classes'=>$classes]);
    }

    public function batchWiseStudent()
    {
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.batch.batch-selection-form',['classes'=>$classes]);
    }

    public function classWiseStudentType(Request $request)
    {
        $classId = $request->class_id;
        $types = StudentType::where([
            'class_id'=>$classId,
            'status'=>1,
        ])->get();

        return view('admin.student.class.student-type',[
            'types'=>$types,
        ]);
    }

    public function classAndTypeWiseStudent(Request $request)
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
                'studenttype_details.type_status'=>1,
            ])
            ->orderBy('studenttype_details.roll_on','ASC')->get();

        return view('admin.student.class.student-list',['students'=>$students]);
    }

    public function classAndTypeWiseBatchList(Request $request)
    {
        $batches = Batch::where([
            'class_id'=>$request->class_id,
            'student_type_id'=>$request->type_id,
            'status'=>1,
        ])->get();

        return view('admin.student.batch.batch-list',['batches'=>$batches]);
    }

    public function batchWiseStudentList(Request $request)
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

        return view('admin.student.batch.student-list',['students'=>$students]);
    }

    public function classSelectionForm()
    {
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.class.class-selection-form',['classes'=>$classes]);
    }

    // Student Type Unpublish
    public function studentUnpublish($id)
    {
        $student = Student::findorfail($id);
        $student->status = 2;
        $student->save();
        // Notification...
        $notification=array(
            'messege'=>'Student Unpublished ',
            'alert-type'=>'warning'
        );
        return redirect()->back()->with($notification);
    }

    // Student  Unpublish
    public function studentPublish($id)
    {
        $student = Student::findorfail($id);
        $student->status = 1;
        $student->save();
        // Notification...
        $notification=array(
            'messege'=>'Student Publish Successfully ',
            'alert-type'=>'warning'
        );
        return redirect()->back()->with($notification);
    }

    // All Student
    public function allStudent()
    {
        $students = DB::table('students')
            ->join('schools','students.school_id','=','schools.id')
            ->join('class_names','students.class_id','=','class_names.id')
            ->select('students.*','schools.school_name','class_names.class_name')
            ->orderBy('students.class_id','ASC')->get();

        return view('admin.student.all-students',['students'=>$students]);
    }


}
