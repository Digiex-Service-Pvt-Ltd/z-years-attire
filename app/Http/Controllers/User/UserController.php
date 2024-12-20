<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function register()
    {   
        
    }

    public function save_register_data(Request $request){

        $request->validate([
            "name" => "required",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:6|max:15|same:conf_password",
            "conf_password"=> "required"
        ]);

        $user = new User();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = Hash::make($request["password"]);
        $user->remember_token = $request["_token"];
        $user->save();

        $request->session()->flash('msg', 'Registration completed successfully.');
        // return redirect()->back();

        return redirect()->route('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:6|max:15"
        ]);

        $check = array('email'=>$request->email, 'password'=>$request->password);
        if(Auth::guard('user')->attempt($check)){
            return redirect()->route('user.profile')->with('success', 'Welcome to dashboard.');
        }else{
            return redirect()->back()->with('error', 'Please enter a valid credentials.');
        }

    }

    public function profile(){
        return view('maincontents.user.profile');
    }

    public function logout(){
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }

    public function userPassword(){
        return view('maincontents.user.passwordchange');
    }

    public function passwordChange(Request $request){
        $request->validate([
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|max:15|confirmed',
        ]);

        // Old Password Matched //
        $currentUser = Auth::guard('user')->user();
        $passwordStatus = Hash::check($request->old_password, $currentUser->password);
        if($passwordStatus){
                User::findOrFail($currentUser->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('user.passwordchange')
        ->with('success','Success! Password updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Please enter a valid credentials.');
        }
    }


}
