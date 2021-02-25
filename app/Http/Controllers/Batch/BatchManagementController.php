<?php

namespace App\Http\Controllers\Batch;

use App\Batch;
use App\ClassName;
use App\StudentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatchManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassName::all();
    	return view('admin.settings.batch.batch-list',['classes'=>$classes]);
    }

    // Batch List By Ajax
    public function batchListByAjax(Request $request){
        $batches = Batch::where([
            'class_id'=> $request->class_id,
            'student_type_id'=> $request->type_id,
        ])
        ->where('status','!=',3)->get();
        if (count($batches)>0) {
            return view('admin.settings.batch.batch-list-by-ajax',['batches'=>$batches]);
        }else{
            return view('admin.settings.batch.batch-empty-error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassName::all();
    	return view('admin.settings.batch.add-form',['classes'=>$classes]);
    }

    // Class Wise Student
    public function classwiseStudentType(Request $request){
        $types = StudentType::where(['class_id'=>$request->class_id])
            ->where('status','!=',3)->get();
        return view('admin.settings.batch.class-wise-student-type',['types'=>$types]);
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
            'class_id'=>'required',
            'type_id'=>'required',
            'batch_name'=>'required|string|unique:batches',
            'student_capacity'=>'required|integer|max:100',
        ]);
        $batch = new Batch();
        $batch->class_id = $request->class_id;
        $batch->student_type_id = $request->type_id;
        $batch->batch_name = $request->batch_name;
        $batch->student_capacity = $request->student_capacity;
        $batch->status = 1;
        $batch->save();
        // Notification...
        $notification=array(
            'messege'=>'Batch Add Successfully.',
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

    // Batch Unpublish
    public function batchUnpublished(Request $request)
    {
        $batch = Batch::findorfail($request->batch_id);
        $batch->status = 2;
        $batch->save();
        $batches = Batch::where([
            'class_id'=> $request->class_id
        ])->get();
        return view('admin.settings.batch.batch-list-by-ajax',['batches'=>$batches]);
    }

    // Batch Publish
    public function batchPublished(Request $request)
    {
        $batch = Batch::findorfail($request->batch_id);
        $batch->status = 1;
        $batch->save();
        $batches = Batch::where([
            'class_id'=> $request->class_id
        ])->get();
        return view('admin.settings.batch.batch-list-by-ajax',['batches'=>$batches]);
    }

    public function batchDelete(Request $request)
    {
        $batch = Batch::findorfail($request->batch_id);
        $batch->delete();
        $batches = Batch::where([
            'class_id'=> $request->class_id
        ])->get();

       if (count($batches)>0) {
          return view('admin.settings.batch.batch-list-by-ajax',['batches'=>$batches]);
       }else{
        return view('admin.settings.batch.batch-empty-error');
       }
    }

    public function batchEdit($id)
    {
        $batch = Batch::find($id);
        $classes = ClassName::all();
        return view('admin.settings.batch.batch-edit-form',[
            'batch'=>$batch,
            'classes'=>$classes
        ]);
    }

    public function batchUpdate(Request $request)
    {
        $this->validate($request, [
            'class_id'=>'required',
            'type_id'=>'required',
            'batch_name'=>'required|string|unique:batches',
            'student_capacity'=>'required|max:2',
        ]);

        $batch = Batch::findorfail($request->batch_id);
        $batch->class_id = $request->class_id;
        $batch->student_type_id = $request->type_id;
        $batch->batch_name = $request->batch_name;
        $batch->student_capacity = $request->student_capacity;
        $batch->save();
        // Notification...
        $notification=array(
            'messege'=>'Batch Update Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->route('batches.index')->with($notification);
    }
}
