<?php

namespace App\Http\Controllers\Users;

use Image;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class UserRegistationController extends Controller
{

    // Validation
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role'    => ['required'],
            'name'    => ['required', 'string', 'max:50'],
            'mobile'  => ['required', 'string', 'min:11', 'max:20', 'unique:users'],
            'email'   => ['required', 'string', 'email', 'max:80', 'unique:users'],
            'password'=> ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // User Careate Function
    protected function addNew(array $data)
    {
        return User::create([
            'role' => $data['role'],
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Image Function
    protected function uploadPhoto($request, $users){

        $validation = $request->validate([
             'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|required',
        ]);

        $file = $request->file('image');
        $file_name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(300, 300)->save('public/admin/profile/' . $file_name);
        $users->avatar = $file_name;
        $users->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role=='Admin') {
            $users = User::all();
            return view('admin.users.user-list',compact('users'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role=='Admin'){
            return view('admin.users.register-form');
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->addNew($request->all())));

        // Notification...
        $notification=array(
            'messege'=>'User Registation Successfully.',
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
        $users = User::findorfail($id);
        return view('admin.users.show_user', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        // Notification...
        $notification=array(
            'messege'=>'User Delete Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->route('users.index')->with($notification);
    }

    
    // User Profile Section
    public function userProfile($id)
    {
        $users = User::findorfail($id);
        return view('Admin.users.profile',compact('users'));
    }

    // User Info
    public function ChageInfo($id)
    {
        $Info = User::findorfail($id);
        return view('Admin.users.ChangeUserInfo',compact('Info'));
    }

    // Info Update
    public function InfoUpdate(Request $request)
    {
        $id = $request->user_id;

        $this->validate($request,[
            'name' => 'required|string|max:50',
            'mobile' => 'required|string|min:11|max:13',
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
        ]);
        $user = User::findorfail($id);

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->save();

        // Notification...
        $notification=array(
            'messege'=>'User Update Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->to("user/profile/$id")->with($notification);
    }

    // Profile Change
    public function profileChange($id)
    {
        $users = User::findorfail($id);
        return view('Admin.users.ChangeUserImage',compact('users'));
    }

    // User Profile Add and Update
    public function UpdatePhoto(Request $request)
    {
        $users = User::findorfail($request->user_id);

        if (isset($users->avatar)) {
            @unlink(public_path('admin/profile/'.$users->avatar ));
            $this->uploadPhoto($request, $users);
            // Notification...
            $notification=array(
                'messege'=>'Profile Update Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->to("user/profile/$request->user_id")->with($notification);
        }else{
            $this->uploadPhoto($request, $users);
            // Notification...
            $notification=array(
                'messege'=>'Profile Add Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->to("user/profile/$request->user_id")->with($notification);
        }
    }

    // Password Change
    public function changePassword($id)
    {
       $user = User::findorfail($id);
       return view('admin.users.ChangeUserPassword',compact('user'));
    }
    
    // Password Update
    public function passwordUpdate(Request $request)
    {
        $this->validate($request,[
            'new_password' =>'required|string|min:8'
        ]);

        $oldPassword = $request->password;
        $user = User::findorfail($request->user_id);

        if(Hash::check($oldPassword,$user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            // Notification...
            $notification=array(
                'messege'=>'Password Update Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->to("user/profile/$request->user_id")->with($notification);
        }else{
            $notification=array(
                'messege'=>'Password does Not Match, Please try Again Later!',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
    }

}
