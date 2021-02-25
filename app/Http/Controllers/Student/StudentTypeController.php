<?php

namespace App\Http\Controllers\Student;

use App\ClassName;
use App\StudentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentTypeController extends Controller
{
    // Student Type
    protected function getStudentType()
    {
        $studenttype = DB::table('student_types')
        ->join('class_names','student_types.class_id','=','class_names.id')
        ->select('student_types.*','class_names.class_name')
        ->where('student_types.status','!=',3)
        ->get();

        return $studenttype;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.studentType.student-type-table',[
        	'studenttype'=>$studenttype,
        	'classes'=>$classes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.studentType.student-type-list',[
        	'studenttype'=>$studenttype,
        	'classes'=>$classes,
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
        $this->validate($request,[
    		'student_type'=>'required|string',
    	]);

    	// if ($request->ajax()) {
	    	$data = new StudentType();
	    	$data->class_id = $request->class_id;
	    	$data->student_type = $request->student_type;
	    	$data->status = 1;
	    	$data->save();
    	// }
         // Notification...
         $notification=array(
            'messege'=>'StudentType Add Successfully.',
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    // Student Type Unpublish
    public function studentTypeUnpublish(Request $request)
    {
        $data = StudentType::find($request->type_id);
        $data->status = 2;
        $data->save();

        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.studentType.student-type-table',[
            'studenttype'=>$studenttype,
            'classes'=>$classes,
        ]);
    }

    // Student Type Publish
    public function studentTypePublish(Request $request)
    {
        $data = StudentType::find($request->type_id);
        $data->status = 1;
        $data->save();

        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.studentType.student-type-table',[
            'studenttype'=>$studenttype,
            'classes'=>$classes,
        ]);
    }

    // Student Type Update
    public function studentTypeUpdate(Request $request)
    {
        $data = StudentType::find($request->type_id);
        $data->student_type = $request->student_type;
        $data->save();

        // $studenttype = $this->getStudentType();
        // $classes = ClassName::all();
        // return view('admin.settings.studentType.student-type-table',[
        //     'studenttype'=>$studenttype,
        //     'classes'=>$classes,
        // ]);
        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
         // Notification...
         $notification=array(
            'messege'=>'Student Type Update Successfully.',
            'alert-type'=>'success'
        );
        return view('admin.settings.studentType.student-type-list', compact('studenttype','classes'))->with($notification);
    }

    // Student Type Delete
    public function studentTypeDelete(Request $request)
    {
        $data = StudentType::find($request->type_id);
        $data->status = 3;
        $data->save();

        $studenttype = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.studentType.student-type-table',[
            'studenttype'=>$studenttype,
            'classes'=>$classes,
        ]);
    }
}
