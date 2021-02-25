<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use Illuminate\Http\Request;
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
            'role' => ['required'],
            'name' => ['required', 'string', 'max:50'],
            'mobile' => ['required', 'string', 'min:11', 'max:13', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // User Careate Function
    protected function create(array $data)
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

    // User Registation Foram
    public function ShowRegistationform()
    {
       if(Auth::user()->role=='Admin'){
        return view('admin.users.register-form');
       }
       else{
        return redirect()->back();
       }
    }

    // Create User
    public function UserSave(Request $request)
    {
    	$this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Notification...
        $notification=array(
            'messege'=>'User Registation Successfully.',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    // User List
    public function ShowallUser()
    {
        if (Auth::user()->role=='Admin') {

        $users = User::all();

        return view('admin.users.user-list',compact('users'));
        }
        else{
            return redirect()->back();
        }
    	
    }

    // User Profile
    public function userProfile($id)
    {
        $users = User::findorfail($id);
        return view('Admin.users.profile',compact('users'));
    }

    // User Info
    public function ChageUserInfo($id)
    {
        $Info = User::findorfail($id);
        return view('Admin.users.ChangeUserInfo',compact('Info'));
    }

    // Info Update
    public function UserInfoUpdate(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:50',
            'mobile' => 'required|string|min:11|max:13',
            'email' => 'required|string|email|max:255',
        ]);
        $user = User::findorfail($request->user_id);

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->save();

        return redirect()->to("/user-profile/$request->user_id")->with('message','User Update Successfully.');

    }

    // Profile Change
    public function UserprofileChange($id)
    {
        $users = User::findorfail($id);
        return view('Admin.users.ChangeUserImage',compact('users'));
    }

    // User Profile Add and Update
    public function UpdateUserPhoto(Request $request)
    {
        $users = User::find($request->user_id);

        if (isset($users->avatar)) {
            @unlink(public_path('admin/profile/'.$users->avatar ));
            $this->uploadPhoto($request, $users);
            return redirect()->to("/user-profile/$request->user_id")->with('message','Profile Update Successfully.');
        }else{
            $this->uploadPhoto($request, $users);
            return redirect()->to("/user-profile/$request->user_id")->with('message','Profile Add Successfully.');
        }
    }

    // Password Change
    public function ChangeUserPassword($id)
    {
       $user = User::findorfail($id);
       return view('admin.users.ChangeUserPassword',compact('user'));
    }

    // Password Update
    public function UserPasswordUpdate(Request $request)
    {
        $this->validate($request,[
            'new_password' =>'required|string|min:8'
        ]);

        $oldPassword = $request->password;
        $user = User::findorfail($request->user_id);

        if(Hash::check($oldPassword,$user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->to("/user-profile/$request->user_id")->with('message','Password Update Successfully.');
        }else{
            return redirect()->back()->with('error','Password does Not Match, Please try Again Later!');
        }
    }


}
