<?php

namespace App\Http\Controllers\Header_footer;

use App\HeaderFooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HeaderFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.add-Header-Footer-form');
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
            'institute_name'=>'required|max:150',
            'title'=>'required|max:100|min:8',
            'address'=>'required|max:255',
            'mobile'=>'required|max:20|min:11',
            'email'=>'required|max:80',
            'copyright'=>'required|max:100',
        ]);

        $data = new HeaderFooter();
    	$data->institute_name = $request->institute_name;
    	$data->title = $request->title;
    	$data->address = $request->address;
    	$data->mobile = $request->mobile;
    	$data->email = $request->email;
    	$data->copyright = $request->copyright;
    	$data->status = $request->status;
    	$data->save();
        // Notification...
        $notification=array(
            'messege'=>'Header And Footer Add Successfully.',
            'alert-type'=>'success'
        );
    	return redirect()->route('home')->with($notification);
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
        $headerFooter = HeaderFooter::find($id);
        return view('admin.home.Manage-Header-Footer-form',['headerFooter'=>$headerFooter]);
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
            'institute_name'=>'required|max:150',
            'title'=>'required|max:100|min:8',
            'address'=>'required|max:255',
            'mobile'=>'required|max:20|min:11',
            'email'=>'required|max:80',
            'copyright'=>'required|max:100',
        ]);

        $headerFooter = HeaderFooter::find($id);
        $headerFooter->institute_name = $request->institute_name;
        $headerFooter->title = $request->title;
        $headerFooter->address = $request->address;
        $headerFooter->mobile = $request->mobile;
        $headerFooter->email = $request->email;
        $headerFooter->copyright = $request->copyright;
        $headerFooter->save();
        // Notification...
        $notification=array(
            'messege'=>'Header And Footer Updated Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->route('home')->with($notification);
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
}
