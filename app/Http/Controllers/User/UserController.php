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
        return redirect()->back();
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


}
