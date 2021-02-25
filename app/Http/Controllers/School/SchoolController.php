<?php

namespace App\Http\Controllers\School;

use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
    	return view('admin.settings.school.school-list',['schools'=>$schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.school.add-form');
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
    		'school_name'=>'required|unique:schools|string|min:4',
    	]);

    	$data = new School();
    	$data->school_name = $request->school_name;
    	$data->status = 1;
    	$data->save();
		// Notification...
        $notification=array(
            'messege'=>'School Add Successfully.',
            'alert-type'=>'success'
        );	
		// Redirect
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
        $school = School::findorfail($id);
    	return view('admin.settings.school.edit-form',['school'=>$school]);
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
    		'school_name'=>'required|string|min:4',
    	]);

    	$school = School::find($id);
    	$school->school_name = $request->school_name;
    	$school->save();
        // Notification...
        $notification=array(
            'messege'=>'School Name Update Successfully.',
            'alert-type'=>'success'
        );	
		// Redirect
		return redirect()->route('schools.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
    	$school->delete();
        // Notification...
        $notification=array(
            'messege'=>'School Name Deleted ',
            'alert-type'=>'warning'
        );
		return redirect()->back()->with($notification);
    }

    // School Active
    public function schoolUnpublish($id)
    {
    	$schools = School::findorfail($id);
    	$schools->status = 2;
    	$schools->save();
        // Notification...
        $notification=array(
            'messege'=>'School Unpublished',
            'alert-type'=>'warning'
        );	
    	return redirect()->back()->with($notification);
    }

    // School Inactive
    public function schoolPublish($id)
    {
    	$schools = School::findorfail($id);
    	$schools->status = 1;
    	$schools->save();
         // Notification...
        $notification=array(
            'messege'=>'School Published Successfully.',
            'alert-type'=>'success'
        );
    	return redirect()->back()->with($notification);
    }
}
