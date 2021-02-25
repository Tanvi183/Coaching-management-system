<?php

namespace App\Http\Controllers\Slider;

use Image;
use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    // Image Function
    protected function slideImageUpload($request)
    {
        $file = $request->file('slide_image');
        $file_name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(1400, 500)->save('public/Slider/' . $file_name);
        return $file_name;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slider.manage-slider',['slides'=>$slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.slider-add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slide_image'=>'required|mimes:jpeg,bmp,png',
            'slide_title'=>'required',
            'slide_description'=>'required',
            'status'=>'required',
        ]);

    	$data = new Slide;
    	$data->slide_image = $this->slideImageUpload($request);
    	$data->slide_title = $request->slide_title;
    	$data->slide_description = $request->slide_description;
    	$data->status = $request->status;
    	$data->save();
        // Notification...
        $notification=array(
            'messege'=>'Slider Add Successfully.',
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
        $slides = Slide::find($id);
        return view('admin.slider.slider-edit-form',compact('slides'));
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
        $validatedData = $request->validate([
            'slide_image'=>'mimes:jpeg,bmp,png',
            'slide_title'=>'required',
            'slide_description'=>'required',
            'status'=>'required',
        ]);

        $slides = Slide::find($id);
        $slides->slide_title = $request->slide_title;
        $slides->slide_description = $request->slide_description;
        $slides->status = $request->status;
        if ($request->file('slide_image')) {
            @unlink(public_path('Slider/'.$slides->slide_image));
            $slides->slide_image = $this->slideImageUpload($request);
        }
        $slides->save();
        // Notification...
        $notification=array(
            'messege'=>'Slider Update Successfully.',
            'alert-type'=>'success'
        );
    	return redirect()->route('sliders.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slides = Slide::find($id);
        @unlink(public_path('Slider/'.$slides->slide_image));
        $slides->delete();
        // Notification...
        $notification=array(
            'messege'=>'Slide Delete Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    // Slider Inactive
    public function slideUnpublish($id)
    {
        $slide = Slide::findorfail($id);
        $slide->status = 2;
        $slide->save();
        // Notification...
        $notification=array(
            'messege'=>'Slider Unpublished ',
            'alert-type'=>'warning'
        );
        return redirect()->back()->with($notification);
    }

    // Slider Active
    public function slidePublish($id)
    {
        $slide = Slide::findorfail($id);
        $slide->status = 1;
        $slide->save();
        // Notification...
        $notification=array(
            'messege'=>'Slider Published Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    // Photo Gallery
    public function photoGallery()
    {
        $slides = Slide::all();
        return view('admin.slider.photo-gallery',['slides'=>$slides]);
    }
}
