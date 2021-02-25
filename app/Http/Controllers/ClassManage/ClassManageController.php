<?php

namespace App\Http\Controllers\ClassManage;

use App\ClassName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassName::all();
    	return view('admin.settings.class.class-list',['classes'=>$classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.class.add-form');
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
    		'class_name'=>'required|string|min:4|unique:class_names',
    	]);

    	$data = new ClassName();
    	$data->class_name = $request->class_name;
    	$data->status = 1;
    	$data->save();
    	// Notification...
        $notification=array(
            'messege'=>'Class Add Successfully.',
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
        $class = ClassName::find($id);
    	return view('admin.settings.class.edit-form',['class'=>$class]);
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
        $this->validate($request,[
    		'class_name'=>'required|string|min:4',
    	]);

    	$class = ClassName::findorfail($id);
    	$class->class_name = $request->class_name;
    	$class->save();
        // Notification...
        $notification=array(
            'messege'=>'Class Update Successfully.',
            'alert-type'=>'success'
        );
    	return redirect()->route('classes.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = ClassName::find($id);
    	$class->delete();
    	// Notification...
        $notification=array(
            'messege'=>'Class Is Deleted',
            'alert-type'=>'error'
        );
		return redirect()->back()->with($notification);
    }

    // Class Unpublish
    public function unPublish($id)
    {
    	$classes = ClassName::find($id);
    	$classes->status = 2;
    	$classes->save();
        // Notification...
        $notification=array(
            'messege'=>'Class Unpublished',
            'alert-type'=>'warning'
        );
		return redirect()->back()->with($notification);
    }

    public function publish($id)
    {
    	$classes = ClassName::find($id);
    	$classes->status = 1;
    	$classes->save();
        // Notification...
        $notification=array(
            'messege'=>'Class Published Successfully.',
            'alert-type'=>'success'
        );
		return redirect()->back()->with($notification);
    }
}
